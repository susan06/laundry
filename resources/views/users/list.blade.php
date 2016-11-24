<div class="row">
  <form action="{{ URL::route('statusUsers') }}" method="post" class="form-horizontal">
  <input type="hidden" name="_token" value="{{csrf_token()}}">      
  <div class="col-md-2 col-sm-2 col-xs-12">
      {!! Form::select('status', $status, 'Select', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'status']) !!}
  </div>
  <div class="col-md-2 col-sm-2 col-xs-12">
      <input type="submit" value="Consultar" class="btn btn-success">
  </div>  
  </form>
</div>
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
                <button type="button" data-href="{{ route('user.edit', $user->id).'?role=true' }}" class="btn btn-round btn-primary create-edit-show" data-model="modal"
                   title="@lang('app.edit_user')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-edit"></i>
                </button>
                <button type="button" data-href="{{ route('user.destroy', $user->id) }}" 
                  class="btn btn-round btn-danger btn-delete" 
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
 