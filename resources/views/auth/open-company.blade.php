@extends('layouts.master')
@section('title', 'Home')
@section('content')
<script src="https://kit.fontawesome.com/1c0b3bb21d.js" crossorigin="anonymous"></script>
<div class="content-wrap nopadding" ng-app="OpenCompanyApp" ng-controller="OpenCompanyController">

    <div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; "></div>

    <div class="section nobg full-screen nopadding nomargin">
        <div class="container vertical-middle divcenter clearfix">
            <div class="panel panel-default divcenter noradius noborder" style="max-width: 1000px;">
                <div class="panel-body" style="padding: 40px;">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <h3>Select your company</h3>
                            <label for="company-name">Type your company name</label>
                            <input type="text" ng-keyup="searchCompany(company_name);" ng-model="company_name" id="company-name" class="form-control" placeholder="Type your company name">
                            <ul ng-if="nomore" style="padding-left:15px;">
                                <li ng-bind="nomore"></li>
                            </ul>
                            <ol ng-if="companies" style="padding-left:15px;">
                                <li style="cursor: pointer" ng-click="getCompanyInformation(company.id)" ng-repeat="company in companies" ng-bind="company.company_name"></li>
                            </ol>
                            <hr>
                            <div class="row" ng-if="mycompany">
                                <div class="col-lg-2 col-md-2 col-sm-2">
                                    <img class="img img-sm img-thumbnail" ng-src="{{asset('public/company_logs/<% mycompany.company_logo %>')}}" alt="">
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <p>
                                        <label for="">Company Name : </label>
                                        <span ng-bind="mycompany.company_name"></span><br/>
                                        <label for="">Established : </label>
                                        <span ng-bind="mycompany.established"></span><br/>
                                        <label for="">Created Since : </label>
                                        <span ng-bind="mycompany.created_at"></span><br/>
                                        <label for="">Address : </label>
                                        <span ng-bind="mycompany.address_line_1"></span>
                                        <span ng-bind="mycompany.sector"></span>
                                        <span ng-bind="mycompany.street"></span>
                                        <span ng-bind="mycompany.city"></span>, 
                                        <span ng-bind="mycompany.country"></span><br/>
                                        <input type="checkbox" name="" id="agree"> <label for="agree">Are you agree to open this company</label>
                                    </p>
                                </div>
                            </div>
                            <div id="loadMore" align="center">
                                <i class="fas fa-spinner fa-lg" style="font-size: 72px; color: #eee;"></i>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
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
                                    <button class="button button-3d button-black nomargin" tabindex="4" id="login-form-submit" name="login-form-submit" value="login">Open</button>
                                    <a class="button button-3d button-red nomargin" tabindex="5" href="<?php echo env('APP_URL'); ?>">Back to home</a>
                                    <!--<a href="register" class="button button-rounded si-facebook si-colored" tabindex="5">Register</a>-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row center"><small>Copyrights &copy; All Rights Reserved by App.</small></div>

        </div>
    </div>

</div>
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
                    $("#loadMore").hide('slow');
                });
            }else{
                $scope.nomore = "Please select company";
            }
        };
    });
</script>