@extends('layouts.auth')

@section('content')
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
            @if (session('status'))
             <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                {{ session('status') }}
              </div>
            @endif
        <form class="form-horizontal"  id="login-form" role="form" method="POST" action="{{ url('/password/email') }}">
         {{ csrf_field() }}
          <h1>@lang('app.reset_password')</h1>
           <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
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

          <div>
            <button type="submit" class="btn btn-default">@lang('app.send_password_link_reset')</button>
          </div>

          <div class="clearfix"></div>

          <div class="separator">
              <a href="{{ url('login') }}" class="to_register">@lang('app.back')</a>
            <div class="clearfix"></div>
            <br />

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
