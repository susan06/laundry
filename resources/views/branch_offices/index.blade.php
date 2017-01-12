@extends('layouts.app')

@section('page-title', trans('app.branch_offices'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3 id="content-title">@lang('app.branch_offices')</h3>
            </div>
            @include('partials.status')
            @include('partials.search')
          </div>
        
          <div class="x_content">
          
            <div class="row">
              <div class="col-md-2 col-sm-2 col-xs-12">
                  <button type="button" data-href="{{ route('admin-branch-office.create') }}" class="btn btn-primary create-edit-show btn-create col-xs-12" data-model="content" title="@lang('app.create_branch_office')">@lang('app.create_branch_office')</button>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-12">
                <button type="button" data-href="{{ route('admin-branch-office.map') }}" class="btn btn-primary create-edit-show btn-create col-xs-12" data-model="content" title="@lang('app.map_branch')">@lang('app.map_branch')</button>
              </div>
            </div>

            <div id="content-table">
              @include('branch_offices.list')
            </div>

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
@parent
<!-- Select2 -->
{!! HTML::script('public/vendors/select2/dist/js/select2.full.min.js') !!}
<!-- jquery.inputmask -->
{!! HTML::script('public/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') !!}
{!! HTML::script('public/assets/js/maps_services.js') !!}

<script type="text/javascript">

  function openInfoWindowBranch(marker, address) {
      infowindow.close();
      infowindow = new google.maps.InfoWindow();
      var markerLatLng = marker.getPosition();
      infowindow.setContent('<div class="lat-lng"><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Lng:</strong><br>' + markerLatLng.lng() +'<br> '+address+'</div>');
      infowindow.open(map, marker);   
  }

  function initMapBranch() {
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
      infowindow.setContent("{{ trans('app.my_location') }}");
      map.setCenter(pos);
      }, function() {
        handleLocationError(true, infowindow, map.getCenter());
      });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infowindow, map.getCenter());
  }

  @foreach($all_branch_offices as $branch)

    @if($branch->locations)

    $.each(JSON.parse('{!! json_encode($branch->locations) !!}'), function(index, item) {

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(item['lat'], item['lng']),
        map: map,
        title: '{{ $branch->name }}',
        icon: icon_map
      });

      openInfoWindowBranch(marker, item['address']);
      infowindow.close();

      google.maps.event.addListener(marker, 'click', function(){ openInfoWindowBranch(marker, item['address']); });
    });

    @endif
  @endforeach  

}
</script>
@endsection