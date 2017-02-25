<section class="content invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12" style="text-align: center;">
    <!--
      <img height="150" width="150" src="{{ url('public/assets/images/logos/logo.png') }}">-->
         <h1>
        @lang('app.details_order') # {{ $order->id }}
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
          @if($order->user->client_location)
          <br>
            <strong>@lang('app.address'):</strong>{{ $order->client_location->address }}
          @endif
          <br>
          {!! $order->user->label_phones() !!}
          @if (Auth::user()->role->name == 'driver')
          <br>
          <button class="btn btn-success col-sm-10 col-xs-10" onclick="show_map()">@lang('app.show_map')</button>
          @endif
      </address>
    </div>
    <div class="col-sm-4 invoice-col"></div>
    <div class="col-sm-4 invoice-col">
      @if($order->bag_code) 
      <strong>@lang('app.bag_code'):</strong> {{ $order->bag_code }}
      <br>
      @endif
      <strong>@lang('app.search_date'):</strong> {{ $order->date_search }}
      <br>
      <strong>@lang('app.search_hour'):</strong> {{ $order->get_time_search() }}
      <br>
      <strong>@lang('app.delivery_date'):</strong> {{ $order->date_delivery }}
      <br>
      <strong>@lang('app.delivery_hour'):</strong> {{ $order->get_time_delivery() }}
      <br>
       <strong>@lang('app.status_driver'):</strong> {!! $order->getStatus() !!}
      @if($order->branch_offices_location_id)
       <br>
       <strong>@lang('app.branch_office'):</strong> {{ $order->branch_office->name.', '.$order->location_branch()->address }}
      @endif
      @if (Auth::user()->role->name == 'admin' && $order->driver_id)
      <br>
      <strong>@lang('app.driver'):</strong> {{ $order->driver->full_name() }}
      @endif
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
            <th>@lang('app.quantity')</th>
            <th>@lang('app.service')</th>
            <th>@lang('app.price')</th>
            <th>@lang('app.sub_total')</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($order->order_package as $key => $package)
            <tr>
                <td>{{ $package->quantity }}</td>
                <td>{{ $package->name }}</td>
                <td>{{ $package->price }}</td>
                <td>{!! $package->quantity * $package->price !!}</td>
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
      @if($order->special_instructions)
      <p class="lead">@lang('app.special_instructions'):</p>
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          {{ $order->special_instructions }}
      </p>
      @endif
      <p class="lead">@lang('app.method_payment'):</p>
      @if($order->order_payment)
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

      @if (Auth::user()->role->name == 'driver' && $order->status == 'search')
      {!! Form::open(['route' => ['driver.order.taked', $order->id], 'method' => 'post', 'id' => 'form-modal']) !!}
        <button type="submit" class="btn btn-success btn-submit col-sm-2 col-xs-5">@lang('app.taked')</button>
      {!! Form::close() !!}
      @endif

      @if (Auth::user()->role->name == 'driver' && $order->status == 'recoge' || $order->status == 'via_branch')
      {!! Form::open(['route' => ['driver.order.inbranch', $order->id], 'method' => 'post', 'id' => 'form-modal']) !!}
        <button type="submit" class="btn btn-success btn-submit col-sm-2 col-xs-5">@lang('app.inbranch')</button>
      {!! Form::close() !!}
      @endif

      @if (Auth::user()->role->name == 'driver' && $order->status == 'branch_finish')
      {!! Form::open(['route' => ['driver.order.inexit', $order->id], 'method' => 'post', 'id' => 'form-modal']) !!}
        <button type="submit" class="btn btn-success btn-submit col-sm-2 col-xs-5">@lang('app.inexit')</button>
      {!! Form::close() !!}
      @endif

      @if(Auth::user()->role->name == 'driver' && $order->status == 'inexit')
        {!! Form::open(['route' => ['driver.order.delivered', $order->id], 'method' => 'post', 'id' => 'form-modal']) !!}
          <button type="submit" class="btn btn-success btn-submit col-sm-2 col-xs-5" title="@lang('app.delivered')">@lang('app.delivered')
          </button>
        {!! Form::close() !!}
      @endif

      @if (Auth::user()->role->name == 'driver' && $order->status == 'recoge')
      <button type="button" data-href="{{ route('order.change.bag', $order->id) }}" class="btn btn-warning create-edit-show col-sm-2 col-xs-5" data-model="modal" title="@lang('app.asign_bad_code')">@lang('app.asign_bad_code')
      </button>    
      @endif

      <button class="btn btn-primary col-sm-2 col-xs-5" onclick="window.print();"><i class="fa fa-print"></i> @lang('app.print')</button>
      <button type="button" class="btn btn-default btn-cancel col-sm-2 col-xs-5">@lang('app.back')</button>
    </div>
  </div>
</section>

<div class="modal fade bs-example-modal-lg no-print" id="show_map_modal" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 9999">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">@lang('app.map')</h4>
      </div>

    <div class="modal-body">
      <div class="content_map form-horizontal">
        <div class="col-md-11 col-sm-11 col-xs-11 input_delivery_address">
          {!! Form::text('delivery_address', $order->client_location->address, ['id' => 'delivery_address', 'readonly' => 'readonly' ]) !!}
        </div>

        <div id="map-form"></div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
    </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var center = new google.maps.LatLng('{!! $order->client_location->lat !!}', '{!! $order->client_location->lng !!}');
  @if($order->branch_offices_location_id)
  var latLngBranch = new google.maps.LatLng('{!! $order->location_branch()->lat !!}', '{!! $order->location_branch()->lng !!}');
  var branch_name =  '{{ $order->branch_office->name }}';
  var branch_name_address = '{{ $order->branch_office->name." - ".$order->location_branch()->address }}';
  @else
  var latLngBranch = false;
  @endif

</script>
