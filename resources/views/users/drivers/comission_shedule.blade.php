<div class="modal-body">
{!! Form::open(['route' => ['admin-driver.comission.shedule.update', $driver->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.comission')">@lang('app.comission') <span class="required">*</span>
    </label>
    <div class="col-md-2 col-sm-2 col-xs-12">
    {!! Form::text('comission', isset($driver->driver_comission) ? $driver->driver_comission->percentage : old('comission'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'comission']) !!}
    </div>
  </div>

<div class="row">
   <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
  <div class="form-group col-md-4 col-sm-4 col-xs-12">
    <button type="button" onClick="add_working_time()" class="btn btn-default col-xs-12">@lang('app.add_delivery_hour')</button>
  </div>
</div>

<div class="row">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
    <div class="col-md-6 col-sm-6 col-xs-12"> 
      <table class="table" id="shedules_table" style="display: none;">
      <thead>
      <tr>
        <th>@lang('app.interval')</th>
        <th width="10%"></th>
      </tr>
      </thead>
      <tbody id="shedules_list" class="form-horizontal">
      @if(count($driver->driver_shedules) > 0)
          @foreach($driver->driver_shedules as $shedules)
          <tr>
            <td>
            {!! Form::select('shedules[]', $working_hours, $shedules->value, ['class' => 'form-control']) !!}
            <input type="hidden" name="shedule_id[]" value="{{ $shedules->id }}">
            </td>
            <td>
              <button type="button" class="btn btn-round btn-danger delete-shedule"> 
                <i class="fa fa-trash"></i>
              </button>
            </td>
          </tr>
          @endforeach
      @endif
      </tbody>
    </table>
  </div>
</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.update')</button>
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}
 
<script type="text/javascript">
  @if(count($driver->driver_shedules) > 0)
    $('#shedules_table').show();
  @endif
  var working_hours = {!! json_encode($working_array) !!};
</script> 
