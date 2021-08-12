@extends('layouts.admin.creationTier')
@section('title', 'View Logistics')
@section('pagetitle', 'View Logistics')
@section('breadcrumb', 'View Logistics')
@section('content')
<div  ng-app="viewLogisticsApp" ng-controller="viewLogisticsController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">View Logistic Info</h3>
        </div>
        <div class="card-body">
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Logistic Type</th>
                            <th>Organization Name</th>
                            <th>NTN</th>
                            <th>Country</th>
                            <th>Mobile Number</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getLogisticInfo()">
                        <tr ng-repeat="data in logisticsInfo">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="data.logistic_type"></td>
                            <td ng-bind="data.organization_name" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.ntn_no" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.country" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.mobile_number" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.city" style="text-transform: capitalize;"></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="edit-logistic/<% data.id %>">Edit</a>
                                <button class="btn btn-xs btn-danger" ng-click="deleteLogisticInfo(data.id)">Delete</button>
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
    var viewLogistics = angular.module('viewLogisticsApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    viewLogistics.controller('viewLogisticsController', function ($scope, $http) {
        $("#sourcing").addClass('menu-open');
        $("#sourcing a[href='#']").addClass('active');
        $("#view-logistics").addClass('active');
        $scope.getLogisticInfo = function(){
            $scope.logisticsInfo = {};
            $http.get('get-logistics').then(function (response) {
                if (response.data.length > 0) {
                    $scope.logisticsInfo = response.data;
                }
            });
        };

        $scope.deleteLogisticInfo = function (id) {
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
                $http.delete('delete-logistic/' + id).then(function (response) {
                    $scope.getLogisticInfo();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
    });
</script>
@endsection