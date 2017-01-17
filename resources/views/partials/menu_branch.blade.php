 @if(session('branch_office'))
   <!--Branch office -->
   <li>
    <a href="#" onclick="change_branch_office()"><i class="fa fa-building-o"></i> @lang('app.branch_office') {{ session('branch_office')->name }}</a>
    </li>
  <!--//Branch office -->
  @endif

  <!--Order in branch -->
  <li>
    <a href="{{ route('driver.order.itinerary') }}" title="@lang('app.order_in_branch')"><i class="fa fa-file-o"></i> @lang('app.order_in_branch')
    </a>
  </li>
  <!--//Order in branch -->

   <!--Order complete -->
  <li>
    <a href="{{ route('driver.order.itinerary') }}" title="@lang('app.order_complete')"><i class="fa fa-file-o"></i> @lang('app.order_complete')
    </a>
  </li>
  <!--//Order complete -->