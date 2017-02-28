 <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
<tbody>
    @foreach ($orders as $key => $order)
        <tr>
            <td colspan="2">
              <h4><a href="javascript::void(0);" class="create-edit-show" data-href="{{ route('order.show', $order->id) }}" data-model="content" title="@lang('app.order_show')">{{ trans('app.order_id').': '.$order->id }}</a></h4>
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
         <tr>
            <td colspan="2" class="text-center">
              <button type="button" data-href="{{ route('order.show', $order->id) }}" class="btn btn-primary create-edit-show" data-model="content" data-title="{{ trans('app.order_id').': '.$order->id }}" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-search"></i>
                </button>
      
              @if( $order->get_date_search() && !$order->order_penalty)
               <button type="button" data-href="{{ route('order.edit', $order->id) }}" class="btn btn-primary create-edit-show" data-model="content" data-title="{{ trans('app.edit_order').' ID: '.$order->id }}" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-edit"></i>
                </button>
              @endif

              @if($order->order_penalty)
                <button type="button" data-href="{{ route('order.payment.penalty', $order->id.'?modal=true') }}" class="btn btn-round btn-primary create-edit-show" data-model="modal" data-title="@lang('app.method_payment_penalty') - {{ trans('app.order_id').': '.$order->id }}" data-toggle="tooltip" data-placement="top"><i class="fa fa-minus-square"></i>
                  </button>
               @endif
                
               <button type="button" data-href="{{ route('order.payment', $order->id.'?modal=true') }}" class="btn btn-round btn-primary create-edit-show" data-model="modal" data-title="@lang('app.method_payment') - {{ trans('app.order_id').': '.$order->id }}" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-money"></i>
                </button>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $orders->links() }}
