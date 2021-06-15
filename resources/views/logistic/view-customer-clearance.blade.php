@extends('layouts.admin.master')
@section('title', 'View Customer Clearance')
@section('content')
<div  ng-app="ViewCusClearApp" ng-controller="ViewCusClearController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Customer Clearance</h3>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Organization Name</th>
                            <th>NTN</th>
                            <th>Country</th>
                            <th>Mobile Number</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getCusClearanceInfo()">
                        <tr ng-repeat="data in clearance">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="data.organization_name" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.ntn_no" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.country" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.mobile_number" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.city" style="text-transform: capitalize;"></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="edit-cus-clearance/<% data.id %>">Edit</a>
                                <button class="btn btn-xs btn-danger" ng-click="deleteCusClearInfo(data.id)">Delete</button>
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
    var Customer = angular.module('ViewCusClearApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Customer.controller('ViewCusClearController', function ($scope, $http) {
        $scope.getCusClearanceInfo = function(){
            $scope.clearance = {};
            $http.get('save-cus-clearance').then(function (response) {
                if (response.data.length > 0) {
                    $scope.clearance = response.data;
                }
            });
        };

        $scope.deleteCusClearInfo = function (id) {
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
                $http.delete('save-cus-clearance/' + id).then(function (response) {
                    $scope.getCusClearanceInfo();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
    });
</script>
@endsection