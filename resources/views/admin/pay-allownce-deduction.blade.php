@extends('layouts.admin.master')
@section('title', 'Employee Pay Allowance and Deduction')
@section('content')
<div  ng-app="PayAllowanceApp" ng-controller="PayAllowanceController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Pay, Allowance and Deduction</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
            <div class="row" ng-init="getoffice(0)">
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="company" ng-init="all_companies();">Select Company</label>
                    <select ng-model="pld.company_id" ng-change="getoffice(pld.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="pld.office_id" ng-change="getDepartments(pld.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department"> Select Department</label>
                    <select ng-model="pld.department_id" id="department" ng-change="getGroups(pld.department_id); get_calendars(pld.department_id); get_shifts(pld.department_id)"  ng-change="get_shifts(pld.department_id); get_calendars(pld.department_id)" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="group_id">* Select Employee Group</label>
                    <select ng-model="pld.group_id" id="employee-group" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!pld.group_id && showError"><small>Please Select Employee Group</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_calendar">Select Calendar</label>
                    <select ng-model="pld.calendar_id" ng-options="calendar.id as calendar.calender_name for calendar in calendars" id="select_calendar" class="form-control">
                        <option value="">Select Calendar</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_calendar">Select Shift</label>
                    <select ng-model="pld.shift_id" ng-options="shift.id as shift.shift_name for shift in shifts" id="select_calendar" class="form-control">
                        <option value="">Select Shift</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="allowance">Allowance</label>
                    <input type="text" class="form-control" id="allowance" ng-model="pld.allowance" placeholder="Leave Rules">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="per_amount">Amount/Percentage</label>
                    <input type="text" class="form-control" id="per_amount" ng-model="pld.per_amount" datepicker placeholder="Amount/Percentage">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="amount">Amount in Rs</label>
                    <input type="text" class="form-control" id="amount" ng-model="pld.amount" datepicker placeholder="Amount in Rs">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pay_frequency">Pay Frequency</label>
                    <input type="text" class="form-control" id="pay_frequency" ng-model="pld.pay_frequency" placeholder="Pay Frequency">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="hourly">Hourly</label>
                    <input type="text" class="form-control" id="hourly" ng-model="pld.hourly" placeholder="Hourly">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="rate">Rate</label>
                    <input type="text" class="form-control" id="rate" ng-model="pld.rate" placeholder="Rate">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="deduction_rule">Deduction Rule</label>
                    <input type="text" class="form-control" id="deduction_rule" ng-model="pld.deduction_rule" placeholder="Deduction Rule">
                </div>
            </div><br>
           <!--  <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="account_id ">Select Chart of Account </label>
                    <input type="text" class="form-control" id="pay_frequency" ng-model="pld.pay_frequency" placeholder="Pay Frequency">
                </div>
            </div><br> -->
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
                        <th>Allowance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_payallowance();">
                    <tr ng-repeat="p in pays">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="p.company_name"></td>
                        <td ng-bind="p.office_name"></td>
                        <td ng-bind="p.department_name"></td>
                        <td ng-bind="p.allowance"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getoffice(p.company_id); getDepartments(p.office_id); getCalendars(p.department_id); getShifts(p.department_id); editpayallowance(p.id); getGroups(p.department_id);">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deletePayAllowance(p.id)">Delete</button>
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
    var PayAllowance = angular.module('PayAllowanceApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    PayAllowance.controller('PayAllowanceController', function ($scope, $http) {
        $scope.pld = {};
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

        $scope.getGroups = function (dep_id) {
            $scope.groups = {};
            $http.get($scope.app_url + 'company/get-groups/' + dep_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.groups = response.data;
                }
            });
        };

       /*  $scope.getCalendar = function (dept_id) {
            $scope.calendars = {};
            $http.get('maintain-calender/'+dept_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.calendars = response.data;
                }
               // $scope.getShift(dept_id);
            });
        }; */

        /* $scope.getShift = function (dept_id) {
            $scope.shifts = {};
            $http.get('maintain-shift/'+dept_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.shifts = response.data;
                }
            });
        }; */

        $scope.get_payallowance = function(){
            $http.get($scope.app_url + 'company/maintain-allowance-deducation').then(function (response) {
                if(response.data.length > 0){
                    $scope.pays = response.data;
                }
            });
        };

        $scope.get_calendars = function(dept_id){
            $http.get($scope.app_url + 'company/get-calendar/' + dept_id).then(function (response) {
                if(response.data.length > 0){
                    $scope.calendars = response.data;
                }
            });
        };

        $scope.get_shifts = function(dept_id){
            $http.get($scope.app_url + 'company/get-shift/' +dept_id).then(function (response) {
                if(response.data.length > 0){
                    $scope.shifts = response.data;
                }
            });
        };

        $scope.getCalendars = function(dept_id){
            $http.get('edit-calendar/' + dept_id).then(function (response) {
                if(response.data.length > 0){
                   angular.extend($scope.pld, response.data);
                }
            });
        };

        $scope.getShifts = function(dept_id){
            $http.get('edit-shift/' + dept_id).then(function (response) {
                if(response.data.length > 0){
                    angular.extend($scope.pld, response.data);
                }
            });
        };

        $scope.editpayallowance = function(id){
            $http.get($scope.app_url + 'company/maintain-allowance-deducation/'+ id + '/edit').then(function (response) {
                $scope.pld = response.data[0];
                $scope.pld.company_id = parseInt($scope.pld.company_id);
                $scope.pld.office_id = parseInt($scope.pld.office_id);
                $scope.pld.department_id = parseInt($scope.pld.department_id);
                $scope.pld.calendar_id = parseInt($scope.pld.calendar_id);
                $scope.pld.shift_id = parseInt($scope.pld.shift_id);
                $("#ShowPrint").show();
            });
        }


        $scope.save_leave = function () {
            if (!$scope.pld.department_id || !$scope.pld.allowance) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.pld, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.app_url + 'company/maintain-allowance-deducation', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.get_payallowance();
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.pld = {};
                });
            }
        };

        $scope.deletePayAllowance = function(id){
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
                $http.delete($scope.app_url + 'company/maintain-allowance-deducation/'+id).then(function (response) {
                    $scope.get_payallowance();
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