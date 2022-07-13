@extends('layouts.admin.taskTier')
@section('title', 'Recieve Inventory Form')
@section('pagetitle', 'Despatch Inventory')
@section('breadcrumb', 'Despatch Inventory')
@section('content')

<div ng-controller="DespetchInventoryController">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Inventory Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <label for="invoice_number">Invoice Number</label>
                    <input type="text" ng-model="di.invoice_number" id="invoice_number" placeholder="Invoice Number" class="form-control">
                    <i class="text-danger" ng-show="!di.invoice_number && showError"><small>Please type invoice number</small></i>
                </div>
                <div class="col">
                    <label for="pending_so">Apply to pending sales Order</label>
                    <div class="input-group">
                        <input type="search" ng-model="di.pending_so" id="pending_so" placeholder="Apply to pending sales Order" class="form-control">
                        <div class="input-group-append">
                            <button type="button" ng-click="searchPendingSo(di.pending_so, 0);" class="btn btn-md btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="<?php echo env('APP_URL') ?>sale/add-sales-order" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item" ng-repeat="so in pendingSo" style="cursor:pointer" ng-click="selectSo(so)" ng-bind="so.so_number"></li>
                    </ul>
                    <i class="text-danger" ng-show="di.so_id && showError"><small>Please select sales order</small></i>
                </div>
            </div>
        </div>
    </div>
    <div id="po_details" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sale Order Detail</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="so_number">SO Number</label>
                        <p ng-bind="so.so_number" class="form-control">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="so_date">SO Date</label>
                        <p class="form-control" ng-bind="so.so_date"></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="apply_to">Quotation Information</label>
                        <p class="form-control" ng-bind="so.quotation_number"></p>
                    </div>
                </div><br/>
            </div>
        </div><br/>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Customer Details</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="vendor">Search Customer</label>
                        <p class="form-control" ng-bind="so.customer_name"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="quotation_till">Quotation Valid Till</label>
                        <p class="form-control" ng-bind="so.quotation_till"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="delivery_date">Delivery Date</label>
                        <p class="form-control" ng-bind="so.delivery_date"></p>
                    </div>
                </div><br>
                <div class="row" id="checklist" style="display: none;">
                    <div class="col">
                        <h5 for="card-title">List of Document</h5><hr/>
                        <div class="row" ng-repeat="chklst in checList">
                            <ul style="list-style:none;">
                                <li ng-if="chklst.checklist == 'principal_performa'">
                                    <label>Principal performa invoce with sign & stamp on company letter head</label>
                                </li>
                                <li ng-if="chklst.checklist == 'agency_agreement'">
                                    <label for="agency_agreement">Agency agreement with sign & stamp on company letter head</label>
                                </li>
                                <li ng-if="chklst.checklist == 'oem_certificate'">
                                    <label for="oem_certificate">OEM Certificate</label>
                                </li>
                                <li ng-if="chklst.checklist == 'atp'">
                                    <label for="atp">ATP</label>
                                </li>
                                <li ng-if="chklst.checklist == 'compliance_sheet'">
                                    <label for="compliance_sheet">Compliance Sheet</label>
                                </li>
                                <li ng-if="chklst.checklist == 'company_profile'">
                                    <label for="company_profile">Company Profile/Certificate</label>
                                </li>
                                <li ng-if="chklst.checklist == 'warrenty'">
                                    <label for="warrenty">Warrenty / Guarantee acceptence as per IT</label>
                                </li>
                                <li ng-if="chklst.checklist == 'technical_offer'">
                                    <label for="technical_offer">Complete Technical Offer</label>
                                </li>
                                <li ng-if="chklst.checklist == 'trade_link'">
                                    <label for="trade_link">Complete Trade Link</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><hr/>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Item Details</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="product_item">Search Product/Item</label>
                        <p class="form-control" ng-bind="so.product_name"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="unit_price">Unit Price</label>
                        <p ng-bind="so.unit_price" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="qty">Due Quantity</label>
                        <p ng-bind="so.quantity" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" id="received" style="display: none;">
                        <label for="despatch_qty">Despatch Qty</label>
                        <div ng-if="(so.quantity - so.despatch_qty) > 0">
                            <input type="text" ng-model="di.despatch_qty" ng-keyup="lessQuantity(di.despatch_qty)" id="despatch_qty" placeholder="Despatch Qty" class="form-control">
                            <i class="text-danger" ng-show="di.despatch_qty && showError"><small>Please type despatch quantity</small></i>
                        </div>
                        <p ng-if="(so.quantity - so.despatch_qty) == 0" ng-bind="despatch_all"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" id="receivedforedit" style="display: none;">
                        <label for="despatch_qty">Despatch Qty</label>
                        <div>
                            <input type="text" ng-model="di.despatch_qty" id="despatch_qty" ng-keyup="netAmount()" placeholder="Received Qty" class="form-control">
                            <i class="text-danger" ng-show="di.despatch_qty && showError"><small>Please type despatch quantity</small></i>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" id="remaining" style="display:none;">
                        <label for="remaining_qty">Remaining Qty</label>
                        <input type="text" ng-model="di.remaining_quantity" readonly id="remaining_qty" placeholder="Remaining Qty" class="form-control">
                        <i class="text-danger" id="remain" ng-show="di.remaining_quantity && showError"><small>Remaining quantity is not calculate Due - Received</small></i>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="gross_price">Gross Price</label>
                        <p ng-bind="so.gross_price" class="form-control"></p>
                    </div>
                </div><br>
                <div class="row" id="TaxRow" style="display: none;">
                    <div class="col">
                        <h5>Add Taxes</h5>
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th>Tax Name</th>
                                <th>Tax Percentage</th>
                            </tr>
                            <tr ng-repeat="adtx in AddTaxes">
                                <td ng-bind="adtx.tax_name"></td>
                                <td>
                                    <span ng-bind="adtx.tax_percentage"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Total Tax
                                </th>
                                <td>
                                    <span ng-bind="totalTaxes"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div><br/>
                <div class="row" id="LogisticRow" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col"><h5>Delivery Charges</h5></div>
                        </div><br/>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Logistic Type</th>
                                    <th>Delivery Charges</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="logc in logisticscharges">
                                    <td ng-bind="logc.logistic_type"></td>
                                    <td ng-bind="logc.delivery_charges"></td>
                                </tr>
                                <tr>
                                    <th>Total Charges</th>
                                    <td ng-bind="so.total_delivery_charges"></t>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Discount Name</label>
                        <p ng-bind="so.discount_name" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Discount Amount</label>
                        <p ng-bind="so.discount_amount" class="form-control discount_amount"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Net Amount</label>
                        <p ng-bind="so.net_amount" class="form-control net_amount"></p>
                    </div>
                </div><br>
                <!-- <button class="btn btn-sm btn-primary" style="display: none;" id="showcalc" ng-click="netAmount()">Calculate</button> -->
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Payment Terms</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Advance Percentage</label>
                        <p ng-bind="so.advance_percentage" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Time Of Advance</label>
                        <p ng-bind="so.time_advance" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Payment Type</label>
                        <p ng-bind="so.payment_type" class="form-control"></p>
                    </div>
                </div><br>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Special Note Description</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p ng-bind="so.description" class="form-control"></p>
                    </div>
                </div><br/>
                <button class="btn btn-sm float-right btn-success" ng-click="saveDespatchInventory()"> <i class="fa fa-save" id="loader"></i> Submit</button>
            </div>
        </div>
    </div>
    <input type="hidden" id="company_id" value="<?php echo session('company_id'); ?>">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Receive Inventories</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SO Number</th>
                        <th>Invoice Number</th>
                        <th>Due Quantity</th>
                        <th>Receive Quantity</th>
                        <th>Gross Price</th>
                        <th>Net Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getDespatchInventroy()">
                    <tr ng-repeat="des in dis">
                        <td ng-bind="des.so_number"></td>
                        <td ng-bind="des.invoice_number"></td>
                        <td ng-bind="des.due_quantity"></td>
                        <td ng-bind="des.despatch_qty"></td>
                        <td ng-bind="des.new_gross_price"></td>
                        <td ng-bind="des.new_net_amount"></td>
                        <td>
                            <div class="btn-group">
                                <!-- <button class="btn btn-info btn-xs"ng_click="editRI(ri.id)">Edit</button> -->
                                <button class="btn btn-danger btn-xs" ng-click="deleteDI(des.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table><br/>
            <div class="text-center">
                <button id="loadMorebtn" class="btn btn-sm btn-primary" ng-click="loadMore()"> <i class="fa fa-spinner"></i> Load More</button>
                <p ng-if="nomore" ng-bind="nomore"></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('internaljs')
<script src="{{asset('ng_controllers/sales/despatch_inventory.js')}}"></script>
@endsection