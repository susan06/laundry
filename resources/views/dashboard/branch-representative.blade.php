@extends('layouts.back')

@section('page-title', trans('app.home'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>@lang('app.branch_offices')</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="content-table">
              @include('branch_offices.list')
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