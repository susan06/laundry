<div class="modal-body">
{!! Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12 hor-form" for="@lang('app.name')">@lang('app.name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12 hor-form">
    {!! Form::text('name', old('name'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12 hor-form" for="@lang('app.last_name')">@lang('app.last_name') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'lastname']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12 hor-form" for="@lang('app.email')">@lang('app.email') <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('email', old('email'), ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'email']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12 hor-form" for="@lang('app.birthday')">@lang('app.birthday')
    </label>
    <div class="col-md-3 col-sm-3 col-xs-12">
    {!! Form::text('birthday', isset($user->birthday) ? $user->birthday : old('birthday'), ['class' => 'form-control col-md-4 col-xs-6 birthday', 'id' => 'birthday', 'data-inputmask' => "'mask' : '99-99-9999'"]) !!}
    </div>
  </div> 
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12 hor-form" for="@lang('app.mobile')">@lang('app.phone_mobile') <span class="required">*</span>
    </label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    {!! Form::text('phone_mobile', $phones['phone_mobile'], ['class' => 'form-control col-md-7 col-xs-12 phones', 'id' => 'mobile', 'data-inputmask' => "'mask' : '9999999999'"]) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12 hor-form" for="@lang('app.phone_home')">@lang('app.phone_home') 
    </label>
    <div class="col-md-4 col-sm-4 col-xs-12">
    {!! Form::text('phone_home', $phones['phone_home'], ['class' => 'form-control col-md-7 col-xs-12 phones', 'id' => 'telephone', 'data-inputmask' => "'mask' : '9999999'"]) !!}
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="submit" class="btn btn-primary btn-submit col-sm-3 col-xs-6">@lang('app.update')</button>
  <button type="button" class="btn btn-default col-sm-3 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
</div>
{!! Form::close() !!}

<script>
  $(document).ready(function() {

    $(".phones").inputmask();
    $(".birthday").inputmask();

  });
</script>