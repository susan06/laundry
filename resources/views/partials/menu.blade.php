 <!--Main Menu-->
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{ url('home') }}" class="site_title"><i class="fa fa-car"></i> <span>{{ config('app.name') }}</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <img src="http://placehold.it/150x150" alt="user" class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>@lang('app.welcome'),</span>
        <h2>{{ Auth::user()->name }}</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>{{ Auth::user()->role->display_name }}</h3>
        <ul class="nav side-menu">
        <li>
          <a href="{{ url('home') }}" title="@lang('app.home')"><i class="fa fa-home"></i> @lang('app.home')
          </a>
        </li>
        
        @if (Auth::user()->role->name == 'admin')
        <!--Users and Roles -->
        <li><a><i class="fa fa-users"></i> @lang('app.users') <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('user.index') }}">@lang('app.users')</a></li>
            <li><a href="{{ route('role.index') }}">@lang('app.roles')</a></li>
          </ul>
        </li>
        <!--//Users and Roles -->
        <!--Clients -->
        <li>
          <a href="{{ route('admin.client.index') }}" title="@lang('app.clients')"><i class="fa fa-users"></i> @lang('app.clients')
          </a>
        </li>
        <!--//Clients -->
        <!--Coupons -->
        <li>
          <a href="{{ route('coupon.index') }}" title="@lang('app.coupons')"><i class="fa fa-tags"></i> @lang('app.coupons')
          </a>
        </li>
        <!--//Coupons -->
        <!--branch offices -->
        <li>
          <a href="{{ route('branch-office.index') }}" title="@lang('app.branch_offices')"><i class="fa fa-building-o"></i> @lang('app.branch_offices')
          </a>
        </li>
        <!--//branch offices -->
        @endif

        <!--Clients -->
        <li><a><i class="fa fa-users"></i> @lang('app.clients') <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ route('clients.create') }}">@lang('app.registration')</a></li>
            <li><a href="{{ route('clients.services') }}">@lang('app.request_services')</a></li>
            <li><a href="{{ route('clients.orders') }}">@lang('app.my_orders')</a></li>
            <li><a href="{{ route('clients.terms') }}">@lang('app.terms_and_conditions')</a></li>
            <li><a href="{{ route('clients.questions') }}">@lang('app.frequent_questions')</a></li>
            <li><a href="{{ route('clients.privacy') }}">@lang('app.privacy_policies')</a></li>
            <li><a href="{{ route('clients.invite') }}">@lang('app.invite_friend')</a></li>
          </ul>
        </li>
        <!--//Clients -->
       
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->
  </div>
</div>
<!--/MainMenu--> 