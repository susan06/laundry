 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.name')</th>
      <th>@lang('app.category')</th>
      <th>@lang('app.registration_date')</th>
      <th>@lang('app.status')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
<tbody>
    @foreach ($packages as $package)
        <tr>
            <td>{{ $package->name }}</td>
            <td>{{ $package->package_category->name }}</td>
            <td>{{ $package->created_at }}</td>
            <td>
              <span class="label label-{{ $package->labelClass() }}">{{ ($package->status == 1) ? trans('app.Published') : trans('app.No Published') }}</span>
            </td>
            <td class="text-center">
                <button type="button" data-href="{{ route('admin-package.edit', $package->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="content"
                   title="@lang('app.edit_package')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-edit"></i>
                </button>
                <button type="button" data-href="{{ route('admin-package.destroy', $package->id) }}" 
                  class="btn btn-round btn-danger btn-delete" 
                  data-confirm-text="@lang('app.are_you_sure_delete_package')"
                  data-confirm-delete="@lang('app.yes_delete_him')"
                  title="@lang('app.delete_package')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
</tbody>
</table>
{{ $packages->links() }}
 