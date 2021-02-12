@extends('layouts.subuser.master')
@section('title', 'View Purchase Order')
@section('content')
<div  ng-app="PurchaseOrderApp" ng-controller="PurchaseOrderController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Purchase Order</h3>
            
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var PurchaseOrder = angular.module('PurchaseOrderApp', []);
    PurchaseOrder.controller('PurchaseOrderController', function ($scope, $http) {

    });
</script>
@endsection