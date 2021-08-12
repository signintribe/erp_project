@extends('layouts.admin.creationTier')
@section('title', 'Employees Timing Info')
@section('pagetitle', 'Employees Timing Info')
@section('breadcrumb', 'Employees Timing Info')
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
        $("#employee").addClass('menu-open');
        $("#employee a[href='#']").addClass('active');
        $("#timing-info").addClass('active');
    });
</script>
@endsection