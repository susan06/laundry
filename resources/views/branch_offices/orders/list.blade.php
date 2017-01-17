 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>#</th>
      <th>@lang('app.bag_code')</th>
      <th>@lang('app.delivery_date')</th>
      <th>@lang('app.special_instructions')</th>
      <th>@lang('app.registration_date')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
<tbody>
    @foreach ($orders as $key => $order)
        <tr>
            <td>{{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}</td>
            <td>{{ $order->bag_code }}</td>
            <td>{{ $order->date_delivery }}</td>
            <td>{{ $order->special_instructions }}</td>
            <td>{{ $order->created_at }}</td>
            <td class="text-center">
                @if($order->status == 'inbranch')
                {!! Form::open(['route' => ['branch-office.order.complete', $order->id], 'method' => 'post', 'id' => 'form-modal']) !!}
                <button type="submit" class="btn btn-round btn-primary btn-submit" title="@lang('app.complete')">@lang('app.complete')
                </button>
                {!! Form::close() !!}
                
                <button data-model="modal" data-href="{{ route('branch-office.order.incomplete', $order->id) }}" class="btn btn-round btn-danger create-edit-show" title="@lang('app.change_branch')">@lang('app.change_branch')
                </button>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $orders->links() }}
 