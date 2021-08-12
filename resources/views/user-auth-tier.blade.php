@extends('layouts.admin.userAuthTier')
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('content')
<div ng-app="AdminDashboardApp" ng-controller="AdminDashboardController">
    
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var AdminDashboard = angular.module('AdminDashboardApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    AdminDashboard.controller('AdminDashboardController', function ($scope, $http) {

    });
</script>
@endsection