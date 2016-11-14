var icon_image = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';

function addMark(location){
  icon_image = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
  marker = new google.maps.Marker({
    position: location,
    map: map,
    draggable: true,
    customInfo: count,
    title: location_trans + ' ' + count,
    icon: icon_image
  });
  add_location(JSON.parse(JSON.stringify(location)));
  openInfoWindow(marker);
  count++;
  google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
  google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser does not support geolocation.');
}

function openInfoWindow(marker) {
    infowindow.close();
    infowindow = new google.maps.InfoWindow();
    var markerLatLng = marker.getPosition();
    infowindow.setContent('<div class="lat-lng"><strong>' + location_trans + ' ' + marker.customInfo +':</strong><br><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Long:</strong><br>' + markerLatLng.lng() +'</div>');
    infowindow.open(map, marker);
    google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
    google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });    
}

function changeInfoWindow(marker) {
    var markerLatLng = marker.getPosition();
    var loc_change = {lat: markerLatLng.lat(), lng: markerLatLng.lng() };
    infowindow.setContent('<div class="lat-lng"><strong>' + location_trans + ' ' + marker.customInfo +':</strong><br><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Long:</strong><br>' + markerLatLng.lng() +'</div>');
    infowindow.open(map, marker);
    $('#lat_'+marker.customInfo).val(loc_change.lat);
    $('#lng_'+marker.customInfo).val(loc_change.lng);
}

function add_location(loc) {

  $('#locations_table').show();

  var input = document.createElement("input");
  var tr    = document.createElement("TR");
  var td    = document.createElement("TD");  

  input.type  = 'text';
  input.name  = 'address[]';
  input.className = 'form-control',
  input.id    = 'address_input_' + (count);  
  input.setAttribute('required', 'required');

  var input1 = document.createElement("input");
  var td1    = document.createElement("TD");

  input1.type  = 'text';
  input1.name  = 'lat[]';
  input1.className = 'form-control',
  input1.id    = 'lat_' + (count); 
  input1.value = loc.lat;

  var input2 = document.createElement("input");
  var td2    = document.createElement("TD");

  input2.type  = 'text';
  input2.name  = 'lng[]';
  input2.className = 'form-control',
  input2.id    = 'lng_' + (count); 
  input2.value = loc.lng;

  if(edit){
    var input3 = document.createElement("input");
    input3.type  = 'hidden';
    input3.name  = 'location_id[]';
    input3.value = 0;
  }

  var td3    = document.createElement("TD");

  button               = document.createElement('button');
  button.className     = 'btn btn-round btn-danger btn-xs delete-location';

  var icon               = document.createElement('i');
  icon.style.cursor  = 'pointer';
  icon.className     = 'fa fa-trash';
  
  button.appendChild(icon);

  td.appendChild(input);
  td1.appendChild(input1);
  td2.appendChild(input2);
  if(edit){
    td.appendChild(input3);
  }
  td3.appendChild(button);

  tr.appendChild(td); 
  tr.appendChild(td1); 
  tr.appendChild(td2); 
  tr.appendChild(td3); 

  container = document.getElementById('locations_list');
  container.appendChild(tr); 

  document.getElementById('lat_' + count).readOnly = true;
  document.getElementById('lng_' + count).readOnly = true;

}

function initMap() {
  map = new google.maps.Map(document.getElementById('map-form'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 14,
    styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
  });

  infowindow = new google.maps.InfoWindow({map: map});

  // Try HTML5 geolocation.
  if(!edit){
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        infowindow.setPosition(pos);
        infowindow.setContent(location_label);
        map.setCenter(pos);
        }, function() {
          handleLocationError(true, infowindow, map.getCenter());
        });
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infowindow, map.getCenter());
    }
  }

  var input = (document.getElementById('address_search'));
  // country default system
  var options = {componentRestrictions: {country: country_default}};
  autocomplete = new google.maps.places.Autocomplete(input, options);
  autocomplete.bindTo('bounds', map);
  autocomplete.setTypes(['geocode']);

  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    customInfo: count,
    title: location_trans + ' ' + count,
    icon: icon_image
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(16);  
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    addMark({lat: place.geometry.location.lat(), lng: place.geometry.location.lng()});
    document.getElementById('address_search').value = '';

  });

  if(edit){
    locations_old = JSON.parse(locations);
    var count_old = 1;

    $.each(locations_old, function(index, item) {

      icon_image = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
      if(count_old == 1) { 
        icon_image = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
        map.setCenter(new google.maps.LatLng(item['lat'], item['lng']));
        map.setZoom(15);  
      } 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(item['lat'], item['lng']),
        map: map,
        draggable: true,
        customInfo: count_old,
        title: location_trans + ' ' + count_old,
        icon: icon_image
      });

      openInfoWindow(marker);
      infowindow.close();
      count_old++;

    });
    
  }

  google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
  google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });
  google.maps.event.addListener(map, 'click', function(event) {addMark(event.latLng); });

}

$(document).on('click', '.delete-location', function () {
    var row = $(this).closest('tr');
    row.remove();
});

$(document).ready(function() {
    initMap();
});