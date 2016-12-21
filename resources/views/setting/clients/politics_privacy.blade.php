@extends('layouts.app')

@section('page-title', trans('app.privacy_policies'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.privacy_policies')</h3>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
              {!! Settings::get('privacy_policy') !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

