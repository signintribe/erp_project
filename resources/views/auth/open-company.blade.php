@extends('layouts.master')
@section('title', 'Open an Existing Company')
@section('content')
<script src="https://kit.fontawesome.com/1c0b3bb21d.js" crossorigin="anonymous"></script>
<div class="content-wrap nopadding">
        <!-- Slider
============================================= -->
<section id="slider" class="slider-parallax full-screen" ng-app="OpenCompanyApp" ng-controller="OpenCompanyController">

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
        <div class="vertical-middle" data-loader="button">
            <div class="col-padding">
                <div class="heading-block nobottomborder bottommargin-sm">
                    <h1 style="line-height: 1.4;font-size: 24px;">Login to your Account</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="company-name">Type your company name</label>
                        <input type="text" ng-keyup="searchCompany(company_name);" ng-model="company_name" id="company-name" class="form-control" placeholder="Type your company name">
                        <ul ng-if="nomore" style="padding-left:15px;">
                            <li ng-bind="nomore"></li>
                        </ul>
                        <ol ng-if="companies" style="padding-left:15px;">
                            <li style="cursor: pointer" ng-click="getCompanyInformation(company.id)" ng-repeat="company in companies" ng-bind="company.company_name"></li>
                        </ol>
                        <div class="row" ng-if="mycompany">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p>
                                    <label for="">Company Name : </label>
                                    <span ng-bind="mycompany.company_name"></span><br/>
                                    <label for="">Created Since : </label>
                                    <span ng-bind="mycompany.created_at"></span>
                                </p>
                            </div>
                        </div>
                        <div id="loadMore" align="center">
                            <i class="fas fa-spinner fa-lg" style="font-size: 20px; color: #eee;"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
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
                            <input type="hidden" class="form-control" id="company_id" name="company_id" require>
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
                                <button class="button button-3d button-black nomargin" tabindex="4" id="login-form-submit" name="login-form-submit" value="login">Open</button>
                                <a class="button button-3d button-red nomargin" tabindex="5" href="<?php echo env('APP_URL'); ?>">Back to home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <a href="#" data-scrollto="#section-about" data-easing="easeInOutExpo" data-speed="1250" data-offset="65" class="one-page-arrow"><i class="icon-angle-down infinite animated fadeInDown"></i></a> -->
    </div>

</div>

</section>
@stop
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var OpenCompany = angular.module('OpenCompanyApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    OpenCompany.controller('OpenCompanyController', function ($scope, $http) {
        $scope.searchCompany = function(company_name){
            $scope.nomore = "";
            $scope.companies = {};
            if(company_name){
                $http.get( 'search-companies/' + company_name).then(function (response) {
                    $("#loadMore i").addClass('fa-pulse');
                    if(response.data.length > 0){
                        $scope.companies = response.data;
                        $("#loadMore i").removeClass('fa-pulse');
                    }else{
                        $scope.nomore = "There is no more data";
                        $("#loadMore i").removeClass('fa-pulse');
                    }
                });
            }else{
                $scope.nomore = "Please type company name";
            }
        };

        $scope.getCompanyInformation = function(company_id){
            if(company_id){
                $("#loadMore i").addClass('fa-pulse');
                $scope.mycompany = {};
                $http.get( 'get-mycompany/' + company_id).then(function (response) {
                    $scope.mycompany = response.data[0];
                    $("#company_id").val($scope.mycompany.id);
                    $("#loadMore").hide('slow');
                    $scope.companies = {};
                });
            }else{
                $scope.nomore = "Please select company";
            }
        };
    });
</script>