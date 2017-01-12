<div class="modal-body">
{!! Form::model($user, ['route' => ['admin-client.update', $user->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.name')">@lang('app.name') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name', 'disabled' => 'true']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.last_name')">@lang('app.lastname') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'lastname', 'disabled' => 'true']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.email')">@lang('app.email') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('email', old('email'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'email', 'disabled' => 'true']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.mobile')">@lang('app.mobile') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('mobile', old('mobile'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'mobile', 'disabled' => 'true']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.telephone')">@lang('app.telephone') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('telephone', old('telephone'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'telephone', 'disabled' => 'true']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.date_of_birth')">@lang('app.date_of_birth') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('date_of_birth', old('date_of_birth'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'date_of_birth', 'disabled' => 'true']) !!}
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.status')">@lang('app.status') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::select('status', $status, old('status'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'status_client', 'disabled' => 'true']) !!}
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}
