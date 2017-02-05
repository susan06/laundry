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
            <div id="row"> 
              <table class="table">
                <thead>
                <tr>
                  <th>@lang('app.name')</th>
                  <th>@lang('app.address')</th>
                  <th width="10%"></th>
                </tr>
                </thead>
                <tbody id="locations_list" class="form-horizontal">
                  @foreach($branch_offices as $branch_office)
                  @if($branch_office->locations)
                    @foreach($branch_office->locations as $loc)
                      <tr class="locations {{ ($order->branch_offices_location_id == $loc->id) ? 'success' : '' }}">
                        <td>{{ $loc->branchOffice->name }}</td>
                        <td>{{ $loc->address }}</td>
                        <td>
                          <button type="button" data-branch="{{ $loc->branch_office_id }}"" data-id="{{ $loc->id }}" class="btn btn-round btn-success select-branch"> 
                            <i class="fa fa-check"></i>
                          </button>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="ln_solid"></div>
            {!! Form::open(['route' => ['driver.order.branch.update', $order->id], 'method' => 'PUT', 'id' => 'form-modal']) !!}
            {!! Form::hidden('branch_office', $order->branch_offices_id, ['id' => 'branch_office']) !!}
            {!! Form::hidden('branch_location', $order->branch_offices_location_id, ['id' => 'branch_office_location']) !!}
              <div class="form-group col-md-3 col-sm-3 col-xs-12">
              <button type="submit" class="btn btn-primary btn-submit col-xs-12">@lang('app.save')</button>
            {!! Form::close() !!}
            </div>

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
    infowindow.setContent('<div class="lat-lng"><strong>'+ marker.customInfo +':</strong></div>');
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
          customInfo: '{{ $branch->name }} - '+item['address'],
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

$(document).on('click', '.select-branch', function () {
    $('.locations').removeClass('success');
    $(this).closest('tr').addClass('success');
    $('#branch_office').val($(this).data('branch'));
    $('#branch_office_location').val($(this).data('id'));
});

$(document).ready(function() {
  initMapBranch();
});

</script>
@endsection