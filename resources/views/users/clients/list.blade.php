<div class="row">
  <form action="{{ URL::route('statusClientss') }}" method="post" class="form-horizontal">
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
      <th>@lang('app.registration_date')</th>
      <th>@lang('app.status')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
    <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->full_name() }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->created_at }}</td>
                <td>
                  <span class="label label-{{ $client->labelClass() }}">{{ trans("app.{$client->status}") }}</span>
                </td>
                <td class="text-center">
                    <button type="button" data-href="{{ route('admin-client.show', $client->id).'?role=true' }}" class="btn btn-round btn-primary btn-xs create-edit-show" data-model="modal"
                                   title="@lang('app.view_user')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-search"></i>
                    </button>
                    <button type="button" data-href="{{ route('admin-client.edit', $client->id).'?role=true' }}" class="btn btn-round btn-success btn-xs create-edit-show" data-model="modal"
                                   title="@lang('app.edit_user')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-edit"></i>
                    </button>
                    @if ($client->status == 'Banned')
                    <button type="button" data-href="{{ route('client.destroy', $client->id) }}" 
                      class="btn btn-round btn-danger btn-xs btn-delete" 
                      data-confirm-text="@lang('app.are_you_sure_delete_client')"
                      data-confirm-delete="@lang('app.yes_delete_him')"
                      title="@lang('app.delete_client')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash"></i>
                    </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $clients->links() }}