<!-- form register -->
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
      <input type="text" name="birthday" id="birthday" class="form-control has-feedback-left" placeholder="@lang('app.birthday')" value="" readonly="readonly">
      <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
    </div>
    <!--
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
    -->
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
    <div class="col-xs-12 form-group pull-left checkbox">
      <input type="checkbox" name="accept_terms" id="accept_terms" value="1"/>
      <label for="accept_terms">@lang('app.i_accept') <a href="#terms_and_conditions_modal" data-toggle="modal">@lang('app.terms_of_service')</a></label>     
    </div>
    @else
      <input type="checkbox" name="accept_terms" id="accept_terms" value="1" checked="checked" style="display: none" />
    @endif
    <div class="col-xs-12 form-group pull-left checkbox">
      <input type="checkbox" id="accept_promotions" name="accept_promotions" value="1"/>
      <label for="accept_promotions">@lang('app.i_accept') @lang('app.send_promotions_descuent')</label>
    </div>
    <br/>
    <div class="form-group">
      <div class="row">
        <div class="col-xs-12">
          <input type="submit" name="register-submit" tabindex="4" class="form-control btn btn-register btn-submit" id="btn-register" value="@lang('app.register')">
        </div>
      </div>
    </div>
</form>