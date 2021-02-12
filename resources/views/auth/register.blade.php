@extends('layouts.master')
@section('title', 'Register')
@section('content')
<div class="content-wrap">

    <div class="container clearfix">
        <div class="panel panel-default divcenter noradius noborder" style="max-width: 400px; background-color: #ecf0f1;">
            <div class="panel-body" style="padding: 40px;">
                <h3 class="card-header">{{ __('Register') }}</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" autofocus class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit"  class="btn btn-md btn-primary">
                                {{ __('Register') }}
                            </button>                    
                        </div>
                        <div class="col-md-6">
                            <a href="<?php echo env('BASEURL') ?>" class="btn btn-md btn-info pull-right">Already Account</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
