@extends('layouts.app')

@section('page-title', trans('app.invited_friends'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>@lang('app.clients') <small>@lang('app.invite_friend')</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
              @include('clients.partials.invite_friend')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

@endsection