<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
    <th>@lang('app.label')</th>
    <th>@lang('app.address')</th>
    <th>@lang('app.description')</th>
    <th>@lang('app.status')</th>
    <th>@lang('app.status_driver')</th>
  </thead>
  <tbody>
      @foreach ($client->client_location as $key => $item)
          <tr>
            <td>{{ $item->get_label() }}</td>
            <td>{{ $item->address }}</td>
            <td>{{ $item->description }}</td>
            <td>

                {!! Form::select('status', $locations_status, $item->status, ['class' => 'form-control', 'id' => 'status_address', 'data-id' => $item->id]) !!}

                @if($item->status == 'rejected')
                  <br>
                  <a href="#reazon_status_{{$item->id}}" data-toggle="modal" class="btn btn-round btn-warning"><i class="fa fa-eye"></i></a>
                  <div class="modal fade" id="reazon_status_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="tos-label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="modal-title">@lang('app.reazon_supervisor_location')</h3>
                            </div>
                            <div class="modal-body">
                                {!! $item->reazon_status !!}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
                            </div>
                        </div>
                    </div>
                  </div>
                @endif
            </td>
            <td class="center">
              <span class="label label-success">@lang('app.confirmed_driver')</span>
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>
