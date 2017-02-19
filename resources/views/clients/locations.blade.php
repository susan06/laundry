@extends('layouts.app')

@section('page-title', trans('app.my_locations'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.my_locations')</h2>
  </div>
<!--//banner-->

  <div class="grid-form">
    <div class="grid-form1">

      {!! Form::open(['route' => ['client.locations.update'], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}

        <div id="load_locations" class="col-md-6 col-sm-6 col-xs-12"> 
          <table id="locations_table" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
              <tbody id="locations_list" class="locations-client form-horizontal">
                @foreach($user->client_location as $key => $item)
                  <tr class="info">
                    <td>{{ trans('app.address').' '.$count }}</td>
                  </tr>
                  <tr>
                    <td>
                    {!! Form::select('locations_labels[]', $locations_labels, $item->label, ['class' => 'form-control']) !!}</td>
                  </tr>
                  <tr>
                    <td>
                      <input type="text" name="address[]" class="form-control" value="{{ $item->address }}" required="required"><input type="hidden" name="location_id[]" value="{{ $item->id }}">
                      <input type="hidden" name="lat[]" id="lat_{{$count}}" class="form-control" value="{{ $item->lat }}">
                      <input type="hidden" name="lng[]" id="lng_{{$count}}" class="form-control" value="{{ $item->lng }}">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="text" name="description[]" class="form-control" value="{{ $item->description }}">
                    </td>
                  </tr>
                  <tr>
                    <td class="center">
                      {!! $item->getStatus() !!}
                    </td>
                  </tr>
                  @if($item->confirmed)
                  <tr>
                    <td class="center">
                      <span class="label label-success">@lang('app.confirmed_driver')</span>
                    </td>
                  </tr>
                  @endif
                  <tr>  
                    <td class="center">
                      @if($item->status == 'rejected')
                        <a href="#reazon_status_{{$item->id}}" data-toggle="modal" class="btn btn-round btn-warning"><i class="fa fa-eye"></i></a>
                        <div class="modal fade" id="reazon_status_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="tos-label">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                      <h3 class="modal-title">@lang('app.reazon_supervisor_location')</h3>
                                  </div>
                                  <div class="modal-body">
                                      {!! $item->reazon_status !!}
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
                                  </div>
                              </div>
                          </div>
                        </div>
                      @endif
                      @if($item->status != 'accepted')
                        <button type="button" class="btn btn-round btn-danger delete-location"> 
                          <i class="fa fa-trash"></i>
                        </button>
                      @endif
                    </td>
                  </tr>
                <?Php $count++; ?>
                @endforeach
              </tbody>
          </table>
        </div>

        <div class="margin-top-10 clear col-md-6 col-sm-6 col-xs-12">
            <button type="submit" class="btn btn-primary col-sm-6 col-xs-12 btn-submit">@lang('app.update')</button>
        </div>

        <div class="clear">
          <div class="col-md-12 col-xs-12 margin-top-10">
            {!! Form::text('address_search', old('address_search'), ['class' => 'form-control col-md-12 col-xs-12', 'placeholder' => trans('app.address_add_autocomplete'), 'id' => 'address_search']) !!}
          </div>
        </div>

        {!! Form::close() !!}

        <div id="map-form"></div>

    </div>
  </div>

@endsection

@section('scripts_head')
@parent
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key={{ env('API_KEY_GOOGLE')}}&libraries=places&language={{Auth::User()->lang}}"></script>
@endsection

@section('scripts')
@parent

<script type="text/javascript">

  var country_default = new String("{{Settings::get('country_default')}}");
  country_default = country_default.toLowerCase();
  var map = null;
  var infowindow = null;
  var marker = null;
  var location_trans = "{{ trans('app.location') }}";
  var address_trans = "{{ trans('app.address') }}";
  var location_label = "{{ trans('app.my_location') }}";
  var edit = true;
  var count = {{ $count }};
  var locations = '{!! json_encode($user->client_location) !!}';
  var error_geolocation = "{{ trans('app.error_geolocation') }}";
  var dont_found_your_location = "{{ trans('app.dont_found_your_location')}}";
  var select_option = {!! json_encode($locations_labels) !!};
</script>

{!! HTML::script('public/assets/js/map_locations.js') !!}

<script type="text/javascript">

  $(document).ready(function() {
    initMap();
  });

</script>
@endsection