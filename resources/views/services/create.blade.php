@extends('layouts.front')

@section('page-title', trans('app.services'))

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
          {!! Form::open(['route' => 'service.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
          <!--
          <div class="alert alert-warning alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            No tiene direcciones confirmadas aún, será tomada su ubicación actual. Puede mover el marcador para más exactitud de su ubicación.
          </div>
          -->

            <div class="t_title">
              <h2> @lang('app.address')</h2>
              <div class="clearfix"></div>
            </div>

            <div class="content_map">
              <div class="col-md-11 col-sm-11 col-xs-11 input_delivery_address">
                {!! Form::text('delivery_address', old('delivery_address'), ['id' => 'delivery_address', 'required' => 'required', 'placeholder' => trans('app.delivery_address') ]) !!}
              </div>

              <div id="map-form"></div>
            </div>

            <br />
           
              {!! Form::hidden('lat', '', ['id' => 'lat']) !!}
              {!! Form::hidden('lng', '', ['id' => 'lng']) !!}

            <div class="row">
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                {!! Form::select('locations_labels', $locations_labels, old('locations_labels'), ['class' => 'form-control', 'id' => 'locations_labels']) !!}
              </div>
            </div>

            <div class="row">
              <div class="col-md-7 col-sm-7 col-xs-12 form-group">
                  {!! Form::textarea('details_address', old('details_address'), ['class' => 'form-control', 'id' => 'details_address', 'rows' => '3', 'placeholder' => trans('app.details_address')]) !!}
              </div>
            </div>

            <div class="t_title">
              <h2> @lang('app.searched')</h2>
              <div class="clearfix"></div>
            </div>

            <!--
            <div class="checkbox">
              <label>
                <input type="checkbox" class="flat" id="check_today" checked="checked"> @lang('app.today_search')
              </label>
              <label>
                <input type="checkbox" class="flat" id="check_tomorrow"> @lang('app.tomorrow_search') 
              </label> 
            </div>

            <br />

            -->
            
            <div class="row">            
              <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                  {!! Form::text('date_search', old('date_search'), ['class' => 'form-control datetime has-feedback-left', 'id' => 'date_search', 'readonly' => 'readonly']) !!}
                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
              </div>
            </div>

            <div class="row"> 
              <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                <select name="time_search" class="form-control" id="time_search">
                  @foreach($working_hours as $working_hour)
                    @if($working_hour['status'] == 'available')
                    <option value="{{$working_hour['id']}}">{{$working_hour['interval']}}
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
              
            <div class="t_title">
              <h2> @lang('app.delivery')</h2>
              <div class="clearfix"></div>
            </div>

 
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                {!! Form::text('date_delivery', old('date_delivery'), ['class' => 'form-control has-feedback-left datetime', 'id' => 'date_delivery', 'readonly' => 'readonly']) !!}
                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
              </div>                
            </div>
             <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                <select name="time_delivery" class="form-control" id="time_delivery">
                  @foreach($time_delivery as $delivery)
                    @if($delivery['published'] == 'public')
                    <option value="{{$delivery['id']}}">{{$delivery['interval']}}
                    @endif
                  @endforeach
                </select>  
              </div>            
            </div>
            
            <div class="t_title">
              <h2> @lang('app.packages')</h2>
              <div class="clearfix"></div>
            </div>

            <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                {!! Form::select('category', $categories, old('category'), ['class' => 'form-control col-md-7 col-xs-12 select2_single', 'id' => 'category']) !!}
              </div>            
            </div>

            <div class="row">
                <table class="table" id="packages_table">
                  <thead>
                  <tr>
                    <th>@lang('app.name')</th>
                    <th>@lang('app.category')</th>
                    <th>@lang('app.price') {{ '('.Settings::get('coin').')' }}</th>
                    <th width="10%"></th>
                  </tr>
                  </thead>
                  <tbody id="packages_list" class="form-horizontal">
                    <!-- load content locations -->
                  </tbody>
                </table>
            </div>

            <div class="t_title">
              <h2> @lang('app.details')</h2>
              <div class="clearfix"></div>
            </div>

            <div class="row">
              <div class="col-md-7 col-sm-7 col-xs-12 form-group">
                  {!! Form::textarea('special_instructions', old('special_instructions'), ['class' => 'form-control', 'id' => 'special_instructions', 'rows' => '3', 'placeholder' => trans('app.special_instructions')]) !!}
              </div>
            </div>

            <div class="t_title">
              <h2> @lang('app.code_promo')</h2>
              <div class="clearfix"></div>
            </div>

            <div class="row">
              <div class="col-md-7 col-sm-7 col-xs-12 form-group">
                <div class="input-group">
                  {!! Form::text('coupon', old('coupon'), ['class' => 'form-control', 'id' => 'coupon', 'placeholder' => trans('app.coupon')]) !!}
                  <span class="input-group-btn">
                      <button class="btn btn-primary validate" type="button">@lang('app.validate')</button>
                    </span>
                </div>
              </div>
            </div>
            {!! Form::text('client_coupon_id', '', ['id' => 'coupon_id']) !!}

          <div class="discount" style="display: none;">
            <div class="t_title">
              <h2> @lang('app.discount')</h2>
              <div class="clearfix"></div>
            </div>

            <div class="row">
              <div class="product_price col-md-4 col-sm-4 col-xs-12">
                <h1 class="price" id="discount">0.00</h1>
              </div>
            </div>
            {!! Form::text('discount', 'null', ['id' => 'discount_price']) !!}
          </div>
            
            <div class="t_title">
              <h2> @lang('app.total')</h2>
              <div class="clearfix"></div>
            </div>

            <div class="row">
              <div class="product_price col-md-4 col-sm-4 col-xs-12">
                <h1 class="price"><span id="total">0.00</span> {{Settings::get('coin') }}</h1> 
              </div>
            </div>
            {!! Form::text('total', '0', ['id' => 'total_price']) !!}

            <div class="ln_solid"></div>
            <div class="form-group col-md-3 col-sm-3 col-xs-12">
              <button type="submit" class="btn btn-primary btn-submit col-xs-12">@lang('app.save')</button>
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
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key={{ env('API_KEY_GOOGLE')}}&libraries=places&language={{Auth::User()->lang}}&region={{Settings::get('country_default')}}"></script>
@endsection

@section('scripts')
@parent

  <!-- Select2 -->
  {!! HTML::script('public/vendors/select2/dist/js/select2.full.min.js') !!}
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
  var first_select_package = "{{ trans('app.first_select_package') }}";
  var first_introduce_coupon = "{{ trans('app.first_introduce_coupon') }}";
  var package_added = "{{ trans('app.package_added') }}";
  var edit = false;
  var count = 1;
  var day_disabled = [0,{!! Settings::get('week') !!},6];
  var today = moment(new Date());
  var url_package_get_details = "{{ route('package.get.details') }}";
  var url_package_show_category = "{{ route('package.show.category') }}";
  var url_validate_coupon = "{{ route('coupon.check') }}";
  var endTime = '{!! Settings::get("time_close") !!}';
  var coin = "{{ Settings::get('coin') }}";

  var beginningTime = moment().add({ hours: 0, minutes: 30}).format('h:mm A');

  if(! moment(new Date(beginningTime)).isBefore(new Date(endTime)) ) {
    today =  moment(new Date()).add(1, 'day');
  }

  $('#date_search').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: today,
    maxDate: moment(today).add(7, 'day'),
    ignoreReadonly: true,
    daysOfWeekDisabled: day_disabled
  });

  var today_search = $('#date_search').val();
  var today_new = today_search.split("-").reverse().join("-");
  var tomorrow = moment(today_new).add(1, 'day');

  $('#date_delivery').datetimepicker({
    format: 'DD-MM-YYYY',
    defaultDate: tomorrow,
    minDate: tomorrow,
    maxDate: moment(today).add(7, 'day'),
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
    var tomorrow2 = today;
    tomorrow2.setDate(tomorrow.getDate() + 1);
    $("#date_search").data('DateTimePicker').date(tomorrow2);
  });

</script>

{!! HTML::script('public/assets/js/services_create.js') !!}

@endsection