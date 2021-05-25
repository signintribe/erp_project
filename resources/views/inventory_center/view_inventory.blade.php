@extends('layouts.admin.master')
@section('title', 'View Inventory')
@section('content')
<div  ng-app="ViewInventoryApp" ng-controller="ViewInventoryController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Inventory</h3>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Category Id</th>
                            <th>Product Name</th>
                            <th>Vendor Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getInventoryInfo()">
                        <tr ng-repeat="data in inventoryinfo">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="data.category_id" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.product_name" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.vendor_name" style="text-transform: capitalize;"></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="add-inventory/<% data.id %>">Edit</a>
                                <button class="btn btn-xs btn-danger" ng-click="deleteInventoryInfo(data.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Inventory = angular.module('ViewInventoryApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Inventory.controller('ViewInventoryController', function ($scope, $http) {

        $scope.getInventoryInfo = function(){
            $scope.inventoryinfo = {};
            $http.get('get-inventory').then(function (response) {
                if (response.data.length > 0) {
                    $scope.inventoryinfo = response.data;
                }
            });
        };

        $scope.editInventoryInfo = function (id) {
            $http.get('edit-inventory/'+id).then(function (response) {
                $scope.inventory = response.data;
                $scope.getInventoryStock($scope.inventory.id);
                $scope.getInventoryPricing($scope.inventory.id);
                $scope.getInventoryAccount($scope.inventory.id);
                $scope.getInventoryVendor($scope.inventory.id);

            });
        };

        $scope.getInventoryStock = function(id){
            $scope.inventoryinfo = {};
            $http.get('get-stock/'+id).then(function (response) {
                angular.extend($scope.inventory,response.data);
                
            });
        };

        $scope.getInventoryPricing = function(id){
            $scope.inventoryinfo = {};
            $http.get('get-pricing/'+id).then(function (response) {
                angular.extend($scope.inventory,response.data);
                
            });
        };

        $scope.getInventoryAccount = function(id){
            $scope.inventoryinfo = {};
            $http.get('get-account/'+id).then(function (response) {
                angular.extend($scope.inventory, response.data);
                
            });
        };

        $scope.getInventoryVendor = function(id){
            $scope.inventoryinfo = {};
            $http.get('get-vendor/'+id).then(function (response) {
                angular.extend($scope.inventory,response.data);
                
            });
        };

        $scope.deleteInventoryInfo = function (id) {
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('delete-inventory/' + id).then(function (response) {
                    $scope.getInventoryInfo();
                    swal("Deleted!", response.data, "success");
                });
            });
        };;

    });
</script>
@endsection