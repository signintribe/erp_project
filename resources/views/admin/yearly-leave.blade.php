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
            <div class="row" ng-init="getoffice(0); getAccounts()">
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
                    <label for="leave-start">Leave Start Period</label>
                    <div class="form-group">
                        <div class="input-group date" id="leave_start" data-target-input="nearest">
                            <input type="text" placeholder="Leave Start Period" ng-model="yl.leave_start" class="form-control datetimepicker-input" data-target="#leave_start"/>
                            <div class="input-group-append" data-target="#leave_start" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave-end">Leave End Period</label>
                    <div class="form-group">
                        <div class="input-group date" id="leave_end" data-target-input="nearest">
                            <input type="text" placeholder="Leave End Period" ng-model="yl.leave_end" class="form-control datetimepicker-input" data-target="#leave_end"/>
                            <div class="input-group-append" data-target="#leave_end" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <duv class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="carry_forword">Does leave carry forward at the end of year</label><br/>
                    <input type="checkbox" ng-model="yl.carry_forword" ng-value="carry_forword" id="carry"> <label for="carry">Does leave carry forword</label>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="encash-leave">Can employee encash leave</label><br/>
                    <input type="checkbox" ng-model="yl.encash" ng-value="encash" id="encash"> <label for="encash">Can employee encash leave</label>
                </div>
            </duv><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="encashmonths">Month leave can be encash</label>
                    <input type="text" ng-model="yl.encashmonth" id="encashmonths" placeholder="Month leave can be encash" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_proof">Leave required any proof</label>
                    <select ng-model="yl.leave_proof" id="leave_proof" class="form-control">
                        <option value="">Leave Proof</option>
                        <option value="Telephonic Message">Telephonic Message</option>
                        <option value="Application of Leave">Application of Leave</option>
                        <option value="Medical Proof">Medical Proof</option>
                        <option value="Marriage Proof">Marriage Proof</option>
                        <option value="Visa">Visa</option>
                        <option value="Attacthment">Attacthment</option>
                        <option value="Any Other">Any Other</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="leave_on_deduction">Deduction on leave</label>
                    <select ng-model="yl.leave_on_deduction" ng-options="Account.id as Account.CategoryName for Account in Accounts" id="leave_on_deduction" class="form-control">
                        <option value="">Deduction on leave</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="initiation_action">Initiation of Action</label>
                    <input type="text" ng-model="yl.initiation_action" id="initiation_action" placeholder="Initiation of Action" class="form-control">
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Leave Penalities</h3><br/><hr/>
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Select Leave Penalities</h3><br/><hr/>
                            <ul class="list-unstyled">
                                <li>
                                    <input type="checkbox" id="ad_note" ng-click="getCheckList('Advisory Note')">
                                    <label for="ad_note">Advisory Note</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="explaination" ng-click="getCheckList('Explaination')">
                                    <label for="explaination">Explaination</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="show_case" ng-click="getCheckList('Show Case')">
                                    <label for="show_case">Show Case</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="stopage_salary" ng-click="getCheckList('Stopage of Salary')">
                                    <label for="stopage_salary">Stopage of Salary</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="stopage_promotion" ng-click="getCheckList('Stopage of Promotion')">
                                    <label for="stopage_promotion">Stopage of Promotion</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="stopage_increment" ng-click="getCheckList('Stopage of Increment')">
                                    <label for="stopage_increment">Stopage of Increment</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="step_down" ng-click="getCheckList('Step Down')">
                                    <label for="step_down">Step Down</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="suspend" ng-click="getCheckList('Suspend')">
                                    <label for="suspend">Suspend</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="terminate" ng-click="getCheckList('Terminate')">
                                    <label for="terminate">Terminate</label>
                                </li>
                            </ul>
                        </div>
                        <div class="col" ng-if="penalities">
                            <h3 class="card-title">Selected Penalities</h3><br/><hr/>
                            <ul class="list-unstyled" ng-repeat="pen in penalities">
                                <li ng-bind="pen.penality"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
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