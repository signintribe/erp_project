@extends('layouts.admin.master')
@section('title', 'Educational Detail')
@section('content')
<div  ng-app="EducationApp" ng-controller="EducationController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Educational Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <label for="select_employee">Select Employee</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="education.employee_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!education.employee_id && showError"><small>Please Select Employee</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="qualification_name">Qualification Name</label>
                    <input type="text" class="form-control" id="qualification_name" ng-model="education.qualification_name" placeholder="Qualification Name"/>
                    <i class="text-danger" ng-show="!education.qualification_name && showError"><small>Please Type Qualification</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="passing_year">Passing Year</label>
                    <select class="form-control" id="passing_year" ng-model="education.passing_year">
                        <option value="">Passing Year</option>
                        <?php for($i = 1990; $i<=2050; $i++){ ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                    <i class="text-danger" ng-show="!education.passing_year && showError"><small>Please Select Passing Year</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="subject">Specialization/Subjects</label>
                    <input type="text" class="form-control" id="subject" ng-model="education.subject" placeholder="Specialization/Subjects"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="institute">Institute / Board</label>
                    <input type="text" class="form-control" id="institute" ng-model="education.institute" placeholder="Institute/Board"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_marks">Total Marks</label>
                    <input type="number" class="form-control" id="total_marks" ng-model="education.total_marks" placeholder="Total Marks"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="obtain_marks">Obtain Marks</label>
                    <input type="number" class="form-control" id="obtain_marks" ng-model="education.obtain_marks" placeholder="Obtain Marks">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="grade">Grade</label>
                    <input type="text" class="form-control" id="grade" ng-model="education.grade" placeholder="Grade"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="division">Division</label>
                    <input type="text" class="form-control" id="division" ng-model="education.division" placeholder="Division"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="distinction">Distinction</label>
                    <input type="text" class="form-control" id="distinction" ng-model="education.distinction" placeholder="Distinction"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/spouse-detail')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="mdi mdi-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_education()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save"></i>
                        </button>
                        <a href="{{url('hr/certification-detail')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Education</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Qualification</th>
                        <th>Passing Year</th>
                        <th>Specilization</th>
                        <th>Institute/Board</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getEducation()">
                    <tr ng-repeat="e in Educations">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="e.employee_name"></td>
                        <td ng-bind="e.qualification_name"></td>
                        <td ng-bind="e.passing_year"></td>
                        <td ng-bind="e.subject"></td>
                        <td ng-bind="e.institute"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editEducation(e.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteEducation(e.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Education = angular.module('EducationApp', []);
    Education.controller('EducationController', function ($scope, $http) {
        $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };

        $scope.getEducation = function () {
            $http.get('maintain-employee-education').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Educations = response.data;
                }
            });
        };

        $scope.editEducation = function (id) {
            $http.get('maintain-employee-education/' + id + '/edit').then(function (response) {
                $scope.education = response.data;
                $scope.education.passing_year = String($scope.education.passing_year);
            });
        };

        $scope.deleteEducation = function (id) {
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
                $http.delete('maintain-employee-education/' + id).then(function (response) {
                    $scope.getEducation();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.education = {};
        $scope.save_education = function(){
            if (!$scope.education.employee_id || !$scope.education.qualification_name || !$scope.education.passing_year) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.education, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-employee-education', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.education = {};
                    $scope.getEducation();
                });
            }
        };
    });
</script>
@endsection