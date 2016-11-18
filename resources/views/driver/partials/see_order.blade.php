<fieldset>
<legend>@lang('app.bag_code')</legend>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="00000">
    <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
  </div>

  </fieldset>

<fieldset>
<legend>@lang('app.branch_office_and_service')</legend>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="@lang('app.branch_office')">
    <span class="fa fa-building-o form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-right" id="inputSuccess4" placeholder="@lang('app.service')">
    <span class="fa fa-bookmark-o form-control-feedback right" aria-hidden="true"></span>
  </div>

  </fieldset>

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
    <input type="text" class="form-control" id="inputSuccess5" placeholder="@lang('app.mobile')">
    <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="@lang('app.telephone')">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control" id="inputSuccess5" placeholder="@lang('app.address')">
    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
<label for="message">@lang('app.delivery_notes')</label>
                          <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                            </div>                     
  
</form>
</fieldset>

<fieldset>
<legend>@lang('app.merchandise_details')</legend>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="@lang('app.collection_date')">
    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-right" id="inputSuccess4" placeholder="@lang('app.collection_hour')">
    <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
  </div>

  </fieldset>

<fieldset>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="@lang('app.delivery_date')">
    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-right" id="inputSuccess4" placeholder="@lang('app.delivery_hour')">
    <span class="fa fa-clock-o form-control-feedback right" aria-hidden="true"></span>
  </div>

  </fieldset>

<fieldset>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
<label for="message">@lang('app.cleaning_instructions')</label>
                          <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                            </div>
</fieldset>

