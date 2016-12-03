 <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.client')</th>
      <th>@lang('app.num_coupons')</th>
      <th class="text-center">@lang('app.actions')</th>
    </thead>
<tbody>
    @foreach ($clients as $client)
      @if($client->count_coupon() > 0)
        <tr>
            <td>{{ $client->full_name() }}</td>
            <td>{{ $client->count_coupon() }}</td>
            <td class="text-center">
                <button type="button" data-href="" class="btn btn-round btn-primary" data-model="content"
                   title="@lang('app.show_coupons')" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-eye"></i>
                </button>
            </td>
        </tr>
      @endif
    @endforeach
</tbody>
</table>
{{ $clients->links() }}
 