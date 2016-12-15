@extends('layouts.auth')

@section('page-title', trans('app.reset_password'))

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
              <form id="login-form" action="{{ url('/password/reset') }}" method="post" role="form" style="display: block;">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="admin" value="{{ $admin }}">
                <div class="reset">
                  <div class="form-group">
                    <input type="text" name="email" id="email" class="form-control has-feedback-left" placeholder="@lang('app.email')" value="{{ $email }}" readonly="readonly">
                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
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
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-12">
                        <input type="submit" name="register-submit" tabindex="4" class="form-control btn btn-register btn-submit" id="btn-register" value="@lang('app.reset_password')">
                      </div>
                    </div>
                  </div>
                </div>
                   <div class="form-group login" style="display: none;">
                    <div class="row">
                      <div class="col-xs-12">
                        @if($admin == 'true')
                          <a href="{{ route('panel') }}" class="form-control btn btn-register" id="login-form-link"><div class="login">@lang('app.login')</div></a>
                        @else
                          <a href="{{ route('login') }}" class="form-control btn btn-register" id="login-form-link"><div class="login">@lang('app.login')</div></a>
                        @endif
                        </div>
                      </div>
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

@section('scripts')
@parent

  <script>

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
                  $('.reset').hide();
                  $('.login').show();
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


