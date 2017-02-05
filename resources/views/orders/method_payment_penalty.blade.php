@extends('layouts.app')

@section('page-title', trans('app.method_payment_penalty'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3 id="content-title">@lang('app.method_payment_penalty')</h3>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            @include('orders.method_payments_penalty_content')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
