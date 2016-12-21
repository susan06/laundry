        <!--Services -->
        <li>
          <a href="{{ secure_url(route('order.create')) }}" title="@lang('app.service_request')"><i class="fa fa-cubes"></i> @lang('app.service_request')
          </a>
        </li>
        <!--//Services -->
        <!--My Orders -->
        <li>
          <a href="{{ secure_url(route('my.orders')) }}" title="@lang('app.my_orders')"><i class="fa fa-file-o"></i> @lang('app.my_orders')
          </a>
        </li>
        <!--//My Orders --> 

        <!--faqs -->
        <li>
          <a href="{{ route('faq.index') }}" title="@lang('app.faqs')"><i class="fa fa-info"></i> @lang('app.faqs')
          </a>
        </li>
        <!--//faqs -->   
        <!--terms of service -->
        <li>
          <a href="{{ route('setting.client.conditions') }}" title="@lang('app.terms_and_conditions')"><i class="fa fa-file-text-o"></i> @lang('app.terms_and_conditions')
          </a>
        </li>
        <!--//terms of service -->   
        <!--politics privacy -->
        <li>
          <a href="{{ route('setting.client.privacy') }}" title="@lang('app.privacy_policies')"><i class="fa fa-file-text"></i> @lang('app.privacy_policies')
          </a>
        </li>
        <!--//politics privacy -->     
 