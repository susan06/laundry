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
						<h3>@lang('app.hi') {{ $email }},</h3>
						<p class="lead">{{ trans('app.invite_to_register_by', ['friend' => $friend]) }}</p>
						<!-- Callout Panel -->
						<p class="callout">
							<a href="{{ route('login') }}">{{ route('login') }}</a>
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
