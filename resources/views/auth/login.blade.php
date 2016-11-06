@extends('layouts.auth')

@section('content')
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="form-horizontal"  id="login-form" role="form" method="POST" action="{{ url('/login') }}">
             {{ csrf_field() }}
              <h1>Login</h1>
               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-3 col-xs-3 control-label">Email</label>
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
                    <label for="password" class="col-md-3 col-xs-3 control-label">Password</label>
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
                <a class="reset_pass" href="{{ url('/password/reset') }}">@lang('app.i_forgot_my_password')</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">@lang('app.dont_have_an_account')
                  <a href="#signup" class="to_register">@lang('app.create_account')</a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>{{ config('app.name') }}</h1>
                  <p>©2016 @lang('app.all_rights_reserved')</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>@lang('app.create_account')</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>{{ config('app.name') }}</h1>
                  <p>©2016 @lang('app.all_rights_reserved')</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
@endsection
