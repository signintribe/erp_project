@extends('layouts.admin.taskTier')
@section('title', 'Assign Pay Roll')
@section('pagetitle', 'Assign Pay Roll')
@section('breadcrumb', 'Assign Pay Roll')
@section('content')
<div ng-controller="PayRollController" ng-cloak>
    <style>
        #exampleModal p{
            border-bottom: solid 1px;
        }
    </style>
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
    <!-- Add Form All Pay and Allowance -->
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
    <!-- /. Add Form All Pay and Allowance -->
    <div class="row">
        <div class="col">
            <button class="btn btn-success btn-sm float-right" ng-click="assign_payroll()"><i class="fa fa-save" id="loader"></i> Assign Payroll</button>
        </div>
    </div><br/>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Pay Rolls</h3>
                    <div class="card-tools">
                        <button class="btn btn-xs btn-warning" ng-click="get_allpayroll();">Refresh</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Payroll type</th>
                                <th>Payment type</th>
                                <th>Office name</th>
                                <th>Dept name</th>
                                <th>Group name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="pr in getallpayroll">
                                <td ng-bind="$index+1"></td>
                                <td ng-bind="pr.payroll_type"></td>
                                <td ng-bind="pr.payment_type"></td>
                                <td ng-bind="pr.office_name"></td>
                                <td ng-bind="pr.department_name"></td>
                                <td ng-bind="pr.group_name"></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-info" ng-click="getOnePayroll(pr.id, pr.payroll_type)" data-toggle="modal" data-target="#exampleModal" ng-click="getPayroll(pr.id)">Run Payroll</button>
                                        <button class="btn btn-xs btn-danger">Delete</button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Run Payroll of <span ng-if="payrolltype" ng-bind="payrolltype"></span></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label for="payrolltype">Payroll Type</label>
                                                                    <p ng-bind="onePayroll.payroll_type"></p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label for="payment_type">Payment Type</label>
                                                                    <p ng-bind="onePayroll.payment_type"></p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label for="office_name">Office Name</label>
                                                                    <p ng-bind="onePayroll.office.office_name"></p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label for="department_name">Department Name</label>
                                                                    <p ng-bind="onePayroll.department.department_name"></p>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label for="group_name">Group Name</label>
                                                                    <p ng-bind="onePayroll.group.group_name"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br/>
                                                    <h4>Pays to Employee</h4>
                                                    <table class="table">
                                                        <tr>
                                                            <th>Employee</th>
                                                            <th>Pay Type</th>
                                                            <th>Pay Amount</th>
                                                        </tr>
                                                        <tr ng-repeat="spay in payrollpays">
                                                            <td>
                                                                <span ng-bind="spay.first_name"></span>
                                                                <span ng-bind="spay.middle_name"></span>
                                                                <span ng-bind="spay.last_name"></span>
                                                            </td>
                                                            <td ng-bind="spay.pay_type"></td>
                                                            <td ng-bind="spay.pay_amount"></td>
                                                        </tr>
                                                    </table><br/>
                                                    <h4>Allowance to Employee</h4>
                                                    <table class="table">
                                                        <tr>
                                                            <th>Employee</th>
                                                            <th>Allownace Type</th>
                                                            <th>Allowanec Amount</th>
                                                        </tr>
                                                        <tr ng-repeat="sallow in payrollallowance">
                                                            <td>
                                                                <span ng-bind="sallow.first_name"></span>
                                                                <span ng-bind="sallow.middle_name"></span>
                                                                <span ng-bind="sallow.last_name"></span>
                                                            </td>
                                                            <td ng-bind="sallow.allowance_type"></td>
                                                            <td ng-bind="sallow.allow_amount"></td>
                                                        </tr>
                                                    </table><br>
                                                    <h4>Libilities to Employee</h4>
                                                    <table class="table">
                                                        <tr>
                                                            <th>Employee</th>
                                                            <th>Libility Type</th>
                                                            <th>Libility Amount</th>
                                                        </tr>
                                                        <tr ng-repeat="slib in payrolllibility">
                                                            <td>
                                                                <span ng-bind="slib.first_name"></span>
                                                                <span ng-bind="slib.middle_name"></span>
                                                                <span ng-bind="slib.last_name"></span>
                                                            </td>
                                                            <td ng-bind="slib.libility_type"></td>
                                                            <td ng-bind="slib.libility_amount"></td>
                                                        </tr>
                                                    </table>
                                                    <h4>Deduction to Employee</h4>
                                                    <table class="table">
                                                        <tr>
                                                            <th>Employee</th>
                                                            <th>Libility Type</th>
                                                            <th>Libility Amount</th>
                                                        </tr>
                                                        <tr ng-repeat="sded in payrollded">
                                                            <td>
                                                                <span ng-bind="sded.first_name"></span>
                                                                <span ng-bind="sded.middle_name"></span>
                                                                <span ng-bind="sded.last_name"></span>
                                                            </td>
                                                            <td ng-bind="sded.deduct_type"></td>
                                                            <td ng-bind="sded.deduct_amount"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table><br/>
                    <div class="text-center">
                        <p ng-if="nomore" ng-bind="nomore"></p>
                        <button class="btn btn-primary btn-sm btn-loadmore" ng-click="loadMore()"> <i class="fa fa-spinner" id="loadmore-spinner"></i> Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="company_id" value="<?php echo session('company_id') ?>">
<input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/task_hr/assign-payroll.js')}}"></script>
@endsection