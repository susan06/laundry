<div class="title"><h4>@lang('app.details')</h4></div>
<table class="table" cellspacing="0" width="100%">
  <tbody>
        <tr>
            <td width="50%">
            <div class="title_list_order">@lang('app.status_driver')</div>
               <div class="text-center"> {!! $order->getStatus() !!}</div>
            </td>
            <td width="50%">
            <div class="title_list_order">@lang('app.bag_code')</div>
              <div class="text-center"> {{ $order->bag_code }}</div>
            </td>
        </tr>
        <tr>
            <td width="50%">
            <div class="title_list_order">@lang('app.searched')</div>
              <div class="float_left">{{ $order->date_search }}</div>
              <div class="float_right">{{ $order->get_time_search() }}</div>
            </td>
            <td width="50%">
            <div class="title_list_order">@lang('app.delivery')</div>
              <div class="float_left">{{ $order->date_delivery }}</div>
              <div class="float_right">{{ $order->get_time_delivery() }}</div>
            </td>
        </tr>
        <tr>
            <td width="50%">
            <div class="title_list_order">@lang('app.branch_office')</div>
              <div class="text-center">{{ ($order->branch_office_id) ? $order->branch_office->name.', '.$order->location_branch()->address : '' }}</div>
            </td>
            <td width="50%">
            <div class="title_list_order">@lang('app.driver')</div>
             <div class="text-center"> {{ ($order->driver_id) ? $order->driver->full_name() : '' }}</div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
             <div class="progress">
                <div class="circle {{($order->status == 'search') ?  'active' : '' }} 
                {{($order->status == 'recoge') ?  'done' : '' }}
                {{($order->status == 'inbranch') ?  'done' : '' }}
                {{($order->status == 'inexit') ?  'done' : '' }}
                {{($order->status == 'delivered') ?  'done' : '' }}">
                  <span class="label label-progress"><i class="fa fa-2x fa-calendar"></i></span>
                  <span class="title">@lang('app.searched')</span>
                </div>
                <span class="bar done"></span>
                <div class="circle {{($order->status == 'recoge') ?  'active' : '' }}
                {{($order->status == 'inbranch') ?  'done' : '' }}
                {{($order->status == 'inexit') ?  'done' : '' }}
                {{($order->status == 'delivered') ?  'done' : '' }}">
                  <span class="label label-progress"><i class="fa fa-2x fa-car"></i></span>
                  <span class="title">@lang('app.recoge')</span>
                </div>
                <span class="bar half"></span>
                <div class="circle {{($order->status == 'inbranch') ?  'active' : '' }}
                {{($order->status == 'inexit') ?  'done' : '' }}
                {{($order->status == 'delivered') ?  'done' : '' }}">
                  <span class="label label-progress"><i class="fa fa-2x fa-building-o"></i></span>
                  <span class="title">@lang('app.inbranch')</span>
                </div>
                <span class="bar"></span>
                <div class="circle {{($order->status == 'inexit') ?  'active' : '' }}
                {{($order->status == 'delivered') ?  'done' : '' }}">
                  <span class="label label-progress"><i class="fa fa-2x fa-car"></i></span>
                  <span class="title">@lang('app.inexit')</span>
                </div>
                <span class="bar"></span>
                <div class="circle {{($order->status == 'delivered') ?  'done' : '' }}">
                  <span class="label label-progress"><i class="fa fa-2x fa-check"></i></span>
                  <span class="title">@lang('app.delivered')</span>
                </div>
              </div>
            </td>
        </tr>
  </tbody>
</table>

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table">
      <div class="title"><h4>@lang('app.items') ({{ $order->order_package->count() }})</h4></div>
      <table class="table table-striped font-size-18">
        <thead>
          <tr>
            <th>@lang('app.service')</th>
            <th>@lang('app.sub_total')</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($order->order_package as $key => $package)
            <tr>
                <td>{{ $package->name }}</td>
                <td>{{ $package->price }}</td>
            </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row --> 
  <div class="col-xs-12">
      <div class="table-responsive">
        <table class="table font-size-18">
          <tbody>
            <tr>
              <th style="width:50%">@lang('app.sub_total'):</th>
              <td>{{ $order->sub_total.' '.Settings::get('coin') }}</td>
            </tr>
              @if($order->discount)
              <tr>
                <th>{{ $order->client_coupon->coupon->percentage }}</th>
                <td>{{ $order->discount.' '.Settings::get('coin') }}</td>
              </tr>
              @endif
            <tr>
              <th><strong>@lang('app.total'):</strong></th>
              <td><h4>{{ $order->total.' '.Settings::get('coin') }}</h4></td>
            </tr>
          </tbody>
        </table>
      </div>
  </div> 

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-md-6 col-xs-12">
      @if($order->special_instructions)
      <p class="lead">@lang('app.special_instructions'):</p>
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          {{ $order->special_instructions }}
      </p>
      @endif
      @if($order->order_payment)
      <div class="title"><h4>@lang('app.method_payment')</h4></div>
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        <b>{{ $order->order_payment->payment_method->name }}</b> <br/>
        <b>@lang('app.status'):</b> {!! $order->order_payment->getStatusPayment() !!} <br/> 
        <b>@lang('app.payment_date'):</b> {{ $order->order_payment->created_at }} <br/> 
      @endif
      @if($order->order_penalty)
        --------------------------<br/>
        <b>@lang('app.method_payment_penalty'):</b> <br/>
        <b>{{ $order->order_penalty->payment_method->name }}</b> <br/>
        <b>@lang('app.status'):</b> {!! $order->order_penalty->getStatusPayment() !!} <br/> 
        <b>@lang('app.percentage'):</b> {{ $order->order_penalty->percentage.' %' }} <br/> 
        <b>@lang('app.amount'):</b> {{ $order->order_penalty->amount.' '.Settings::get('coin') }} <br/> 
        <b>@lang('app.payment_date'):</b> {{ $order->order_penalty->created_at }} 
      </p>
      @endif
      @if($order->order_payment)
      </p>
      @endif
      @if($order->client_coupon_id != 0)
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        <b>@lang('app.coupon'):</b> {{ $order->coupon->first()->codeDecrypt() }}<br/>
        <b>@lang('app.percentage'):</b> {{ $order->coupon->first()->percentage }}<br/>
        <b>@lang('app.validity'):</b> {{ $order->coupon->first()->validity }}<br/>  
      </p>
      @endif
    </div>
  </div>

<div class="row">
  <div class="form-group">
    <button type="button" class="btn btn-default btn-cancel col-sm-3 col-xs-12">@lang('app.back')</button>
  </div>
</div>

