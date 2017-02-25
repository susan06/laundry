{!! Form::open(['route' => ['order.update', $order->id], 'method' => 'PUT', 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
<section class="content invoice">

  @if($order->before_hour_search() <= 3)
  <div class="row">  
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      {{ trans('app.penalty_three', ['porcentaje' => $porcentaje, 'monto' => $penalty]) }}
    </div>
  </div>
  @endif

  <br/>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-5 invoice-col">
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
      </address>
    </div>
    <div class="col-sm-2 invoice-col"></div>
    <div class="col-sm-5 invoice-col">
      <strong>@lang('app.search_date'):</strong> {{ $order->date_search }}
      <br>
      <strong>@lang('app.search_hour'):</strong> 
        <select name="time_search" class="form-control" id="time_search">
          @foreach($working_hours as $working_hour)
          @if($working_hour['status'] == 'notavailable')
             <option value="" disabled="disabled">{{$working_hour['interval'].' - '.trans("app.Not available") }}
          @else
              @if( Carbon\Carbon::createFromFormat('h:i A', $working_hour['start'])->format('H:i') <= Carbon\Carbon::now()->format('H:i'))
                <option value="" disabled="disabled">{{$working_hour['interval'].' - '.trans("app.Not available") }}
              @else
                <option value="{{$working_hour['id']}}" {{($order->time_search == $working_hour['id']) ? 'selected' : ''}}>{{$working_hour['interval']}} 
              @endif
          @endif
          @endforeach
        </select>
      <strong>@lang('app.delivery_date'):</strong> {{ $order->date_delivery }}
      <br>
      <strong>@lang('app.delivery_hour'):</strong> {{ $order->get_time_delivery() }}
    </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="t_title">
      <h2> @lang('app.address')</h2>
      <div class="clearfix"></div>
    </div>
    <div class="col-ms-12 col-md-12 col-xs-12 table">
    {{Form::hidden('client_location_id', $order->client_location_id, ['id' => 'client_location_id'])}}
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
            <tr class="row_location {{ ($order->client_location_id == $item->id) ? 'success' : '' }}">
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
    </div>
  </div>

  <br/>
  <!-- Table row -->
  <div class="row">
    <div class="col-ms-12 col-md-12 col-xs-12 table">
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
  <div class="row">
    <div class="ln_solid"></div>
    <div class="col-xs-12">
      <button type="submit" class="btn btn-primary btn-submit col-sm-2 col-xs-6">@lang('app.update')</button>
      <button type="button" class="btn btn-default btn-cancel col-sm-2 col-xs-5">@lang('app.back')</button>
    </div>
  </div>
</section>
{!! Form::close() !!}
<script type="text/javascript">
$(document).on('click', '.select-location', function () {
  var $this = $(this);
  $('.row_location').removeClass('success');
  $this.closest('tr').addClass('success');
  $('#client_location_id').val($this.data('location'));
});
</script>

