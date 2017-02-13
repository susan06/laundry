@extends('layouts.back')

@section('page-title', trans('app.categories'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.categories')</h3>
            </div>
            @include('partials.status')
            @include('partials.search')
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
            <div class="row">
              <div class="col-md-2 col-sm-2 col-xs-12">
              <button type="button" data-href="{{ route('admin-package-category.create') }}" class="btn btn-primary create-edit-show col-xs-12" data-model="modal" title="@lang('app.create_category')">@lang('app.create_category')</button>
              </div>
            </div>

            <div id="content-table">
              @include('packages.categories.list')
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