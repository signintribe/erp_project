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
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_name" ng-init="getCustomers();">* Name of Customer</label>
                    <select class="form-control" id="customer_name" ng-options="customer.id as customer.customer_name for customer in customerinformations" ng-model="bank.actor_id">
                        <option value="">Select Customer Name</option>
                    </select>
                    <i class="text-danger" ng-show="!bank.actor_id && showError"><small>Please Select Customer</small></i>
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
           </div>
           <div class="row">
               <div class="col">
                   <button class="btn btn-sm btn-success float-right" ng-click="saveBank()"> <i class="fa fa-save"></i> Save</button>
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
<input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/sales/customer-bank-detail.js')}}"></script>
@endsection