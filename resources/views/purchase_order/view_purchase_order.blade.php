@extends('layouts.admin.master')
@section('title', 'View Purchase Order')
@section('content')
<div  ng-app="PurchaseOrderApp" ng-controller="PurchaseOrderController" ng-cloak>
<div class="card">
        <div class="card-body">
            <h3 class="card-title">View Inventory</h3>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>PO-Id</th>
                            <th>PO Date</th>
                            <th>Mobile Number</th>
                            <th>PO Status</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getPurchaseOrder()">
                        <tr ng-repeat="data in poinfo">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="data.id"></td>
                            <td ng-bind="data.po_date"></td>
                            <td ng-bind="data.mobile_number" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.po_status" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.quantity" style="text-transform: capitalize;"></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="edit-purchase-order/<% data.id %>">Edit</a>
                                <button class="btn btn-xs btn-danger" ng-click="deletePurchaseOrder(data.id)">Delete</button>
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
    var PurchaseOrder = angular.module('PurchaseOrderApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    PurchaseOrder.controller('PurchaseOrderController', function ($scope, $http) {

        $scope.getPurchaseOrder = function(){
            $scope.poinfo = {};
            $http.get('get-purchase-order-info').then(function (response) {
                if (response.data.length > 0) {
                    $scope.poinfo = response.data;
                }
            });
        };

        $scope.deletePurchaseOrder = function (id) {
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
                $http.delete('delete-purchase-order/' + id).then(function (response) {
                    $scope.getPurchaseOrder();
                    swal("Deleted!", response.data, "success");
                });
            });
        };;
    });
</script>
@endsection