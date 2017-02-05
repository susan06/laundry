@extends('layouts.app')

@section('page-title', trans('app.orders'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title no-print">
            <div class="title_left">
              <h3 id="content-title">@lang('app.orders')</h3>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
              {!! Form::select('status', $status, old('status'), ['class' => 'form-control', 'id' => 'status']) !!}
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
              {!! Form::select('status_driver', $status_driver, old('status_driver'), ['class' => 'form-control', 'id' => 'status_driver']) !!}
            </div>
             <div>
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
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

            <div id="content-table">
              @include('orders.list')
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