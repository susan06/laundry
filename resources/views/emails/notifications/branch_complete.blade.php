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
						<h3>@lang('app.change_status_order')</h3>
						<p class="lead">@lang('app.order'): {{ $order->bag_code }}</p>
						<!-- Callout Panel -->
						<p class="callout">
							@lang('app.status'): @lang('app.'.$order->status)
						</p><!-- /Callout Panel -->							
					</td>
				</tr>
			</table>
			</div><!-- /content -->					
		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->

@endsection