 <!--Main Menu-->
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar">
      <div class="site_logo"></div>
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
          @include('partials.menu_admin')
        @endif

        @if (Auth::user()->role->name == 'client')
          @include('partials.menu_client')
        @endif
       
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->
  </div>
</div>
<!--/MainMenu--> 