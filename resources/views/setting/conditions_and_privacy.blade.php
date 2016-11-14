@extends('layouts.app')

@section('page-title', trans('app.terms_service'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.terms_service')</h3>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="content-table">
              @include('setting.conditions_privacy_field')
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