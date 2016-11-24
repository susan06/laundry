@extends('layouts.app')

@section('page-title', trans('app.clients'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.clients')</h3>
            </div>
            @include('partials.status')
            @include('partials.search')
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">
            <p>
            <button type="button" data-href="{{ route('admin-client.create', 'role=true') }}" class="btn btn-primary btn-sm create-edit-show" data-model="modal" title="@lang('app.create_client')">@lang('app.create_client')</button>
            </p>

            <div id="content-table">
              @include('users.clients.list')
              {{ $clients->links() }}
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