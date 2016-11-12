@extends('layouts.app')

@section('page-title', trans('app.clients'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.clients')</h3>
            </div>
            <div>
              <div class="col-md-6 col-sm-7 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" id="search" class="form-control" placeholder="@lang('app.write_here')">
                  <span class="input-group-btn">
                    <button class="btn btn-default search" type="button">@lang('app.search')</button>
                  </span>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
            <p>
            <button type="button" data-href="#" class="btn btn-primary btn-sm create-edit" data-model="modal" title="@lang('app.create_client')">@lang('app.create_client')</button>
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
                @if (count($clients))
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->full_name() }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->created_at }}</td>
                            <td>
                              <span class="label label-{{ $client->labelClass() }}">{{ trans("app.{$client->status}") }}</span>
                            </td>
                            <td class="text-center">
                                <button type="button" data-href="#" class="btn btn-round btn-primary btn-xs create-edit-modal"
                                   title="@lang('app.edit_client')" data-toggle="tooltip" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data-href="#" 
                                  class="btn btn-round btn-danger btn-xs btn-delete" 
                                  data-confirm-text="@lang('app.are_you_sure_delete_client')"
                                  data-confirm-delete="@lang('app.yes_delete_him')"
                                  title="@lang('app.delete_client')" data-toggle="tooltip" data-placement="top">
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
              {{ $clients->links() }}
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