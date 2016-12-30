  <div class="row"> 
  @foreach($coupons as $key => $coupon)
    <div class="col-md-5 col-sm-5 col-xs-12">
      <div class="coupons">
        <div class="coupons-inner">
        {{ trans('app.content_coupon', ['percentage' => $coupon->coupon->percentage]) }}
          <div class="coupons-code {{ $coupon->coupon->validity_class() }} {{ $coupon->validity_class() }}">
          {{ $coupon->coupon->codeDecrypt() }}
          </div>
          <div class="one-time">
          @if($coupon->coupon->status == 'Valid' && $coupon->status == 1)
            @lang('app.validity'): {{ $coupon->coupon->validity }}
          @else
            @if($coupon->coupon->status == 'noValid')
              @lang('app.novalidity_admin')
            @elseif($coupon->status == 0)
              @lang('app.novalidity_client')
            @endif
          @endif
          </div>
        </div>
      </div>
    </div>
  @endforeach
  </div>

  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
      <button type="button" class="btn btn-default btn-cancel col-sm-3 col-xs-12">@lang('app.back')</button>
    </div>
  </div>
{!! Form::close() !!}
