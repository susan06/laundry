@extends('layouts.app')

@section('page-title', trans('app.roles'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.roles')</h3>
            </div>
            @include('partials.search')
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
            <div id="content-table">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <th>@lang('app.name')</th>
                    <th>@lang('app.display_name')</th>
                    <th>@lang('app.description')</th>
                    <th class="text-center">@lang('app.actions')</th>
                    </thead>
                <tbody>
                @if (count($roles))
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td class="text-center">
                                <button type="button" data-href="{{ route('role.edit', $role->id) }}" class="btn btn-round btn-primary create-edit-show" data-model="modal"
                                   title="@lang('app.edit_role')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4"><em>@lang('app.no_records_found')</em></td>
                    </tr>
                @endif
                </tbody>
              </table>
              {{ $roles->links() }}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

@endsection