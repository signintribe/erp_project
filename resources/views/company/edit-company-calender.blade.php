@extends('layouts.admin.master')
@section('title', 'Edit Company Calender')
@section('content')
<div  ng-app="EditCalanderApp" ng-controller="EditCalanderController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Company Calendar</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
            <div class="row" ng-init="getoffice(0)">
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="company" ng-init="all_companies();">Select Company</label>
                    <select ng-model="calander.company_id" ng-change="getoffice(calander.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="calander.office_id" ng-change="getDepartments(calander.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="calander.department_id" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!calander.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_name">* Calander Name</label>
                    <input type="text" ng-model="calander.calender_name" id="calander_name" class="form-control" placeholder="Calander Name">
                    <i class="text-danger" ng-show="!calander.calender_name && showError"><small>Please Type Department Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_type">Calander Type</label>
                    <input type="text" ng-model="calander.calender_type" id="calander_type" class="form-control" placeholder="Calander Type">
                </div>
            </div><br>
            <div class="row">                
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fiscal">Fiscal/Financial</label>
                    <input type="text" ng-model="calander.fiscal_financial" id="fiscal" class="form-control" placeholder="Fiscal/Financial">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_year">Calander Year</label>
                    <select ng-model="calander.calender_year" id="calander_year" class="form-control" placeholder="Calander Year">
                        <option value="">Select Year</option>
                        @for ($i = 1970; $i <= 2050; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_start">Calander Start Date</label>
                    <input type="text" ng-model="calander.calender_start_date" datepicker id="calander_start" class="form-control" placeholder="Calander Start">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_end">Calander End Date</label>
                    <input type="text" ng-model="calander.calender_end_date" datepicker id="calander_end" class="form-control" placeholder="Calander End">
                </div>
            </div><br>
            <div class="row">                
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_month">Total Month</label>
                    <input type="text" ng-model="calander.total_month" id="total_month" class="form-control" placeholder="Total Month">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_weeks">Total Weeks</label>
                    <input type="text" ng-model="calander.total_weeks" id="total_weeks" class="form-control" placeholder="Total Weeks">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_days">Total No. of Days</label>
                    <input type="text" ng-model="calander.total_days" id="total_days" class="form-control" placeholder="Total No. of Days">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_days">Working Days in a week</label>
                    <input type="text" ng-model="calander.daysin_week" id="working_days" class="form-control" placeholder="Working Days in a week">
                </div>
            </div><br>
            <div class="row">                
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_hours_days">Working Hours in a day</label>
                    <input type="text" ng-model="calander.daysin_hours" id="working_hours" class="form-control" placeholder="Working Hours in a day">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_hours_week">Working Hours in a week</label>
                    <input type="text" ng-model="calander.daysin_week" id="working_hours_week" class="form-control" placeholder="Working Hours in a week">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_hours_months">Working Hours in a month</label>
                    <input type="text" ng-model="calander.daysin_month" id="working_hours_months" class="form-control" placeholder="Working Hours in a month">
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_calender()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-body">
            <h3 class="card-title">Get All Company Calendars</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Calendar Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_calendars();">
                    <tr ng-repeat="calendar in calendars">
                        <td ng-bind="$index + 1"></td>
                        <td ng-bind="calendar.company_name"></td>
                        <td ng-bind="calendar.office_name"></td>
                        <td ng-bind="calendar.department_name"></td>
                        <td ng-bind="calendar.calender_name"></td>
                        <td ng-bind="calendar.calender_start_date"></td>
                        <td ng-bind="calendar.calender_end_date"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getoffice(calendar.company_id);getDepartments(calendar.office_id);editCalendar(calendar.id);">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteCalendar(calendar.id);">Delete</button>
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
    var OrderList = angular.module('EditCalanderApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    OrderList.directive('datepicker', function () {
        return {
            restrict: 'A',
            require: 'ngModel',
            compile: function () {
                return {
                    pre: function (scope, element, attrs, ngModelCtrl) {
                        var format, dateObj;
                        format = (!attrs.dpFormat) ? 'yyyy-mm-dd' : attrs.dpFormat;
                        if (!attrs.initDate && !attrs.dpFormat) {
                            // If there is no initDate attribute than we will get todays date as the default
                            dateObj = new Date();
//                            scope[attrs.ngModel] = dateObj.getFullYear() + '-' + (dateObj.getMonth() + 1) + '-' + dateObj.getDate();
                        } else if (!attrs.initDate) {
                            // Otherwise set as the init date
                            scope[attrs.ngModel] = attrs.initDate;
                        } else {
                            // I could put some complex logic that changes the order of the date string I
                            // create from the dateObj based on the format, but I'll leave that for now
                            // Or I could switch case and limit the types of formats...
                        }
                        // Initialize the date-picker
                        $(element).datepicker({
                            format: format
                        }).on('changeDate', function (ev) {
                            // To me this looks cleaner than adding $apply(); after everything.
                            scope.$apply(function () {
                                ngModelCtrl.$setViewValue(ev.format(format));
                            });
                        });
                    }
                };
            }
        };
    });

    OrderList.controller('EditCalanderController', function ($scope, $http) {
        $scope.calander = {};
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

        $scope.get_calendars = function(){
            $http.get('maintain-calender').then(function (response) {
                if(response.data.length > 0){
                    $scope.calendars = response.data;
                }
            });
        }

        $scope.editCalendar = function(id){
            $http.get('maintain-calender/'+ id + '/edit').then(function (response) {
                $scope.calander = response.data[0];
                $scope.calander.company_id = parseInt($scope.calander.company_id);
                $scope.calander.office_id = parseInt($scope.calander.office_id);
                $scope.calander.department_id = parseInt($scope.calander.department_id);
                $("#ShowPrint").show();
            });
        }


        $scope.save_calender = function () {
            if (!$scope.calander.department_id || !$scope.calander.calender_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.calander, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-calender', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.get_calendars();
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.calander = {};
                });
            }
        };

        $scope.deleteRegistration = function(id){
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
                $http.delete('registration-company/'+id).then(function (response) {
                    $scope.allcompany_registrations();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
    });
</script>
@endsection