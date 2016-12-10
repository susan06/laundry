@extends('layouts.app')

@section('page-title', trans('app.order'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3 id="content-title">@lang('app.order') {{ $order->bag_code }}</h3>
            </div>
          </div>
        
          <div class="x_content">

            <div id="content-table">
              aqui se mostrara la factura de la orden
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
