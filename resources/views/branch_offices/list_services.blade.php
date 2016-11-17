<div class="modal-body">
  <h2 class="title">{{ $branch_office->name }}</h2>
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>#</th>
      <th>@lang('app.name')</th>
      <th>@lang('app.price')</th>
      <th>@lang('app.status')</th>
    </thead>
    <tbody>
      @foreach ($branch_office->services as $key => $service)
          <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $service->name }}</td>
              <td>{{ $service->price }}</td>
              <td>
                <span class="label label-{{ $service->labelClass() }}">{{ trans("app.{$service->status}") }}</span>
              </td>
          </tr>
      @endforeach
    </tbody>
    </table>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
</div>