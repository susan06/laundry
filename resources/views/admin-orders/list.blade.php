<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.bag_code')</th>
      <th>@lang('app.branch_office')</th>
      <th>@lang('app.client')</th>
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
        @foreach ($orders as $order)
            <tr class="{{ ($order->order_penalty && !$order->order_penalty->confirmed) ? 'danger' : '' }}">
                <td>{{ $order->bag_code }}</td>
                <td>{{ is_null($order->branch_offices_location_id)  ? trans('app.noasigned') : $order->branch_office->name }}</td>
                <td>{{ $order->user->full_name() }}</td>
                <td>{{ $order->date_search }}</td>
                <td>{{ $order->get_time_search() }}</td>
                <td>{{ $order->total.' '.Settings::get('coin') }}</td>
                <td>
                  @if($order->order_payment)
                    {!! $order->order_payment->getStatusPayment() !!}
                  @else
                    <span class="label label-danger">{{ trans("app.no_register_payment") }}</span>
                  @endif
                  @if($order->order_penalty)
                    {!! $order->order_penalty->getStatusPayment() !!}
                  @endif
                </td>
                 <td>
                  @if($order->order_payment)
                    {!! $order->order_payment->getConfirmedPayment() !!}
                  @else
                    <span class="label label-danger">{{ trans("app.no_register_payment") }}</span>
                  @endif
                  @if($order->order_penalty)
                    {!! $order->order_penalty->getConfirmedPayment() !!}
                  @endif
                  </td>
                <td>{!! $order->getStatus() !!}</td>
                <td>{{ $order->created_at }}</td>
                <td class="text-center">
                    <button type="button" data-href="{{ route('order.show', $order->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="content"
                                   title="@lang('app.order_show')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-search"></i>
                    </button>

                    @if ( Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'supervisor' && count($order->order_payment) > 0 )
                      @if(isset($order->order_payment->status))
                      <button type="button" data-href="{{ route('admin-order.change.confirmed', $order->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="modal" title="@lang('app.confirmed_order')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-check"></i>
                      </button>
                      @endif
                    @endif
                    @if( Auth::user()->role->name == 'supervisor' && $order->get_date_search() && !$order->order_penalty)
                       <button type="button" data-href="{{ route('order.edit', $order->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="content"
                                           title="@lang('app.edit_order')" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-edit"></i>
                        </button>
                    @endif

                    @if( Auth::user()->role->name == 'supervisor')
                      <button type="button" data-href="{{ route('admin-order.change.status', $order->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="modal" title="@lang('app.change_status')" data-toggle="tooltip" data-placement="top">@lang('app.change_status')
                      </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $orders->links() }}