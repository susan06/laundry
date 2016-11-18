<fieldset>
<legend>@lang('app.client_data')</legend>
<form class="form-horizontal form-label-left input_mask">

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="@lang('app.first_name')">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control" id="inputSuccess3" placeholder="@lang('app.last_name')">
    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="@lang('app.email')">
    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control" id="inputSuccess3" placeholder="@lang('app.password')">
    <span class="fa fa-lock form-control-feedback right" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="@lang('app.confirm_password')">
    <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control" id="inputSuccess5" placeholder="@lang('app.mobile')">
    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="@lang('app.telephone')">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control" id="inputSuccess5" placeholder="@lang('app.date_of_birth')*">
    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
  </div>                     
  
</form>
</fieldset>

<fieldset>
<legend>@lang('app.credit_card_details')</legend>

  <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="radio">
        <label>
          <input type="radio" name="radio-inline" checked>
                          <i></i>Visa</label>
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="radio-inline">
                          <i></i>MasterCard</label>
      </div>
    </div>


  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess5" placeholder="@lang('app.name_on_card')">
    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
  </div> 

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control" id="inputSuccess5" placeholder="@lang('app.number')">
    <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
  </div>                 

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess5" placeholder="@lang('app.cvv')">
    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control" id="inputSuccess5" placeholder="@lang('app.month_of_expiration')">
    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess5" placeholder="@lang('app.year_of_expiration')">
    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="checkbox">
        <label>
          <a href="{{ route('clients.terms') }}" target="_blank"><input type="checkbox" value="">@lang('app.accept_terms_and_conditions')</a>
        </label>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" value="">@lang('app.receive_promotion_and_discounts')
        </label>
      </div>
    </div>

  <div class="form-group">
    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
      <button type="submit" class="btn btn-primary">Cancel</button>
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </div> 
</fieldset>