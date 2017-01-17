@extends('layouts.app')

@section('content')

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Admin</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <!-- top tiles -->
            <div class="row tile_count">
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-users"></i> @lang('app.users')</span>
                <div class="count green">{{count($totalUsers)}}</div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> @lang('app.clients')</span>
                <div class="count green">{{count($totalClients)}}</div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-car"></i> @lang('app.drivers')</span>
                <div class="count green">{{count($totalDrivers)}}</div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-building-o"></i> @lang('app.branch_offices') </span>
                <div class="count green">{{count($totalBranchOffices)}}</div>
              </div>
              <!--<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> @lang('app.orders') </span>
                <div class="count">2,315</div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
                <div class="count">7,325</div>
              </div>-->
            </div>
            <!-- /top tiles -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

@endsection