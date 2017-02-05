function openInfoWindowShowMap(marker) {
    infowindow.close();
    var markerLatLng = marker.getPosition();
    infowindow.setPosition(markerLatLng);
    map.setCenter(markerLatLng);
    infowindow.setContent('<div class="lat-lng">' + marker.customInfo + '</div>');
    infowindow.open(map, marker);   
}

function show_map() {

    map = new google.maps.Map(document.getElementById('map-form'), {
      zoom: 15,
      center: center,
      styles: [{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}]
    });

    infowindow = new google.maps.InfoWindow({map: map});

    marker = new google.maps.Marker({
      position: center,
      map: map,
      icon: icon_map
    });

    openInfoWindowShowMap(marker);
    infowindow.close();

    if(latLngBranch){
      marker = new google.maps.Marker({
        position: latLngBranch,
        map: map,
        title: branch_name,
        customInfo: branch_name_address
      });
      openInfoWindowShowMap(marker);
      infowindow.close();
    }

    map.setCenter(center);
    map.panTo(center);
    map.setZoom(15); 

    google.maps.event.addListener(marker, 'click', 
      function(){ openInfoWindowShowMap(marker); 
    });

    google.maps.event.trigger(map, "resize");

    $('#show_map_modal').modal('show');
}