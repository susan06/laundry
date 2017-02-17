<div class="col-md-12">
        <!-- New widget -->
        <div class="powerwidget" data-widget-editbutton="false">
          
          <div class="inner-spacer">


            <h2>@lang('app.invite_friend_to_disccounts')</h2>
            <br>

            <fieldset>
                <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control has-feedback-right" id="inputSuccess4" placeholder="@lang('app.emails')">
                <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
              </div>
            </fieldset>

            <fieldset>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                <textarea id="message" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10" placeholder="@lang('app.personal_note')"></textarea>
                                        </div>
            <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-success">@lang('app.send_invitation')</button>
            </div>
          </div> 
            </fieldset>
            
            </div>
        </div>
      </div>