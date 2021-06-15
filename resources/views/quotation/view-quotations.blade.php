@extends('layouts.admin.master')
@section('title', 'View Quotations')
@section('content')
<div  ng-app="QuotationApp" ng-controller="QuotationController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Quotation</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Vendor Name</th>
                            <th>Item Name</th>
                            <th>Status</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getQuotationInformation()">
                        <tr ng-repeat="quotation in quotationinformations">
                            <td ng-bind="$index+1"></td>                                        
                            <td ng-bind="quotation.company_name"></td>
                            <td ng-bind="quotation.item_name"></td>
                            <td>
                                <span ng-if="quotation.shipment_status == 0">Pending</span>
                                <span ng-if="quotation.shipment_status == 1">Shipped</span>
                                <span ng-if="quotation.shipment_status == 2">Dropped</span>
                            </td>
                            <td ng-bind="quotation.address"></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-info" href="edit-quotation/<% quotation.id %>">Edit</a>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteQuotationInformation(quotation.id)">Delete</button>                                         
                                </div>
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
    var Quotation = angular.module('QuotationApp', []);
    Quotation.controller('QuotationController', function ($scope, $http) {
        $scope.getQuotationInformation = function () {
            $scope.quotationinformations = {};
            $http.get('get-quotation-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.quotationinformations = response.data;
                }
            });
        };

        
        $scope.deleteQuotationInformation = function (id) {
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
                $http.delete('delete-quotation-information/' + id).then(function (response) {
                    $scope.getQuotationInformation();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
    });
</script>
@endsection