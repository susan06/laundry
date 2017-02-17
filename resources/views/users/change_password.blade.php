@extends('layouts.app')

@section('page-title',  trans('app.auth_and_registration'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.auth_and_registration')</h2>
  </div>
<!--//banner-->

  <div class="grid-form">
    <div class="grid-form1">
            {!! Form::open(['route' => ['user.password.update'], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12 hor-form" for="@lang('app.password')">@lang('app.password') <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::password('password', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'password']) !!}
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12 hor-form" for="@lang('app.password_confirmation')">@lang('app.confirm_password') <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::password('password_confirmation', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'password_confirmation']) !!}
                </div>
              </div>

          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-10 col-xs-12">
              <button type="submit" class="btn btn-primary btn-submit col-sm-4 col-xs-12">@lang('app.change_password')</button>
            </div>
          </div>

          {!! Form::close() !!}
    </div>
   </div> 

@endsection
