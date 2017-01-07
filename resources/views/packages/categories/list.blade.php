<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
    <th>#</th>
    <th>@lang('app.name')</th>
    <th>@lang('app.registration_date')</th>
    <th>@lang('app.status')</th>
    <th class="text-center">@lang('app.actions')</th>
  </thead>
  <tbody>
      @foreach ($categories as $key => $category)
          <tr>
              <td>{{ ($categories->currentpage()-1) * $categories->perpage() + $key + 1 }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->created_at }}</td>
              <td>{!! $category->getStatus() !!}</td>
              <td class="text-center">
                  <button type="button" data-href="{{ route('admin-package-category.edit', $category->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="modal"
                     title="@lang('app.edit_category')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-edit"></i>
                  </button>
                  <button type="button" data-href="{{ route('admin-package-category.destroy', $category->id) }}" 
                    class="btn btn-round btn-danger btn-delete" 
                    data-confirm-text="@lang('app.are_you_sure_delete_category')"
                    data-confirm-delete="@lang('app.yes_delete_him')"
                    title="@lang('app.delete_category')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-trash"></i>
                  </button>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>
{{ $categories->links() }}