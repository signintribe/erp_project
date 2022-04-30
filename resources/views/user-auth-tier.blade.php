@extends('layouts.admin.userAuthTier')
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('content')
<div ng-controller="AdminDashboardController">
    
</div>
@endsection
@section('internaljs')
<script>
    UserAuthTierApp.controller('AdminDashboardController', function ($scope, $http) {

    });
</script>
@endsection