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
    {!! HTML::style("public/assets/css/bootstrap.min.css") !!}
    <!-- font-awesome.css -->
    {!! HTML::style("public/assets/css/font-awesome.css") !!}
    <!-- all vendors -->
    {!! HTML::style("public/assets/css/all_styles.css") !!}
    <!-- Custom Theme Style -->
    {!! HTML::style("public/assets/css/style.css") !!}
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

    @if (Auth::user()->role->name == 'client')
    <!--Start of Zendesk Chat Script-->
    <script type="text/javascript">
    
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
    $.src="https://v2.zopim.com/?4O4qGFz3j5u7LynP2fQPpGHDgtpqigrH";z.t=+new Date;$.
    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");

    </script>
    <!--End of Zendesk Chat Script-->
    @endif

    @yield('scripts_head') 

</head>
<body>
    <div id="wrapper">

        <div class="loader loader-default" id="loading"></div>

        @include('partials.navbar')

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="content-main">
                <!--content-->
                @yield('content') 
                <!--//content-->   
                <div class="copy">
                    <p>©2016 - {{ Settings::get('app_name') }}</p>     
                </div>
            </div>
            @include('partials.modals')
        </div>

        <div class="clearfix"> </div>
    </div>

    @if (Auth::user()->role->name == 'branch-representative')
        @include('partials.modal_branch_offices')
    @endif
    <!--JQuery--> 
    {!! HTML::script('public/vendors/jquery/dist/jquery.min.js') !!}
    <!--Bootstrap--> 
    {!! HTML::script('public/vendors/bootstrap/dist/js/bootstrap.min.js') !!}
    <!-- moment -->
    {!! HTML::script('public/assets/js/moment/moment.min.js') !!}
    <!--sweet alert--> 
    {!! HTML::script('public/assets/js/sweetalert/sweetalert.min.js') !!}
    @include('sweet::alert')
    <!-- Datatables -->
    {!! HTML::script('public/assets/js/datatables.js') !!}
    <!-- PNotify -->
    {!! HTML::script('public/assets/js/pnotify.min.js') !!}

    <script>
       var lang = {"cancel" : "@lang('app.cancel')",
        "no_data_table" : "@lang('app.no_records_found')",
        "on_hold": "@lang('app.on_hold')"};
       var icon_map = "{{ url('public/images/pointer-celeste.png') }}";
       var icon_map_green = "{{ url('public/images/pointer-green.png') }}";
       var map_center = {lat: {{Settings::get('lat')}}, lng: {{Settings::get('lng')}} };   
    </script>

    {!! HTML::script('public/assets/js/jquery.metisMenu.js') !!}
    <!-- Custom Theme Scripts -->
    {!! HTML::script('public/assets/js/custom.js') !!}

    @include('partials.messages')

    @if (Auth::user()->role->name == 'branch-representative')
        <script type="text/javascript">
        function change_branch_office(){
            @if (session('branch_offices'))
            $('#modal_branch_offices').modal('show');
            @endif
        }
        </script>
    @endif

    @if (Auth::user()->role->name == 'branch-representative' && !session('branch_office'))
        <script type="text/javascript">
            $('#modal_branch_offices').modal('show');
        </script>
    @endif

    @if (Auth::user()->role->name == 'driver')
    <script type="text/javascript">
        function driver_notifications() {
            $.ajax({
                url: '{{ route("driver.notification.count") }}',
                type : 'get',
                dataType: 'json',
                success: function (response) {
                   $(".driver-notifications").text(response.count);
                }
            });
        }
    
        $(document).ready(function () {            
            driver_notifications();
            setInterval(driver_notifications,30000);
        });
    </script>
    @endif

    @if (Auth::user()->role->name == 'supervisor')
    <script type="text/javascript">
        function driver_notifications() {
            $.ajax({
                url: '{{ route("supervisor.notification.count") }}',
                type : 'get',
                dataType: 'json',
                success: function (response) {
                   $(".supervisor-notifications").text(response.count);
                }
            });
        }
    
        $(document).ready(function () {            
            driver_notifications();
            setInterval(driver_notifications,30000);
        });
    </script>
    @endif


    @yield('scripts')

</body>
</html>
