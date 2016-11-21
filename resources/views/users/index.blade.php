@extends('layouts.app')

@section('page-title', trans('app.users'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.users')</h3>
            </div>
            @include('partials.search')
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

          <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-12">
             <button type="button" data-href="{{ route('user.create', 'role=true') }}" class="btn btn-primary create-edit-show col-xs-12" data-model="modal" title="@lang('app.create_user')">@lang('app.create_user')</button>
            </div>
          </div>

            <div id="content-table">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <th>@lang('app.full_name')</th>
                  <th>@lang('app.email')</th>
                  <th>@lang('app.role')</th>
                  <th>@lang('app.registration_date')</th>
                  <th>@lang('app.status')</th>
                  <th class="text-center">@lang('app.actions')</th>
                </thead>
                <tbody>
                @if (count($users))
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->full_name() }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->display_name }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                              <span class="label label-{{ $user->labelClass() }}">{{ trans("app.{$user->status}") }}</span>
                            </td>
                            <td class="text-center">
                                <button type="button" data-href="{{ route('user.edit', $user->id).'?role=true' }}" class="btn btn-primary create-edit-show" data-model="modal"
                                   title="@lang('app.edit_user')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data-href="{{ route('user.destroy', $user->id) }}" 
                                  class="btn btn-danger btn-delete" 
                                  data-confirm-text="@lang('app.are_you_sure_delete_user')"
                                  data-confirm-delete="@lang('app.yes_delete_him')"
                                  title="@lang('app.delete_user')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6"><em>@lang('app.no_records_found')</em></td>
                    </tr>
                @endif
                </tbody>
              </table>
              {{ $users->links() }}
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