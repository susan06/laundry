<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.description')</th>
      <th>@lang('app.registration_date')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
    <tbody>
        @foreach ($notifications as $key => $notification)
            <tr>
                <td>{{ $notification->description }}</td>
                <td>{{ $notification->created_at }}</td>
                <td class="text-center">
                @if ($notification->order_id && !$notification->change_branch)
                  <a type="button" href="{{ route('order.show', $notification->order_id) }}" class="btn btn-round btn-primary" data-model="content" title="@lang('app.order_show')" data-toggle="tooltip" data-placement="top"><i class="fa fa-search"></i>
                  </a>
                @endif
                  @if ($notification->change_branch)
                    <a href="{{ route('driver.order.branch.list', $notification->order_id.'?noti='.$notification->id) }}" class="btn btn-round btn-primary" title="@lang('app.select_branch_office')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-map-marker"></i>
                    </a>
                  @endif
                    <button type="button" data-href="{{ route('notification.destroy', $notification->id) }}" 
                      class="btn btn-round btn-danger btn-delete" 
                      data-confirm-text="@lang('app.are_you_sure_delete_notification')"
                      data-confirm-delete="@lang('app.yes_delete_him')"
                      title="@lang('app.delete_notification')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash"></i>
                    </button>
  
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
