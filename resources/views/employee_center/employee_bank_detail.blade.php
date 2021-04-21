@extends('layouts.admin.master')
@section('title', 'Employee Bank Detail')
@section('content')
<div  ng-app="BankDetailApp" ng-controller="BankDetailController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Employee Bank Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <div class="form-group">
                        <label for="select_employee">* Select Employee</label>
                        <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="bankdetail.employee_id">
                            <option value="">Select Employee</option>
                        </select>
                        <i class="text-danger" ng-show="!bankdetail.employee_id && showError"><small>Please Select Employee</small></i>
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
        </div>
    </div> <br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Contact Detail</h3>
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
                        <label for="whatsapp">Whatsapp</label>
                        <input type="text" id="whatsapp" ng-model="bankdetail.whatsapp" class="form-control" placeholder="Whatsapp"/>
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
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Address Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">Postal Address Line 1</label>
                        <input type="text" id="address_1" ng-model="bankdetail.address_line_1" class="form-control" placeholder="Postal Address Line 1"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Postal Address Line 2</label>
                        <input type="text" id="address_2" ng-model="bankdetail.address_line_2" class="form-control" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_3">Postal Address Line 3</label>
                        <input type="text" id="address_3" ng-model="bankdetail.address_line_3" class="form-control" placeholder="Postal Address Line 3"/>
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
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" ng-model="bankdetail.postal_code" class="form-control" placeholder="Postal Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" id="zip_code" ng-model="bankdetail.zip_code" class="form-control" placeholder="Zip Code"/>
                    </div>
                </div>
            </div><br/>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Social Media</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" id="facebook" ng-model="bankdetail.facebook" class="form-control" placeholder="Facebook"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="linkedin">Linkedin</label>
                        <input type="text" id="linkedin" ng-model="bankdetail.linkedin" class="form-control" placeholder="Linkedin"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="instgram">Instgram</label>
                        <input type="text" id="instgram" ng-model="bankdetail.instagram" class="form-control" placeholder="Instgram"/>
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button class="btn btn-sm btn-success float-right" ng-click="save_bankdetail()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Bank Name</th>
                        <th>Branch Name</th>
                        <th>Account Type</th>
                        <th>Branch Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getBankDetails()">
                    <tr ng-repeat="bank in bankdetails">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="bank.first_name"></td>
                        <td ng-bind="bank.bank_name"></td>
                        <td ng-bind="bank.branch_name"></td>
                        <td ng-bind="bank.account_type"></td>
                        <td ng-bind="bank.branch_code"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editBankDetail(bank.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteBankDetail(bank.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" id="app_url" value="<?php echo env('APP_URL'); ?>">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var BankDetail = angular.module('BankDetailApp', []);
    BankDetail.controller('BankDetailController', function ($scope, $http) {
        $scope.bankdetail = {};
        $scope.appurl = $("#app_url").val();

        $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };

        $scope.deleteBankDetail = function (id) {
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('maintain-emp-bankdetail/' + id).then(function (response) {
                    $scope.getBankDetails();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.getBankDetails = function () {
            $scope.bankdetails = {};
            $http.get('maintain-emp-bankdetail').then(function (response) {
                if (response.data.length > 0) {
                    $scope.bankdetails = response.data;
                }
            });
        };

        $scope.editBankDetail = function (id) {
            $http.get('maintain-emp-bankdetail/' + id + '/edit').then(function (response) {
                $scope.bankdetail = response.data;
                $scope.getAddress($scope.bankdetail.address_id);
                $scope.getContact($scope.bankdetail.contact_id);
                $scope.getSocialMedia($scope.bankdetail.social_id);
            });
        };

        $scope.getAddress = function(address_id){
            $http.get($scope.appurl+'getAddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.bankdetail, response.data);
                    $scope.getContact($scope.bankdetail.contact_id);
                }
            });
        };

        $scope.getContact = function(contact_id){
            $http.get($scope.appurl+'getContact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.bankdetail, response.data);
                }
            });
        };

        $scope.getSocialMedia = function(social_id){
            $http.get($scope.appurl+'getSocialMedia/' + social_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.bankdetail, response.data);
                }
            });
        };

        
        $scope.save_bankdetail = function(){
            if (!$scope.bankdetail.employee_id || !$scope.bankdetail.account_title) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.bankdetail, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-emp-bankdetail', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.bankdetail = {};
                    $scope.getBankDetails();
                });
            }
        };
    });
</script>
@endsection