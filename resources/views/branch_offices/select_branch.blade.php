@extends('layouts.app')

@section('page-title', trans('app.list_branch_offices'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.list_branch_offices') {{ $order->bag_code }}</h3>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div id="map-form"></div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts_head')
@parent
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key={{ env('API_KEY_GOOGLE')}}&libraries=places&language={{Auth::User()->lang}}"></script>
@endsection

@section('scripts')

<script type="text/javascript">

  function openInfoWindowBranch(marker) {
    infowindow.close();
    infowindow = new google.maps.InfoWindow();
    var markerLatLng = marker.getPosition();
    infowindow.setContent('<div class="lat-lng"><strong>'+ marker.customInfo +':</strong><br><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Lng:</strong><br>' + markerLatLng.lng() +'</div>');
    infowindow.open(map, marker);
    google.maps.event.addListener(marker, 'click', function(){ openInfoWindowBranch(marker); })
  }

  function initMapBranch() {

    var center = new google.maps.LatLng('{!! $order->client_location->lat !!}', '{!! $order->client_location->lng !!}');

    map = new google.maps.Map(document.getElementById('map-form'), {
      center: center,
      zoom: 14,
      styles: [{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}]
    });

    infowindow = new google.maps.InfoWindow({map: map});

    marker = new google.maps.Marker({
      position: center,
      map: map,
      title: '{{ $order->user->full_name() }}',
      icon: icon_map
    });

    @foreach($all_branch_offices as $branch)

      @if($branch->locations)

      $.each(JSON.parse('{!! json_encode($branch->locations) !!}'), function(index, item) {

        marker = new google.maps.Marker({
          position: new google.maps.LatLng(item['lat'], item['lng']),
          map: map,
          customInfo: item['address'],
          title: '{{ $branch->name }} - '+item['address'],
        });

        openInfoWindowBranch(marker);
        infowindow.close();
        map.setCenter(marker.getPosition());

      });

      @endif
    @endforeach  

    google.maps.event.addListener(marker, 'click', function(){ openInfoWindowBranch(marker); });

}

  $(document).ready(function() {
    initMapBranch();
  });

</script>
@endsection