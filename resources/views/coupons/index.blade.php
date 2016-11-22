@extends('layouts.app')

@section('page-title', trans('app.coupons'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.coupons')</h3>
            </div>
            @include('partials.search')
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
            <div class="row">
              <div class="col-md-2 col-sm-2 col-xs-12">
              <button type="button" data-href="{{ route('coupon.create') }}" class="btn btn-primary create-edit-show col-xs-12" data-model="modal" title="@lang('app.create_coupon')">@lang('app.create_coupon')</button>
              </div>
            </div>

            <div id="content-table">
              @include('coupons.list')
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