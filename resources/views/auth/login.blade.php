@extends('layouts.auth')

@section('page-title', trans('app.login'))

@section('content') 

<div class="container">

   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12 col-xs-12">
              <div class="center">
                <a href="{{ url('login') }}"><img class="site_logo_login" src="{{ url('public/assets/images/logos/logo.png') }}"></a>
              </div>

              <form id="login-form" action="{{ url('/authenticate/client') }}" method="post" role="form" style="display: block;">
                {{ csrf_field() }}
                  <div class="form-group">
                    <input type="text" name="email" id="username" class="form-control has-feedback-left" placeholder="@lang('app.email')" value="{{ old('email') }}">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control has-feedback-left" placeholder="@lang('app.password')">
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="col-xs-12 form-group pull-right">     
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="@lang('app.log_in')">
                  </div>
                  <div class="col-xs-12 form-group pull-left checkbox">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label for="checkbox1">@lang('app.remember_me')</label>   
                  </div>

                @if(Settings::get('forgot_password'))
                <div class="col-xs-12 form-group pull-left">
                  <a class="reset_pass" id="reset_pass" href="javascript:void(0)">@lang('app.i_forgot_my_password')</a>
                </div>
                @endif
              </form>

              @include('auth.passwords.email')

              @include('auth.register_client')

            </div>
          </div>
        </div>
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
              <a href="#" class="active" id="login-form-link"><div class="login">@lang('app.login')</div></a>
            </div>
            <div class="col-xs-6 tabs">
              <a href="#" id="register-form-link"><div class="register">@lang('app.register')</div></a>
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

@if (Settings::get('terms_and_conditions_show'))
<div class="modal fade" id="terms_and_conditions_modal" tabindex="-1" role="dialog" aria-labelledby="tos-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('app.terms_of_service')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="tos-label">@lang('app.terms_and_conditions')</h3>
            </div>
            <div class="modal-body">
                {!! Settings::get('terms_and_conditions') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
@parent

  <!-- jquery.inputmask -->
  {!! HTML::script('public/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') !!}
  <!-- moment -->
  {!! HTML::script('public/assets/js/moment/moment.min.js') !!}
  <!-- bootstrap-daterangepicker -->
  {!! HTML::script('public/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}

  <script>
  var acept_term_obligatory = "{{ trans('app.acept_term_obligatory') }}";
  </script>

  {!! HTML::script('public/assets/js/client_login.js') !!}

@endsection