@extends('layouts.back')

@section('page-title', trans('app.locations'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3 id="content-title">@lang('app.locations') - {{ $client->full_name() }}</h3>
            </div>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

            <div id="content-table">
              @include('users.clients.list_locations')
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="reazon_status_modal" tabindex="-1" role="dialog" aria-labelledby="tos-label">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="modal-title">@lang('app.reazon_supervisor_location')</h3>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <textarea id="reazon_status" name="reazon_status" style="width: 100%;"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default col-sm-2 col-xs-5" id="update-status-address">@lang('app.save')</button>
              <button type="button" class="btn btn-default col-sm-2 col-xs-5" data-dismiss="modal">@lang('app.close')</button>
          </div>
      </div>
  </div>
</div>
@endsection
