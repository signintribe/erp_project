@extends('layouts.admin.master')
@section('title', 'Employee Yearly Leaves')
@section('content')
<div  ng-app="YearlyLeaveApp" ng-controller="YearlyLeaveController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Yearly Leaves</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
            <div class="row" ng-init="getoffice(0)">
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="company" ng-init="all_companies();">Select Company</label>
                    <select ng-model="yl.company_id" ng-change="getoffice(yl.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="yl.office_id" ng-change="getDepartments(yl.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="yl.department_id" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!yl.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_type">* Leave Type</label>
                    <select ng-model="yl.leave_type" id="leave_type" class="form-control">
                        <option value="">Select Leave Type</option>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Short Leave">Short Leave</option>
                        <option value="Casual Leave">Casual Leave</option>
                    </select>
                    <i class="text-danger" ng-show="!yl.leave_type && showError"><small>Please Type Leave Type</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_leave">Total Leave</label>
                    <input type="text" class="form-control" id="total_leave" ng-model="yl.total_leave" placeholder="Total Leave">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_rules">Leave Rules</label>
                    <input type="text" class="form-control" id="leave_rules" ng-model="yl.leave_rules" placeholder="Leave Rules">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_deduction">Leave Deduction</label>
                    <input type="text" class="form-control" id="leave_deduction" ng-model="yl.leave_deduction" datepicker placeholder="Leave Deduction">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_rate">Leave Rate</label>
                    <input type="text" class="form-control" id="leave_rate" ng-model="yl.leave_rate" datepicker placeholder="Leave Rate">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="lapsed">Does Leave Lapsed/C.F</label>
                    <input type="text" class="form-control" id="lapsed" ng-model="yl.lapsed" placeholder="Does Leave Lapsed/C.F">
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_leave()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-body">
            <h3 class="card-title">Get All Gazzeted Holiday</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Leave Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_leaves();">
                    <tr ng-repeat="l in leaves">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="l.company_name"></td>
                        <td ng-bind="l.office_name"></td>
                        <td ng-bind="l.department_name"></td>
                        <td ng-bind="l.leave_type"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getoffice(l.company_id); getDepartments(l.office_id); editLeaves(l.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteYearlyLeave(l.id)">Delete</button>
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
    var YearlyLeave = angular.module('YearlyLeaveApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    YearlyLeave.controller('YearlyLeaveController', function ($scope, $http) {
        $scope.yl = {};
        $scope.app_url = $("#appurl").val();
        $scope.all_companies = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };


        $scope.getoffice = function (company_id) {
            $scope.offices = {};
            $http.get('getoffice/'+company_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.offices = response.data;
                }
            });
        };
        
        $scope.getDepartments = function (office_id) {
            $scope.departments = {};
            $http.get('get-departments/'+office_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.departments = response.data;
                }
            });
        };

        $scope.get_leaves = function(){
            $http.get('maintain-leaves').then(function (response) {
                if(response.data.length > 0){
                    $scope.leaves = response.data;
                }
            });
        }

        $scope.editLeaves = function(id){
            $http.get('maintain-leaves/'+ id + '/edit').then(function (response) {
                $scope.yl = response.data[0];
                $scope.yl.company_id = parseInt($scope.yl.company_id);
                $scope.yl.office_id = parseInt($scope.yl.office_id);
                $scope.yl.department_id = parseInt($scope.yl.department_id);
                $("#ShowPrint").show();
            });
        }


        $scope.save_leave = function () {
            if (!$scope.yl.department_id || !$scope.yl.leave_type) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.yl, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-leaves', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.get_leaves();
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.yl = {};
                });
            }
        };

        $scope.deleteYearlyLeave = function(id){
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
                $http.delete('maintain-leaves/'+id).then(function (response) {
                    $scope.get_leaves();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.jdDoc = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.jds.jdDoc = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };
    });
</script>
@endsection