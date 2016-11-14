 {!! Form::open(['route' => 'branch-office.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.name')">@lang('app.name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.phone')">@lang('app.phone') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('phone', old('phone'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'phone']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.representative')">@lang('app.representative') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::select('representative_id', $representatives, old('representative_id'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'representative_id']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.address_add_autocomplete')">@lang('app.address_add_autocomplete') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::text('address', old('address'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'address_search']) !!}
    </div>
  </div>
  <div id="load_locations"> 
    <table class="table" id="locations_table">
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

  <div id="map-form" style="width:80%;height:400px;margin-left:auto; margin-right:auto;"></div>

  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default btn-cancel">@lang('app.cancel')</button>
      <button type="submit" class="btn btn-primary btn-submit">@lang('app.save')</button>
    </div>
  </div>
{!! Form::close() !!}

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
</script>

{!! HTML::script('assets/js/maps.js') !!}