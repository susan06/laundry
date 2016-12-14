<!-- form reset password -->
<form id="reset-form" action="{{ url('/password/remind') }}" method="post" role="form" style="display: none;">
  {{ csrf_field() }}
    <div class="form-group">
      <input type="email" name="email" id="email_reset" class="form-control has-feedback-left" placeholder="@lang('app.email')">
      <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
    </div>

    <div class="col-xs-12 form-group pull-right">     
      <input type="submit" id="login-submit" tabindex="4" class="form-control btn btn-login btn-submit" value="@lang('app.send_password_link_reset')">
    </div>
</form>