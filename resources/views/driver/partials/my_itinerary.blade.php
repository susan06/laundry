<div class="col-md-12">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.order')</th>
      <th>@lang('app.address')</th>
      <th>@lang('app.see_order')</th>
      <th class="text-center">@lang('app.status')</th>
    </thead>
<tbody>
        <tr>
            <td>1</td>
            <td>Esta es mi dirección</td>
            <td class="text-center">
                <button type="button" data-href="#" class="btn btn-round btn-primary btn-xs create-edit-modal"
                   title="@lang('app.see_order')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-search"></i>
                </button>
            </td>
            <td class="text-center">
                <button type="button" data-href="#" class="btn btn-round btn-info btn-xs create-edit-modal"
                   title="@lang('app.capture')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-check"></i>
                </button>
                <button type="button" data-href="#" class="btn btn-round btn-danger btn-xs create-edit-modal"
                   title="@lang('app.office')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-building"></i>
                </button>
                <button type="button" data-href="#" class="btn btn-round btn-warning btn-xs create-edit-modal"
                   title="@lang('app.start')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-car"></i>
                </button>
                <button type="button" data-href="#" class="btn btn-round btn-success btn-xs create-edit-modal"
                   title="@lang('app.delivered')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-check"></i>
                </button>
            </td>
        </tr>
</tbody>
</table>
      </div>