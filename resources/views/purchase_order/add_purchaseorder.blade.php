@extends('layouts.admin.taskTier')
@section('title', 'Add Purchase Order')
@section('pagetitle', 'Add Purchase Order')
@section('breadcrumb', 'Add Purchase Order')
@section('content')
<div ng-controller="POController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Purchase Order</h3>
        </div>
        <div class="card-body">
            <div class="row" ng-init="getVendorInfo(); getAccounts()">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="vendor_id">Vendor Name</label>
                    <select id="vendor_id" class="form-control" ng-change="getVendors(po.vendor_id)" ng-options="vendor.id as vendor.organization_name for vendor in vendors" ng-model="po.vendor_id">
                        <option value="">Select Vendor</option>
                    </select>
                    <table class="table table-bordered table-striped" ng-if="vendorinfo">
                        <tbody ng-repeat="ven in vendorinfo">
                            <tr>
                                <td ng-bind="ven.organization_name"></td>
                            </tr>
                            <tr>
                             <td ng-bind="ven.address_line_1"></td>
                            </tr>
                            <tr>
                                <td ng-bind="ven.street"></td>
                            </tr>
                            <tr>
                                <td ng-bind="ven.city"></td>
                                <td ng-bind="ven.zip_code"></td>
                            </tr>
                            <tr>
                                <td ng-bind="ven.country"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="po_date">PO Date</label>
                            <input type="text" id="po_date" class="form-control" datepicker ng-model="po.po_date" placeholder="PO Date"/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="goods_date">Goods through Date</label>
                            <input type="text" id="goods_date" class="form-control" datepicker ng-model="po.goods_date" placeholder="Goods through Date"/>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="po_status">PO Status</label>
                            <select id="po_status" class="form-control" ng-model="po.po_status">
                                <option value="">Select PO Status</option>
                                <option value="Active">Active</option>
                                <option value="In Active">In Active</option>
                                <option value="Close">Close</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="shipment_status">Shipment Status</label>
                            <select id="shipment_status" class="form-control" ng-model="po.shipment_status">
                                <option value="">Select Shipment Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Dropped">Dropped</option>
                            </select>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="ship_via">Ship Via</label>
                            <input type="text" id="ship_via" class="form-control" ng-model="po.ship_via" placeholder="Ship Via"/>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="chartofaccount_purchase">Chart of Account Purchases</label>
                            <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="po.chartofaccount_purchase">
                                <option value="">Chart of Account Purchases</option>
                            </select>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="chartofaccount_payment">Chart of Account for Payment</label>
                            <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="po.chartofaccount_payment">
                                <option value="">Chart of Account for Payment</option>
                            </select>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Product Category</h3>
        </div>
        <div class="card-body">
            <div class="row" ng-init="getInventoryInfo()">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pro_id">Product Name</label>
                    <select id="pro_id" class="form-control" ng-change="getProductInfo(po.product_id)" ng-options="pro.id as pro.product_name for pro in products" ng-model="po.product_id">
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
            <div class="row" ng-if="allproducts.length > 0" id="add">
                <table class="table table-bordered">
                    <thead>
                        <th>Sr#</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Job</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Tax</th>
                        <th>Discount</th>
                        <th>Action</th>
                    </thead>
                    <tbody ng-repeat="pro in allproducts">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="pro.product_id"></td>
                        <td ng-bind="pro.product_name"></td>
                        <td ng-bind="pro.product_description"></td>
                        <td><input type="text" id="job" class="form-control" ng-model="pro.job" placeholder="Job"/></td>
                        <td ng-bind="pro.unit_price"></td>
                        <td><input type="text" id="quantity" class="form-control" ng-model="pro.quantity" placeholder="Quantity"/></td>
                        <td><input type="text" id="taxes" class="form-control" ng-model="pro.taxes" placeholder="Taxes"/></td>
                        <td><input type="text" id="discount" class="form-control" ng-model="pro.discount" placeholder="Discount if any"/></td>
                        <td><button class="btn btn-xs btn-success bill-btn" id="add<%pro.product_id%>" ng-click="addProduct(pro)">Add</button></td>
                    </tbody>
                </table>
            </div><br/>
            <div class="row" ng-if="addToCart.length > 0" id="show">
                <table class="table table-bordered">
                    <thead>
                        <th>Sr#</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Job</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Tax</th>
                        <th>Discount</th>
                        <th>Total Price</th>
                    </thead>
                    <tbody ng-repeat="cart in addToCart">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="cart.product_id"></td>
                        <td ng-bind="cart.product_name"></td>
                        <td ng-bind="cart.product_description"></td>
                        <td ng-bind="cart.job"></td>
                        <td ng-bind="cart.unit_price"></td>
                        <td ng-bind="cart.quantity"></td>
                        <td ng-bind="cart.taxes"></td>
                        <td ng-bind="cart.discount"></td>
                        <td ng-bind="cart.total_price"></td>
                    </tbody>
                </table>
            </div></br>
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
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/purchases/add-po.js')}}"></script>
@endsection