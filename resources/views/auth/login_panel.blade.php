@extends('layouts.auth')

@section('content')
    <div>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="form-horizontal"  id="login-form" role="form" method="POST" action="{{ url('/authenticate') }}">
             {{ csrf_field() }}
              <h1>@lang('app.panel_administration')</h1>
               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-3 col-xs-3 control-label">@lang('app.email')</label>
                    <div class="col-md-9 col-xs-9">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
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
              <div>
                <button type="submit" class="btn btn-default">Login</button>
                @if(Settings::get('forgot_password'))
                <a class="reset_pass" href="{{ url('/password/reset') }}">@lang('app.i_forgot_my_password')</a>
                @endif
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
    </div>
@endsection
