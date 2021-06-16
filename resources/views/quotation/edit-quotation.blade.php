@extends('layouts.admin.master')
@section('title', 'Edit Quotation')
@section('content')
<div  ng-app="EditQuotationApp" ng-controller="EditQuotationController" ng-cloak>
    <div class="card">
        <div class="card-body" ng-init="editQuotationInformation({{$id}}); quotation.id={{$id}}">
            <h3 class="card-title">Add Quotation</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getVendorInformation()">
                    <label for="customer_name">Select Vendor</label>
                    <select id="customer_name" class="form-control" ng-options="vendor.id as vendor.company_name for vendor in vendorinformations" ng-model="quotation.vendor_name">
                        <option value="">Select Vendor</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="item_name">Item Name</label>
                    <input type="text" id="item_name" class="form-control" ng-model="quotation.item_name" placeholder="Item Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quantity">Quantity</label>
                    <input type="text" id="quantity" class="form-control" ng-model="quotation.quantity" placeholder="Quantity"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="text" id="unit_price" class="form-control" ng-model="quotation.unit_price" placeholder="Unit Price"/>
                </div>
            </div><br/>
            <div class="row">            
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="total_price">Total Price</label>
                    <div class="form-group">                        
                        <div class="input-group">
                            <input type="text" class="form-control" readonly ng-model="quotation.total_price" placeholder=" Calculate total price" aria-label="Recipient's username">
                            <div class="input-group-append">
                            <button class="btn btn-sm btn-success" ng-click="calculate()" type="button">Calculate</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="shipment_status">Shipment Status</label>
                    <select id="shipment_status" class="form-control" ng-model="quotation.shipment_status">
                        <option value="">Shipment Status</option>
                        <option value="0">Pending</option>
                        <option value="1">Shipped</option>
                        <option value="2">Dropped</option>
                    </select>
                </div>                
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="taxes">Taxes</label>
                    <input type="text" id="taxes" class="form-control" ng-model="quotation.taxes" placeholder="Taxes"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="discount">Discount if any</label>
                    <input type="text" id="discount" class="form-control" ng-model="quotation.discount" placeholder="Discount if any"/>
                </div>
            </div><br/>
            <div class="row">            
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="address">Address</label>
                    <textarea id="address" class="form-control" ng-model="quotation.address" placeholder="Address"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-left" ng-click="save_quotationInformation()">Save</button>
                </div>
            </div><br/>
        </div>
    </div><br/><!-- 
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Account Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="payment_mode">Payment Mode</label>
                    <input type="text" id="payment_mode" class="form-control" ng-model="quotation.payment_mode" placeholder="Payment Mode"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="chartofaccount_purchase">Chart of Account Purchases</label>
                    <input type="text" id="chartofaccount_purchase" class="form-control" ng-model="quotation.chartofaccount_purchase" placeholder="Chart of Account Purchases"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="chartofaccount_payment">Chart of Account for Payment</label>
                    <input type="text" id="chartofaccount_payment" class="form-control" ng-model="quotation.chartofaccount_payment" placeholder="Chart of Account for Payment"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customeraccount_head">Customer Account Head</label>
                    <input type="text" class="form-control" id="customer_account_head" ng-model="quotation.customer_account_head" placeholder="Customer Account Head"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="paymentaccount_head">Payment Account Head</label>
                    <input type="text" id="payment_account_head" class="form-control" ng-model="quotation.payment_account_head" placeholder="Payment Account Head"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="inventoryaccount_head">Inventory A/C Head</label>
                    <input type="text" id="chartofaccount_payment" class="form-control" ng-model="quotation.chartofaccount_payment" placeholder="Chart of Account for Payment"/>
                </div>
            </div>
        </div>
    </div> -->
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var EditQuotatoion = angular.module('EditQuotationApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    EditQuotatoion.controller('EditQuotationController', function ($scope, $http) {
        $scope.quotation = {};
        $scope.appurl = $("#appurl").val();

        $scope.getVendorInformation = function () {
            $scope.vendorinformations = {};
            $http.get($scope.appurl + 'vendor/save-vendor-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.vendorinformations = response.data;
                }
            });
        };

        $scope.calculate = function(){
            if(!$scope.quotation.quantity){
              $scope.quotation.quantity = 0;
            }
            if(!$scope.quotation.unit_price){
                $scope.quotation.unit_price = 0;
            }
            $scope.quotation.total_price = parseInt($scope.quotation.quantity) * parseInt($scope.quotation.unit_price);
        };

        $scope.save_quotationInformation = function(){
            if (!$scope.quotation.vendor_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.quotation, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.appurl + 'save-quotation-information', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.editQuotationInformation();
                });
            }
        };

        $scope.editQuotationInformation = function (id) {
            $http.get($scope.appurl + 'edit-quotation-information/' + id ).then(function (response) {
                $scope.quotation = response.data;
                $scope.quotation.vendor_name = parseInt(response.data.vendor_name);
                $scope.quotation.shipment_status = response.data.shipment_status;
            });
        };
    });
</script>
@endsection