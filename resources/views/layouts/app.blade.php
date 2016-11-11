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
    {!! HTML::style("vendors/bootstrap/dist/css/bootstrap.min.css") !!}
    <!-- font-awesome.css -->
    {!! HTML::style("vendors/font-awesome/css/font-awesome.min.css") !!}
    <!-- Animate.css -->
    {!! HTML::style("assets/css/animate.min.css") !!}
    <!-- sweetalert -->
    {!! HTML::style("assets/css/sweetalert.css") !!}
    <!-- Custom Theme Style -->
    {!! HTML::style("assets/css/custom.css") !!}
    <!-- Datatables -->
    {!! HTML::style("vendors/datatables.net-bs/css/dataTables.bootstrap.min.css") !!}
    {!! HTML::style("vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css") !!}
    {!! HTML::style("vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css") !!}
    {!! HTML::style("vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") !!}
    {!! HTML::style("vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css") !!}
    {!! HTML::style("vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css") !!}

    <!-- PNotify -->
    {!! HTML::style("vendors/pnotify/dist/pnotify.css") !!}
    {!! HTML::style("vendors/pnotify/dist/pnotify.buttons.css") !!}
    {!! HTML::style("vendors/pnotify/dist/pnotify.nonblock.css") !!}

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
                ©2016 - {{ config('app.name') }}</a>
              </div>
              <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!--JQuery--> 
    {!! HTML::script('vendors/jquery/dist/jquery.min.js') !!}

    <!--Bootstrap--> 
    {!! HTML::script('vendors/bootstrap/dist/js/bootstrap.min.js') !!}

    <!-- moment -->
    {!! HTML::script('assets/js/moment/moment.min.js') !!}

    <!-- Laravel Javascript Validation -->
    {!! HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}

    <!--sweet alert--> 
    {!! HTML::script('assets/js/sweetalert/sweetalert.min.js') !!}

    @include('sweet::alert')

    <!-- FastClick -->
    {!! HTML::script('vendors/fastclick/lib/fastclick.js') !!}

    <!-- Datatables -->
    {!! HTML::script('vendors/datatables.net/js/jquery.dataTables.min.js') !!}
    {!! HTML::script('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}
    {!! HTML::script('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') !!}
    {!! HTML::script('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') !!}
    {!! HTML::script('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') !!}
    {!! HTML::script('vendors/datatables.net-scroller/js/datatables.scroller.min.js') !!}
    {!! HTML::script('vendors/fastclick/lib/fastclick.js') !!}

    <!-- PNotify -->
    {!! HTML::script('vendors/pnotify/dist/pnotify.js') !!}
    {!! HTML::script('vendors/pnotify/dist/pnotify.buttons.js') !!}
    {!! HTML::script('vendors/pnotify/dist/pnotify.nonblock.js') !!}

    <!-- bootstrap-daterangepicker -->
    {!! HTML::script('assets/js/moment/moment.min.js') !!}

    <script>
       var lang = {"cancel" : "@lang('app.cancel')"};
    </script>

    <!-- Custom Theme Scripts -->
    {!! HTML::script('assets/js/custom.js') !!}

     @yield('scripts')


</body>
</html>
