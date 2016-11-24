@extends('layouts.app')

@section('page-title', trans('app.branch_offices'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3 id="content-title">@lang('app.branch_offices')</h3>
            </div>
            @include('partials.status')
            @include('partials.search')
          </div>
        
          <div class="x_content">
          
            <div class="row">
              <div class="col-md-2 col-sm-2 col-xs-12">
                  <button type="button" data-href="{{ route('admin-branch-office.create') }}" class="btn btn-primary create-edit-show btn-create col-xs-12" data-model="content" title="@lang('app.create_branch_office')">@lang('app.create_branch_office')</button>
              </div>
            </div>

            <div id="content-table">
              @include('branch_offices.list')
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts_head')
@parent
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?&key={{ env('API_KEY_GOOGLE')}}&libraries=places&language={{Auth::User()->lang}}"></script>
@endsection