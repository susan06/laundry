<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>#</th>
      <th>@lang('app.client')</th>
      <th>@lang('app.suggestion')</th>
      <th>@lang('app.registration_date')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
    <tbody>
        @foreach ($suggestions as $key => $suggestion)
            <tr>
                <td>{{ ($suggestions->currentpage()-1) * $suggestions->perpage() + $key + 1 }}</td>
                <td>{{ $suggestion->user->full_name() }}</td>
                <td>{{  str_limit($suggestion->content, 20) }}</td>
                <td>{{ $suggestion->created_at }}</td>
                <td class="text-center">
                <button type="button" data-href="{{ route('admin-suggestion.show', $suggestion->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="modal"
                     title="@lang('app.show_suggestion')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-eye"></i>
                  </button>
                  <button type="button" data-href="{{ route('admin-suggestion.destroy', $suggestion->id) }}" 
                    class="btn btn-round btn-danger btn-delete" 
                    data-confirm-text="@lang('app.are_you_sure_delete_suggestion')"
                    data-confirm-delete="@lang('app.yes_delete_him')"
                    title="@lang('app.delete_suggestion')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-trash"></i>
                  </button>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $suggestions->links() }}