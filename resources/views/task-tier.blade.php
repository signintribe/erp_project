@extends('layouts.admin.taskTier')
@section('title', 'Dashboard')
@section('pagetitle', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('content')
<div ng-controller="AdminDashboardController">
    
</div>
@endsection
@section('internaljs')
<script>
    TaskTierApp.controller('AdminDashboardController', function ($scope, $http) {

    });
</script>
@endsection