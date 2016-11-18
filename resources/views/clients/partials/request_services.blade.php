<fieldset>
<legend>@lang('app.address')</legend>
<form class="form-horizontal form-label-left input_mask">

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="@lang('app.address')">
    <span class="fa fa-globe form-control-feedback left" aria-hidden="true"></span>
  </div>

</form>
</fieldset>

<fieldset>
<legend>@lang('app.select_address')</legend>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    Usted no tiene ninguna dirección confirmada
  </div>

</fieldset>


<fieldset>
<legend>@lang('app.delivery_notes')</legend>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
<label for="message">@lang('app.additional_delivery_notes')</label>
                          <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                            </div>
</fieldset>

<fieldset>
<legend>@lang('app.merchandise_details')</legend>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="@lang('app.collection_date')">
    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
    <div class="radio">
        <label>
          <input type="radio" name="radio-inline" checked>
                          <i></i>@lang('app.today')</label>
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="radio-inline">
                          <i></i>@lang('app.tomorrow')</label>
      </div>
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

<fieldset>

  

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess5" placeholder="@lang('app.voucher_code')">
    <span class="fa fa-barcode form-control-feedback left" aria-hidden="true"></span>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control" id="inputSuccess5" disabled="disabled" placeholder="@lang('app.total')">
    <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
  </div>

  <div class="form-group">
    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
      <button type="submit" class="btn btn-primary">Cancel</button>
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </div> 
</fieldset>