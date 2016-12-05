<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Settings::get('app_name') }} | @yield('page-title')</title>

    <!-- Styles -->
    {!! HTML::style("public/vendors/bootstrap/dist/css/bootstrap.min.css") !!}
    <!-- font-awesome.css -->
    {!! HTML::style("public/vendors/font-awesome/css/font-awesome.min.css") !!}
    <!-- Animate.css -->
    {!! HTML::style("public/assets/css/animate.min.css") !!}
    <!-- sweetalert -->
    {!! HTML::style("public/assets/css/sweetalert.css") !!}
    <!-- Datatables -->
    {!! HTML::style("public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css") !!}
    {!! HTML::style("public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") !!}
    {!! HTML::style("public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css") !!}
    {!! HTML::style("public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") !!}
    {!! HTML::style("public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css") !!}
    {!! HTML::style("public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") !!}
    <!-- PNotify -->
    {!! HTML::style("public/vendors/pnotify/dist/pnotify.css") !!}
    {!! HTML::style("public/vendors/pnotify/dist/pnotify.buttons.css") !!}
    {!! HTML::style("public/vendors/pnotify/dist/pnotify.nonblock.css") !!}
    <!-- iChecks -->
    {!! HTML::style("public/vendors/iCheck/skins/flat/green.css") !!}
    <!-- bootstrap-wysiwyg -->
    {!! HTML::style("public/vendors/google-code-prettify/bin/prettify.min.css") !!}
    <!-- Select2 -->
    {!! HTML::style("public/vendors/select2/dist/css/select2.min.css") !!}
    <!-- bootstrap datetimepicker -->
    {!! HTML::style("public/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css") !!}
    <!-- Custom Theme Style -->
    {!! HTML::style("public/assets/css/custom.css") !!}
    <!-- Responsive -->
    {!! HTML::style("public/assets/css/responsive.css") !!}

    @yield('styles') 

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-6741427-13', 'auto');
      ga('send', 'pageview');

    </script>
    
    @yield('scripts_head') 

</head>
<body class="nav-md">
    <div class="container body">

        <div class="loader loader-default" id="loading"></div>

        <div class="main_container">
            @include('partials.menu')

            @include('partials.navbar')

            @yield('content') 

            @include('partials.modals')
            
            <!-- footer content -->
            <footer>
              <div class="pull-right">
                ©2016 - {{ Settings::get('app_name') }}</a>
              </div>
              <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    
    <!--JQuery--> 
    {!! HTML::script('public/vendors/jquery/dist/jquery.min.js') !!}

    <!-- bootstrap-daterangepicker -->
    {!! HTML::script('public/assets/js/moment/moment.min.js') !!}

    <!--Bootstrap--> 
    {!! HTML::script('public/vendors/bootstrap/dist/js/bootstrap.min.js') !!}

    <!-- moment -->
    {!! HTML::script('public/assets/js/moment/moment.min.js') !!}

    <!--sweet alert--> 
    {!! HTML::script('public/assets/js/sweetalert/sweetalert.min.js') !!}

    @include('sweet::alert')

    <!-- FastClick -->
    {!! HTML::script('public/vendors/fastclick/lib/fastclick.js') !!}

    <!-- Datatables -->
    {!! HTML::script('public/vendors/datatables.net/js/jquery.dataTables.min.js') !!}
    {!! HTML::script('public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}
    {!! HTML::script('public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') !!}
    {!! HTML::script('public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') !!}
    {!! HTML::script('public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') !!}
    {!! HTML::script('public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') !!}
    {!! HTML::script('public/vendors/fastclick/lib/fastclick.js') !!}

    <!-- PNotify -->
    {!! HTML::script('public/vendors/pnotify/dist/pnotify.js') !!}
    {!! HTML::script('public/vendors/pnotify/dist/pnotify.buttons.js') !!}
    {!! HTML::script('public/vendors/pnotify/dist/pnotify.nonblock.js') !!}

    <script>
       var lang = {"cancel" : "@lang('app.cancel')"};
       var icon_map = "{{ url('public/images/pointer-celeste.png') }}";
       var icon_map_green = "{{ url('public/images/pointer-green.png') }}";
       var map_center = {lat: {{Settings::get('lat')}}, lng: {{Settings::get('lng')}} };   
    </script>

    <!-- Custom Theme Scripts -->
    {!! HTML::script('public/assets/js/custom.js') !!}

    @include('partials.messages')

    @yield('scripts')

</body>
</html>
