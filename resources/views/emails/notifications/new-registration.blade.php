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
						<h3>@lang('app.hi') {{ $user->present()->nameOrEmail }},</h3>
						<p class="lead">@lang('app.to_view_details_visit_link_below')</p>
						<!-- Callout Panel -->
						<p class="callout">
							<a href="{{ route('user.show', $newUser->id) }}">{{ route('user.show', $newUser->id) }}</a>
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
