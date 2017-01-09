@extends('layouts.app')

@section('page-title', trans('app.orders'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.orders')</h3>
            </div>
              <div class="col-md-6 col-sm-6 col-xs-12 form-group pull-right top_search">
              <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="@lang('app.search_by_client')">
                <span class="input-group-btn">
                  <button class="btn btn-danger search-cancel" type="button"><i class="fa fa-close"></i></button>
                  <button class="btn btn-primary search" type="button">@lang('app.search')</button>
                </span>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

            <div id="content-table">
              @include('admin-orders.list')
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
