@if($edit)
{!! Form::model($branch_office, ['route' => ['branch-office.update', $branch_office->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@else
 {!! Form::open(['route' => 'branch-office.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@endif
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
  @if($edit) 
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.status')">@lang('app.status') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::select('status', $status, old('status'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'status']) !!}
    </div>
  </div> 
  @endif
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.address_add')">@lang('app.address_add') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::text('address', old('address'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'address_search']) !!}
    </div>
  </div>

  <div id="map-form" style="width:80%;height:400px;margin-left:auto; margin-right:auto;"></div>

  {{ Form::text('lat', old('lat'), ['id' => 'lat']) }}
  {{ Form::text('lng', old('lng'), ['id' => 'lng']) }}

  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default btn-cancel">@lang('app.cancel')</button>
       @if($edit)
        <button type="submit" class="btn btn-primary btn-submit">@lang('app.update')</button>
      @else
          <button type="submit" class="btn btn-primary btn-submit">@lang('app.save')</button>
      @endif
    </div>
  </div>
{!! Form::close() !!}

<script type="text/javascript">
  var country_default = Settings::get('country_default');
</script>
{!! HTML::script('assets/js/maps.js') !!}
