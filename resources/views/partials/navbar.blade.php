<!-- top navigation -->
<div class="top_nav no-print">
  <div class="nav_menu">
    <nav class="no-print" role="navigation">
      <div class="nav toggle no-print">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right no-print">
        <li class="">
          <a href="javascript:void(0)" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ Auth::user()->avatar() }}" alt="avatar">{{ Auth::user()->name }}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="{{ route('profile.index')}}"> @lang('app.profile')</a></li>
            <li>
            @if (Auth::user()->role->name == 'client')
              <a href="{{ route('client.setting') }}">
                <span>@lang('app.settings')</span>
              </a>
            @else
              <a href="{{ route('user.setting') }}">
                <span>@lang('app.settings')</span>
              </a>
            @endif
            </li>
            <li>
              <a href="{{ route('user.password') }}">
                <span>@lang('app.auth_and_registration')</span>
              </a>
            </li>
            @if (Auth::user()->role->name == 'client')
            <li>
              <a href="{{ route('qualification.create') }}">
                <span>@lang('app.qualification')</span>
              </a>
            </li>
            @endif
            <li><a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out pull-right"></i> @lang('app.sign_out')</a></li>
          </ul>
        </li>
        @if (Auth::user()->role->name == 'client')
        <li role="presentation" class="dropdown">
          <a href="javascript:void(0);" class="dropdown-toggle info-number send-suggestions" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
          </a>
        </li>
        @endif
      </ul>
    </nav>
  </div>
</div>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
  {{ csrf_field() }}
</form>
<!-- /top navigation -->
