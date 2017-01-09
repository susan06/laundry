<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>#</th>
      <th>@lang('app.client')</th>
      <th>@lang('app.email')</th>
      <th>@lang('app.status')</th>
    </thead>
    <tbody>
        @foreach ($friends as $key => $friend)
            <tr>
                <td>{{ ($friends->currentpage()-1) * $friends->perpage() + $key + 1 }}</td>
                <td>{{ $friend->user->full_name() }}</td>
                <td>{{ $friend->email }}</td>
                <td>
                  {!! $friend->get_status() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $friends->links() }}