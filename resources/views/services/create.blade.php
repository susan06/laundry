@extends('layouts.app')

@section('page-title', trans('app_service_request'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>@lang('app.service_request')</h3>
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

            <div class="alert alert-info alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              @lang('app.only_days_are_enabled')
              {{ (in_array(1,$week)) ? '' : trans("app.monday").' ' }}
              {{ (in_array(2,$week)) ? '' : trans("app.tuesday").' ' }}
              {{ (in_array(3,$week)) ? '' : trans("app.wednesday").' ' }}
              {{ (in_array(4,$week)) ? '' : trans("app.thursday").' ' }}
              {{ (in_array(5,$week)) ? '' : trans("app.friday").' ' }}
              <div id="alert-schedule">
              </div>
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" class="flat" id="check_today" checked="checked"> @lang('app.today_search')
              </label>
              <label>
                <input type="checkbox" class="flat" id="check_tomorrow"> @lang('app.tomorrow_search') 
              </label> 
            </div>

            <br />

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.date_search')">@lang('app.date_search') <span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-3 col-xs-12">
                {!! Form::text('date_search', old('date_search'), ['class' => 'form-control col-md-7 col-xs-12 datetime', 'id' => 'date_search', 'readonly' => 'readonly']) !!}
              </div>                                   
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
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.date_delivery')">@lang('app.date_delivery') <span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-3 col-xs-12">
                {!! Form::text('date_delivery', old('date_delivery'), ['class' => 'form-control col-md-7 col-xs-12 datetime', 'id' => 'date_delivery', 'readonly' => 'readonly']) !!}
              </div>                
            </div>
             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.time_delivery')">@lang('app.time_delivery') <span class="required">*</span>
              </label>
              <div class="col-md-2 col-sm-3 col-xs-12">
                {!! Form::select('time_delivery', $time_delivery, old('time_delivery'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'time_delivery']) !!}     
              </div>            
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.special_instructions')">@lang('app.special_instructions') 
              </label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                {!! Form::textarea('special_instructions', old('special_instructions'), ['class' => 'form-control', 'id' => 'special_instructions', 'rows' => '3']) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.coupon')">@lang('app.coupon')
              </label>
              <div class="col-md-7 col-sm-7 col-xs-12">
              {!! Form::text('coupon', old('coupon'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'coupon']) !!}
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group col-md-2 col-sm-2 col-xs-12">
              <button type="submit" class="btn btn-primary col-xs-12">@lang('app.save')</button>
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
  var day_disabled = [0,{!! Settings::get('week') !!},6];
  var today = new Date();

  var beginningTime = moment().add({ hours: 0, minutes: 30}).format('h:mm A');
  var endTime = '{!! Settings::get("time_close") !!}';

  if(! moment(new Date(beginningTime)).isBefore(new Date(endTime)) ) {
    today = new Date(today.setDate(today.getDate() + 1));
    document.getElementById("alert-schedule").innerHTML = "Hora de cierre: {{ Settings::get('time_close') }}, solo podrá selecionar la siguiente fecha hábil, debido a que falta media hora o menos para cerrar.";
  }

  $('#date_search').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: today,
    ignoreReadonly: true,
    daysOfWeekDisabled: day_disabled
  }); 


  $('#date_delivery').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: today.setDate(today.getDate() + 1),
    ignoreReadonly: true,
    daysOfWeekDisabled: day_disabled
  }); 

  $("#date_search").on("dp.change", function(e) {
      var delivery = new Date(e.date);
      delivery.setDate(delivery.getDate() + 1);
      $("#date_delivery").data('DateTimePicker').date(delivery);
  });

  $("#check_today").on("ifClicked", function() {
    $('#check_tomorrow').iCheck('uncheck');
    var today1 = today;
    today1.setDate(today1.getDate());
    $("#date_search").data('DateTimePicker').date(today1);
  });

  $("#check_tomorrow").on("ifClicked", function() {
    $('#check_today').iCheck('uncheck');
    var tomorrow = today;
    tomorrow.setDate(tomorrow.getDate() + 1);
    $("#date_search").data('DateTimePicker').date(tomorrow);
  });

</script>

{!! HTML::script('public/assets/js/maps_client.js') !!}

@endsection