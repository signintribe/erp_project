@extends('layouts.admin.master')
@section('title', 'Departments')
@section('content')
<div  ng-app="DepartmentsApp" ng-controller="DepartmentsController" ng-cloak>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-body" ng-init="get_companyinfo()">
                    <h3 class="card-title">Add Department</h3>
                    <label for="company">Select Company</label>
                    <select ng-model="dept.company_id" ng-options="company.id as company.company_name for company in companies" class="form-control" id="company">
                        <option value="">Select Company</option>
                    </select>
                    <i class="text-danger" ng-show="!dept.company_id && showError"><small>Please Select Company</small></i><br/>
                    <label for="department_name">Department Name</label>
                    <input type="text" id="department_name" ng-model="dept.department_name" class="form-control" placeholder="Department Name"/>
                    <i class="text-danger" ng-show="!dept.department_name && showError"><small>Please Type Department Name</small></i><br/> 
                    <label for="description">Description</label>
                    <textarea id="description" ng-model="dept.description" class="form-control" placeholder="Description" cols="5" rows="5"></textarea><br/> 
                    <button type="button" class="btn btn-sm btn-success" ng-click="save_department()"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-body" ng-init="get_departments();">
                    <h3 class="card-title">All Departments</h3>
                    <table class="table table-bordered table-sm" style="font-size: 12px;">
                        <tr>
                            <th>Sr#</th>
                            <th>Company Name</th>
                            <th>Department Name</th>
                            <th>Action</th>
                        </tr>
                        <tr ng-repeat="dept in departments">
                            <td ng-bind="$index + 1"></td>
                            <td ng-bind="dept.company_name"></td>
                            <td ng-bind="dept.department_name"></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>
    var Departments = angular.module('DepartmentsApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Departments.controller('DepartmentsController', function ($scope, $http) {
        $scope.get_companyinfo = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };
        
        $scope.get_departments = function () {
            $http.get('getdepartments').then(function (response) {
                if (response.data.length > 0) {
                    $scope.departments = response.data;
                }
            });
        };
        
        $scope.dept = {};
        $scope.save_department = function () {
            if (!$scope.dept.company_id || !$scope.dept.department_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.dept, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('SaveDepartment', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.dept = {};
                });
            }
        };

    });
</script>
@endsection