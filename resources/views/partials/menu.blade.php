<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
        @if (Auth::user()->role->name == 'admin')
          @include('partials.menu_admin')
        @endif

        @if (Auth::user()->role->name == 'client')
          @include('partials.menu_client')
        @endif

        @if (Auth::user()->role->name == 'driver')
          @include('partials.menu_driver')
        @endif

        @if (Auth::user()->role->name == 'branch-representative')
          @include('partials.menu_branch')
        @endif

        @if (Auth::user()->role->name == 'supervisor')
          @include('partials.menu_supervisor')
        @endif 
    </ul>
  </div>
</div>
