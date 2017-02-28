@extends('layouts.app')

@section('page-title', trans('app.payments_order'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.method_payment_order')</h2>
  </div>
<!--//banner-->

<div class="content">
	<div id="content-table">
  		@include('orders.method_payments_content')
  	</div>
</div>

@endsection
