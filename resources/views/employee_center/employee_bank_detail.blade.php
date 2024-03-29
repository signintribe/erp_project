@extends('layouts.admin.creationTier')
@section('title', 'Your Bank Detail')
@section('pagetitle', 'Your Bank Detail')
@section('breadcrumb', 'Your Bank Detail')
@section('content')
<div ng-controller="BankController" ng-cloak>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title">Enter Your Bank Detail</h3>
       </div>
       <div class="card-body">
           <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <label for="select_employee">Select Employee</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="bank.actor_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!bank.actor_id && showError"><small>Please Select Employee</small></i>
                </div>
               <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getBanksDetail()">
                   <label for="bank_id">Select Bank</label>
                   <select ng-model="bank.bank_id" ng-options="b.id as b.bank_name for b in banks" ng-change="getCompanyid(b)" id="bank_id" class="form-control">
                       <option value="">Select Bank</option>
                   </select>
                   <i class="text-danger" ng-show="!bank.bank_id && showError"><small>Please select bank</small></i>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
                   <label for="account_title">Account Title</label>
                   <input type="text" ng-model="bank.account_title" placeholder="Account Title" id="account_title" class="form-control">
                   <i class="text-danger" ng-show="!bank.account_title && showError"><small>Please type account title</small></i>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
                   <label for="account_number">Account Number</label>
                   <input type="text" ng-model="bank.account_number" placeholder="Account Number" id="account_number" class="form-control">
                   <i class="text-danger" ng-show="!bank.account_number && showError"><small>Please type account number</small></i>
               </div>
           </div><br/>
           <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                   <label for="iban">IBAN Number</label>
                   <input type="text" ng-model="bank.iban" placeholder="IBAN Number" id="iban" class="form-control">
                   <i class="text-danger" ng-show="!bank.iban && showError"><small>Please type IBAN Number</small></i>
               </div>
           </div><br/>
           <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('employee-leave')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="saveBank()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/employee-contact-person')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
       </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Bank Details
            </h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Bank Name</th>
                        <th>Account Title</th>
                        <th>Account Number</th>
                        <th>IBAN Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getBanksInfo();">
                    <tr ng-repeat="info in bankinfo">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="info.bank_name"></td>
                        <td ng-bind="info.account_title"></td>
                        <td ng-bind="info.account_number"></td>
                        <td ng-bind="info.iban"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editBank(info.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteBank(info.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" value="<?php echo session('company_id'); ?>" id="actor_id">
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/employee_bank_detail.js')}}"></script>
@endsection