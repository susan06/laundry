<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <th>@lang('app.description')</th>
      <th>@lang('app.registration_date')</th>
    </thead>
    <tbody>
        @foreach ($activities as $activity)
            <tr>
                <td>{{ $activity->description }}</td>
                <td>{{ $activity->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $activities->links() }}
