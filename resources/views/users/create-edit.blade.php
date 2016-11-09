<div class="modal-body">
@if($edit)
{!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@else
 {!! Form::open(['route' => 'user.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
@endif
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.name')">@lang('app.name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('name', old('name'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.last_name')">@lang('app.last_name') <span class="required">*</span>
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
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.role')">@lang('app.role') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'role_id']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.role')">@lang('app.status') <span class="required">*</span>
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

@section('scripts_modal')

@if($edit)
  {!! JsValidator::formRequest('App\Http\Requests\User\UpdateUser', '#form-modal') !!}
@else
  {!! JsValidator::formRequest('App\Http\Requests\User\CreateUser', '#form-modal') !!}
@endif

@endsection
