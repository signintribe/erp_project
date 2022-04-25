@extends('layouts.admin.creationTier')
@section('title', 'Employee Pay, Allowance & Deduction')
@section('pagetitle', 'Employee Pay, Allowance & Deduction')
@section('breadcrumb', 'Employee Pay, Allowance & Deduction')
@section('content')
<div ng-controller="PayAllowanceController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Pay, Allowance and Deduction</h3>
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
                    <select ng-model="pld.company_id" ng-change="getoffice(pld.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="pld.office_id" ng-change="getDepartments(pld.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department"> Select Department</label>
                    <select ng-model="pld.department_id" id="department" ng-change="getGroups(pld.department_id); get_shifts(pld.department_id); get_calendars(pld.department_id)" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="group_id">* Select Employee Group</label>
                    <select ng-model="pld.group_id" id="employee-group" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!pld.group_id && showError"><small>Please Select Employee Group</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_calendar">Select Calendar</label>
                    <select ng-model="pld.calendar_id" ng-options="calendar.id as calendar.calender_name for calendar in calendars" id="select_calendar" class="form-control">
                        <option value="">Select Calendar</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_calendar">Select Shift</label>
                    <select ng-model="pld.shift_id" ng-options="shift.id as shift.shift_name for shift in shifts" id="select_calendar" class="form-control">
                        <option value="">Select Shift</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="allowance">Allowance</label>
                    <input type="text" class="form-control" id="allowance" ng-model="pld.allowance" placeholder="Leave Rules">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="per_amount">Amount/Percentage</label>
                    <input type="text" class="form-control" id="per_amount" ng-model="pld.per_amount" datepicker placeholder="Amount/Percentage">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="amount">Amount in Rs</label>
                    <input type="text" class="form-control" id="amount" ng-model="pld.amount" datepicker placeholder="Amount in Rs">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pay_frequency">Pay Frequency</label>
                    <input type="text" class="form-control" id="pay_frequency" ng-model="pld.pay_frequency" placeholder="Pay Frequency">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="hourly">Hourly</label>
                    <input type="text" class="form-control" id="hourly" ng-model="pld.hourly" placeholder="Hourly">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="rate">Rate</label>
                    <input type="text" class="form-control" id="rate" ng-model="pld.rate" placeholder="Rate">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="deduction_rule">Deduction Rule</label>
                    <input type="text" class="form-control" id="deduction_rule" ng-model="pld.deduction_rule" placeholder="Deduction Rule">
                </div>
            </div><br>
           <!--  <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="account_id ">Select Chart of Account </label>
                    <input type="text" class="form-control" id="pay_frequency" ng-model="pld.pay_frequency" placeholder="Pay Frequency">
                </div>
            </div><br> -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/employee-jd')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_leave()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/organizational-assignment')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Pay, Allownace and Deduction</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Group Name</th>
                        <th>Allowance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_payallowance();">
                    <tr ng-repeat="p in pays">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="p.company_name"></td>
                        <td ng-bind="p.office_name"></td>
                        <td ng-bind="p.department_name"></td>
                        <td ng-bind="p.group_name"></td>
                        <td ng-bind="p.allowance"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getoffice(p.company_id); getDepartments(p.office_id); get_calendars(p.department_id); get_shifts(p.department_id); editpayallowance(p.id); getGroups(p.department_id);">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deletePayAllowance(p.id)">Delete</button>
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
<script src="{{asset('ng_controllers/creation_hr/pay-allownce-deduction.js')}}"></script>
@endsection