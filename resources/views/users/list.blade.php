 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.full_name')</th>
      <th>@lang('app.email')</th>
      <th>@lang('app.role')</th>
      <th>@lang('app.registration_date')</th>
      <th>@lang('app.status')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
<tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->full_name() }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role->display_name }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
              <span class="label label-{{ $user->labelClass() }}">{{ trans("app.{$user->status}") }}</span>
            </td>
            <td class="text-center">
                <button type="button" data-href="{{ route('user.edit', $user->id).'?role=true' }}" class="btn btn-round btn-primary btn-xs create-edit" data-model="modal"
                   title="@lang('app.edit_user')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-edit"></i>
                </button>
                <button type="button" data-href="{{ route('user.destroy', $user->id) }}" 
                  class="btn btn-round btn-danger btn-xs btn-delete" 
                  data-confirm-text="@lang('app.are_you_sure_delete_user')"
                  data-confirm-delete="@lang('app.yes_delete_him')"
                  title="@lang('app.delete_user')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $users->links() }}
 