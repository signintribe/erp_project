@extends('layouts.admin.master')
@section('title', 'Employee Gazzeted Holiday')
@section('content')
<div  ng-app="GHApp" ng-controller="GHController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Gazzeted Holiday</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="company" ng-init="all_companies();">Select Company</label>
                    <select ng-model="gh.company_id" ng-change="getoffice(gh.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="gh.office_id" ng-change="getDepartments(gh.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="gh.department_id" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!gh.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="holiday_name">* Holiday Name</label>
                    <input type="text" ng-model="gh.holiday_name" id="holiday_name" class="form-control" placeholder="Holiday Name">
                    <i class="text-danger" ng-show="!gh.holiday_name && showError"><small>Please Type Holiday Name</small></i>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="holiday_event">Holiday Event</label>
                    <input type="text" class="form-control" id="holiday_event" ng-model="gh.holiday_event" placeholder="Holiday Event">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="start_date">Start Date</label>
                    <input type="text" class="form-control" id="start_date" ng-model="gh.start_date" datepicker placeholder="Start Date">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="end_date">End Date</label>
                    <input type="text" class="form-control" id="end_date" ng-model="gh.end_date" datepicker placeholder="End Date">
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_holiday()">Save</button>
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
                        <th>Holiday Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_holiday();">
                    <tr ng-repeat="h in holidays">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="h.company_name"></td>
                        <td ng-bind="h.office_name"></td>
                        <td ng-bind="h.department_name"></td>
                        <td ng-bind="h.holiday_name"></td>
                        <td ng-bind="h.start_date"></td>
                        <td ng-bind="h.end_date"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getoffice(h.company_id); getDepartments(h.office_id); editHoliday(h.id)">Edit</button>
                            <button class="btn btn-xs btn-danger">Delete</button>
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
    var GH = angular.module('GHApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    GH.directive('datepicker', function () {
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


    GH.controller('GHController', function ($scope, $http) {
        $scope.gh = {};
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

        $scope.get_holiday = function(){
            $http.get('maintain-holiday').then(function (response) {
                if(response.data.length > 0){
                    $scope.holidays = response.data;
                }
            });
        }

        $scope.editHoliday = function(id){
            $http.get('maintain-holiday/'+ id + '/edit').then(function (response) {
                $scope.gh = response.data[0];
                $scope.gh.company_id = parseInt($scope.gh.company_id);
                $scope.gh.office_id = parseInt($scope.gh.office_id);
                $scope.gh.department_id = parseInt($scope.gh.department_id);
                $("#ShowPrint").show();
            });
        }


        $scope.save_holiday = function () {
            if (!$scope.gh.department_id || !$scope.gh.holiday_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.gh, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-holiday', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.get_holiday();
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.gh = {};
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