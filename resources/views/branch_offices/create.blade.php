 {!! Form::open(['route' => 'admin-branch-office.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.name')">@lang('app.name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.phone')">@lang('app.phone') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('phone', old('phone'), ['class' => 'form-control inputmask', 'id' => 'phone',  'data-inputmask' => "'mask' : '999999999'"]) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.representative')">@lang('app.representative') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::select('representative_id', $representatives, old('representative_id'), ['class' => 'form-control select2_single', 'id' => 'representative_id']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.address_add_autocomplete')">@lang('app.address_add_autocomplete') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::text('address', old('address'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'address_search']) !!}
    </div>
  </div>

 <div class="t_title">
    <h2> @lang('app.locations')</h2>
    <div class="clearfix"></div>
  </div>

  <div id="load_locations"> 
    <table class="table-responsive table table-striped table-bordered dt-responsive nowrap form-horizontal" id="locations_table">
    <thead>
    <tr>
      <th>@lang('app.address')</th>
      <th width="18%">Lat</th>
      <th width="18%">lng</th>
      <th width="10%"></th>
    </tr>
    </thead>
    <tbody id="locations_list" class="form-horizontal">
      <!-- load content locations -->
    </tbody>
  </table>
  </div>

  <div id="map-form"></div>

  <div class="t_title">
    <h2> @lang('app.services')</h2>
    <div class="clearfix"></div>
  </div>

  <div class="row" id="load_services">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div id="content-table">
        <div id="load_services"> 
          <table class="table-responsive table table-striped table-bordered dt-responsive nowrap form-horizontal" id="services_table">
          <thead>
          <tr>
            <th>@lang('app.name')</th>
            <th>@lang('app.price')</th>
            <th>@lang('app.status')</th>
            <th width="10%">@lang('app.actions')</th>
          </tr>
          </thead>
          <tbody id="services_list">
            <!-- load content services -->
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-3 col-sm-4 col-xs-12">
      <button type="button" onClick="add_services()" class="btn btn-default col-xs-12">@lang('app.add_services')</button>
    </div>
  </div>

  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="submit" class="btn btn-primary btn-submit col-md-3 col-sm-3 col-xs-6">@lang('app.save')</button>
      <button type="button" class="btn btn-default btn-cancel col-md-3 col-sm-3 col-xs-5">@lang('app.back')</button>
    </div>
  </div>
{!! Form::close() !!}

<script type="text/javascript">
  $(".inputmask").inputmask();
  var country_default = new String("{{Settings::get('country_default')}}");
  country_default = country_default.toLowerCase();
  var map = null;
  var infowindow = null;
  var marker = null;
  var location_trans = "{{ trans('app.location') }}";
  var location_label = "{{ trans('app.my_location') }}";
  var edit = false;
  var count = 1;
  var select_option = {'In service':'{{trans("app.In service")}}', 'Out of service':'{{trans("app.Out of service")}}'};
  var select_option_service = {'Available':'{{trans("app.Available")}}', 'Not available':'{{trans("app.Not available")}}'};

  $(".select2_single").select2({
    placeholder: "@lang('app.selected_item')",
    allowClear: true
  });

  $(document).ready(function() {
    initMap();
  });

</script>


