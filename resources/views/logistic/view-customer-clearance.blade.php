@extends('layouts.admin.master')
@section('title', 'View Customer Clearance')
@section('content')
<div  ng-app="LogisticsApp" ng-controller="LogisticsController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Customer Clearance</h3>
            
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Logistics = angular.module('LogisticsApp', []);
    Logistics.controller('LogisticsController', function ($scope, $http) {

    });
</script>
@endsection