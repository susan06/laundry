@extends('layouts.app')

@section('page-title', trans('app.faqs'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.faqs')</h2>
  </div>
<!--//banner-->

<div class="asked">
    @include('faqs.clients.list')
</div>

@endsection
