@extends('layouts.subuser.master')
@section('title', 'View Inventory')
@section('content')
<div  ng-app="InventoryApp" ng-controller="InventoryController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Inventory</h3>
            
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Inventory = angular.module('InventoryApp', []);
    Inventory.controller('InventoryController', function ($scope, $http) {

    });
</script>
@endsection