<!-- page content -->
        
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    
                    <div class="col-md-12 col-sm-12 col-xs-12">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="contact-tab" role="tab" data-toggle="tab" aria-expanded="true">@lang('client.contact_information')</a> 
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="financial-tab" data-toggle="tab" aria-expanded="false">@lang('client.financial_state')</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="plan-tab" data-toggle="tab" aria-expanded="false">@lang('client.plan_details')</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="rate-tab" data-toggle="tab" aria-expanded="false">@lang('client.rate_app')</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="contact-tab">

                            <!-- start contact information -->
                            <form class="form-horizontal form-label-left" novalidate>

                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">@lang('client.first_name')
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="first_name" placeholder="" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">@lang('client.last_name')
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="last_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="last_name" placeholder="" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">@lang('client.email')
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="email" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="email" placeholder="" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">@lang('client.email')
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="email" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="email" placeholder="" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile">@lang('client.mobile')
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="mobile" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="mobile" placeholder="" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">@lang('client.telephone')
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="telephone" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="telephone" placeholder="" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_of_birth">@lang('client.date_of_birth')
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="date_of_birth" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="date_of_birth" placeholder="" required="required" type="text">
                              </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">@lang('client.edit')</button>
                              </div>
                            </div>
                          </form>
                            <!-- end contact information -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="financial-tab">

                            <!-- start financial state -->

                            <form class="form-horizontal form-label-left" novalidate>
                            <legend>@lang('client.credit_card_details')</legend>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_on_card">@lang('client.name_on_card')
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name_on_card" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name_on_card" placeholder="" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">@lang('client.number')
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="number" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="number" placeholder="" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cvv">@lang('client.cvv')
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="cvv" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="cvv" placeholder="" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="month_of_expiration">@lang('client.month_of_expiration')
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="month_of_expiration" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="month_of_expiration" placeholder="" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="year_of_expiration">@lang('client.year_of_expiration')
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="year_of_expiration" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="year_of_expiration" placeholder="" required="required" type="text">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">@lang('client.edit')</button>
                        </div>
                      </div>
                    </form>
                            
                            <!-- end financial state -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="plan-tab">

                          <!-- start plan details -->
                            <div class="col-md-12 col-sm-6 col-xs-12">
                              <div class="pricing">
                                <div class="title">
                                  <h2>Tally Box Design</h2>
                                  <h1>free</h1>
                                </div>
                                <div class="x_content">
                                  <div class="">
                                    <div class="pricing_features">
                                      <ul class="list-unstyled text-left">
                                        <li><i class="fa fa-times text-danger"></i> 2 years access <strong> to all storage locations</strong></li>
                                        <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> storage</li>
                                        <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                        <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                        <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                        <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> access to all files</li>
                                        <li><i class="fa fa-times text-danger"></i> <strong>Allowed</strong> to be exclusing per sale</li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- end plan details -->
                          </div>

                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="rate-tab">

                            <!-- start rate app-->
                            
                            <!-- end rate app -->

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
        <!-- /page content -->