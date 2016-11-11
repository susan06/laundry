 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
<thead>
  <th>#</th>
  <th>@lang('app.name')</th>
  <th>@lang('app.phone')</th>
  <th>@lang('app.representative')</th>
  <th>@lang('app.registration_date')</th>
  <th>@lang('app.status')</th>
  <th class="text-center">@lang('app.actions')</th>
</thead>
<tbody>
  @foreach ($branch_offices as $key => $branch_office)
      <tr>
          <td>{{ ($branch_offices->currentpage()-1) * $branch_offices->perpage() + $key + 1 }}</td>
          <td>{{ $branch_office->name }}</td>
          <td>{{ $branch_office->phone }}</td>
          <td>{{ $branch_office->representative->full_name() }}</td>
          <td>{{ $branch_office->created_at }}</td>
          <td>
            <span class="label label-{{ $branch_office->labelClass() }}">{{ trans("app.{$branch_office->status}") }}</span>
          </td>
          <td class="text-center">

              <button type="button" data-href="{{ route('branch-office.edit', $branch_office->id) }}" class="btn btn-round btn-primary btn-xs create-edit-modal"
                 title="@lang('app.edit_branch_office')" data-toggle="tooltip" data-placement="top">
                  <i class="fa fa-edit"></i>
              </button>

          @if($branch_office->status == 'Out of service')
              <button type="button" data-href="{{ route('branch-office.destroy', $branch_office->id) }}" 
                class="btn btn-round btn-danger btn-xs btn-delete" 
                data-confirm-text="@lang('app.are_you_sure_delete_branch_office')"
                data-confirm-delete="@lang('app.yes_delete_him')"
                title="@lang('app.delete_branch_office')" data-toggle="tooltip" data-placement="top">
                  <i class="fa fa-trash"></i>
              </button>
           @endif
          </td>
      </tr>
  @endforeach
</tbody>
</table>
{{ $branch_offices->links() }}