@extends('layouts.master')
@section('title', 'Home')
@section('content')
<div class="content-wrap nopadding">
        <!-- Slider
============================================= -->
<section id="slider" class="slider-parallax full-screen">

<div class="slider-parallax-inner">

    <div class="col-md-7 col-sm-6 hidden-xs full-screen center nopadding" style="background: url('public/erpimg.jpg') center center no-repeat; background-size: cover;">
        <div class="vertical-middle dark center clearfix" style="z-index: 2;">

            <div class="emphasis-title nobottommargin">
                <h1>
                    <span class="text-rotater nocolor" data-separator="|" data-rotate="fadeIn" data-speed="6000">
                        <span class="t-rotate t700 font-body opm-medium-word">Enterprise Resource Planning|Company Management|Finance & Reports Management|Human Resource Management|Inventory Management|Sales & Purchase Management|Vendor & Customer Management</span>
                    </span>
                </h1>
            </div>

        </div>
        <div class="video-wrap" style="position: absolute; z-index:1; height:100%;">
            <div class="video-overlay" style="background-color: rgba(0,0,0,0.2);"></div>
        </div>
    </div>

    <div class="col-md-5 col-sm-6 full-screen" style="background-color: #F5F5F5;">
        <div class="vertical-middle subscribe-widget" data-loader="button">
            <div class="col-padding">
                <div class="heading-block nobottomborder bottommargin-sm">
                    <h1 style="line-height: 1.4;font-size: 24px;">Welcome to ERP</h1>
                    <span style="font-size:16px; top-margin: 20px;" class="t300 hidden-xs">
                        From below buttons you can create new or open existing company. 
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <a href="register" data-animate="tada" class="button button-3d button-teal button-small nobottommargin">
                            <i class="icon-building"></i> Create new company
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <a href="open-existing-company" data-animate="tada" class="button button-3d button-red button-small nobottommargin">
                            <i class="icon-signin"></i> Open existing company
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <a href="#" data-scrollto="#section-about" data-easing="easeInOutExpo" data-speed="1250" data-offset="65" class="one-page-arrow"><i class="icon-angle-down infinite animated fadeInDown"></i></a> -->
    </div>

</div>

</section>
<!-- #slider end -->
            <!-- <div class="container vertical-middle divcenter clearfix">

                <div class="row center">
                    <a href="#"></a>
                </div>

                <div class="panel panel-default divcenter noradius noborder" style="max-width: 400px;">
                    <div class="panel-body" style="padding: 40px;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h3>Login to your Account</h3>

                            @error('status')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <div class="col_full">
                                <label for="login-form-username">Username:</label>
                                <input id="email" type="email" tabindex="1" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col_full">
                                <label for="login-form-password">Password:</label>
                                <a href="#" class="fright" tabindex="3">Forgot Password?</a>
                                <input id="password" type="password" tabindex="2" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col_full nobottommargin">
                                <button class="button button-3d button-black nomargin" tabindex="4" id="login-form-submit" name="login-form-submit" value="login">Login</button>
                                <a href="register" class="button button-rounded si-facebook si-colored" tabindex="5">Register</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row center dark"><small>Copyrights &copy; All Rights Reserved by App.</small></div>

            </div> -->
        </div>

    </div>
</div>
@stop

<script>
    
</script>