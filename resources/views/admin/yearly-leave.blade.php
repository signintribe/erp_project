@extends('layouts.admin.creationTier')
@section('title', 'Yearly Leave')
@section('pagetitle', 'Yearly Leave')
@section('breadcrumb', 'Yearly Leave')
@section('content')
<div ng-controller="YearlyLeaveController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Yearly Leaves</h3>
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
                    <select ng-model="yl.company_id" ng-change="getoffice(yl.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="yl.office_id" ng-change="getDepartments(yl.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="yl.department_id" id="department" ng-change="getGroups(yl.department_id)" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!yl.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="group_id">* Select Employee Group</label>
                    <select ng-model="yl.group_id" id="employee-group" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!yl.group_id && showError"><small>Please Select Employee Group</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_type">* Leave Type</label>
                    <select ng-model="yl.leave_type" id="leave_type" class="form-control">
                        <option value="">Select Leave Type</option>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Short Leave">Short Leave</option>
                        <option value="Casual Leave">Casual Leave</option>
                        <option value="Maternity">Maternity</option>
                        <option value="Maternity Leave">Maternity Leave</option>
                        <option value="Marriage Leave">Marriage Leave</option>
                        <option value="Earnd Leave">Earnd Leave</option>
                        <option value="Study Leave">Study Leave</option>
                        <option value="Foreign Leave">Foreign Leave</option>
                    </select>
                    <i class="text-danger" ng-show="!yl.leave_type && showError"><small>Please Type Leave Type</small></i>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="month-leave">Leave in Month</label>
                    <input type="text" ng-model="yl.month_leave" id="month-leave" ng-blur="yl.total_leave=yl.month_leave*12" placeholder="Leave in Month" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_leave">Total Leave</label>
                    <input type="text" class="form-control" readonly id="total_leave" ng-model="yl.total_leave" placeholder="Total Leave">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_rules">Leave Rules</label>
                    <input type="text" class="form-control" id="leave_rules" ng-model="yl.leave_rules" placeholder="Leave Rules">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_deduction">Leave Deduction</label>
                    <select class="form-control" id="leave_deduction" ng-model="yl.leave_deduction">
                        <option value="">Select Leave Deduction</option>
                        <option value="Deductible from pay">Deductible from pay</option>
                        <option value="Non-deductible form pay">Non-deductible form pay</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_rate">Leave Rate</label>
                    <input type="text" class="form-control" id="leave_rate" ng-model="yl.leave_rate" datepicker placeholder="Leave Rate">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="lapsed">Does Leave Lapsed/C.F</label>
                    <select class="form-control" id="lapsed" ng-model="yl.lapsed">
                        <option value="">Doed Leave Lapsed/C.F</option>
                        <option value="Lapsed">Lapsed</option>
                        <option value="Carry Forward">Carry Forward</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_leave()"> <i class="fa fa-save" id="loader"></i> Save</button>
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
                        <th>Leave Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_leaves();">
                    <tr ng-repeat="l in leaves">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="l.company_name"></td>
                        <td ng-bind="l.office_name"></td>
                        <td ng-bind="l.department_name"></td>
                        <td ng-bind="l.leave_type"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="getoffice(l.company_id); getDepartments(l.office_id); editLeaves(l.id); getGroups(l.department_id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteYearlyLeave(l.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo env('APP_URL'); ?>" id="appurl">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_company/yearly-leave.js')}}"></script>
@endsection