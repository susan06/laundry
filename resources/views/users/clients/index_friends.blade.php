@extends('layouts.back')

@section('page-title', trans('app.friends_invited'))

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="page-title">
            <div class="title_left">
              <h3>@lang('app.friends_invited')</h3>
            </div>
            <div class="clearfix"></div>
          </div>
        
          <div class="x_content">

            <div id="content-table">
              @include('users.clients.list_friends')
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

