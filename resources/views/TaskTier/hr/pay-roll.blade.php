@extends('layouts.admin.taskTier')
@section('title', 'Assign Pay Roll')
@section('pagetitle', 'Assign Pay Roll')
@section('breadcrumb', 'Assign Pay Roll')
@section('content')
<div ng-controller="PayRollController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Assign Pay Roll</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="payroll_type">Payroll Type</label>
                    <input type="text" ng-model="payroll.payroll_type" placeholder="Payroll Type" id="payroll_type" class="form-control">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getoffice();">
                    <label for="office_id">* Select Office</label>
                    <select ng-model="payroll.office_id" ng-change="getDepartments(payroll.office_id)" ng-options="office.id as office.office_name for office in offices"  id="office_id" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                    <i class="text-danger" ng-show="!payroll.office_id && showError"><small>Please Select Office</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department_id">* Select Department</label>
                    <select ng-model="payroll.department_id" ng-change="getGroup(payroll.department_id)" ng-options="dept.id as dept.department_name for dept in departments" class="form-control" id="department_id">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!payroll.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="group_id">Select Employee Group</label>
                    <select ng-model="payroll.group_id" id="group_id" ng-change="getEmployess(payroll.group_id)" ng-options="group.id as group.group_name for group in allgroups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!payroll.group_id && showError"><small>Please Select Employee Group</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="payment_type">Payment Type</label>
                    <select ng-model="payroll.payment_type" id="payment_type" class="form-control">
                        <option value="">Select Payment Type</option>
                        <option value="Regular Payroll">Regular Payroll</option>
                        <option value="Daily Wages Payroll">Daily Wages Payroll</option>
                        <option value="Cotigent Payroll">Daily Wages Payroll</option>
                    </select>
                    <i class="text-danger" ng-show="!payroll.payment_type && showError"><small>Please Select Payment Type</small></i>
                </div>
            </div><br/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9" ng-if="payallowance">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Pay and Allowance</h3>
                </div>
                <div class="card-body" style="height: 660px">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Pays</h5>
                                </div>
                                <div class="card-body" style="height: 250px; overflow-y: scroll;">
                                    <ul class="list-unstyled">
                                        <li ng-repeat="pay in pays">
                                            <input type="checkbox" ng-click="getPays(pay.id)" id="pay<% pay.id %>"> <label for="pay<% pay.id %>" ng-bind="pay.pay_type"></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Allowances</h5>
                                </div>
                                <div class="card-body" style="height: 250px; overflow-y: scroll;">
                                    <ul class="list-unstyled">
                                        <li ng-repeat="allowance in allowances">
                                            <input type="checkbox" ng-click="getAllowance(allowance.id)" id="allowance<%allowance.id%>"> <label for="allowance<%allowance.id%>" ng-bind="allowance.allowance_type"></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Deduction</h5>
                                </div>
                                <div class="card-body" style="height: 250px; overflow-y: scroll;">
                                    <ul class="list-unstyled">
                                        <li ng-repeat="deduct in deductions">
                                            <input type="checkbox" ng-click="getDeduct(deduct.id)" id="deduct<%deduct.id%>"> <label for="deduct<%deduct.id%>" ng-bind="deduct.deduct_type"></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Libilities</h5>
                                </div>
                                <div class="card-body" style="height: 250px; overflow-y: scroll;">
                                    <ul class="list-unstyled">
                                        <li ng-repeat="libility in libilities">
                                            <input type="checkbox" ng-click="getLibility(libility.id)" id="libility<%libility.id%>"> <label for="libility<%libility.id%>" ng-bind="libility.libility_type"></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3" ng-if="allemployees">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Employees</h3>
                </div>
                <div class="card-body" style="height: 660px; overflow-y: scroll">
                    <ul class="list-unstyled">
                        <li ng-repeat="emp in allemployees">
                            <input type="checkbox" ng-click="getEmployees(emp.id)" id="employee<% emp.id %>"> <label for="employee<% emp.id %>" ng-bind="emp.first_name"></label> <label ng-bind="emp.last_name"></label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn btn-success float-right" ng-click="assign_payroll()"><i class="fa fa-save" id="loader"></i> Assign Payroll</button>
        </div>
    </div><br/>
</div>
<input type="hidden" id="company_id" value="<?php echo session('company_id') ?>">
<input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/task_hr/assign-payroll.js')}}"></script>
@endsection