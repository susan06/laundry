<div class="modal-body">
 {!! Form::open(['route' => 'admin-client.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
  
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
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.email')">@lang('app.email') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('email', old('email'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'email']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.password')">@lang('app.password') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('password', old('password'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'password']) !!}
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.confirm_password')">@lang('app.confirm_password') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('confirm_password', old('confirm_password'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'confirm_password']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.mobile')">@lang('app.mobile') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('mobile', old('mobile'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'mobile']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.telephone')">@lang('app.telephone') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('telephone', old('telephone'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'telephone']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.date_of_birth')">@lang('app.date_of_birth') 
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
      {!! Form::select('status', $status, 'Active', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'status']) !!}
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
  @if($edit)
    <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.update')</button>
  @else
      <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.save')</button>
  @endif
</div>

{!! Form::close() !!}

