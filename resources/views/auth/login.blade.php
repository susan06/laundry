@extends('layouts.auth')

@section('content')

<div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="login-form" action="{{ url('/authenticate/client') }}" method="post" role="form" style="display: block;">
               {{ csrf_field() }}
                <h2>{{ Settings::get('app_name') }} - LOGIN</h2>
                  <div class="form-group">
                    <input type="text" name="email" id="username" tabindex="1" class="form-control" placeholder="@lang('app.email')" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="@lang('app.password')">
                  </div>
                  <div class="col-xs-12 form-group pull-right">     
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="@lang('app.log_in')">
                  </div>
                  <div class="col-xs-12 form-group pull-left checkbox">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label for="checkbox1">@lang('app.remember_me')</label>   
                  </div>
              </form>
              <form id="register-form" action="#" method="post" role="form" style="display: none;">
                <h2>REGISTER</h2>
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                      </div>
                    </div>
                  </div>
              </form>
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

@endsection

@section('scripts')
@parent

    <script>

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
      $("#register-form").fadeOut(100);
      $('#register-form-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
      $("#register-form").delay(100).fadeIn(100);
      $("#login-form").fadeOut(100);
      $('#login-form-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
    });
        $(document).on('click', '.btn-register', function (e) {
            e.preventDefault();
            var form = $('#form_register'); 
            if( $('#accept_terms').is(':checked') ) {
              $.ajax({
                  url: form.attr('action'),
                  type: 'post',
                  data: form.serialize(),
                  dataType: 'json',
                  success: function(response) {
                      var message = '';
                      if(response.success){
                          notify('success', response.message);
                          form.reset[0];
                          $('.form-group').removeClass('has-error')
                                    .removeClass('has-success');
                          $('.help-block').remove();
                      } else {
                        console.log(response.message);
                        $('.form-group').removeClass('has-error');
                        $('.form-control').removeClass('parsley-error');
                        $('.help-block').remove();
                        $.each(response.message, function(key, value) {
                          var element = $('#' + key + '_reg');
                          var form_group = element.closest('.form-group');
                          if(value.length) {
                            element.addClass('parsley-error');
                            form_group.removeClass('has-success');
                            form_group.addClass('has-error');
                            element.after('<span class="help-block">' + value +'</span>');
                          } else {
                            form_group.addClass('has-success');
                          }
                        });
                      }
                  }
              });
            } else {
              notify('error', "@lang('app.acept_term_obligatory')");
            }
        });

        $(document).on('click', '#accept_terms', function (e) {
            if( $('#accept_terms').is(':checked') ) {
              document.getElementById('btn-register').disabled = false;
            } else {
              document.getElementById('btn-register').disabled = true;
            }
        });

    </script>

@endsection