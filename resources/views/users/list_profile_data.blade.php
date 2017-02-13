<table class="table table-striped dt-responsive nowrap" cellspacing="0" width="100%">
  <tr>
    <td><strong>@lang('app.name'):</strong></td>
    <td>{{ $user->name }}</td> 
  </tr>
  <tr>
    <td><strong>@lang('app.lastname'):</strong></td>
    <td>{{ $user->lastname }}</td>
  </tr>
  <tr>
    <td><strong>@lang('app.email'):</strong></td>
    <td>{{ $user->email }}</td>
  </tr>
  <tr>
    <td><strong>@lang('app.phone'):</strong></td>
    <td>{!! $user->label_phones() !!}</td>
  </tr>
</table>