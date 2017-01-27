<!--notifications-->
  <li>
    <a href="{{ route('driver.notifications') }}" title="@lang('app.notifications')"><i class="fa fa-bell"></i> @lang('app.notifications') <span class="badge bg-green driver-notifications">0</span>
    </a>
  </li>
<!--//notifications-->

  <!--Itinerary -->
  <li>
    <a href="{{ route('driver.order.itinerary') }}" title="@lang('app.my_itinerary')"><i class="fa fa-file-o"></i> @lang('app.my_itinerary')
    </a>
  </li>
  <!--//Itinerary -->

    <!--order delivered -->
  <li>
    <a href="{{ route('driver.order.itinerary.delivery') }}" title="@lang('app.order_delivered')"><i class="fa fa-file-o"></i> @lang('app.order_delivered')
    </a>
  </li>
  <!--//order delivered -->

  <!--Activities -->
  <li>
    <a href="{{ route('driver.activities') }}" title="@lang('app.activities')"><i class="fa fa-bars"></i> @lang('app.activities')
    </a>
  </li>
  <!--//Activities -->
