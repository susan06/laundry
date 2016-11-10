<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
  <thead>
    <th>#</th>
    <th>@lang('app.percentage')</th>
    <th>@lang('app.validity')</th>
    <th>@lang('app.registration_date')</th>
    <th>@lang('app.status')</th>
    <th class="text-center">@lang('app.actions')</th>
  </thead>
  <tbody>
      @foreach ($coupons as $key => $coupon)
          <tr>
              <td>{{ ($coupons->currentpage()-1) * $coupons->perpage() + $key + 1 }}</td>
              <td>{{ $coupon->percentage }}</td>
              <td>{{ $coupon->validity }}</td>
              <td>{{ $coupon->created_at }}</td>
              <td>
                <span class="label label-{{ $coupon->labelClass() }}">{{ trans("app.{$coupon->status}") }}</span>
              </td>
              <td class="text-center">
              @if($coupon->status == 'Valid')
                  <button type="button" data-href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-round btn-primary btn-xs create-edit-modal"
                     title="@lang('app.edit_coupon')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-edit"></i>
                  </button>
              @endif
              @if($coupon->status == 'Useless')
                  <button type="button" data-href="{{ route('coupon.destroy', $coupon->id) }}" 
                    class="btn btn-round btn-danger btn-xs btn-delete" 
                    data-confirm-text="@lang('app.are_you_sure_delete_coupon')"
                    data-confirm-delete="@lang('app.yes_delete_him')"
                    title="@lang('app.delete_coupon')" data-toggle="tooltip" data-placement="top">
                      <i class="fa fa-trash"></i>
                  </button>
               @endif
              </td>
          </tr>
      @endforeach
  </tbody>
</table>
{{ $coupons->links() }}