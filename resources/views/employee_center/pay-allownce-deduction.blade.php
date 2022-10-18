@extends('layouts.admin.creationTier')
@section('title', 'Employee Pay, Allowance & Deduction')
@section('pagetitle', 'Employee Pay and Allowance')
@section('breadcrumb', 'Employee Pay and Allowance')
@section('content')
<div ng-controller="PayAllowanceController" ng-cloak>
    <div class="row" ng-init="getAccounts('Company');getAccounts('Employee');">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pay</h3>
                    <div class="card-tools">
                        <button class="btn btn-xs btn-primary" ng-click="addPayMore()">Add More</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" ng-repeat="pay in pays" style="border-bottom: solid 1px; margin-top: 10px;">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="pay_type">Pay Type</label>
                            <input type="text" ng-model="pay.pay_type" id="pay_type" placeholder="Pay Type" class="form-control"><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="emp_account">Emp Chart of Account</label>
                            <select ng-model="pay.pay_emp_account" ng-options="account.id as account.CategoryName for account in EmpAccounts" id="emp_account" class="form-control">
                                <option value="">Select Employee Account</option>
                            </select><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="pay_amount">Amount</label>
                            <input type="text" ng-model="pay.pay_amount" id="pay_amount" placeholder="Amount" class="form-control"/><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="emp_account">Company Chart of Account</label>
                            <select ng-model="pay.pay_com_account" ng-options="caccount.id as caccount.CategoryName for caccount in ComAccounts" id="emp_account" class="form-control">
                                <option value="">Select Company Account</option>
                            </select><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Allowance</h3>
                    <div class="card-tools">
                        <button class="btn btn-xs btn-primary" ng-click="addAllowanceMore()">Add More</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" ng-repeat="allow in allowances" style="border-bottom: solid 1px; margin-top: 10px;">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="allowance_type">Allowance Type</label>
                            <input type="text" ng-model="allow.allowance_type" id="allowance_type" placeholder="Allowance Type" class="form-control"><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="allow_emp_account">Emp Chart of Account</label>
                            <select ng-model="allow.allow_emp_account" ng-options="account.id as account.CategoryName for account in EmpAccounts" id="allow_emp_account" class="form-control">
                                <option value="">Select Employee Account</option>
                            </select><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="allow_amount">Amount</label>
                            <input type="text" ng-model="allow.allow_amount" id="allow_amount" placeholder="Amount" class="form-control"/><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="allow_emp_account">Company Chart of Account</label>
                            <select ng-model="allow.allow_com_account" ng-options="caccount.id as caccount.CategoryName for caccount in ComAccounts" id="allow_emp_account" class="form-control">
                                <option value="">Select Company Account</option>
                            </select><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Deduction</h3>
                    <div class="card-tools">
                        <button class="btn btn-xs btn-primary" ng-click="addDeductionMore()">Add More</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" ng-repeat="deduct in deductions" style="border-bottom: solid 1px; margin-top: 10px;">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="deduct_type">Deduction Type</label>
                            <input type="text" ng-model="deduct.deduct_type" id="deduct_type" placeholder="Deduction Type" class="form-control"><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="deduct_emp_account">Emp Chart of Account</label>
                            <select ng-model="deduct.deduct_emp_account" ng-options="account.id as account.CategoryName for account in EmpAccounts" id="deduct_emp_account" class="form-control">
                                <option value="">Select Employee Account</option>
                            </select><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="deduct_amount">Amount</label>
                            <input type="text" ng-model="deduct.deduct_amount" id="deduct_amount" placeholder="Amount" class="form-control"/><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="deduct_com_account">Company Chart of Account</label>
                            <select ng-model="deduct.deduct_com_account" ng-options="caccount.id as caccount.CategoryName for caccount in ComAccounts" id="deduct_com_account" class="form-control">
                                <option value="">Select Company Account</option>
                            </select><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Libility</h3>
                    <div class="card-tools">
                        <button class="btn btn-xs btn-primary" ng-click="addLibilityMore()">Add More</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" ng-repeat="libility in libilities" style="border-bottom: solid 1px; margin-top: 10px;">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="libility_type">Libility Type</label>
                            <input type="text" ng-model="libility.libility_type" id="libility_type" placeholder="Libility Type" class="form-control"><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="libility_emp_account">Emp Chart of Account</label>
                            <select ng-model="libility.libility_emp_account" ng-options="account.id as account.CategoryName for account in EmpAccounts" id="libility_emp_account" class="form-control">
                                <option value="">Select Employee Account</option>
                            </select><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="libility_amount">Amount</label>
                            <input type="text" ng-model="libility.libility_amount" id="libility_amount" placeholder="Amount" class="form-control"/><br/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="libility_emp_account">Company Chart of Account</label>
                            <select ng-model="libility.libility_com_account" ng-options="caccount.id as caccount.CategoryName for caccount in ComAccounts" id="allow_emp_account" class="form-control">
                                <option value="">Select Company Account</option>
                            </select><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row" ng-init="getoffice()">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="select_office">Select Office</label>
                            <select ng-model="pay_allowance.office_id" ng-change="getDepartments(pay_allowance.office_id)" ng-options="office.id as office.office_name for office in offices" class="form-control" id="select_office">
                                <option value="">Select Office</option>
                            </select>
                            <i class="text-danger" ng-show="!pay_allowance.office_id && showError"><small>Please Select Office</small></i>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="select_department">Select Department</label>
                            <select ng-model="pay_allowance.department_id" ng-options="dept.id as dept.department_name for dept in departments" class="form-control" id="select_department">
                                <option value="">Select Department</option>
                            </select>
                            <i class="text-danger" ng-show="!pay_allowance.department_id && showError"><small>Please Select Department</small></i>
                        </div>
                    </div><br/>
                    <button class="btn btn-success btn-sm float-right" ng-click="savePayAllowance()"> <i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Pay and Allownace</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_payallowance();">
                    <tr ng-repeat="p in allallowances">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="p.office_name"></td>
                        <td ng-bind="p.department_name"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="getoffice(p.company_id); getDepartments(p.office_id);editpayallowance(p.id);">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deletePayAllowance(p.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table><br/>
            <div class="text-center">
                <i id='rec-loader'></i><br/>
                <button class="btn btn-md btn-primary loader-btn" ng-click="loadMore()"> <i id='loadmore' class="fa fa-spinner"></i> Load More</button>
                <p ng-if="norecord" ng-bind="norecord"></p>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo session('company_id') ?>" id="company_id">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/pay-allownce-deduction.js')}}"></script>
@endsection