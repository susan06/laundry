<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Settings('app_name') }} | @yield('page-title')</title>

    <!-- Styles -->
    {!! HTML::style("public/vendors/bootstrap/dist/css/bootstrap.min.css") !!}
    <!-- font-awesome.css -->
    {!! HTML::style("public/vendors/font-awesome/css/font-awesome.min.css") !!}
    <!-- Animate.css -->
    {!! HTML::style("public/assets/css/animate.min.css") !!}
    <!-- PNotify -->
    {!! HTML::style("public/vendors/pnotify/dist/pnotify.css") !!}
    {!! HTML::style("public/vendors/pnotify/dist/pnotify.buttons.css") !!}
    {!! HTML::style("public/vendors/pnotify/dist/pnotify.nonblock.css") !!}
    <!-- Custom Theme Style -->
    {!! HTML::style("public/assets/css/login.css") !!}
    <!-- Responsive -->
    {!! HTML::style("public/assets/css/responsive.css") !!}
    
    <!-- Scripts -->
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
    
</head>
<body class="login">
    
    @yield('content')

    <!-- Scripts -->

    <!--JQuery--> 
    {!! HTML::script('public/vendors/jquery/dist/jquery.min.js') !!}

    <!--Bootstrap--> 
    {!! HTML::script('public/vendors/bootstrap/dist/js/bootstrap.min.js') !!}

    <!-- PNotify -->
    {!! HTML::script('public/vendors/pnotify/dist/pnotify.js') !!}
    {!! HTML::script('public/vendors/pnotify/dist/pnotify.buttons.js') !!}
    {!! HTML::script('public/vendors/pnotify/dist/pnotify.nonblock.js') !!}

    <script>
        function notify(type, message){
            new PNotify({
              text: message,
              type: type,
              hide: true,
              styling: 'bootstrap3'
            });
        }
    </script>

    @include('partials.messages')

    @yield('scripts')
</body>
</html>
