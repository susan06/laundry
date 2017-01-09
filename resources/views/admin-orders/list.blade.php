<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.branch_office')</th>
      <th>@lang('app.client')</th>
      <th>@lang('app.total')</th>
      <th>@lang('app.registration_date')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ is_null($order->branch_office)  ? trans('app.noasigned') : $order->branch_office->name }}</td>
                <td>{{ $order->user->full_name() }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->created_at }}</td>
                <td class="text-center">
                    <button type="button" data-href="{{ route('order.show', $order->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="content"
                                   title="@lang('app.order_show')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-search"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $orders->links() }}