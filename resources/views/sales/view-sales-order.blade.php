@extends('layouts.subuser.master')
@section('title', 'View Sales Orders')
@section('content')
<div  ng-app="SalesOrderApp" ng-controller="SalesOrderController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Sales Orders</h3>
            
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var SalesOrder = angular.module('SalesOrderApp', []);
    SalesOrder.controller('SalesOrderController', function ($scope, $http) {

    });
</script>
@endsection