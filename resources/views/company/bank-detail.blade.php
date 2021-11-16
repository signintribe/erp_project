@extends('layouts.admin.creationTier')
@section('title', 'Your Bank Detail')
@section('pagetitle', 'Your Bank Detail')
@section('breadcrumb', 'Your Bank Detail')
@section('content')
<div  ng-app="BankApp" ng-controller="BankController" ng-cloak>
   <div class="card">
       <div class="card-header">
           <h3 class="card-title">Enter Your Bank Detail</h3>
       </div>
       <div class="card-body">
           <div class="row">
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
               <div class="col-lg-3 col-md-3 col-sm-3">
                   <label for="iban">IBAN Number</label>
                   <input type="text" ng-model="bank.iban" placeholder="IBAN Number" id="iban" class="form-control">
                   <i class="text-danger" ng-show="!bank.iban && showError"><small>Please type IBAN Number</small></i>
               </div>
           </div><br/>
           <div class="row">
               <div class="col">
                   <button class="btn btn-sm btn-success float-right" ng-click="saveBank()"> <i id="loader" class="fa fa-save"></i> Save</button>
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
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Company = angular.module('BankApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    
    Company.controller('BankController', function ($scope, $http) {
        $("#company").addClass('menu-open');
        $("#company a[href='#']").addClass('active');
        $("#company-bank").addClass('active');
        $scope.url = $("#appurl").val();
        $scope.bank = {};

        $scope.getBanksDetail = function () {
            $http.get('maintain-company-bankdetail').then(function (response) {
                if (response.data.length > 0) {
                    $scope.banks = response.data;
                }
            });
        };

        $scope.getBanksInfo = function () {
            $http.get($scope.url + 'get-bank-info/company').then(function (response) {
                if (response.data.length > 0) {
                    $scope.bankinfo = response.data;
                }
            });
        };

        $scope.editBank = function (id) {
            $http.get($scope.url + 'manage-banks/' + id + '/edit').then(function (response) {
                $scope.bank = response.data;
                $scope.bank.bank_id = parseInt(response.data.bank_id);
                $("#ShowPrint").show();
            });
        };
        
        $scope.deleteBank = function (bank_id) {
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
                $http.delete($scope.url + 'manage-banks/' + bank_id).then(function (response) {
                    $scope.getBanksInfo();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.saveBank = function () {
            $scope.bank.actor_name = 'company';
            $scope.bank.actor_id = $("#actor_id").val();
            if (!$scope.bank.bank_id || !$scope.bank.account_title || !$scope.bank.account_number || !$scope.bank.iban) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
                var Data = new FormData();
                angular.forEach($scope.bank, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.url + 'manage-banks', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                    $scope.bank = {};
                    $scope.getBanksInfo();
                });
            }
        };
    });
</script>
@endsection