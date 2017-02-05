 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>#</th>
      <th>@lang('app.bag_code')</th>
      <th>@lang('app.search_date')</th>
      <th>@lang('app.search_hour')</th>
      <th>@lang('app.total')</th>
      <th>@lang('app.status_payment')</th>
      <th>@lang('app.status_order')</th>
      <th>@lang('app.status_driver')</th>
      <th>@lang('app.registration_date')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
<tbody>
    @foreach ($orders as $key => $order)
        <tr class="{{ ($order->order_penalty && !$order->order_penalty->confirmed) ? 'danger' : '' }}">
            <td>{{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}</td>
            <td>{{ $order->bag_code }}</td>
            <td>{{ $order->date_search }}</td>
            <td>{{ $order->get_time_search() }}</td>
            <td>{{ $order->total.' '.Settings::get('coin') }}</td>
            <td>
            @if($order->order_payment)
              {!! $order->order_payment->getStatusPayment() !!}
            @else
              <span class="label label-warning">{{ trans("app.pending_payment") }}</span>
            @endif
            @if($order->order_penalty)
              {!! $order->order_penalty->getStatusPayment() !!}
            @endif
            </td>
            <td>
            @if($order->order_payment)
              {!! $order->order_payment->getConfirmedPayment() !!}
            @else
              <span class="label label-danger">{{ trans("app.Unconfirmed") }}</span>
            @endif
            @if($order->order_penalty)
              {!! $order->order_penalty->getConfirmedPayment() !!}
            @endif
            </td>
            <td>
            {!! $order->getStatus() !!}
            </td>
            <td>{{ $order->created_at }}</td>
            <td class="text-center">
               <button type="button" data-href="{{ route('order.show', $order->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="content"
                                   title="@lang('app.order_show')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-search"></i>
                </button>
      
              @if( $order->get_date_search() && !$order->order_penalty)
               <button type="button" data-href="{{ route('order.edit', $order->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="content"
                                   title="@lang('app.edit_order')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-edit"></i>
                </button>
              @endif

              @if($order->order_penalty)
                <button type="button" data-href="{{ route('order.payment.penalty', $order->id.'?modal=true') }}" class="btn btn-round btn-primary create-edit-show" data-model="modal" title="@lang('app.method_payment_penalty')" data-toggle="tooltip" data-placement="top"><i class="fa fa-minus-square"></i>
                  </button>
               @endif
                
               <button type="button" data-href="{{ route('order.payment', $order->id.'?modal=true') }}" class="btn btn-round btn-primary create-edit-show" data-model="modal"
                                   title="@lang('app.method_payment')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-money"></i>
                </button>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $orders->links() }}
