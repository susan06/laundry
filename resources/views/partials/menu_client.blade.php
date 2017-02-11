        <!--My locations -->
        <li>
          <a href="{{ route('client.locations') }}" class="hvr-bounce-to-right" title="@lang('app.my_locations')"><i class="fa fa-location-arrow nav_icon"></i> <span class="nav-label">@lang('app.my_locations')</span>
          </a>
        </li>
        <!--//My locations -->

        <!--Services -->
        <li>
          <a href="{{ secure_url(route('order.create')) }}" class="hvr-bounce-to-right" title="@lang('app.service_request')"><i class="fa fa-cubes nav_icon"></i> <span class="nav-label">@lang('app.service_request')</span>
          </a>
        </li>
        <!--//Services -->
        <!--My Orders -->
        <li>
          <a href="{{ secure_url(route('my.orders')) }}" class="hvr-bounce-to-right" title="@lang('app.my_orders')"><i class="fa fa-cart-plus nav_icon"></i> <span class="nav-label">@lang('app.my_orders')</span>
          </a>
        </li>
        <!--//My Orders --> 

        <!--faqs -->
        <li>
          <a href="{{ route('faq.index') }}" class="hvr-bounce-to-right" title="@lang('app.faqs')"><i class="fa fa-info nav_icon"></i> <span class="nav-label">@lang('app.faqs')</span>
          </a>
        </li>
        <!--//faqs -->   
        <!--terms of service -->
        <li>
          <a href="{{ route('setting.client.conditions') }}" class="hvr-bounce-to-right" title="@lang('app.terms_and_conditions')"><i class="fa fa-file-text-o nav_icon"></i> <span class="nav-label">@lang('app.terms_and_conditions')</span>
          </a>
        </li>
        <!--//terms of service -->   
        <!--politics privacy -->
        <li>
          <a href="{{ route('setting.client.privacy') }}" class="hvr-bounce-to-right" title="@lang('app.privacy_policies')"><i class="fa fa-file-text nav_icon"></i> <span class="nav-label">@lang('app.privacy_policies')</span>
          </a>
        </li>
        <!--//politics privacy --> 
        <!--invite friends -->
        <li>
          <a href="{{ route('client.friends') }}" class="hvr-bounce-to-right" title="@lang('app.invited_friends')"><i class="fa fa-envelope-o nav_icon"></i> <span class="nav-label">@lang('app.invited_friends')</span>
          </a>
        </li>
        <!--//invite friends -->  
 