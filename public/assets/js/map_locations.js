function addMark(location){
  marker = new google.maps.Marker({
    position: location,
    map: map,
    draggable: true,
    customInfo: count,
    title: location_trans + ' ' + count,
    icon: icon_map
  });
  add_location(JSON.parse(JSON.stringify(location)));
  openInfoWindow(marker);
  count++;
  google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
  google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  notify('error', error_geolocation);
}

function openInfoWindow(marker) {
    infowindow.close();
    infowindow = new google.maps.InfoWindow();
    var markerLatLng = marker.getPosition();
    infowindow.setContent('<div class="lat-lng"><strong>' + location_trans + ' ' + marker.customInfo +':</strong></div>');
    infowindow.open(map, marker);
    google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
    google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });    
}

function changeInfoWindow(marker) {
    var markerLatLng = marker.getPosition();
    var loc_change = {lat: markerLatLng.lat(), lng: markerLatLng.lng() };
    infowindow.setContent('<div class="lat-lng"><strong>' + location_trans + ' ' + marker.customInfo +':</strong></div>');
    infowindow.open(map, marker);
    $('#lat_'+marker.customInfo).val(loc_change.lat);
    $('#lng_'+marker.customInfo).val(loc_change.lng);
}

function add_location(loc) {

  var tr    = document.createElement("TR");
  tr.className = 'row-loc' + (count); 

  var tr1    = document.createElement("TR");
  tr1.className = 'row-loc' + (count);   

  var td1    = document.createElement("TD");
  var select1 = document.createElement("select");

  select1.name  = 'locations_labels[]';
  select1.className = 'form-control',
  $.each(select_option, function(index, value) { 
    var option = document.createElement("option");
    option.value = index;
    option.text = value;
    select1.appendChild(option);
  });

  var tr2    = document.createElement("TR");
  tr2.className = 'row-loc' + (count); 

  var td2    = document.createElement("TD");
  var input2 = document.createElement("input");

  input2.type  = 'text';
  input2.name  = 'address[]';
  input2.className = 'form-control';
  input2.id    = 'address_input_' + (count);  
  input2.setAttribute('required', 'required');

  var inputid = document.createElement("input");
  inputid.type  = 'hidden';
  inputid.name  = 'location_id[]';
  inputid.value = 0;
  
  var input3 = document.createElement("input");
  input3.type  = 'hidden';
  input3.name  = 'lat[]';
  input3.className = 'form-control';
  input3.id    = 'lat_' + (count); 
  input3.value = loc.lat;

  var input4 = document.createElement("input");
  input4.type  = 'hidden';
  input4.name  = 'lng[]';
  input4.className = 'form-control';
  input4.id    = 'lng_' + (count); 
  input4.value = loc.lng;

  var tr3    = document.createElement("TR");
  tr3.className = 'row-loc' + (count); 

  var td5    = document.createElement("TD");
  var input5 = document.createElement("input");

  input5.type  = 'text';
  input5.name  = 'description[]';
  input5.className = 'form-control'; 

  var tr4    = document.createElement("TR");
  tr4.className = 'row-loc' + (count);
  
  var td6    = document.createElement("TD");

  span             = document.createElement('span');
  span.className   = 'label label-warning';
  var text_span = document.createTextNode(lang.on_hold); 
  
  span.appendChild(text_span);

  var tr5    = document.createElement("TR");
  tr5.className = 'row-loc' + (count); 

  var td7    = document.createElement("TD");

  button             = document.createElement('button');
  button.className   = 'btn btn-round btn-danger delete-location';
  button.setAttribute('data-row', 'row-loc' + count);
  var icon           = document.createElement('i');
  icon.style.cursor  = 'pointer';
  icon.className     = 'fa fa-trash';
  
  button.appendChild(icon);

  var td    = document.createElement("TD");
  var text = document.createTextNode(address_trans +' '+ count); 

  td.appendChild(text);
  td1.appendChild(select1);
  td2.appendChild(input2);
  td2.appendChild(inputid);
  td2.appendChild(input3);
  td2.appendChild(input4);
  td5.appendChild(input5);
  td6.appendChild(span);
  td7.appendChild(button);
 
  container = document.getElementById('locations_list');

  tr.appendChild(td); 
  tr1.appendChild(td1); 
  tr2.appendChild(td2); 
  tr3.appendChild(td5); 
  tr4.appendChild(td6); 
  tr5.appendChild(td7); 

  container.appendChild(tr);
  container.appendChild(tr1);
  container.appendChild(tr2);
  container.appendChild(tr3);
  container.appendChild(tr4);
  container.appendChild(tr5);
   
  //document.getElementById('lat_' + count).readOnly = true;
  //document.getElementById('lng_' + count).readOnly = true;
}

function initMap() {
  map = new google.maps.Map(document.getElementById('map-form'), {
    center: map_center,
    zoom: 14,
    styles: [{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}]
  });

  infowindow = new google.maps.InfoWindow({map: map});

  // Try HTML5 geolocation.
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
    icon: icon_map
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      notify('warning', dont_found_your_location);
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

  locations_old = JSON.parse(locations);
  var count_old = 1;

  $.each(locations_old, function(index, item) {

    marker = new google.maps.Marker({
      position: new google.maps.LatLng(item['lat'], item['lng']),
      map: map,
      draggable: true,
      customInfo: count_old,
      title: location_trans + ' ' + count_old,
      icon: icon_map
    });

    openInfoWindow(marker);
    infowindow.close();
    count_old++;

  });
    
  google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
  google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });
  google.maps.event.addListener(map, 'click', function(event) {addMark(event.latLng); });

}

$(document).on('click', '.delete-location', function () {
    var row = $(this).data('row');
    $('.'+row).remove();
});
