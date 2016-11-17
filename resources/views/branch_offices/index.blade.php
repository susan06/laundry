@extends('layouts.app')

@section('page-title', trans('app.branch_offices'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3 id="content-title">@lang('app.branch_offices')</h3>
            </div>
            @include('partials.search')
          </div>
        
          <div class="x_content">
            <p>
            <button type="button" data-href="{{ route('admin-branch-office.create') }}" class="btn btn-primary btn-sm create-edit-show btn-create" data-model="content" title="@lang('app.create_branch_office')">@lang('app.create_branch_office')</button>
            </p>

            <div id="content-table">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <th>#</th>
                  <th>@lang('app.name')</th>
                  <th>@lang('app.phone')</th>
                  <th>@lang('app.representative')</th>
                  <th>@lang('app.registration_date')</th>
                  <th>@lang('app.status')</th>
                  <th class="text-center">@lang('app.actions')</th>
                </thead>
                <tbody>
                @if (count($branch_offices))
                    @foreach ($branch_offices as $key => $branch_office)
                        <tr>
                            <td>{{ ($branch_offices->currentpage()-1) * $branch_offices->perpage() + $key + 1 }}</td>
                            <td>{{ $branch_office->name }}</td>
                            <td>{{ $branch_office->phone }}</td>
                            <td>{{ $branch_office->representative->full_name() }}</td>
                            <td>{{ $branch_office->created_at }}</td>
                            <td>
                              <span class="label label-{{ $branch_office->labelClass() }}">{{ trans("app.{$branch_office->status}") }}</span>
                            </td>
                            <td class="text-center">
     
                                <button type="button" data-href="{{ route('admin-branch-office.edit', $branch_office->id) }}" class="btn btn-round btn-primary btn-xs create-edit-show" data-model="content"
                                   title="@lang('app.edit_branch_office')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>

                             @if($branch_office->services)
                             <button type="button" data-href="{{ route('branch-office.services', $branch_office->id) }}" class="btn btn-round btn-primary btn-xs create-edit-show" data-model="modal"
                              title="@lang('app.show_services')" data-toggle="tooltip" data-placement="top">
                             <i class="fa fa-eye"></i>
                              </button>
                             @endif

                             @if($branch_office->status == 'Out of service')
                                <button type="button" data-href="{{ route('admin-branch-office.destroy', $branch_office->id) }}" 
                                  class="btn btn-round btn-danger btn-xs btn-delete" 
                                  data-confirm-text="@lang('app.are_you_sure_delete_branch_office')"
                                  data-confirm-delete="@lang('app.yes_delete_him')"
                                  title="@lang('app.delete_branch_office')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                             @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7"><em>@lang('app.no_records_found')</em></td>
                    </tr>
                @endif
                </tbody>
              </table>
              {{ $branch_offices->links() }}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts_head')
@parent
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key={{ env('API_KEY_GOOGLE')}}&libraries=places&language={{Auth::User()->lang}}"></script>
@endsection