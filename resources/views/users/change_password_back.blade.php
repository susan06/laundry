@extends('layouts.back')

@section('page-title',  trans('app.auth_and_registration'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.auth_and_registration')</h3>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            {!! Form::open(['route' => ['user.password.update'], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.password')">@lang('app.password') <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::password('password', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'password']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="@lang('app.password_confirmation')">@lang('app.confirm_password') <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::password('password_confirmation', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'password_confirmation']) !!}
                </div>
              </div>
            <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-primary btn-submit col-sm-6 col-xs-12">@lang('app.change_password')</button>
                </div>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

@endsection