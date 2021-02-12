<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="SemiColonWeb" />

        <!-- Stylesheets
        ============================================= -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/style.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/swiper.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/dark.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/font-icons.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/animate.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/magnific-popup.css') }}" type="text/css" />

        <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lt IE 9]>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <title>APP - @yield('title')</title>
    </head>
    <body class="stretched">

        <!-- Document Wrapper -->
        <div id="wrapper" class="clearfix">
            <!-- Content -->
            <section id="content">
                @yield('content')
            </section>
            <!-- #content end -->
        </div>
        <!--#End Document Wrapper-->
        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-angle-up"></div>


            <!-- External JavaScripts
        ============================================= -->
        <script type="text/javascript" src="{{ asset('public/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/plugins.js') }}"></script>

        <!-- Footer Scripts
        ============================================= -->
        <script type="text/javascript" src="{{ asset('public/js/functions.js') }}"></script>

    </body>
</html>