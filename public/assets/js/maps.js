var map = null;
var infowindow = null;
var i = 1;
/*
var componentForm = {
  locality: 'long_name',
  postal_code: 'short_name'
};
*/

function openInfoWindow(marker) {
    var markerLatLng = marker.getPosition();
    infowindow.setContent('<div class="lat-lng"><strong>address ' + i +':</strong><br><strong>Latitude:</strong><br> ' + markerLatLng.lat() + '<br><strong>Longitude:</strong><br>' + markerLatLng.lng()+'</div>');
    infowindow.open(map, marker);
    i++;
}

function initMap() {
  map = new google.maps.Map(document.getElementById('map-form'), {
    center: {lat: 40.438, lng: -3.679},
    zoom: 8,
    styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]
  });
  var input = (document.getElementById('address_search'));
  // country default system
  var options = {componentRestrictions: {country: 'es'}};

  autocomplete = new google.maps.places.Autocomplete(input, options);
  autocomplete.bindTo('bounds', map);
  autocomplete.setTypes(['geocode']);

  infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    draggable: true,
    anchorPoint: new google.maps.Point(0, -29),
    title: 'address '+ i
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
      map.setZoom(17);  // Why 17? Because it looks good.
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div class="lat-lng"><strong>Latitude:</strong><br> ' + place.geometry.location.lat() + '<br><strong>Longitude:</strong><br>' + place.geometry.location.lng() +'</div>');
    infowindow.open(map, marker);
    $('#lat').val(place.geometry.location.lat());
    $('#lng').val(place.geometry.location.lng());
    //fillInAddress();
  });

  google.maps.event.addListener(marker, 'dragend', function(){ openInfoWindow(marker); });
  google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });
  google.maps.event.addListener(map, 'click', function(event) {addMark(event.latLng); });

}

function addMark(location){
  marker = new google.maps.Marker({
    position: location,
    map: map,
    title: 'address '+ i
  });
  openInfoWindow(marker);
}

/*
function fillInAddress() {

  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
  }

  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
*/


$(document).ready(function() {
    initMap();
});