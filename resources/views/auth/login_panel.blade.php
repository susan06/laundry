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
              <div class="center">
                <a href="{{ url('login') }}"><img class="site_logo_login" src="{{ url('public/assets/images/logos/logo.png') }}"></a>
              </div>
              <form id="login-form" action="{{ url('/authenticate/administration') }}" method="post" role="form" style="display: block;">
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
              </form>

              @include('auth.passwords.email')

            </div>
          </div>
        </div>
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
              <a href="#" class="active" id="login-form-link"><div class="login">@lang('app.login')</div></a>
            </div>
            <div class="col-xs-6 tabs">
              <a href="#" id="reset_pass"><div class="register active">@lang('app.i_forgot_my_password')</div></a>
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

@section('scripts')
@parent

  <script>
    $('#login-form-link').click(function(e) {
      $("#login-form").delay(100).fadeIn(100);
      $("#reset-form").fadeOut(100);
      $("#reset-form").get(0).reset();
      $('#reset_pass').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });

    $('#reset_pass').click(function(e) {
      $("#reset-form").delay(100).fadeIn(100);
      $("#login-form").fadeOut(100);
      $('#login-form-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });

  $(document).on('click', '.btn-submit', function (e) {
      e.preventDefault();
      showLoading();
      var $this = $(this);
      var form_id = $this.closest("form").attr("id"); 
      var form = $('#'+form_id);
      var type = $('#'+form_id+' input[name="_method"]').val();
      if(typeof type == "undefined") {
          type = form.attr('method');
      }
      $.ajax({
          url: form.attr('action'),
          type: type,
          data: form.serialize(),
          dataType: 'json',
          success: function(response) {
              hideLoading();
              var message = '';
              if(response.success){
                  notify('success', response.message);
                  $('#'+form_id).get(0).reset();
                  if(response.url_return) {
                      showLoading();
                      window.location.href = response.url_return;
                  }
              } else {
                if(response.validator) {
                  var message = '';
                  $.each(response.message, function(key, value) {
                    message += value+' ';
                  });
                  notify('error', message);
                } else {
                  notify('error', response.message);
                }
              }
          },
          error: function (status) {
              hideLoading();
              notify('error', status.statusText);
          }
      });
  });
  </script>

@endsection
