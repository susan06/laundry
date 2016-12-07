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
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.mobile')">@lang('app.mobile') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('mobile', old('phones["mobile"]'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'mobile']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.telephone')">@lang('app.telephone') 
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('telephone', old('phones["home"]'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'telephone']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.birthday')">@lang('app.birthday')
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('birthday', isset($user->birthday) ? date_format(date_create($user->birthday), 'd-m-Y') : old('birthday'), ['class' => 'form-control col-md-4 col-xs-6', 'id' => 'birthday', 'readonly' => 'readonly']) !!}
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
  @if($edit)
    <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.update')</button>
  @else
      <button type="submit" class="btn btn-primary btn-submit col-sm-2 -xs-6">@lang('app.save')</button>
  @endif
  <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}
 
<script>
  $(document).ready(function() {

      $(":input").inputmask();

      @if($edit)
        $('#birthday').datetimepicker({
          format: 'DD-MM-YYYY',
          ignoreReadonly: true
        });
      @else
        $('#birthday').datetimepicker({
          format: 'DD-MM-YYYY',
          ignoreReadonly: true
        });
      @endif
  });
</script>
