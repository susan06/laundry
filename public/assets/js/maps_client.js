function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser does not support geolocation.');
  infowindow.open(map, marker);
}


function openInfoWindow(marker) {
    infowindow.close();
    infowindow = new google.maps.InfoWindow();
    var markerLatLng = marker.getPosition();
    infowindow.setContent('<div class="lat-lng"><strong>' + location_label +':</strong><br><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Long:</strong><br>' + markerLatLng.lng() +'</div>');
    infowindow.open(map, marker); 
}

function changeInfoWindow(marker) {
    var markerLatLng = marker.getPosition();
    var loc_change = {lat: markerLatLng.lat(), lng: markerLatLng.lng() };
    infowindow.setContent('<div class="lat-lng"><strong>' +location_label +':</strong><br><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Long:</strong><br>' + markerLatLng.lng() +'</div>');
    infowindow.open(map, marker);
    $('#lat').val(loc_change.lat);
    $('#lng').val(loc_change.lng);
    geocoder(loc_change);
}

function processGeocoder(results, status){

  if (status == google.maps.GeocoderStatus.OK) {
    if (results[0]) {
      document.getElementById('delivery_address').value = results[0].formatted_address;
    } else {
      document.getElementById('delivery_address').placeholder = 'Ingrese su dirección';
    }
  } else {
    infowindow = new google.maps.InfoWindow({map: map});
    infowindow.setPosition(map.getCenter());
    infowindow.setContent("Geocoding fallo debido a : " + status);
  }
}

function geocoder(geo) {
  var geocoder = new google.maps.Geocoder();
  var yourLocation = new google.maps.LatLng(geo.lat, geo.lng);
  geocoder.geocode({ 'latLng': yourLocation }, processGeocoder);
}

function initMap() {
  map = new google.maps.Map(document.getElementById('map-form'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 16,
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

      infowindow.close();
      map.setCenter(new google.maps.LatLng(position.coords.latitude,position.coords.longitude));

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        map: map,
        draggable: true,
        title: location_label,
        icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
      });

      google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
      google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });

      $('#lat').val(position.coords.latitude);
      $('#lng').val(position.coords.longitude);

      geocoder(pos);
      
      }, function() {
        handleLocationError(true, infowindow, map.getCenter());
      });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infowindow, map.getCenter());
  }

}

$(document).ready(function() {
    initMap();
});