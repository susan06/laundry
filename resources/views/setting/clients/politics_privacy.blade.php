@extends('layouts.app')

@section('page-title', trans('app.privacy_policies'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.privacy_policies')</h2>
  </div>
<!--//banner-->

<div class="content">
    <div id="content-table" class="questions">
        {!! Settings::get('privacy_policy') !!}
    </div>
</div>

@endsection

