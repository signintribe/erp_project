@extends('layouts.admin.taskTier')
@section('title', 'Add Purchase Order')
@section('pagetitle', 'Add Purchase Order')
@section('breadcrumb', 'Add Purchase Order')
@section('content')
<div ng-controller="POController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Purchase Order Detail</h3>
        </div>
        <div class="card-body">
            <div class="row" ng-init="getVendorInfo(); getAccounts()">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="po_number">PO Number</label>
                    <input type="text" id="po_number" class="form-control"  ng-model="po.po_number" placeholder="PO Number">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="po_date">PO Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="po_date" data-target-input="nearest">
                            <input type="text" placeholder="PO Date" ng-model="po.po_date" class="form-control datetimepicker-input" data-target="#po_date"/>
                            <div class="input-group-append" data-target="#po_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="apply_to">Apply To Quotation</label>
                    <input type="text" id="apply_to" class="form-control" ng-model="po.apply_to" placeholder="Apply To Quotation"/>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Vendor Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="vendor_id">Search Vendor</label>
                    <input type="text" name="po.vendor_id" id="vendor_id" placeholder="Search Vendor" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="po_valid">PO Valid Till</label>
                    <div class="form-group">
                        <div class="input-group date" id="po_valid" data-target-input="nearest">
                            <input type="text" placeholder="PO Valid Till" ng-model="po.po_valid" class="form-control datetimepicker-input" data-target="#po_valid"/>
                            <div class="input-group-append" data-target="#po_valid" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="delivery_date">Delivery Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="delivery_date" data-target-input="nearest">
                            <input type="text" placeholder="Delivery Date" ng-model="po.delivery_date" class="form-control datetimepicker-input" data-target="#delivery_date"/>
                            <div class="input-group-append" data-target="#delivery_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5 for="card-title">List of Document</h5><hr/>
                    <div class="row">
                        <div class="col">
                        <label for="principal_performa">Principal performa invoce with sign & stamp on company letter head</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="principal_performa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="agency_agreement">Agency agreement with sign & stamp on company letter head</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="agency_agreement">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="oem_certificate">OEM Certificate</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="oem_certificate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="atp">ATP</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="atp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="compliance_sheet">Compliance Sheet</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="compliance_sheet">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="company_profile">Company Profile/Certificate</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="company_profile">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="warrenty">Warrenty / Guarantee acceptence as per IT</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="warrenty">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="special_instruction">Special Instruction Compliance</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="special_instruction">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="technical_offer">Complete Technical Offer</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="technical_offer">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="trade_link">Complete Trade Link</label>
                        </div>
                        <div class="col text-right">
                            <input type="checkbox"  id="trade_link">
                        </div>
                    </div>
                </div>
            </div><hr/>
        </div>
    </div>
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