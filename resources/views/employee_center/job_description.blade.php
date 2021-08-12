@extends('layouts.admin.creationTier')
@section('title', 'Job Description')
@section('pagetitle', 'Job Description')
@section('breadcrumb', 'Job Description')
@section('content')
<div  ng-app="JobDescriptiontApp" ng-controller="JobDescriptionController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Job Description</h3>
        </div>
        <div class="card-body">
            <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12" ng-init="getEmployees();">
                    <label for="select_employee">* Select Employee</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="jobdescription.employee_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!jobdescription.employee_id && showError"><small>Please Select Employee</small></i>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="daily_task">Daily Task</label>
                    <textarea class="form-control" id="daily_task" rows="5" cols="5" ng-model="jobdescription.daily_task" placeholder="Daily Task"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label class="weekly_task">Weekly Task</label>
                    <textarea class="form-control" id="weekly_task" rows="5" cols="5" ng-model="jobdescription.weekly_task" placeholder="Weekly Task"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label class="monthly_task">Monthly Task</label>
                    <textarea class="form-control" id="monthly_task" rows="5" cols="5" ng-model="jobdescription.monthly_task" placeholder="Monthly Task"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" ng-click="save_jobDescription()" class="btn btn-sm btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee Job Descriptions</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Daily Task</th>
                        <th>Weekly Task</th>
                        <th>Monthly Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getJobDescriptions();">
                    <tr ng-repeat="job in jobdescriptions">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="job.employee_name"></td>
                        <td ng-bind="job.daily_task"></td>
                        <td ng-bind="job.weekly_task"></td>
                        <td ng-bind="job.monthly_task"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editJob(job.id);">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteJob(job.id);">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p ng-if='norecord' ng-bind='norecord'></p>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var JobDescription = angular.module('JobDescriptiontApp', []);
    JobDescription.controller('JobDescriptionController', function ($scope, $http) {
        $("#employee").addClass('menu-open');
        $("#employee a[href='#']").addClass('active');
        $("#employee-jd").addClass('active');
        $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };

        $scope.getJobDescriptions = function () {
            $http.get('maintain-job-description').then(function (response) {
                if (response.data.length > 0) {
                    $scope.jobdescriptions = response.data;
                    $scope.norecord = "";
                }else{
                    $scope.norecord = "There is no record found";
                }
            });
        };

        $scope.editJob = function (id) {
            $http.get('maintain-job-description/'+id+'/edit').then(function (response) {
                $scope.jobdescription = response.data;
            });
        };

        $scope.deleteJob = function (id) {
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
                $http.delete('maintain-job-description/' + id).then(function (response) {
                    $scope.getJobDescriptions();
                    swal("Deleted!", response.data, "success");
                });
            });
        };


        $scope.jobdescription = {};
        $scope.save_jobDescription = function(){
            if (!$scope.jobdescription.employee_id) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.jobdescription, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-job-description', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.jobdescription = {};
                    $scope.getJobDescriptions();
                });
            }
        };

    });
</script>
@endsection