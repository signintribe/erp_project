@extends('layouts.admin.creationTier')
@section('title', 'Gazzeted Holidaies')
@section('pagetitle', 'Gazzeted Holidaies')
@section('breadcrumb', 'Gazzeted Holidaies')
@section('content')
<div  ng-app="GHApp" ng-controller="GHController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Gazzeted Holiday</h3>
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
                    <select ng-model="gh.company_id" ng-change="getoffice(gh.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="gh.office_id" ng-change="getDepartments(gh.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="gh.department_id" id="department" ng-change="getGroups(gh.department_id)" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!gh.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="group_id">* Select Employee Group</label>
                    <select ng-model="gh.group_id" id="employee-group" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!gh.group_id && showError"><small>Please Select Employee Group</small></i>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="holiday_name">* Holiday Name</label>
                    <input type="text" ng-model="gh.holiday_name" id="holiday_name" class="form-control" placeholder="Holiday Name">
                    <i class="text-danger" ng-show="!gh.holiday_name && showError"><small>Please Type Holiday Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="holiday_event">Holiday Event</label>
                    <input type="text" class="form-control" id="holiday_event" ng-model="gh.holiday_event" placeholder="Holiday Event">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="start_date">Start Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="start_date" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="gh.start_date" class="form-control datetimepicker-input" data-target="#start_date"/>
                            <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="end_date">End Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="end_date" data-target-input="nearest">
                            <input type="text" placeholder="End Date" ng-model="gh.end_date" class="form-control datetimepicker-input" data-target="#end_date"/>
                            <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_holiday()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Get All Gazzeted Holiday</h3>
        </div>
        <div class="card-body">
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
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="getoffice(h.company_id); getDepartments(h.office_id); editHoliday(h.id); getGroups(h.department_id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteGazHoliday(h.id)">Delete</button>
                            </div>
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

    GH.controller('GHController', function ($scope, $http) {
        $("#company").addClass('menu-open');
        $("#company a[href='#']").addClass('active');
        $("#gazzeted-holiday").addClass('active');
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
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

        $scope.getGroups = function (dep_id) {
            $scope.groups = {};
            $http.get('get-groups/' + dep_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.groups = response.data;
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
                $scope.gh.start_date = $('#start_date input').val();
                $scope.gh.end_date = $('#end_date input').val();
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
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
                    $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                    $scope.gh = {};
                });
            }
        };

        $scope.deleteGazHoliday = function(id){
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
                $http.delete('maintain-holiday/'+id).then(function (response) {
                    $scope.get_holiday();
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