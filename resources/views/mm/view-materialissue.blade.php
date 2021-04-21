@extends('layouts.admin.master')
@section('title', 'View Material Issuance')
@section('content')
<div  ng-app="MaterialissuanceApp" ng-controller="MaterialissuanceController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Material Issuance</h3>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Materialissuance = angular.module('MaterialissuanceApp', []);
    Materialissuance.controller('MaterialissuanceController', function ($scope, $http) {

    });
</script>
@endsection