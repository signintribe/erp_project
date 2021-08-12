@extends('layouts.admin.creationTier')
@section('title', 'Company Group')
@section('pagetitle', 'Company Group')
@section('breadcrumb', 'Company Group')
@section('content')
<div  ng-app="GroupApp" ng-controller="GroupController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Group</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row" ng-init="getoffice(0)">
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="company" ng-init="all_companies();">Select Company</label>
                    <select ng-model="group.company_id" ng-change="getoffice(group.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="group.office_id" ng-change="getDepartments(group.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="group.department_id" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!group.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="group_name">* Group Name</label>
                    <input type="text" ng-model="group.group_name" id="group_name" class="form-control" placeholder="Group Name">
                    <i class="text-danger" ng-show="!group.group_name && showError"><small>Please Type Group Name</small></i>
                </div>
            </div><br><!-- 
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="group_category">* Group Category</label>
                    <select ng-model="group.group_category" id="group_category" class="form-control">
                        <option value="">Group Category</option>
                    </select>
                </div>
            </div><br> -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="group_scope">Scope of Group</label>
                    <textarea ng-model="group.scope_group" id="group_scope" cols="30" rows="10" class="form-control" placeholder="Scope of Group"></textarea>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_group()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Get All Shifts</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Group Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_groups();">
                    <tr ng-repeat="g in allgroups">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="g.company_name"></td>
                        <td ng-bind="g.office_name"></td>
                        <td ng-bind="g.department_name"></td>
                        <td ng-bind="g.group_name"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getoffice(g.company_id); getDepartments(g.office_id); editGroup(g.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteEmployeeGroup(g.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo env('APP_URL'); ?>" id="appurl">
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Shifts = angular.module('GroupApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    Shifts.controller('GroupController', function ($scope, $http) {
        $("#company").addClass('menu-open');
        $("#company a[href='#']").addClass('active');
        $("#company-group").addClass('active');
        $scope.group = {};
        $scope.app_url = $("#appurl").val();
        $scope.all_companies = function () {
            $http.get($scope.app_url + 'company/getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };


        $scope.getoffice = function (company_id) {
            $scope.offices = {};
            $http.get($scope.app_url + 'company/getoffice/'+company_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.offices = response.data;
                }
            });
        };
        
        $scope.getDepartments = function (office_id) {
            $scope.departments = {};
            $http.get($scope.app_url + 'company/get-departments/'+office_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.departments = response.data;
                }
            });
        };

        $scope.get_groups = function(){
            $http.get($scope.app_url + 'company/maintain-group').then(function (response) {
                if(response.data.length > 0){
                    $scope.allgroups = response.data;
                }
            });
        }

        $scope.editGroup = function(id){
            $http.get($scope.app_url + 'company/maintain-group/'+ id + '/edit').then(function (response) {
                $scope.group = response.data[0];
                $scope.group.company_id = parseInt($scope.group.company_id);
                $scope.group.office_id = parseInt($scope.group.office_id);
                $scope.group.department_id = parseInt($scope.group.department_id);
                $("#ShowPrint").show();
            });
        }


        $scope.save_group = function () {
            if (!$scope.group.department_id || !$scope.group.group_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.group, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.app_url + 'company/maintain-group', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.get_groups();
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.group = {};
                    $scope.get_groups();
                });
            }
        };

        $scope.deleteEmployeeGroup = function(id){
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
                $http.delete($scope.app_url + 'company/maintain-group/'+id).then(function (response) {
                    $scope.get_groups();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
    });
</script>
@endsection