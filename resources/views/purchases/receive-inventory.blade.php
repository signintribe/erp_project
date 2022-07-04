@extends('layouts.admin.taskTier')
@section('title', 'Recieve Inventory Form')
@section('pagetitle', 'Recieve Inventory')
@section('breadcrumb', 'Recieve Inventory')
@section('content')

<div ng-controller="ReceiveInventoryController">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Inventory Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <label for="invoice_number">Invoice Number</label>
                    <input type="text" ng-model="ri.invoice_number" id="invoice_number" placeholder="Invoice Number" class="form-control">
                    <i class="text-danger" ng-show="!ri.invoice_number && showError"><small>Please type invoice number</small></i>
                </div>
                <div class="col">
                    <label for="pending_po">Apply to pending purchase Order</label>
                    <div class="input-group">
                        <input type="search" ng-model="ri.pending_po" id="pending_po" placeholder="Apply to pending purchase Order" class="form-control">
                        <div class="input-group-append">
                            <button type="button" ng-click="searchPendingPo(ri.pending_po, 0);" class="btn btn-md btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="<?php echo env('APP_URL') ?>purchases/add-purchase-order" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item" ng-repeat="po in pendingPo" style="cursor:pointer" ng-click="selectPo(po)" ng-bind="po.po_number"></li>
                    </ul>
                    <i class="text-danger" ng-show="!ri.po_id && showError"><small>Please select purchase order</small></i>
                </div>
            </div>
        </div>
    </div>
    <div id="po_details" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Purchase Order Detail</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="po_number">PO Number</label>
                        <p ng-bind="po.po_number" class="form-control">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="po_date">PO Date</label>
                        <p class="form-control" ng-bind="po.po_date"></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="apply_to">Apply To Quotation</label>
                        <p class="form-control" ng-bind="po.quotation_number"></p>
                    </div>
                </div><br/>
            </div>
        </div><br/>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Vendor Details</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="vendor">Search Vendor</label>
                        <p class="form-control" ng-bind="po.organization_name"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="quotation_till">Quotation Valid Till</label>
                        <p class="form-control" ng-bind="po.quotation_till"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="delivery_date">Delivery Date</label>
                        <p class="form-control" ng-bind="po.delivery_date"></p>
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
                        <p class="form-control" ng-bind="po.product_name"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="unit_price">Unit Price</label>
                        <p ng-bind="po.unit_price" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="qty">Due Quantity</label>
                        <p ng-bind="po.quantity" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" id="received" style="display: none;">
                        <label for="received_qty">Received Qty <% po.quantity %>, <% po.received_qty %></label>
                        <div ng-if="(po.quantity - po.received_qty) > 0">
                            <input type="text" ng-model="ri.received_qty" ng-keyup="lessQuantity(ri.received_qty)" id="received_qty" placeholder="Received Qty" class="form-control">
                            <i class="text-danger" ng-show="!ri.received_qty && showError"><small>Please type received quantity</small></i>
                        </div>
                        <p ng-if="(po.quantity - po.received_qty) == 0" ng-bind="received_all"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" id="receivedforedit" style="display: none;">
                        <label for="received_qty">Received Qty</label>
                        <div>
                            <input type="text" ng-model="ri.received_qty" id="received_qty" ng-keyup="netAmount()" placeholder="Received Qty" class="form-control">
                            <i class="text-danger" ng-show="!ri.received_qty && showError"><small>Please type received quantity</small></i>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3" id="remaining" style="display:none;">
                        <label for="remaining_qty">Remaining Qty</label>
                        <input type="text" ng-model="ri.remaining_quantity" readonly id="remaining_qty" placeholder="Remaining Qty" class="form-control">
                        <i class="text-danger" id="remain" ng-show="!ri.remaining_quantity && showError"><small>Remaining quantity is not calculate Due - Received</small></i>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="gross_price">Gross Price</label>
                        <p ng-bind="po.gross_price" class="form-control"></p>
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
                                    <td ng-bind="po.total_delivery_charges"></t>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Discount Name</label>
                        <p ng-bind="po.discount_name" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Discount Amount</label>
                        <p ng-bind="po.discount_amount" class="form-control discount_amount"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Net Amount</label>
                        <p ng-bind="po.net_amount" class="form-control net_amount"></p>
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
                        <p ng-bind="po.advance_percentage" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Time Of Advance</label>
                        <p ng-bind="po.time_advance" class="form-control"></p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="">Payment Type</label>
                        <p ng-bind="po.payment_type" class="form-control"></p>
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
                        <p ng-bind="po.description" class="form-control"></p>
                    </div>
                </div><br/>
                <button class="btn btn-sm float-right btn-success" ng-click="saveReceiveInventory()"> <i class="fa fa-save" id="loader"></i> Submit</button>
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
                        <th>PO Number</th>
                        <th>Invoice Number</th>
                        <th>Due Quantity</th>
                        <th>Receive Quantity</th>
                        <th>Gross Price</th>
                        <th>Net Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getReceiveInventroy()">
                    <tr ng-repeat="ri in ris">
                        <td ng-bind="ri.po_number"></td>
                        <td ng-bind="ri.invoice_number"></td>
                        <td ng-bind="ri.due_quantity"></td>
                        <td ng-bind="ri.received_qty"></td>
                        <td ng-bind="ri.new_gross_price"></td>
                        <td ng-bind="ri.new_net_amount"></td>
                        <td>
                            <div class="btn-group">
                                <!-- <button class="btn btn-info btn-xs"ng_click="editRI(ri.id)">Edit</button> -->
                                <button class="btn btn-danger btn-xs" ng-click="deleteRI(ri.id)">Delete</button>
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
<script src="{{asset('ng_controllers/purchases/receive_inventory.js')}}"></script>
@endsection