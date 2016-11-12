@extends('layouts.app')

@section('page-title', trans('app.drivers'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.drivers')</h3>
            </div>
            @include('partials.search')
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
            <p>
            <button type="button" data-href="{{ route('user.create') }}" class="btn btn-primary btn-sm create-edit" data-model="modal" title="@lang('app.create_driver')">@lang('app.create_driver')</button>
            </p>

            <div id="content-table">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <th>@lang('app.full_name')</th>
                  <th>@lang('app.email')</th>
                  <th>@lang('app.registration_date')</th>
                  <th>@lang('app.status')</th>
                  <th class="text-center">@lang('app.actions')</th>
                </thead>
                <tbody>
                @if (count($drivers))
                    @foreach ($drivers as $driver)
                        <tr>
                            <td>{{ $driver->full_name() }}</td>
                            <td>{{ $driver->email }}</td>
                            <td>{{ $driver->created_at }}</td>
                            <td>
                              <span class="label label-{{ $driver->labelClass() }}">{{ trans("app.{$driver->status}") }}</span>
                            </td>
                            <td class="text-center">
                                <button type="button" data-href="{{ route('user.edit', $driver->id) }}" class="btn btn-round btn-primary btn-xs create-edit" data-model="modal"
                                   title="@lang('app.edit_driver')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data-href="#" data-href="{{ route('user.destroy', $driver->id) }}" 
                                  class="btn btn-round btn-danger btn-xs btn-delete" 
                                  data-confirm-text="@lang('app.are_you_sure_delete_driver')"
                                  data-confirm-delete="@lang('app.yes_delete_him')"
                                  title="@lang('app.delete_driver')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5"><em>@lang('app.no_records_found')</em></td>
                    </tr>
                @endif
                </tbody>
              </table>
              {{ $drivers->links() }}
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