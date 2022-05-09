@extends('layouts.admin.creationTier')
@section('title', 'Organizational Assignment')
@section('pagetitle', 'Organizational Assignment')
@section('breadcrumb', 'Organizational Assignment')
@section('content')
<div ng-controller="AssignmentController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Organizational Assignment</h3>
        </div>
        <div class="card-body">
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
                    <div class="form-group">
                        <div class="input-group date" id="appointment_date" data-target-input="nearest">
                            <input type="text" placeholder="Date of Appointment" ng-model="orgassignment.appointment_date" class="form-control datetimepicker-input" data-target="#appointment_date"/>
                            <div class="input-group-append" data-target="#appointment_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="promotion_date">Date of Promotion</label>
                    <div class="form-group">
                        <div class="input-group date" id="promotion_date" data-target-input="nearest">
                            <input type="text" placeholder="Date of Promotion" ng-model="orgassignment.promotion_date" class="form-control datetimepicker-input" data-target="#promotion_date"/>
                            <div class="input-group-append" data-target="#promotion_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
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
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_assignment()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/pay-emoluments')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Assignments</h3>
        </div>
        <div class ="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Supervisor</th>
                        <th>Appointment</th>
                        <th>Promotion</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getAssignments()">
                    <tr ng-repeat="a in Assignments">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="a.first_name + ' ' + a.last_name"></td>
                        <td ng-bind="a.department_name"></td>
                        <td ng-bind="a.sup_name"></td>
                        <td ng-bind="a.appointment_date"></td>
                        <td ng-bind="a.promotion_date"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getDepartments(a.office_id);editAssignment(a.id);">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteAssignment(a.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/organizational_assignment.js')}}"></script>
@endsection