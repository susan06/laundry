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
