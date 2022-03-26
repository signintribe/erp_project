@extends('layouts.admin.newmaster')
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('content')
<div ng-app="AdminDashboardApp" ng-controller="AdminDashboardController">
    
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>

    var AdminDashboard = angular.module('AdminDashboardApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    AdminDashboard.controller('AdminDashboardController', function ($scope, $http) {
        $scope.all_getcustomer = function () {
            $(".loader").html('<div class="square-path-loader"></div>');
            $http.get('all-customers').then(function (response) {
                $scope.Customers = response.data;
                $(".loader").html('');
            });
        };

        $scope.all_queriesinadmin = function () {
            $(".loaderQ").html('<div class="square-path-loader"></div>');
            $http.get('all-queriesinadmin').then(function (response) {
                $scope.AQuery = response.data;
                $(".loaderQ").html('');
            });
        };

        $scope.all_queriesstatusinadmin = function () {
            $(".loaderS").html('<div class="square-path-loader"></div>');
            $http.get('all-queriesstatusinadmin').then(function (response) {
                $scope.SQuery = response.data;
                $(".loaderS").html('');
            });
        };

        $scope.all_companiesinadmin = function () {
            $(".loaderC").html('<div class="square-path-loader"></div>');
            $http.get('all-companiesinadmin').then(function (response) {
                $scope.Companies = response.data;
                $(".loaderC").html('');
            });
        };

        $scope.all_complaints = function () {
            $(".loader").html('<div class="square-path-loader"></div>');
            $http.get('get-all-complaints').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Complaints = response.data;
                    $(".loader").html('');
                }
            });
        };

        $scope.all_totalrevenue = function () {
            $(".loaderR").html('<div class="square-path-loader"></div>');
            $http.get('get-all-totalrevenue').then(function (response) {
                $scope.Revenue = response.data[0];
                $(".loaderR").html('');
            });
        };
    });
</script>
@endsection