@extends('layouts.app')

@section('page-title', trans('app.service_request'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.service_request')</h2>
  </div>
<!--//banner-->

<div class="content content-wizard">
    <div id="content-table">
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="@lang('app.address')">
                            <span class="round-tab">
                                <i class="fa fa-location-arrow"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="@lang('app.searched') - @lang('app.delivery')">
                            <span class="round-tab">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="@lang('app.packages')">
                            <span class="round-tab">
                                <i class="fa fa-cart-plus"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="@lang('app.order_preview')">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            {!! Form::open(['route' => 'order.store', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
                <div class="tab-content">

                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <div class="title">
                          <h4> @lang('app.address')</h4>
                        </div>

                        @if($exist_address)
                          <table class="table">
                            <thead>
                            <tr>
                              <th>@lang('app.label')</th>
                              <th>@lang('app.address')</th>
                              <th width="10%"></th>
                            </tr>
                            </thead>
                              <tbody id="locations_list" class="form-horizontal">
                              @foreach($client->client_location as $key => $item)
                                @if($item->status == 'accepted')
                                <tr class="row_location">
                                  <td>{{ $item->get_label() }}</td>
                                  <td>{{ $item->address }}</td>
                                  <td>
                                    <button type="button" data-location="{{ $item->id }}" class="btn btn-success select-location"> 
                                      @lang('app.select')
                                    </button>
                                  </td>
                                </tr>
                                @endif
                                @endforeach
                              </tbody>
                           </table>
                        @else
                          <div class="alert alert-warning alert-dismissible fade in" role="alert">
                            @lang('app.dont_address_accepted') <a href="{{ route('client.locations') }}">@lang('app.my_locations')</a>
                          </div>
                        @endif 

                        {{Form::hidden('client_location_id', '', ['id' => 'client_location_id'])}}

                        <ul class="border-top list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">@lang('app.next')</button></li>
                        </ul>
                    </div>

                    <div class="tab-pane" role="tabpanel" id="step2">
                        <div class="title">
                          <h4> @lang('app.searched')</h4>
                        </div>
                        
                        <div class="row margin-bottom-10">            
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              {!! Form::text('date_search', old('date_search'), ['class' => 'form-control datetime has-feedback-left', 'id' => 'date_search', 'readonly' => 'readonly']) !!}
                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                          </div>
                        </div>

                        <div class="row margin-bottom-10"> 
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="time_search" class="form-control" id="time_search">
                              @foreach($working_hours as $working_hour)
                              @if($working_hour['status'] == 'notavailable')
                                 <option value="" disabled="disabled">{{$working_hour['interval'].' - '.trans("app.Not available") }}
                              @else
                                 <option value="{{$working_hour['id']}}">{{$working_hour['interval']}} 
                              @endif
                              @endforeach
                            </select>
                          </div>
                        </div>
                  
                        <div class="title">
                          <h4> @lang('app.delivery')</h4>
                        </div>
             
                        <div class="row margin-bottom-10">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            {!! Form::text('date_delivery', old('date_delivery'), ['class' => 'form-control has-feedback-left datetime', 'id' => 'date_delivery', 'readonly' => 'readonly']) !!}
                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                          </div>                
                        </div>

                        <div class="row margin-bottom-10">
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="time_delivery" class="form-control" id="time_delivery">
                              @foreach($time_delivery as $delivery)
                                @if($delivery['published'] == 'public')
                                <option value="{{$delivery['id']}}">{{$delivery['interval']}}
                                @endif
                              @endforeach
                            </select>  
                          </div>            
                        </div>

                          <div class="title">
                            <h4> @lang('app.details')</h4>
                          </div>

                           <div class="row margin-bottom-10">
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                {!! Form::textarea('special_instructions', old('special_instructions'), ['class' => 'form-control', 'id' => 'special_instructions', 'rows' => '3', 'placeholder' => trans('app.special_instructions')]) !!}
                            </div>
                          </div>
                        
                        <ul class="border-top list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">@lang('app.back')</button></li>
                            <li><button type="button" class="btn btn-primary next-step">@lang('app.next')</button></li>
                        </ul>
                    </div>

                    <div class="tab-pane" role="tabpanel" id="step3">
                      <div class="title">
                        <h4> @lang('app.packages')</h4>
                      </div>

                      <!-- start accordion -->
                      <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                       @foreach($categories as $category)
                          <div class="panel questions">
                            <a class="panel-heading" role="tab" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $category->id }}" aria-expanded="true" aria-controls="collapseOne">
                              <h6 class="panel-title">{{ $category->name }}</h6>
                            </a>
                            <div id="collapse-{{ $category->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-{{ $category->id }}">
                              <div class="panel-body question-answer">
                                  <table class="table">
                                      <tbody>
                                      @foreach($category->package as $package)
                                        @if($package->status)
                                        <tr>
                                          <td>
                                          <button type="button" class="btn btn-primary btn-number"  data-type="minus" data-field="{{$package->id}}"><i class="fa fa-minus"></i></button>
                                          <td class="package-description">

                                          <img src="{{ $package->image }}">

                                           <strong><a href="#description-{{$package->id}}" data-toggle="modal">{{ $package->name }}</strong></a>

                                           <div class="modal fade" id="description-{{$package->id}}" tabindex="-1" role="dialog" aria-labelledby="tos-label">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="@lang('app.terms_of_service')">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h3 class="modal-title">{{ $package->name }}</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! $package->description !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
                                                    </div>
                                                </div>
                                            </div>    
                                           </div>
                                          </td>
                                          <td>
                                            <input type="text" value="0" class="form-control input-number" id="input-number-{{$package->id}}" readonly="readonly">
                                          </td>
                                          <td>
                                          <button type="button" class="btn btn-primary btn-number"  data-type="plus" data-field="{{$package->id}}"><i class="fa fa-plus"></i></button>
                                          </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                      </tbody>
                                   </table>
                              </div>
                            </div>
                          </div>
                      @endforeach
                      </div>
                      <!-- end of accordion -->

                        <ul class="border-top list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full next-step addOrder">@lang('app.next')</button></li>
                        </ul>
                    </div>

                    <div class="tab-pane" role="tabpanel" id="complete">
                      <div class="title">
                        <h4>@lang('app.order_preview')</h4>
                      </div>
                        <div class="row margin-bottom-10 padding-10"  id="packages_table">
                           <!-- load packages -->
                        </div>

                        <div class="title">
                          <h4> @lang('app.code_promo')</h4>
                        </div>

                        <div class="row margin-bottom-10">
                          <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="input-group">
                              {!! Form::text('coupon', old('coupon'), ['class' => 'form-control', 'id' => 'coupon', 'placeholder' => trans('app.coupon'), 'style' => 'height:41px']) !!}
                              <span class="input-group-btn">
                                  <button class="btn btn-primary validate" type="button">@lang('app.validate')</button>
                                </span>
                            </div>
                          </div>
                        </div>
                        {!! Form::hidden('client_coupon_id', '0', ['id' => 'client_coupon_id']) !!}

                      <div class="sub-total" style="display: none;">
                        <div class="title">
                          <h4> @lang('app.sub_total')</h4>
                        </div>

                        <div class="row margin-bottom-10">
                          <div class="product_price col-md-4 col-sm-4 col-xs-12">
                            <h1 class="price"><span id="sub-total">0.00</span> {{Settings::get('coin') }}</h1> 
                          </div>
                        </div>
                      </div>
                      {!! Form::hidden('sub_total', '0', ['id' => 'sub_total_price']) !!}
                          
                        <div class="discount" style="display: none;">
                          <div class="title">
                            <h4> @lang('app.discount')</h4> 
                          </div>

                          <div class="row">
                            <div class="product_price col-md-4 col-sm-4 col-xs-12">
                              <h1 class="price" id="discount">0.00</h1>
                              <h1 class="price" id="discount-porcentage">(0%)</h1>
                            </div>
                          </div>
                          {!! Form::hidden('discount', '0', ['id' => 'discount_price']) !!}
                        </div>
                  
                        <div class="title">
                          <h4> @lang('app.total')</h4>
                        </div>

                        <div class="row margin-bottom-10">
                          <div class="product_price col-md-4 col-sm-4 col-xs-12">
                            <h1 class="price"><span id="total">0.00</span> {{Settings::get('coin') }}</h1> 
                          </div>
                        </div>

                        {!! Form::hidden('total', '0', ['id' => 'total_price']) !!}

                          @if($exist_address)
                          <div class="border-top pull-right">
                            <button type="submit" class="btn btn-primary btn-submit col-md-2 col-sm-3 pull-right col-xs-12">@lang('app.save_order')</button>
                          </div>
                          @endif
                      {!! Form::close() !!}
                    </div>

                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('styles')
{!! HTML::style("public/assets/css/datetimepicker/bootstrap-datetimepicker.css") !!}
@endsection

@section('scripts')

  <!-- bootstrap-daterangepicker -->
  {!! HTML::script('public/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}

<script type="text/javascript">

var first_select_package = "{{ trans('app.first_select_package') }}";
  var first_introduce_coupon = "{{ trans('app.first_introduce_coupon') }}";
  var package_added = "{{ trans('app.package_added') }}";
  var edit = false;
  var count = 1;
  var day_disabled = [0,{!! Settings::get('week') !!},6];
  var today = moment(new Date());
  var url_package_get_details = "{{ route('package.get.details') }}";
  var url_package_show_category = "{{ route('package.show.category') }}";
  var url_validate_coupon = "{{ route('coupon.check') }}";
  var url_preview_order = "{{ route('package.preview.order') }}";
  var endTime = '{!! Settings::get("time_close") !!}';
  var coin = "{{ Settings::get('coin') }}";

  var beginningTime = moment().add({ hours: 0, minutes: 30}).format('h:mm A');

  if(! moment(new Date(beginningTime)).isBefore(new Date(endTime)) ) {
    today =  moment(new Date()).add(1, 'day');
  }

  $('#date_search').datetimepicker({
    format: 'DD-MM-YYYY',
    minDate: today,
    maxDate: moment(today).add(7, 'day'),
    ignoreReadonly: true,
    daysOfWeekDisabled: day_disabled
  });

  var today_search = $('#date_search').val();
  var today_new = today_search.split("-").reverse().join("-");
  var tomorrow = moment(today_new).add(1, 'day');

  $('#date_delivery').datetimepicker({
    format: 'DD-MM-YYYY',
    defaultDate: tomorrow,
    minDate: tomorrow,
    maxDate: moment(today).add(7, 'day'),
    ignoreReadonly: true,
    daysOfWeekDisabled: day_disabled
  }); 

</script>

{!! HTML::script('public/assets/js/services_create.js') !!}

@endsection