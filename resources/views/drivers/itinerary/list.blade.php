 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>#</th>
      <th>ID</th>
      <th>@lang('app.bag_code')</th>
      <th>@lang('app.client')</th>
      <th>@lang('app.search_date')</th>
      <th>@lang('app.search_hour')</th>
      <th>@lang('app.total')</th>
      <th>@lang('app.status_driver')</th>
      <th>@lang('app.status_order')</th>
      <th>@lang('app.registration_date')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
<tbody>
    @foreach ($orders as $key => $order)
        <tr class="@if($order->special_instructions && $order->status == 'recoge') success @endif">
            <td>{{ ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}</td>
            <td>{{ $order->id }}</td>
            <td>{{ $order->bag_code }}</td>
            <td>{{ $order->user->full_name() }}</td>
            <td>{{ $order->date_search }}</td>
            <td>{{ $order->get_time_search() }}</td>
            <td>{{ $order->total.' '.Settings::get('coin') }}</td>
            <td>{!! $order->getStatus() !!}</td>
            <td>
            @if($order->order_payment)
              {!! $order->order_payment->getConfirmedPayment() !!}
            @else
              <span class="label label-danger">{{ trans("app.Unconfirmed") }}</span>
            @endif
            </td>
            <td>{{ $order->created_at }}</td>
            <td class="text-center">
               <button type="button" data-href="{{ route('order.show', $order->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="content"
                                   title="@lang('app.order_show')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-search"></i>
                </button>
                @if($order->status == 'recoge')
                <a href="{{ route('driver.order.branch.list', $order->id) }}" class="btn btn-round btn-primary" title="@lang('app.select_branch_office')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-map-marker"></i>
                </a>
                @endif
                @if($order->status == 'branch_finish')
                {!! Form::open(['route' => ['driver.order.inexit', $order->id], 'method' => 'post', 'id' => 'form-modal']) !!}
                <button type="submit" class="btn btn-round btn-primary btn-submit" title="@lang('app.inexit')">@lang('app.inexit')
                </button>
                {!! Form::close() !!}
                @endif
                @if($order->status == 'inexit')
                {!! Form::open(['route' => ['driver.order.delivered', $order->id], 'method' => 'post', 'id' => 'form-modal']) !!}
                <button type="submit" class="btn btn-round btn-primary btn-submit" title="@lang('app.delivered')">@lang('app.delivered')
                </button>
                {!! Form::close() !!}
                @endif
                @if($order->status == 'recoge')
                <button type="button" data-href="{{ route('order.change.bag', $order->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="modal" title="@lang('app.asign_bad_code')" data-toggle="tooltip" data-placement="top">@lang('app.asign_bad_code')
                </button>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $orders->links() }}
