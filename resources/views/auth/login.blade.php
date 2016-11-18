@extends('layouts.auth')

@section('content')
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form class="form-horizontal"  id="login-form" role="form" method="POST" action="{{ url('/authenticate') }}">
             {{ csrf_field() }}
              <h1>Login</h1>
               <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-3 col-xs-3 control-label">@lang('app.email')</label>
                    <div class="col-md-9 col-xs-9">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-3 col-xs-3 control-label">@lang('app.password')</label>
                    <div class="col-md-9 col-xs-9">
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>  
                </div>
              <div>
                <button type="submit" class="btn btn-default">Login</button>
                @if(Settings::get('forgot_password'))
                <a class="reset_pass" href="{{ url('/password/reset') }}">@lang('app.i_forgot_my_password')</a>
                @endif
              </div>

              <div class="clearfix"></div>

              <div class="separator">
              @if(Settings::get('reg_enabled'))
                <p class="change_link">@lang('app.dont_have_an_account')
                  <a href="#signup" class="to_register">@lang('app.create_account')</a>
                </p>
              @endif
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>{{ Settings::get('app_name') }}</h1>
                  <p>©2016 @lang('app.all_rights_reserved')</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form class="form-horizontal" role="form" method="POST" id="form_register" action="{{ url('/registration') }}">
              {{ csrf_field() }}
              <h1>@lang('app.create_account')</h1>
              <div class="form-group">
                <input type="text" name="name" id="name_reg" class="form-control" placeholder="@lang('app.name')" required="required" />
                <span class="help-block"></span>        
              </div>
              <div class="form-group">
                <input type="text" name="lastname" id="lastname_reg" class="form-control" placeholder="@lang('app.lastname')" required="required" />
              </div>
              <div class="form-group">
                <input type="email" name="email" id="email_reg" class="form-control" placeholder="@lang('app.email')" required="required" />
              </div>
              <div class="form-group">
                <input type="password" name="password" id="password_reg" class="form-control" placeholder="@lang('app.password')" required="required" />
              </div>
              <div class="form-group"> 
                <input type="password" name="password_confirmation" id="password_confirmation_reg" class="form-control" placeholder="@lang('app.confirm_password')" required="required" />
              </div>
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
              <br>
              <div>
                <button class="btn btn-default submit" id="btn-register" disabled="disabled" type="submit">@lang('app.register')</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">@lang('app.already a member?')
                  <a href="#signin" class="to_register"> Login </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>{{ config('app.name') }}</h1>
                  <p>©2016 @lang('app.all_rights_reserved')</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>

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
                    {{ Settings::get('terms_and_conditions') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('scripts')
@parent

    <script>

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