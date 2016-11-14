{!! Form::model($branch_office, ['route' => ['branch-office.update', $branch_office->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
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
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.status')">@lang('app.status') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::select('status', $status, old('status'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'status']) !!}
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
    <table class="table">
    <thead>
    <tr>
      <th>@lang('app.address')</th>
      <th width="18%">Lat</th>
      <th width="18%">lng</th>
      <th width="10%"></th>
    </tr>
    </thead>
    <tbody id="locations_list" class="form-horizontal">
      @foreach($branch_office->locations as $locations)
      <tr>
        <td><input type="text" name="address[]" class="form-control" value="{{ $locations->address }}" required="required"><input type="hidden" name="location_id[]" value="{{ $locations->id }}"></td>
        <td><input type="text" name="lat[]" id="lat_{{$count}}" class="form-control" value="{{ $locations->lat }}" readonly="readonly"></td>
        <td><input type="text" name="lng[]" id="lng_{{$count}}" class="form-control" value="{{ $locations->lng }}" readonly="readonly"></td>
        <td>
        @if($count != 1)
          <button type="button"  class="btn btn-round btn-danger btn-xs delete-location"> 
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

  <div id="map-form" style="width:80%;height:400px;margin-left:auto; margin-right:auto;"></div>

  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default btn-cancel">@lang('app.cancel')</button>
      <button type="submit" class="btn btn-primary btn-submit">@lang('app.update')</button>
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
  var edit = true;
  var count = {{ $count }};
  var locations = '{!! json_encode($branch_office->locations) !!}';
</script>
{!! HTML::script('assets/js/maps.js') !!}