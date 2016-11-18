<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    {!! HTML::style("public/vendors/bootstrap/dist/css/bootstrap.min.css") !!}
    <!-- font-awesome.css -->
    {!! HTML::style("public/vendors/font-awesome/css/font-awesome.min.css") !!}
    <!-- Animate.css -->
    {!! HTML::style("public/assets/css/animate.min.css") !!}
    <!-- sweetalert -->
    {!! HTML::style("public/assets/css/sweetalert.css") !!}
    <!-- Custom Theme Style -->
    {!! HTML::style("public/assets/css/custom.css") !!}
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

    <!-- bootstrap datetimepicker -->
    {!! HTML::style("public/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css") !!}

    @yield('styles')  
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    @yield('scripts_head') 

</head>
<body class="nav-md">
    <div class="container body">
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
    {!! HTML::script('public/vendors/datatables.net-scroller/js/datatables.scroller.min.js') !!}
    {!! HTML::script('public/vendors/fastclick/lib/fastclick.js') !!}

    <!-- PNotify -->
    {!! HTML::script('public/vendors/pnotify/dist/pnotify.js') !!}
    {!! HTML::script('public/vendors/pnotify/dist/pnotify.buttons.js') !!}
    {!! HTML::script('public/vendors/pnotify/dist/pnotify.nonblock.js') !!}

    <!-- bootstrap-daterangepicker -->
    {!! HTML::script('public/assets/js/moment/moment.min.js') !!}

    <script>
       var lang = {"cancel" : "@lang('app.cancel')"};
    </script>

    <!-- Custom Theme Scripts -->
    {!! HTML::script('public/assets/js/custom.js') !!}

    @include('partials.messages')
    
    @yield('scripts')


</body>
</html>
