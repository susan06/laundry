<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>#</th>
      <th>@lang('app.client')</th>
      <th>@lang('app.qualification')</th>
      <th>@lang('app.registration_date')</th>
    </thead>
    <tbody>
        @foreach ($qualifications as $key => $qualification)
            <tr>
                <td>{{ ($qualifications->currentpage()-1) * $qualifications->perpage() + $key + 1 }}</td>
                <td>{{ $qualification->user->full_name() }}</td>
                <td>
                  <div class="starrr stars-existing-{{$qualification->id}}" data-rating='{!! $qualification->quantify !!}'></div>

                </td>
                <td>{{ $qualification->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $qualifications->links() }}

