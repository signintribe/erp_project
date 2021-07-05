@extends('layouts.admin.master')
@section('title', 'Add Purchase Order')
@section('content')
<div  ng-app="POApp" ng-controller="POController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Add Purchase Order</h3>
            <div class="row" ng-init="getVendorInfo()">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="vendor_id">Vendor Name</label>
                    <select id="vendor_id" class="form-control" ng-options="vendor.id as vendor.organization_name for vendor in vendors" ng-model="po.vendor_id">
                        <option value="">Select Vendor</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" id="mobile_number" class="form-control" ng-model="po.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="po_date">PO Date</label>
                    <input type="text" id="po_date" class="form-control" ng-model="po.po_date" placeholder="PO Date"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="goods_date">Goods through Date</label>
                    <input type="text" id="goods_date" class="form-control" ng-model="po.goods_date" placeholder="Goods through Date"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="po_status">PO Status</label>
                    <select id="po_status" class="form-control" ng-model="po.po_status">
                        <option value="">Select PO Status</option>
                        <option value="Active">Active</option>
                        <option value="In Active">In Active</option>
                        <option value="Close">Close</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="shipment_status">Shipment Status</label>
                    <select id="shipment_status" class="form-control" ng-model="po.shipment_status">
                        <option value="">Select Shipment Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Dropped">Dropped</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_po">Purchase Order Total</label>
                    <input type="text" id="total_po" class="form-control" ng-model="po.total_po" placeholder="Purchase Order Total"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="job">Job</label>
                    <input type="text" id="job" class="form-control" ng-model="po.job" placeholder="Job"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="payment_mode">Payment Mode</label>
                    <input type="text" id="payment_mode" class="form-control" ng-model="po.payment_mode" placeholder="Payment Mode"/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="address">Address</label>
                    <textarea id="address" class="form-control" ng-model="po.address" placeholder="Address"></textarea>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" ng-model="po.description" placeholder="Description"></textarea>
                </div>
            </div><br/>
            <div class="row" ng-init="getAccounts()">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="chartofaccount_purchase">Chart of Account Purchases</label>
                    <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="po.chartofaccount_purchase">
                        <option value="">Chart of Account Purchases</option>
                    </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                <label for="chartofaccount_payment">Chart of Account for Payment</label>
                    <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="po.chartofaccount_payment">
                        <option value="">Chart of Account for Payment</option>
                    </select>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Product Category</h3>
            <div class="row" ng-init="getInventoryInfo()">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pro_id">Product Name</label>
                    <select id="pro_id" class="form-control" ng-change="getProductInfo(pro.id)" ng-options="pro.id as pro.product_name for pro in products" ng-model="po.product_id">
                        <option value="">Select Product/Item</option>
                    </select>
                </div>               
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quantity">Quantity</label>
                    <input type="text" id="quantity" class="form-control" ng-model="po.quantity" placeholder="Quantity"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="text" id="unit_price" class="form-control" ng-model="po.unit_price" placeholder="Unit Price"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="taxes">Taxes</label>
                    <input type="text" id="taxes" class="form-control" ng-model="po.taxes" placeholder="Taxes"/>
                </div> -->
            </div><br/>
            <table class="table table-bordered" ng-if="allproducts">
                <thead>
                    <th>Sr#</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>Tax</th>
                </thead>
                <tbody ng-repeat="pro in allproducts">
                    <td ng-bind="$index+1"></td>
                    <td ng-bind="pro.id"></td>
                    <td ng-bind="pro.name"></td>
                    <td ng-bind="pro.unit_price"></td>
                    <td><input type="text" id="quantity" class="form-control" ng-model="po.quantity" placeholder="Quantity"/></td>
                    <td><input type="text" id="taxes" class="form-control" ng-model="po.taxes" placeholder="Taxes"/></td>
                    <td><input type="text" id="discount" class="form-control" ng-model="po.discount" placeholder="Discount if any"/></td>
                </tbody>
            </table><br/>
            <!-- <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="discount">Discount if any</label>
                    <input type="text" id="discount" class="form-control" ng-model="po.discount" placeholder="Discount if any"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_price">Total Price</label>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly ng-model="po.total_price" placeholder="Total Price" aria-label="Recipient's username">
                            <div class="input-group-append">
                            <button class="btn btn-sm btn-success" ng-click="calculate()" type="button">Calculate</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-success btn-sm float-right" ng-click="savePurchaseOrder()">Save</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var PO = angular.module('POApp', []);
    PO.controller('POController', function ($scope, $http) {
        $scope.po = {};
        $scope.appurl = $("#appurl").val();
        $scope.getAccounts = function () {
            var Accounts = $http.get($scope.appurl + 'AllchartofAccount');
            Accounts.then(function (r) {
                $scope.Accounts = r.data;
            });
        };

        $scope.getVendorInfo = function () {
            $scope.vendors = {};
            $http.get('vendor/maintain-vendor-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.vendors = response.data;
                }
            });
        };

        $scope.getInventoryInfo = function(){
            $scope.products = {};
            $http.get('get-inventory').then(function (response) {
                if (response.data.length > 0) {
                    $scope.products = response.data;
                }
            });
        };

        $scope.calculate = function(){
            if(!$scope.po.unit_price){
              $scope.po.unit_price = 0;
            }
            if(!$scope.po.quantity){
              $scope.po.quantity = 0;
            }
            if(!$scope.po.taxes){
              $scope.po.taxes = 0;
            }
            if(!$scope.po.discount){
              $scope.po.discount = 0;
            }

            $scope.total = parseInt($scope.po.unit_price) * parseInt($scope.po.quantity) - parseInt($scope.po.discount);
            $scope.po.total_price = $scope.total - parseInt($scope.po.taxes);
        };

        $scope.getProductInfo = function(pro_id){
            $scope.allproducts = {};
            $http.get('get_pro_info/' + pro_id).then(function (response)){
                $scope.allproducts = response.data;
            }
        };

        $scope.savePurchaseOrder = function(){
            if (!$scope.po.mobile_number) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.po, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('save-purchase-order', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.po = {};
                });
            }
        };
    });
</script>
@endsection