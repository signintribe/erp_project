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
        <link rel="stylesheet" href="{{ asset('public/css/dark.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/font-icons.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/animate.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/css/magnific-popup.css') }}" type="text/css" />

        <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lt IE 9]>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/include/rs-plugin/css/settings.css') }}" media="screen" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/include/rs-plugin/css/layers.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/include/rs-plugin/css/navigation.css') }}">
        <title>EBEETRO - @yield('title')</title>
    </head>
    <body class="stretched">

        <!-- Document Wrapper -->
        <div id="wrapper" class="clearfix">
               <!-- Top Bar
            ============================================= -->
            <div id="top-bar" class="hidden-xs">

                <div class="container clearfix">

                    <div class="col_half nobottommargin">

                        <p class="nobottommargin"><strong>Call:</strong> 1800-547-2145 | <strong>Email:</strong> info@ebeetro.com</p>

                    </div>

                    <div class="col_half col_last fright nobottommargin">

                        <!-- Top Links
                        ============================================= -->
                        <div class="top-links">
                            <ul>
                                <li><a href="#">USD</a>
                                    <ul>
                                        <li><a href="#">EUR</a></li>
                                        <li><a href="#">AUD</a></li>
                                        <li><a href="#">GBP</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">EN</a>
                                    <ul>
                                        <li><a href="#"><img src="images/icons/flags/french.png" alt="French"> FR</a></li>
                                        <li><a href="#"><img src="images/icons/flags/italian.png" alt="Italian"> IT</a></li>
                                        <li><a href="#"><img src="images/icons/flags/german.png" alt="German"> DE</a></li>
                                    </ul>
                                </li>
                                <li><a href="login">Login</a></li>
                                <li><a href="register">Register</a></li>
                            </ul>
                        </div><!-- .top-links end -->

                    </div>

                </div>

            </div><!-- #top-bar end -->
            @include('layouts.header')
            <!-- Page Title
            ============================================= -->
            <section id="page-title" class="page-title-mini">

                <div class="container clearfix">
                    <h1>@yield('title')</h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo env('BASEURL'); ?>">Home</a></li>
                        <li class="active">@yield('title')</li>
                    </ol>
                </div>

            </section><!-- #page-title end -->
            <!-- Content -->
            <section id="content">
                @yield('content')
            </section>
            <!-- #content end -->
            @include('layouts.footer')
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