<div class="modal-body">
{!! Form::model($role, ['route' => ['role.update', $role->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.display_name')">@lang('app.display_name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('display_name', old('display_name'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'display_name']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.description')">@lang('app.description') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::text('description', old('description'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'description']) !!}
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
  <button type="submit" class="btn btn-primary btn-submit">@lang('app.update')</button>
</div>
{!! Form::close() !!}
