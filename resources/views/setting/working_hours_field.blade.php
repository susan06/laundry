{!! Form::open(['route' => 'setting.update.working.hours', 'class' => 'form-horizontal form-label-left']) !!}
<div class="form-group">
  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.time_close')">@lang('app.time_close')
  </label>
  <div class="col-md-2 col-sm-3 col-xs-12">
    {!! Form::text('time_close', Settings::get('time_close'), ['class' => 'form-control col-md-7 col-xs-12 datetime', 'id' => 'time_close', 'readonly' => 'readonly']) !!}
  </div>                 
</div>

<div class="form-group">
  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.week')">@lang('app.week')
  </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="checkbox">
        <input type="checkbox" class="flat" name="week[]" value="1" {{ (in_array(1,$week)) ? '' : 'checked="checked"' }}> Lunes
      </div>
      <div class="checkbox">
        <input type="checkbox" class="flat" name="week[]" value="2" {{ (in_array(2,$week)) ? '' : 'checked="checked"' }}> Martes
      </div>
      <div class="checkbox">
        <input type="checkbox" class="flat" name="week[]" value="3" {{ (in_array(3,$week)) ? '' : 'checked="checked"' }}> Miércoles
      </div>
      <div class="checkbox">
        <input type="checkbox" class="flat" name="week[]" value="4" {{ (in_array(4,$week)) ? '' : 'checked="checked"' }}> Jueves 
      </div>
      <div class="checkbox">
        <input type="checkbox" class="flat" name="week[]" value="5" {{ (in_array(5,$week)) ? '' : 'checked="checked"' }}> Viernes
      </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div id="content-table">
      <div id="load_working_hours"> 
        <table class="table-responsive table table-striped table-bordered dt-responsive nowrap form-horizontal" cellspacing="0" width="100%">
        <thead>
        <tr>
          <th>@lang('app.date_start')</th>
          <th>@lang('app.end')</th>
          <th>@lang('app.quantity_reserve')</th>
          <th>@lang('app.status')</th>
          <th width="10%">@lang('app.actions')</th>
        </tr>
        </thead>
        <tbody id="working_hours_list">

          @foreach ($working_hours as $key => $working_hour)
          <tr>
            <td><input type="text" name="start[]" id="{{$key}}" class="form-control datetime" value="{{$working_hour['start']}}" required="required" readonly="readonly"></td>
            <td><input type="text" name="end[]" id="end-{{$key}}" class="form-control datetime" value="{{$working_hour['end']}}" required="required" readonly="readonly"></td>
            <td><input type="number" name="quantity[]" class="form-control" value="{{$working_hour['quantity']}}" required="required"></td>
            <td>{!! Form::select('status', $status, $working_hour['status'], ['class' => 'form-control']) !!}</td>
            <td>
            @if($key != 0)
              <button type="button"  class="btn btn-round btn-danger btn-xs delete-hour"> 
                <i class="fa fa-trash"></i>
              </button>
            @endif
            </td>
          </tr>
          @endforeach
          <!-- load content locations -->
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="form-group col-md-3 col-sm-3 col-xs-12">
    <button type="button" onClick="add_working_hour()" class="btn btn-default col-xs-12">@lang('app.add_interval')</button>
  </div>
</div>

<div class="ln_solid"></div>
<div class="form-group col-md-2 col-sm-2 col-xs-12">
  <button type="submit" class="btn btn-primary col-xs-12">@lang('app.update')</button>
</div>
{!! Form::close() !!}