<section class="content invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12" style="text-align: center;">
      <img height="150" width="150" src="{{ url('public/assets/images/logos/logo.png') }}">
         <h1>
        @lang('app.order') {{ $order->bag_code }}
        </h1>
    </div>
  </div>
  <br/>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      <address>
          <strong>@lang('app.client'):</strong> {{ $order->user->full_name() }}
          <br>
          <strong>@lang('app.email'):</strong> {{ $order->user->email }}
          <br>
          <strong>@lang('app.search_date'):</strong> {{ $order->date_search }}
          <br>
          <strong>@lang('app.search_hour'):</strong> {{ $order->get_time_search() }}
          <br>
          <strong>@lang('app.delivery_date'):</strong> {{ $order->date_delivery }}
          <br>
          <strong>@lang('app.delivery_hour'):</strong> {{ $order->get_time_delivery() }}
      </address>
    </div>
    <div class="col-sm-4 invoice-col"></div>
    <div class="col-sm-4 invoice-col">
      @if($order->user->client_location)
      @lang('app.address'):
      <br>
      {{ $order->client_location->address }}
      @endif
      <br>
      {{ $order->user->label_phones() }}
    </div>
  </div>
  <!-- /.row -->
  <br/><br/>
  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table">
      <table class="table table-striped">
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

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">@lang('app.method_payment'):</p>
      @if($order->order_payment)
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        <b>{{ $order->order_payment->payment_method->name }}</b> <br/>
        <b>@lang('app.status'):</b> {{ trans("app.{$order->order_payment->statusText()}") }} <br/> 
        <b>@lang('app.payment_date'):</b> {{ $order->order_payment->created_at }} 
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
    <!-- /.col -->
    <div class="col-xs-6">
       <p class="lead">@lang('app.amount'):</p>
      <div class="table-responsive">
        <table class="table">
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
              <th>@lang('app.total'):</th>
              <td>{{ $order->total.' '.Settings::get('coin') }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="ln_solid"></div>
    <div class="col-xs-12">
      <button class="btn btn-primary col-sm-2 col-xs-5" onclick="window.print();"><i class="fa fa-print"></i> @lang('app.print')</button>
      <button type="button" class="btn btn-default btn-cancel col-sm-2 col-xs-5">@lang('app.back')</button>
    </div>
  </div>
</section>
