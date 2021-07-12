@extends('layouts.admin.master')
@section('title', 'Employee JD')
@section('content')
<div  ng-app="JDApp" ng-controller="JDController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee JD's</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
            <div class="row" ng-init="getoffice(0)">
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="company" ng-init="all_companies();">Select Company</label>
                    <select ng-model="jds.company_id" ng-change="getoffice(jds.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="jds.office_id" ng-change="getDepartments(jds.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="jds.department_id" id="department" ng-change="getGroups(jds.department_id)"  ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!jds.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Employee Group</label>
                    <select ng-model="jds.group_id" id="employee-group" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!jds.group_id && showError"><small>Please Select Employee Group</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="jd_name">* JD Name</label>
                    <input type="text" ng-model="jds.jd_name" id="jd_name" class="form-control" placeholder="JD Name">
                    <i class="text-danger" ng-show="!jds.jd_name && showError"><small>Please Type JD Name</small></i>
                </div>
            </div><br>            
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="attachment">Attachment</label>
                    <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);">
                    <img ng-if="jdDoc" ng-src="<% jdDoc %>" class="img-lg rounded" style-="width:100%; height:200px;">
                </div>
                <div class="col">
                    <label for="description">Description</label>
                    <textarea ng-model="jds.description" id="description" class="form-control" cols="30" rows="10" placeholder="Add Description"></textarea>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_jds()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-body">
            <h3 class="card-title">Get All Payscale</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>JD Name</th>
                        <th>Attachment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_jds();">
                    <tr ng-repeat="j in alljds">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="j.company_name"></td>
                        <td ng-bind="j.office_name"></td>
                        <td ng-bind="j.department_name"></td>
                        <td ng-bind="j.jd_name"></td>
                        <td><a href="{{asset('public/employeeJD/<% j.attachment %>')}}" target="_blank" ng-bind="j.attachment"></a></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getoffice(j.company_id); getDepartments(j.office_id); editJD(j.id); getGroups(j.department_id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteJobDescription(j.id)">Delete</button>
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
    var JD = angular.module('JDApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    JD.directive('datepicker', function () {
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


    JD.controller('JDController', function ($scope, $http) {
        $scope.jds = {};
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

        $scope.get_jds = function(){
            $http.get($scope.app_url + 'company/maintain-jds').then(function (response) {
                if(response.data.length > 0){
                    $scope.alljds = response.data;
                }
            });
        }

        $scope.editJD = function(id){
            $http.get($scope.app_url + 'company/maintain-jds/'+ id + '/edit').then(function (response) {
                $scope.jds = response.data[0];
                $scope.jds.company_id = parseInt($scope.jds.company_id);
                $scope.jds.office_id = parseInt($scope.jds.office_id);
                $scope.jds.department_id = parseInt($scope.jds.department_id);
                //$scope.jdDoc = $scope.appurl + "public/employeeJD/" + $scope.jds.attachment;
                $("#ShowPrint").show();
            });
        };


        $scope.save_jds = function () {
            if (!$scope.jds.department_id || !$scope.jds.jd_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.jds, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.app_url + 'company/maintain-jds', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.get_jds();
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.jds = {};
                });
            }
        };

        $scope.deleteJobDescription = function(id){
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
                $http.delete($scope.app_url + 'company/maintain-jds/'+id).then(function (response) {
                    $scope.get_jds();
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