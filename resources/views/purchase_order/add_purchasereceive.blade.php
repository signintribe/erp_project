@extends('layouts.admin.master')
@section('title', 'Add Purchase Receive')
@section('content')
<div  ng-app="PRApp" ng-controller="PRController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Add Purchase Receive</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="vendor_name">Select Vendor</label>
                    <select id="vendor_name" class="form-control" ng-model="pr.vendor_name">
                        <option value="">Select Vendor</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="goods_date">Goods receive date</label>
                    <input type="text" id="goods_date" class="form-control" ng-model="pr.goods_date" placeholder="Goods receive date"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="invoice_number">Invoice Number</label>
                    <input type="text" id="invoice_number" class="form-control" ng-model="pr.invoice_number" placeholder="Invoice Number"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="receiver_name">Employee Receive Goods</label>
                    <select id="receiver_name" class="form-control" ng-model="pr.receiver_name">
                        <option value="">Employee Receive Goods</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="store_detail">Store/Godown Detail</label>
                    <input type="text" id="store_detail" class="form-control" ng-model="pr.store_detail" placeholder="Store/Godown Detail"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="po_number">PO Number</label>
                    <select id="po_number" class="form-control" ng-model="pr.po_number">
                        <option value="">PO Number</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="product_item">Product/Item</label>
                    <input type="text" id="product_item" class="form-control" ng-model="pr.product_item" placeholder="Product/Item"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quantity">Quantity</label>
                    <input type="text" id="quantity" class="form-control" ng-model="pr.quantity" placeholder="Quantity"/>
                </div><!-- 
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="text" id="unit_price" class="form-control" ng-model="pr.unit_price" placeholder="Unit Price"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="taxes">Taxes</label>
                    <input type="text" id="taxes" class="form-control" ng-model="pr.taxes" placeholder="Taxes"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="discount">Discount if any</label>
                    <input type="text" id="discount" class="form-control" ng-model="pr.discount" placeholder="Discount if any"/>
                </div> -->
            </div><br/>
            <!-- <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_price">Total Price</label>
                    <input type="text" id="total_price" class="form-control" ng-model="pr.total_price" placeholder="Total Price"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="job">Job</label>
                    <input type="text" id="job" class="form-control" ng-model="pr.job" placeholder="Job"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="payment_mode">Payment Mode</label>
                    <input type="text" id="payment_mode" class="form-control" ng-model="pr.payment_mode" placeholder="Payment Mode"/>
                </div>
            </div><br/> -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="chartofaccount_purchase">Chart of Account Purchases</label>
                    <input type="text" id="chartofaccount_purchase" class="form-control" ng-model="pr.chartofaccount_purchase" placeholder="Chart of Account Purchases"/>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="chartofaccount_payment">Chart of Account for Payment</label>
                    <input type="text" id="chartofaccount_payment" class="form-control" ng-model="pr.chartofaccount_payment" placeholder="Chart of Account for Payment"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" ng-model="pr.description" placeholder="Description"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var PR = angular.module('PRApp', []);
    PR.controller('PRController', function ($scope, $http) {

    });
</script>
@endsection