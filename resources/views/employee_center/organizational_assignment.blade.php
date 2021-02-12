@extends('layouts.admin.master')
@section('title', 'Organizational Assignment')
@section('content')
<div  ng-app="AssignmentApp" ng-controller="AssignmentController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Organizational Assignment</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_employee">Select Employee</label>
                    <select class="form-control" id="select_employee" ng-model="orgassignment.select_employee">
                        <option value="">Select Employee</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="master_company">Master Company</label>
                    <input type="text" class="form-control" id="master_company" ng-model="orgassignment.master_company" placeholder="Master Company"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="child_company">Branch/Child Company</label>
                    <input type="text" class="form-control" id="child_company" ng-model="orgassignment.child_company" placeholder="Branch/Child Company"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">Name of Department</label>
                    <input type="text" class="form-control" id="department" ng-model="orgassignment.department" placeholder="Name of Department"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="supervisor_name">Name of Supervisor/Senior</label>
                    <input type="text" class="form-control" id="supervisor_name" ng-model="orgassignment.supervisor_name" placeholder="Name of Supervisor/Senior"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="supervisor_designation">Designation of Supervisor/Senior</label>
                    <input type="text" class="form-control" id="supervisor_designation" ng-model="orgassignment.supervisor_designation" placeholder="Designation of Supervisor/Senior"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="appointment_date">Date of Appointment</label>
                    <input type="text" class="form-control" id="appointment_date" ng-model="orgassignment.appointment_date" placeholder="Date of Appointment"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="promotion_date">Date of Promotion</label>
                    <input type="text" class="form-control" id="promotion_date" ng-model="orgassignment.promotion_date" placeholder="Date of Promotion"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="designation">Designation</label>
                    <input type="text" class="form-control" id="designation" ng-model="orgassignment.designation" placeholder="Designation"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pay_scale">Pay Scale</label>
                    <input type="text" class="form-control" id="pay_scale" ng-model="orgassignment.pay_scale" placeholder="Pay Scale"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_since">working Since</label>
                    <input type="text" class="form-control" id="working_since" ng-model="orgassignment.working_since" placeholder="working Since"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Assignment = angular.module('AssignmentApp', []);
    Assignment.controller('AssignmentController', function ($scope, $http) {

    });
</script>
@endsection