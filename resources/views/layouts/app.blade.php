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
    <!-- Custom Theme Style -->
    {!! HTML::style("assets/css/custom.min.css") !!}
    @yield('styles')  
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('partials.menu')

            @include('partials.navbar')

            @yield('content') 

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

    @include('partials.modals')

    <!--JQuery--> 
    {!! HTML::script('vendors/jquery/dist/jquery.min.js') !!}

    <!--Bootstrap--> 
    {!! HTML::script('vendors/bootstrap/dist/js/bootstrap.min.js') !!}

    <!-- moment -->
    {!! HTML::script('assets/js/moment/moment.min.js') !!}

    <!-- Laravel Javascript Validation -->
    {!! HTML::script('vendors/jsvalidation/js/jsvalidation.js') !!}

    <!--sweet alert--> 
    {!! HTML::script('assets/js/sweetalert/sweetalert.min.js') !!}

    @include('sweet::alert')

    <!-- FastClick -->
    {!! HTML::script('vendors/fastclick/lib/fastclick.js') !!}

    <!-- Custom Theme Scripts -->
    {!! HTML::script('assets/js/custom.min.js') !!}

    <script type="text/javascript">
        
    </script>

     @yield('scripts')


</body>
</html>
