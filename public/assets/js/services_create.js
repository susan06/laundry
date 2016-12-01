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
    infowindow.setContent('<div class="lat-lng"><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Long:</strong><br>' + markerLatLng.lng() +'</div>');
    infowindow.open(map, marker); 
}

function changeInfoWindow(marker) {
    var markerLatLng = marker.getPosition();
    var loc_change = {lat: markerLatLng.lat(), lng: markerLatLng.lng() };
    infowindow.setContent('<div class="lat-lng"><strong>' +location_label +'</strong></div>');
    //infowindow.setContent('<div class="lat-lng"><strong>' +location_label +':</strong><br><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Long:</strong><br>' + markerLatLng.lng() +'</div>');
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

function changeLocation(location){

  infowindow.close();
  marker.setVisible(false);
  marker.setPosition(location);
  marker.setVisible(true);
  var markerLatLng = marker.getPosition();

  $('#lat').val(markerLatLng.lat());
  $('#lng').val(markerLatLng.lng());

  var geo_Loc = {lat: markerLatLng.lat(), lng: markerLatLng.lng() }

  geocoder(geo_Loc);
}

function initMap() {
  map = new google.maps.Map(document.getElementById('map-form'), {
    center: map_center,
    zoom: 16,
    disableDefaultUI: true,
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
      map.setZoom(16);  

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        map: map,
        draggable: true,
        title: location_label,
        icon: icon_map
      });

      var input = (document.getElementById('delivery_address'));
      var options = {componentRestrictions: {country: country_default}};
      autocomplete = new google.maps.places.Autocomplete(input, options);
      autocomplete.bindTo('bounds', map);
      autocomplete.setTypes(['geocode']);

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

        $('#lat').val(place.geometry.location.lat());
        $('#lng').val(place.geometry.location.lng());

      });

      google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
      google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });
      google.maps.event.addListener(map, 'click', function(event) {changeLocation(event.latLng); });

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

var add_cart = 0;

function add_package(package, prices) {

   $('#packages_table').show();

    var input = document.createElement("input");
    var tr    = document.createElement("TR");
    var td    = document.createElement("TD");  

    var text_name = document.createTextNode(package.name); 

    input.type  = 'hidden';
    input.name  = 'packages[]';
    input.value = package.id;

    td.appendChild(input);
    td.appendChild(text_name);

    var td1    = document.createElement("TD"); 
    var text_category = document.createTextNode($('#category option:selected').text()); 
    td1.appendChild(text_category);

    var td2    = document.createElement("TD"); 

    $.each(prices, function(index, item) { 
      var span    = document.createElement("span"); 
      span.className = 'prices list_price_'+item.delivery_schedule;
      var price = document.createTextNode(item.price); 
      span.appendChild(price);    
      td2.appendChild(span);               
    });

    var td3    = document.createElement("TD");

    button               = document.createElement('button');
    button.className     = 'btn btn-round btn-danger btn-md delete-package';

    var icon               = document.createElement('i');
    icon.style.cursor  = 'pointer';
    icon.className     = 'fa fa-trash';
    
    button.appendChild(icon);
    td3.appendChild(button);

    tr.appendChild(td); 
    tr.appendChild(td1); 
    tr.appendChild(td2);
    tr.appendChild(td3);  

    container = document.getElementById('packages_list');
    container.appendChild(tr); 

    $("#category").val('');
    add_cart++;
    show_price_by_time();
};

function show_price_by_time(){
    var time_selected = $('#time_delivery option:selected').val();
    if(time_selected) {
      $('.prices').hide();
      $('.list_price_'+time_selected).show();
    }  
    if(add_cart > 0) {
      total();
    }
}

function total() {
  if(add_cart > 0) {
  var time_selected = $('#time_delivery option:selected').val();  
  var sum = 0;       
    $("#packages_list tr").each( function() {       
      var price = $(this).find('td:eq(2) span.list_price_'+time_selected);
      if (price.text() != null) {
        sum += parseFloat(price.text());
      }             
    })   
    $("#total").text(sum.toFixed(2).toString());   
  }
}   

$(document).on('click', '.add-cart', function () {
  var $this = $(this);
  $.ajax({
      url: url_package_get_details,
      type:'GET',
      data: {'id': $this.attr('id') },
      success: function(response) {
          if(response.success){
              $this.addClass('not_clic');
              $('.add-cart > div.mask').hide();
              add_package(JSON.parse(response.details), JSON.parse(response.prices));
          } else {
              notify('error', response.message);
          }
         
      }
  });
});

$(document).on('change', '#category', function () {
  var $this = $(this);
  if($this.val()) {
    $.ajax({
        url: url_package_show_category,
        type:'GET',
        data: {'category': $this.val() },
        success: function(response) {
            if(response.success){
                $('#modal-title').text($('#category option:selected').text());
                $('#content-modal').html(response.view);
                $('#general-modal').modal('show');
                
            } else {
                notify('error', response.message);
            }
           
        }
    });
  }
});

$(document).on('change', '#time_delivery', function () {
  if(add_cart > 0) {
    show_price_by_time();
  }
});

$(document).on('click', '.delete-package', function () {
    var row = $(this).closest('tr');
    row.remove();
    add_cart--;
    total();
});

$(document).ready(function() {
    initMap();
});