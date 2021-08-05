@extends('layouts.admin.master')
@section('title', 'User Rights and Privileges')
@section('content')
<div ng-app="UserRightsApp" ng-controller="UserRightsController">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-body" ng-init="getEmployees();">
                    <label for="user">Select User</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="user.employee_id">
                        <option value="">Select Employee</option>
                    </select><br/>
                    <label for="password">Old Password</label>
                    <input type="password" name="user.old_password" id="password" class="form-control form-contol-sm" placeholder="Old Password"><br/>
                    <label for="new_password">New Password</label>
                    <input type="password" name="user.new_password" id="new_password" class="form-control form-contol-sm" placeholder="New Password">
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var UserRights = angular.module('UserRightsApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    UserRights.controller('UserRightsController', function ($scope, $http) {
        $scope.getEmployees = function () {
            $http.get('hr/getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };
    });
</script>
@endsection