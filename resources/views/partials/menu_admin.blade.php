        <!--Users and Roles -->
        <li><a><i class="fa fa-users"></i> @lang('app.users') <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ secure_url(route('user.index')) }}">@lang('app.users')</a></li>
            <li><a href="{{ secure_url(route('role.index')) }}">@lang('app.roles')</a></li>
          </ul>
        </li>
        <!--//Users and Roles -->
        <!--Clients -->
        <li>
          <a href="{{ route('admin.client.index') }}" title="@lang('app.clients')"><i class="fa fa-child"></i> @lang('app.clients')
          </a>
        </li>
        <!--//Clients -->
         <!--Drivers -->
        <li>
          <a href="{{ route('admin.driver.index') }}" title="@lang('app.drivers')"><i class="fa fa-car"></i> @lang('app.drivers')
          </a>
        </li>
        <!--//Drivers -->
        <!--Coupons -->
        <li>
          <a href="{{ route('coupon.index') }}" title="@lang('app.coupons')"><i class="fa fa-tags"></i> @lang('app.coupons')
          </a>
        </li>
        <!--//Coupons -->
        <!--branch offices -->
        <li>
          <a href="{{ route('admin-branch-office.index') }}" title="@lang('app.branch_offices')"><i class="fa fa-building-o"></i> @lang('app.branch_offices')
          </a>
        </li>
        <!--//branch offices -->
        <!--terms of service -->
        <li>
          <a href="{{ route('setting.conditions_and_privacy') }}" title="@lang('app.terms_service')"><i class="fa fa-info"></i> @lang('app.terms_service')
          </a>
        </li>
        <!--//terms of service -->
        <!--Working hours -->
        <li>
          <a href="{{ route('setting.working.hours') }}" title="@lang('app.working_hours')"><i class="fa fa-calendar"></i> @lang('app.working_hours')
          </a>
        </li>
        <!--//Working hours -->
        <!--setting -->
        <li>
          <a href="{{ route('setting.administration') }}" title="@lang('app.setting')"><i class="fa fa-cog"></i> @lang('app.setting')
          </a>
        </li>
        <!--//setting -->