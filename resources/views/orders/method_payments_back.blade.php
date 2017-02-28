@extends('layouts.app')

@section('page-title', trans('app.payments_order'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.method_payment_order')</h3>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            @include('orders.method_payments_content_back')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
