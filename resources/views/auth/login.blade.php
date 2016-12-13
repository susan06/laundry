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
              <a href="{{ url('login') }}"><img class="site_logo_login" src="{{ url('public/assets/images/logos/logo.png') }}"></a>
              <form id="login-form" action="{{ url('/authenticate/client') }}" method="post" role="form" style="display: block;">
               {{ csrf_field() }}
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
              <form id="register-form" action="{{ url('/registration') }}" method="post" role="form" style="display: none;">
              {{ csrf_field() }}
                  <div class="form-group">
                    <input type="text" name="name" id="firstname" class="form-control has-feedback-left" placeholder="@lang('app.name')" value="">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="text" name="lastname" id="lastname" class="form-control has-feedback-left" placeholder="@lang('app.lastname')" value="">
                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="text" name="email" id="email" class="form-control has-feedback-left" placeholder="@lang('app.email')" value="">
                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="text" name="phone_mobile" id="phone_mobile" class="form-control inputmask has-feedback-left" placeholder="@lang('app.phone_mobile')" value="" data-inputmask="'mask' : '999999999'">
                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="email" name="birthday" id="birthday" class="form-control has-feedback-left" placeholder="@lang('app.birthday')" value="" readonly="readonly">
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="text" name="card_number" id="card_number" class="form-control inputmask has-feedback-left" placeholder="@lang('app.card_number')" value="" data-inputmask="'mask' : '9999-9999-9999-9999'">
                    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="text" name="validaty_card" id="validaty_card" class="form-control has-feedback-left" placeholder="@lang('app.validaty_card')" value="">
                    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="text" name="cvv" id="cvv" tabindex="1" class="form-control inputmask has-feedback-left" placeholder="@lang('app.cvv')" value="" data-inputmask= "'mask' : '999'">
                    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control has-feedback-left" placeholder="@lang('app.password')">
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password_confirmation" id="confirm-password" class="form-control has-feedback-left" placeholder="@lang('app.confirm_password')">
                    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                  </div>
                  <br/>
                  @if (Settings::get('terms_and_conditions_show'))
                  <div>
                      <input type="checkbox" name="accept_terms" id="accept_terms" value="1"/>
                      @lang('app.i_accept') <a href="#terms_and_conditions_modal" data-toggle="modal">@lang('app.terms_of_service')</a>
                  </div>
                  @else
                    <input type="checkbox" name="accept_terms" id="accept_terms" value="1" checked="checked" style="display: none" />
                  @endif
                  <div>
                      <input type="checkbox" name="accept_promotions" value="1"/>
                      @lang('app.i_accept') @lang('app.send_promotions_descuent')
                  </div>
                  <br/>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12">
                        <input type="submit" name="register-submit" tabindex="4" class="form-control btn btn-register" id="btn-register" value="@lang('app.register')">
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

    $(".inputmask").inputmask();

    $('#validaty_card').inputmask("99-99", { "placeholder": "MM-YY" });

    $('#birthday').datetimepicker({
      format: 'DD-MM-YYYY',
      ignoreReadonly: true,
      viewMode: 'years'
    });

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

    $(document).on('click', '#btn-register', function (e) {
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