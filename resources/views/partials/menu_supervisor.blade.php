<!--notifications-->
  <li>
    <a href="{{ route('notification.index') }}" title="@lang('app.notifications')"><i class="fa fa-bell"></i> @lang('app.notifications') <span class="badge bg-green supervisor-notifications">0</span>
    </a>
  </li>
<!--//notifications-->

<!--Orders -->
<li>
  <a href="{{ route('admin-order.index') }}" title="@lang('app.orders')"><i class="fa fa-file-o"></i> @lang('app.orders')
  </a>
</li>
<!--//Orders --> 

<!--Clients -->
<li>
  <a href="{{ route('admin-client.index') }}" title="@lang('app.clients')"><i class="fa fa-child"></i> @lang('app.clients')
  </a>
</li>
<!--//Clients -->

<!--Drivers -->
<li>
  <a href="{{ route('admin-driver.index') }}" title="@lang('app.drivers')"><i class="fa fa-car"></i> @lang('app.drivers')
  </a>
</li>
<!--//Drivers -->
