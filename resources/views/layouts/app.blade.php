<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('libs/sweetalert/dist/sweetalert.min.js') }}"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('libs/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('libs/themify-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('libs/flag-icon-css/css/flag-icon.min.css') }}">
        <link rel="stylesheet" href="{{ asset('libs/selectFX/css/cs-skin-elastic.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        <!--DASHBOARD CSS -->
        @stack('dashboard_css')

        <!--DATATABLE CSS -->
        @stack('datatable_css')
    </head>
    
    @yield('left_panel')
    @yield('right_panel')
    @yield('content')

    </body>
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('libs/popper.js/dist/umd/popper.min.js') }}"></script>

    <!--DASHBOARD JS-->
    @stack('dashboard_js')

    <!--DATATABLE JS-->
    @stack('datatable_js')

    <!--FORM JS-->
    @stack('form_js')

    <script>
        // Counter Number
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 3000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
        
        $('#menuToggle').on('click', function(event) {
            $('body').toggleClass('open');
        });

        $('.search-trigger').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            $('.search-trigger').parent('.header-left').addClass('open');
        });

        $('.search-close').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            $('.search-trigger').parent('.header-left').removeClass('open');
        });
    </script>

</html>
