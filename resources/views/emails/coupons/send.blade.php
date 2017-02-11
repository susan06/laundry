@extends('emails.layout')

@section('content')

<!-- BODY -->
<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">
			<div class="content">
			<table>
				<tr>
					<td>
						<h3>@lang('app.coupon_winnier')</h3>
						<div class="row"> 
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
					</td>
				</tr>
			</table>
			</div><!-- /content -->					
		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->

@endsection