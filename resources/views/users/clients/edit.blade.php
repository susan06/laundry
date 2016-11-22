<div class="modal-body">
{!! Form::model($user, ['route' => ['admin-client.update', $user->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
  
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.name')">@lang('app.name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.last_name')">@lang('app.lastname') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'lastname']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.mobile')">@lang('app.mobile') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('mobile', old('mobile'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'mobile']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.telephone')">@lang('app.telephone') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('telephone', old('telephone'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'telephone']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.date_of_birth')">@lang('app.date_of_birth') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('date_of_birth', old('date_of_birth'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'date_of_birth']) !!}
    </div>
  </div>
  

  @if($role)
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.role')">@lang('app.role') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'role_id']) !!}
    </div>
  </div>
  @else
  <!-- role_id driver -->
  {!! Form::hidden('role_id', '2' ) !!}
  @endif 
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.status')">@lang('app.status') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::select('status', $status, old('status'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'status']) !!}
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
    <button type="submit" class="btn btn-primary btn-submit">@lang('app.update')</button>
</div>

{!! Form::close() !!}

