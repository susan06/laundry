@extends('layouts.front')

@section('page-title', trans('app.faqs'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="x_title">
            <h3>@lang('app.faqs')</h3>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

            <div id="content-table">
             @include('faqs.clients.list')
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