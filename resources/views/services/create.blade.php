@extends('layouts.app')

@section('page-title', trans('app_service_request'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>@lang('app.service_request')</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          {!! Form::open(['route' => 'branch-office.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
          <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            No tiene direcciones confirmadas aún, será tomada su ubicación actual. Puede mover el marcador para más exactitud de su ubicación.
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.delivery_address')">@lang('app.delivery_address') <span class="required">*</span>
            </label>
            <div class="col-md-7 col-sm-7 col-xs-12">
            {!! Form::text('delivery_address', old('delivery_address'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'delivery_address', 'required' => 'required']) !!}
            {!! Form::hidden('lat', '', ['id' => 'lat']) !!}
            {!! Form::hidden('lng', '', ['id' => 'lng']) !!}
            </div>
          </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.locations_labels')">@lang('app.locations_labels') <span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-3 col-xs-12">
                {!! Form::select('locations_labels', $locations_labels, old('locations_labels'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'locations_labels']) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.details_address')">@lang('app.details_address') 
              </label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                {!! Form::textarea('details_address', old('details_address'), ['class' => 'form-control', 'id' => 'details_address', 'rows' => '3']) !!}
              </div>
            </div>
            <div id="map-form"></div>
            <br />
            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.date_search')">@lang('app.date_search') <span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-3 col-xs-12">
                {!! Form::text('date_search', old('date_search'), ['class' => 'form-control col-md-7 col-xs-12 date', 'id' => 'date_search', 'readonly' => 'readonly']) !!}
              </div>            
                <input type="checkbox" class="flat" id="check_today" checked="checked"> @lang('app.today')
                <input type="checkbox" class="flat" id="check_tomorrow"> @lang('app.tomorrow')          
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.time_search')">@lang('app.time_search') <span class="required">*</span>
              </label>
              <div class="col-md-3 col-sm-3 col-xs-12">
              <select name="time_search" class="form-control col-md-7 col-xs-12" id="time_search">
                @foreach($working_hours as $working_hour)
                  @if($working_hour['status'] == 'available')
                  <option value="{{$working_hour['id']}}">{{$working_hour['interval']}}
                  @endif
                @endforeach
              </select>
              </div>
            </div>
          {!! Form::close() !!}
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

  <!-- moment -->
  {!! HTML::script('public/assets/js/moment/moment.min.js') !!}
  <!-- bootstrap-daterangepicker -->
  {!! HTML::script('public/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}
  <!-- icheck -->
  {!! HTML::script('public/vendors/iCheck/icheck.min.js') !!}

<script type="text/javascript">
  var country_default = new String("{{Settings::get('country_default')}}");
  country_default = country_default.toLowerCase();
  var map = null;
  var infowindow = null;
  var marker = null;
  var location_trans = "{{ trans('app.location') }}";
  var location_label = "{{ trans('app.my_location') }}";
  var edit = false;
  var count = 1;

  $('#date_search').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: new Date(),
    ignoreReadonly: true
  }); 

  $("#check_today").on("ifClicked", function() {
    $('#check_tomorrow').iCheck('uncheck');
    var today = new Date();
    today.setDate(today.getDate());
    $("#date_search").data('DateTimePicker').date(today);
  });

  $("#check_tomorrow").on("ifClicked", function() {
    $('#check_today').iCheck('uncheck');
    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    $("#date_search").data('DateTimePicker').date(tomorrow);
  });

</script>

{!! HTML::script('public/assets/js/maps_client.js') !!}

@endsection