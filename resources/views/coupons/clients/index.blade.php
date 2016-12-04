@extends('layouts.app')

@section('page-title', trans('app.coupons_sended'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.coupons_sended')</h3>
            </div>
            @include('partials.search')
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

          <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-12">
             <button type="button" data-href="" class="btn btn-primary create-edit-show btn-create col-xs-12" data-model="content" title="@lang('app.send_coupons')">@lang('app.send_coupons')</button>
            </div>
          </div>
            <div id="content-table">
              @include('coupons.clients.list')
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