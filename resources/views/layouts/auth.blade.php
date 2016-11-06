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

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="login">
    
    @yield('content')

    <!-- Scripts -->

    <!--JQuery--> 
    {!! HTML::script('vendors/jquery/dist/jquery.min.js') !!}

    <!--Bootstrap--> 
    {!! HTML::script('vendors/bootstrap/dist/js/bootstrap.min.js') !!}

    @yield('scripts')
</body>
</html>
