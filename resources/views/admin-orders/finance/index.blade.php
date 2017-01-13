@extends('layouts.app')

@section('page-title', trans('app.history_financial'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title no-print">
            <div class="title_left">
              <h3>@lang('app.history_financial') - {{ $user->full_name() }}</h3>
            </div>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
                        <div class="row">
              <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search margin-left">
                {!! Form::select('branch_office', $branch_offices, old('branch_office'), ['class' => 'form-control', 'id' => 'branch']) !!}
              </div>
              <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search margin-left">
                {!! Form::select('status_admin', $status_admin, old('bstatus_admin'), ['class' => 'form-control', 'id' => 'status_admin']) !!}
              </div>
              <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
                {!! Form::select('status', $status, old('status'), ['class' => 'form-control', 'id' => 'status']) !!}
              </div>
              <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
                {!! Form::select('status_driver', $status_driver, old('status_driver'), ['class' => 'form-control', 'id' => 'status_driver']) !!}
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" id="search" class="form-control" placeholder="@lang('app.write_here')">
                  <span class="input-group-btn">
                    <button class="btn btn-danger search-cancel" type="button"><i class="fa fa-close"></i></button>
                    <button class="btn btn-primary search" type="button">@lang('app.search')</button>
                  </span>
                </div>
              </div>
            </div>
            <div id="content-table">
              @include('admin-orders.finance.list')
            </div>
                
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
@parent

<script type="text/javascript">
  // search status order payment all
$(document).on('change', '#status_driver', function () {
    showLoading();
    var $this = $(this);
    $.ajax({
        url: CURRENT_URL,
        type:"GET",
        data:{ status_driver: $this.val() },
        dataType: 'json',
        success: function(response) {
            CURRENT_URL = this.url;
            hideLoading();
            if(response.success){
                $('#content-table').html(response.view);
                loadResposiveTable();
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});
</script>
@endsection