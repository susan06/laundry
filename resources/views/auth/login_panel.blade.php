@extends('layouts.auth')

@section('page-title', trans('app.login'))

@section('content')

<div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="login-form" action="{{ url('/authenticate/administration') }}" method="post" role="form" style="display: block;">
               {{ csrf_field() }}
                <h2>{{ Settings::get('app_name') }} - @lang('app.panel_administration')</h2>
                  <div class="form-group">
                    <input type="text" name="email" id="username" tabindex="1" class="form-control" placeholder="@lang('app.email')" value="{{ old('email') }}" required autofocus>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="@lang('app.password')" required>
                  </div>
                  <div class="col-xs-12 form-group pull-right">     
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="@lang('app.log_in')">
                  </div>
                  <div class="col-xs-12 form-group pull-left checkbox">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label for="checkbox1">@lang('app.remember_me')</label>   
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>
    <div class="container">
        <div class="col-md-10 col-md-offset-1 text-center">
            <h6 style="font-size:14px;font-weight:100;color: #fff;">©2016 @lang('app.all_rights_reserved')</a></h6>
        </div>   
    </div>
</footer>

@endsection
