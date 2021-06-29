@extends('layouts.admin.master')
@section('title', 'Certification/Training Detail')
@section('content')
<div  ng-app="CertificationApp" ng-controller="CertificationController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Certification/Training Detail (If any)</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <label for="select_employee">* Select Employee</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="education.employee_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!education.employee_id && showError"><small>Please Select Employee</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="certification_name">*Certification Name</label>
                    <input type="text" class="form-control" id="certification_name" ng-model="education.certification_name" placeholder="Certification Name"/>
                    <i class="text-danger" ng-show="!education.certification_name && showError"><small>Please Type Certification Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="start_date">Start Date</label>
                    <input type="text" class="form-control" id="start_date" datepicker ng-model="education.start_date" placeholder="Start Date"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="end_date">End Date</label>
                    <input type="text" class="form-control" id="end_date" datepicker ng-model="education.end_date" placeholder="End Date"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_type">Training Type</label>
                    <input type="text" class="form-control" id="training_type" ng-model="education.training_type" placeholder="Training Type"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_institute">Training Institute</label>
                    <input type="text" class="form-control" id="training_institute" ng-model="education.training_institute" placeholder="Training Institute"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_venue">Training Venue</label>
                    <input type="text" class="form-control" id="training_venue" ng-model="education.training_venue" placeholder="Training Venue"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_referred_by">Training Referred by</label>
                    <input type="text" class="form-control" id="training_referred_by" ng-model="education.training_referred_by" placeholder="Training Referred by"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="subjects">Subjects</label>
                    <input type="text" class="form-control" id="subjects" ng-model="education.subjects" placeholder="Subjects"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_purpose">Purpose of Training</label>
                    <input type="text" class="form-control" id="training_purpose" ng-model="education.training_purpose" placeholder="Purpose of Training"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/education-detail')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="mdi mdi-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_certification()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save"></i>
                        </button>
                        <a href="{{url('hr/experience-detail')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">All Certification</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Certification Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Training Venue</th>
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getCertification()">
                    <tr ng-repeat=" cert in allcert">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="cert.employee_name"></td>
                        <td ng-bind="cert.certification_name"></td>
                        <td ng-bind="cert.start_date"></td>
                        <td ng-bind="cert.end_date"></td>
                        <td ng-bind="cert.training_venue"></td>
                        <td ng-bind="cert.subjects"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editCertification(cert.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteCertification(cert.id);">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Certification = angular.module('CertificationApp', []);

    Certification.directive('datepicker', function () {
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

    Certification.controller('CertificationController', function ($scope, $http) {
        $scope.education = {};
        $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };

        $scope.editCertification = function (id) {
            $http.get('maintain-employee-certification/' + id + '/edit').then(function (response) {
                $scope.education = response.data;
            });
        };
        
        $scope.getCertification = function () {
            $scope.allcert = {};
            $http.get('maintain-employee-certification').then(function (response) {
                if (response.data.length > 0) {
                    $scope.allcert = response.data;
                }
            });
        };

        $scope.deleteCertification = function (id) {
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
                $http.delete('maintain-employee-certification/' + id).then(function (response) {
                    $scope.getCertification();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.save_certification = function(){
            if (!$scope.education.employee_id || !$scope.education.certification_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.education, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-employee-certification', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.education = {};
                    $scope.getCertification();
                });
            }
        };
    });
</script>
@endsection