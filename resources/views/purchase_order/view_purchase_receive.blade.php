@extends('layouts.admin.master')
@section('title', 'View Purchase Receive')
@section('content')
<div  ng-app="PurchaseReceiveApp" ng-controller="PurchaseReceiveController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Purchase Receive</h3>
            
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var PurchaseReceive = angular.module('PurchaseReceiveApp', []);
    PurchaseReceive.controller('PurchaseReceiveController', function ($scope, $http) {

    });
</script>
@endsection