@extends('layouts.admin.master')
@section('title', 'View Freight Forward Det')
@section('content')
<div  ng-app="LogisticsApp" ng-controller="LogisticsController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Freight Forward Det</h3>
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
                    <tbody ng-init="getFFDetInfo()">
                        <tr ng-repeat="data in freight">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="data.organization_name" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.strn" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.country" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.mobile_number" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.city" style="text-transform: capitalize;"></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="edit-ff-det/<% data.id %>">Edit</a>
                                <button class="btn btn-xs btn-danger" ng-click="deleteFFDetInfo(data.id)">Delete</button>
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
    var Logistics = angular.module('LogisticsApp', []);
    Logistics.controller('LogisticsController', function ($scope, $http) {
        $scope.getFFDetInfo = function(){
            $scope.freight = {};
            $http.get('save-freightforward-det').then(function (response) {
                if (response.data.length > 0) {
                    $scope.freight = response.data;
                }
            });
        };
    });
</script>
@endsection