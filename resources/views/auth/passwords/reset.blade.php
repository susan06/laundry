@extends('layouts.auth')

@section('content')
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form class="form-horizontal"  id="login-form" role="form" method="POST" action="{{ url('/password/reset') }}">
         {{ csrf_field() }}
          <input type="hidden" name="token" value="{{ $token }}">
          <h1>Login</h1>
           <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-3 col-xs-3 control-label">@lang('app.email')</label>
                <div class="col-md-9 col-xs-9">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-3 col-xs-3 control-label">@lang('app.password')</label>
                <div class="col-md-9 col-xs-9">
                    <input id="password" type="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>  
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-3 col-xs-3 control-label">@lang('app.confirm_password')</label>
                <div class="col-md-9 col-xs-9">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

          <div>
            <button type="submit" class="btn btn-default">@lang('app.reset_password')</button>
          </div>

          <div class="clearfix"></div>

          <div class="separator">
            <div>
              <h1>{{ Settings::get('app_name') }}</h1>
              <p>©2016 @lang('app.all_rights_reserved')</p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
@endsection
