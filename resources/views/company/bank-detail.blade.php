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
                   <select ng-model="bank.bank_id" ng-options="b.id as b.bank_name for b in banks" id="bank_id" class="form-control">
                       <option value="">Select Bank</option>
                   </select>
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
                   <label for="account_title">Account Title</label>
                   <input type="text" name="bank.account_title" placeholder="Account Title" id="account_title" class="form-control">
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
                   <label for="account_number">Account Number</label>
                   <input type="text" name="bank.account_number" placeholder="Account Number" id="account_number" class="form-control">
               </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
                   <label for="iban">IBAN Number</label>
                   <input type="text" name="bank.iban" placeholder="IBAN Number" id="iban" class="form-control">
               </div>
           </div><br/>
           <div class="row">
               <div class="col">
                   <button class="btn btn-sm btn-success float-right"> <i class="fa fa-save"></i> Save</button>
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
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
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
        $scope.office = {};

        $scope.getBanksDetail = function () {
            $http.get('maintain-company-bankdetail').then(function (response) {
                if (response.data.length > 0) {
                    $scope.banks = response.data;
                }
            });
        };

        $scope.editOffice = function (id) {
            $http.get('office-settings/' + id + '/edit').then(function (response) {
                $scope.office = response.data;
                $scope.office.office_status = $scope.office.office_status == 1 ? true : false;
                $scope.get_companysocial($scope.office.social_id);
                $scope.get_companyaddress($scope.office.address_id);
                $scope.get_companycontact($scope.office.contact_id);
                $("#ShowPrint").show();
            });
        };

        $scope.get_companysocial = function (social_id) {
            $http.get('getcompanysocial/' + social_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.office, response.data);
                }
            });
        };

        $scope.get_companyaddress = function (address_id) {
            $http.get('getcompanyaddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.office, response.data);
                }
            });
        };

        $scope.get_companycontact = function (contact_id) {
            $http.get('getcompanycontact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.office, response.data);
                }
            });
        };
        
        $scope.deleteOffice = function (office_id) {
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
                $http.delete('office-settings/' + office_id).then(function (response) {
                    $scope.getalloffice();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.save_companyoffice = function () {
            if (!$scope.office.office_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.office, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('office-settings', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.office = {};
                    $scope.getalloffice();
                });
            }
        };

        $scope.getalloffice = function () {
            $scope.alloffice = {};
            $http.get('office-settings').then(function (response) {
                if (response.data.length > 0) {
                    $scope.alloffice = response.data;
                }
            });
        };
    });
</script>
@endsection