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
 