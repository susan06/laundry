 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>#</th>
      <th>@lang('app.bag_code')</th>
      <th>@lang('app.amount')</th>
      <th>@lang('app.registration_date')</th>
      <th>@lang('app.status_payment')</th>
      <th>@lang('app.status_order')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
<tbody>
    @foreach ($orders as $key => $order)
        <tr>
            <td>{{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}</td>
            <td>{{ $order->bag_code }}</td>
            <td>{{ $order->total.' '.Settings::get('coin') }}</td>
            <td>{{ $order->created_at }}</td>
            <td>
            @if($order->order_payment)
              <span class="label label-{{ $order->order_payment->statuslabelClass() }}">{{ trans("app.{$order->order_payment->statusText()}") }}</span>
            @else
              <span class="label label-warning">{{ trans("app.pending_payment") }}</span>
            @endif
            </td>
            <td>
            @if($order->order_payment)
              <span class="label label-{{ $order->confirmedlabelClass() }}">{{ trans("app.{$order->order_payment->confirmedText()}") }}</span>
            @else
              <span class="label label-warning">{{ trans("app.pending_payment") }}</span>
            @endif
            </td>
            <td class="text-center">
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $orders->links() }}
 