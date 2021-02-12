@extends('layouts.admin.master')
@section('title', 'Employee Bank Detail')
@section('content')
<div  ng-app="BankDetailApp" ng-controller="BankDetailController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Employee Bank Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="employee_name">* Select Employee Name</label>
                        <select id="employee_name" ng-model="bankdetail.employee_name" class="form-control">
                            <option value="">Select Employee</option>
                        </select>
                        <i class="text-danger" ng-show="!bankdetail.employee_name && showError"><small>Please Select Employee</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="account_title">* Title of Account</label>
                        <input type="text" id="account_title" ng-model="bankdetail.account_title" class="form-control" placeholder="Title of Account"/>
                        <i class="text-danger" ng-show="!bankdetail.account_title && showError"><small>Please Type Title of Account</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="bank_name">* Name of Bank</label>
                        <input type="text" id="bank_name" ng-model="bankdetail.bank_name" class="form-control" placeholder="Name of Bank"/>
                        <i class="text-danger" ng-show="!bankdetail.bank_name && showError"><small>Please Type Name of Bank</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="branch_name">* Name of Branch</label>
                        <input type="text" id="branch_name" ng-model="bankdetail.branch_name" class="form-control" placeholder="Name of Branch"/>
                        <i class="text-danger" ng-show="!bankdetail.branch_name && showError"><small>Please Type Name of Branch</small></i>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="branch_code">* Branch Code</label>
                            <input type="text" id="branch_code" ng-model="bankdetail.branch_code" class="form-control" placeholder="Branch Code"/>
                            <i class="text-danger" ng-show="!bankdetail.branch_code && showError"><small>Please Type Branch Code</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="iban_no">* IBAN No.</label>
                            <input type="text" id="iban_no" ng-model="bankdetail.iban_no" class="form-control" placeholder="IBAN No."/>
                            <i class="text-danger" ng-show="!bankdetail.iban_no && showError"><small>Please Type IBAN No.</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="bank_key">Bank Key</label>
                        <input type="text" id="bank_key" ng-model="bankdetail.bank_key" class="form-control" placeholder="Bank Key"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="account_type">Account Type</label>
                        <input type="text" id="account_type" ng-model="bankdetail.account_type" class="form-control" placeholder="Account Type"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" ng-model="bankdetail.phone_number" class="form-control" placeholder="Phone Number"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" id="mobile_number" ng-model="bankdetail.mobile_number" class="form-control" placeholder="Mobile Number"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="fax_number">Fax Number</label>
                        <input type="text" id="fax_number" ng-model="bankdetail.fax_number" class="form-control" placeholder="Fax Number"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" id="facebook" ng-model="bankdetail.facebook" class="form-control" placeholder="Facebook"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="linkedin">Linkedin</label>
                        <input type="text" id="linkedin" ng-model="bankdetail.linkedin" class="form-control" placeholder="Linkedin"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="instgram">Instgram</label>
                        <input type="text" id="instgram" ng-model="bankdetail.instgram" class="form-control" placeholder="Instgram"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="text" id="whatsapp" ng-model="bankdetail.whatsapp" class="form-control" placeholder="Whatsapp"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" id="twitter" ng-model="bankdetail.twitter" class="form-control" placeholder="Twitter"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                 <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" ng-model="bankdetail.email" class="form-control" placeholder="Email"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">Postal Address Line 1</label>
                        <input type="text" id="address_1" ng-model="bankdetail.address_1" class="form-control" placeholder="Postal Address Line 1"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Postal Address Line 2</label>
                        <input type="text" id="address_2" ng-model="bankdetail.address_2" class="form-control" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" id="street" ng-model="bankdetail.street" class="form-control" placeholder="Street"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" id="sector" ng-model="bankdetail.sector" class="form-control" placeholder="Sector/Mohallah"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" ng-model="bankdetail.country" class="form-control" placeholder="Country"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="state">State/Province</label>
                        <input type="text" id="state" ng-model="bankdetail.state" class="form-control" placeholder="State/Province"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" ng-model="bankdetail.city" class="form-control" placeholder="City"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button class="btn btn-sm btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var BankDetail = angular.module('BankDetailApp', []);
    BankDetail.controller('BankDetailController', function ($scope, $http) {

    });
</script>
@endsection