@extends('layouts.admin.creationTier')
@section('title', 'Creation Tier')
@section('pagetitle', 'Creation Tier')
@section('breadcrumb', 'Creation Tier')
@section('content')
<div ng-controller="CreationDashboardController">
    
</div>
@endsection
@section('internaljs')
<script>
    CreateTierApp.controller('CreationDashboardController', function ($scope, $http) {
        
    });
</script>
@endsection