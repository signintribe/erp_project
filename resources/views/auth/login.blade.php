@extends('layouts.master')
@section('title', 'Home')
@section('content')
<div class="content-wrap nopadding">

    <div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #444;"></div>

    <div class="section nobg full-screen nopadding nomargin">
        <div class="container vertical-middle divcenter clearfix">

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
                            <!--<a href="register" class="button button-rounded si-facebook si-colored" tabindex="5">Register</a>-->
                        </div>
                    </form>
                </div>
            </div>

            <div class="row center dark"><small>Copyrights &copy; All Rights Reserved by App.</small></div>

        </div>
    </div>

</div>
@stop