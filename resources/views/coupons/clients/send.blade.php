@extends('layouts.back')

@section('page-title', trans('app.send_coupons'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3 id="content-title">@lang('app.send_coupons')</h3>
            </div>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
           {!! Form::open(['route' => ['coupon.store.send', $coupon->id], 'id' => 'form-modal', 'class' => 'form-horizontal form-label-left']) !!}
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="@lang('app.selected_client')">@lang('app.selected_client') <span class="required">*</span>
              </label>
              <div class="col-md-10 col-sm-10 col-xs-12">
                {!! Form::select('clients[]', $clients, old('clients'), ['class' => 'form-control select2_single', 'multiple' => 'multiple', 'id' => 'clients']) !!}
              </div>
            </div>
              <div class="row"> 
                <div class="col-md-3 col-sm-3 col-xs-12">
                </div>
                <div class="col-md-5 col-sm-5 col-xs-12">
                  <div class="coupons">
                    <div class="coupons-inner">
                    {{ trans('app.content_coupon', ['percentage' => $coupon->percentage]) }}
                      <div class="coupons-code {{ $coupon->validity_class() }}">
                      {{ $coupon->codeDecrypt() }}
                      </div>
                      <div class="one-time">
                      @if($coupon->status == 'Valid')
                        @lang('app.validity'): {{ $coupon->validity }}
                      @else
                        @if($coupon->status == 'noValid')
                          @lang('app.novalidity_admin')
                        @elseif($coupon->status == 0)
                          @lang('app.novalidity_client')
                        @endif
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                       <button type="submit" class="btn btn-primary btn-submit col-sm-4 col-xs-6">@lang('app.send')</button>
                    <button type="button" class="btn btn-default btn-cancel col-sm-4 col-xs-12">@lang('app.back')</button>
                  </div>
                </div>
              {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<!-- Select2 -->
{!! HTML::script('public/vendors/select2/dist/js/select2.full.min.js') !!}

<script type="text/javascript">
  $(".select2_single").select2({
    placeholder: "@lang('app.selected_client')"
  });
</script>

@endsection