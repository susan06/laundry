@extends('layouts.app')

@section('page-title', trans('app.profile'))

@section('content')

<!--banner--> 
  <div class="banner"> 
    <h2 id="content-title">@lang('app.my_profile')</h2>
  </div>
<!--//banner-->

<div class="grid-form">
    <div class="grid-form1">
        <div id="content-table">
          @include('users.list_profile_data')
        </div>
        
        </br>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10 col-xs-12">
            <a href="javascript:void(0)" data-href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary create-edit-show col-md-12 col-sm-12 col-xs-12" data-model="modal" title="@lang('app.update_profile')">@lang('app.update_profile')
            </a>
          </div>
        </div>

        </br>
        
    </div>
</div>

@endsection

@section('styles')
{!! HTML::style("public/assets/css/datetimepicker/bootstrap-datetimepicker.min.css") !!}
@endsection

@section('scripts')
 <!-- jquery.inputmask -->
 {!! HTML::script('public/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') !!}

 <!-- bootstrap-daterangepicker -->
 {!! HTML::script('public/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') !!}

@endsection