<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.full_name')</th>
      <th>@lang('app.email')</th>
      <th>@lang('app.time_login')</th>
      <th>@lang('app.registration_date')</th>
      <th>@lang('app.status')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
    <tbody>
        @foreach ($drivers as $driver)
            <tr>
                <td>{!! $driver->full_name().' '.$driver->isOnline() !!}</td>
                <td>{{ $driver->email }}</td>
                <td>{{ ($driver->online) ? $driver->timeLogin() : '' }}</td>
                <td>{{ $driver->created_at }}</td>
                <td>
                  <span class="label label-{{ $driver->labelClass() }}">{{ trans("app.{$driver->status}") }}</span>
                </td>
                <td class="text-center">
                    <button type="button" data-href="{{ route('admin-driver.edit', $driver->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="modal"
                       title="@lang('app.edit_driver')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-edit"></i>
                    </button>
                    <a href="{{ route('admin-driver.activities', $driver->id) }}" class="btn btn-round btn-primary" title="@lang('app.activities')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-bars"></i>
                    </a>
                    <button type="button" data-href="{{ route('admin-driver.comission.shedule.edit', $driver->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="modal"
                       title="@lang('app.comission_shedule')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-calendar"></i>
                    </button>
                    <button type="button" data-href="{{ route('admin-driver.destroy', $driver->id) }}"  
                      class="btn btn-round btn-danger btn-delete" 
                      data-confirm-text="@lang('app.are_you_sure_delete_driver')"
                      data-confirm-delete="@lang('app.yes_delete_him')"
                      title="@lang('app.delete_driver')" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $drivers->links() }}
