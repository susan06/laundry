@extends('layouts.app')

@section('page-title', trans('app.terms_and_conditions'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.terms_and_conditions')</h2>
  </div>
<!--//banner-->

<div class="content">
    <div id="content-table" class="questions">
      {!! Settings::get('terms_and_conditions') !!}
    </div>
</div>

@endsection

