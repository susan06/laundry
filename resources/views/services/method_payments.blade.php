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
              <h3>@lang('('app.payments_order')</h3>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              {!! Form::open(['route' => 'service.payment.store', 'id' => 'form-create', 'class' => 'form-horizontal form-label-left']) !!}

              {!! Form::hidden('order_id', $order->id) !!}

              <div class="t_title">
                <h2> @lang('app.payments_order')</h2>
                <div class="clearfix"></div>
              </div>

              <div class="row">
                <div class="form-group col-md-4 col-sm-4 col-xs-12">
                  {!! Form::select('payment_method_id', $payments, old('payment_method_id'), ['class' => 'form-control', 'id' => 'payment_method_id']) !!}
                </div>
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