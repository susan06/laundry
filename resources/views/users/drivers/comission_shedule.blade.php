<div class="modal-body">
{!! Form::open(['route' => ['admin-driver.comission.update', $user->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.comission')">@lang('app.comission') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('comission', is_null($user->comission) ? old('comission') : $user->comission->percentage, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'comission']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.comission')">@lang('app.shedule') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('shedule', is_null($user->shedule) ? old('shedule') : $user->shedule->value, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'shedule']) !!}
    </div>
  </div>
<div class="modal-footer">
  <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.update')</button>
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}
 
