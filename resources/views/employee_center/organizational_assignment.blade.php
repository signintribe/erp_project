@extends('layouts.admin.master')
@section('title', 'Organizational Assignment')
@section('content')
<div  ng-app="AssignmentApp" ng-controller="AssignmentController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Organizational Assignment</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <label for="select_employee">* Select Employee</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="orgassignment.employee_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!orgassignment.employee_id && showError"><small>Please Select Employee</small></i>
                </div><!-- 
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="master_company">* Master Company</label>
                    <input type="text" class="form-control" id="master_company" ng-model="orgassignment.master_company" placeholder="Master Company"/>
                    <i class="text-danger" ng-show="!orgassignment.master_company && showError"><small>Please Type Master Company</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="child_company">Branch/Child Company</label>
                    <input type="text" class="form-control" id="child_company" ng-model="orgassignment.child_company" placeholder="Branch/Child Company"/>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getoffice(0)">
                    <label for="office">Select Office</label>
                    <select ng-model="orgassignment.office_id" ng-change="getDepartments(orgassignment.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="orgassignment.department_id" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!orgassignment.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_supervisor">* Name of Supervisor</label>
                    <select class="form-control" id="select_supervisor" ng-options="user.id as user.first_name for user in Users" ng-model="orgassignment.supervisor_name">
                        <option value="">Select Supervisor</option>
                    </select>
                    <i class="text-danger" ng-show="!orgassignment.supervisor_name && showError"><small>Please Select Department</small></i>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="supervisor_designation">Supervisor Designation</label>
                    <input type="text" class="form-control" id="supervisor_designation" ng-model="orgassignment.supervisor_designation" placeholder="Designation of Supervisor"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="appointment_date">Date of Appointment</label>
                    <input type="text" class="form-control" datepicker id="appointment_date" ng-model="orgassignment.appointment_date" placeholder="Date of Appointment"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="promotion_date">Date of Promotion</label>
                    <input type="text" class="form-control" datepicker id="promotion_date" ng-model="orgassignment.promotion_date" placeholder="Date of Promotion"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="designation">Designation</label>
                    <input type="text" class="form-control" id="designation" ng-model="orgassignment.designation" placeholder="Designation"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pay_scale">Pay Scale</label>
                    <input type="text" class="form-control" id="pay_scale" ng-model="orgassignment.pay_scale" placeholder="Pay Scale"/>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_since">Working Since</label>
                    <select ng-model="orgassignment.working_since" class="form-control" id="working_since">
                        <option value="">Select Working Since</option>
                        <?php for($i=1960; $i<date('Y'); $i++){ ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                </div> -->
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/experience-detail')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="mdi mdi-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_assignment()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save"></i>
                        </button>
                        <a href="{{url('hr/pay-emoluments')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class ="card-body">
            <h3 class="card-title">All Assignments</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Supervisor</th>
                        <th>Appointment</th>
                        <th>Promotion</th>
                        <th>Working Since</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getAssignments()">
                    <tr ng-repeat="a in Assignments">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="a.employee_name"></td>
                        <td ng-bind="a.department_id"></td>
                        <td ng-bind="a.supervisor_name"></td>
                        <td ng-bind="a.appointment_date"></td>
                        <td ng-bind="a.promotion_date"></td>
                        <td ng-bind="a.working_since"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editAssignment(a.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteAssignment(a.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" value="<?php echo env('APP_URL'); ?>" id="appurl">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Assignment = angular.module('AssignmentApp', []);

    Assignment.directive('datepicker', function () {
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

    Assignment.controller('AssignmentController', function ($scope, $http) {
        $scope.app_url = $("#appurl").val();
        $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };

        $scope.getoffice = function (company_id) {
            $scope.offices = {};
            $http.get($scope.app_url +'company/getoffice/'+company_id).then(function (response) {
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
        
        $scope.getAssignments = function () {
            $http.get('maintain-organization-assignment').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Assignments = response.data;
                }
            });
        };

        $scope.editAssignment = function (id) {
            $http.get('maintain-organization-assignment/'+id+'/edit').then(function (response) {
                $scope.orgassignment = response.data;
            });
        };
        
        $scope.deleteAssignment = function (id) {
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
                $http.delete('maintain-organization-assignment/' + id).then(function (response) {
                    $scope.getAssignments();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
        $scope.orgassignment = {};
        $scope.save_assignment = function(){
            if (!$scope.orgassignment.employee_id || !$scope.orgassignment.department_id) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                console.log($scope.orgassignment);
                var Data = new FormData();
                angular.forEach($scope.orgassignment, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-organization-assignment', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.orgassignment = {};
                   $scope.getAssignments();
                });
            }
        };
    });
</script>
@endsection