<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:void(0)" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="http://placehold.it/150x150" alt="">{{ Auth::user()->name }}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="javascript:void(0)"> Profile</a></li>
            <li>
              <a href="javascript:void(0)">
                <span>Settings</span>
              </a>
            </li>
            <li><a href="javascript:void(0)">Help</a></li>
            <li><a href="javascript:void(0)" onClick="$('#logout-form').submit()"><i class="fa fa-sign-out pull-right"></i> @lang('app.sign_out')</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
  {{ csrf_field() }}
</form>
<!-- /top navigation -->
