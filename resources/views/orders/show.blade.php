@extends('layouts.app')

@section('page-title', trans('app.orders'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.order')</h2>
  </div>
<!--//banner-->

<div class="content">
    <div id="content-table">
        @include('orders.show_content')
    </div>
</div>

@endsection

