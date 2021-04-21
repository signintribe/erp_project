@extends('layouts.admin.master')
@section('title', 'Add Quotation')
@section('content')
<div  ng-app="QuotatoionApp" ng-controller="QuotatoionController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Add Quotation</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_name">Select Customer</label>
                    <select id="customer_name" class="form-control" ng-model="quotation.customer_name">
                        <option value="">Select Customer</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_date">Quotation Date</label>
                    <input type="text" id="quotation_date" class="form-control" ng-model="quotation.quotation_date" placeholder="Quotation Date"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="goods_date">Goods through Date</label>
                    <input type="text" id="goods_date" class="form-control" ng-model="quotation.goods_date" placeholder="Goods through Date"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_status">Quotation Status</label>
                    <select id="quotation_status" class="form-control" ng-model="quotation.quotation_status">
                        <option value="">Quotation Status</option>
                        <option value="Active">Active</option>
                        <option value="In Active">In Active</option>
                        <option value="Close">Close</option>
                    </select>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="shipment_status">Shipment Status</label>
                    <select id="shipment_status" class="form-control" ng-model="quotation.shipment_status">
                        <option value="">Shipment Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Dropped">Dropped</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_balance">Customer Balance</label>
                    <input type="text" id="customer_balance" class="form-control" ng-model="quotation.customer_balance" placeholder="Customer Balance"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_total">Quotation Total</label>
                    <input type="text" ng-model="quotation.quotation_total" id="quotation_total" class="form-control" placeholder="Quotation Total"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="product_item">Product/Item</label>
                    <input type="text" id="product_item" class="form-control" ng-model="quotation.product_item" placeholder="Product/Item"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quantity">Quantity</label>
                    <input type="text" id="quantity" class="form-control" ng-model="quotation.quantity" placeholder="Quantity"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="text" id="unit_price" class="form-control" ng-model="quotation.unit_price" placeholder="Unit Price"/>
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
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_price">Total Price</label>
                    <input type="text" id="total_price" class="form-control" ng-model="quotation.total_price" placeholder="Total Price"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="job">Job</label>
                    <input type="text" id="job" class="form-control" ng-model="quotation.job" placeholder="Job"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="address">Address</label>
                    <textarea id="address" class="form-control" ng-model="quotation.address" placeholder="Address"></textarea>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" ng-model="quotation.description" placeholder="Description"></textarea>
                </div>
            </div><br/>
        </div>
    </div><br/>
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
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Quotatoion = angular.module('QuotatoionApp', []);
    Quotatoion.controller('QuotatoionController', function ($scope, $http) {

    });
</script>
@endsection