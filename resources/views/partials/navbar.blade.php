<!-- top navigation -->
  <nav class="navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
     <h1> <a class="navbar-brand" href="{{ url('/home')}}"><strong>Laundry</strong>Movil</a></h1>
    </div>

   <div class="border-bottom">
   
      <div class="drop-men">
          <ul class="nav_1">  
            <li class="dropdown">
              <a href="{{ url('/home') }}" class="margin-right-nav">
                <i class="fa fa-2x fa-dashboard"></i>
              </a>
            </li>
            @if (Auth::user()->role->name == 'client')
            <li class="dropdown">
              <a href="{{ route('my.orders') }}" class="margin-left-nav margin-right-nav">
                <i class="fa fa-2x fa-cart-plus"></i>
              </a>
            </li>
            <li class="dropdown">
              <a href="{{ route('client.locations') }}" class="margin-left-nav margin-right-nav">
                <i class="fa fa-2x fa-location-arrow"></i>
              </a>
            </li>
            <li class="dropdown">
              <a href="javascript:void(0);" class="margin-left-nav margin-right-nav send-suggestions">
                <i class="fa fa-2x fa-envelope-o"></i>
              </a>
            </li>
            @endif
            <li class="dropdown">
              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class="name-caret">{{ Auth::user()->full_name() }}<i class="caret"></i></span><img src="{{ Auth::user()->avatar() }}"></a>
              <ul class="dropdown-menu " role="menu">
                <li><a href="{{ route('profile.index')}}">@lang('app.profile')</a></li>
                <li>
                  @if (Auth::user()->role->name == 'client')
                    <a href="{{ route('client.setting') }}">
                      @lang('app.settings')
                    </a>
                  @else
                    <a href="{{ route('user.setting') }}">
                      @lang('app.settings')
                    </a>
                  @endif
                </li>
                 <li>
                  <a href="{{ route('user.password') }}">
                    @lang('app.auth_and_registration')
                  </a>
                </li>
                @if (Auth::user()->role->name == 'client')
                <li>
                  <a href="{{ route('qualification.create') }}">
                    @lang('app.qualification')
                  </a>
                </li>
                @endif
                <li>
                  <a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out pull-right"></i> @lang('app.sign_out')</a>
                </li>
              </ul>
            </li>  
          </ul>
       </div>

      <div class="clearfix"></div>
      @include('partials.menu')
    </div>
  </nav>
<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
  {{ csrf_field() }}
</form>
<!-- /top navigation -->
