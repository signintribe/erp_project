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
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="po_number">PO Number</label>
                    <input type="text" id="po_number" class="form-control"  ng-model="po.po_number" placeholder="PO Number">
                    <i class="text-danger" ng-show="!po.po_number && showError"><small>Please type PO number</small></i>
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
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="apply_to">Apply To Quotation</label>
                    <div class="input-group">
                        <input type="search" ng-model="po.apply_to" class="form-control" placeholder="Search Your Quotation">
                        <div class="input-group-append">
                            <button type="button" ng-click="getAppliedTo(po.apply_to);" class="btn btn-md btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="<?php echo env('APP_URL') ?>purchases/quotation-purchases" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item" style="cursor: pointer" ng-click="assignQuotation(quot)" ng-repeat="quot in quotation" ng-bind="quot.quotation_number"></li>
                    </ul>
                    <i class="text-danger" ng-show="!po.quotation_id && showError"><small>Please select Quotation</small></i>
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
                    <div class="input-group">
                        <input type="search" ng-model="po.vendor" class="form-control" placeholder="Search Your Quotation">
                        <div class="input-group-append">
                            <button type="button" ng-click="searchVendor(po.vendor);" class="btn btn-md btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="<?php echo env('APP_URL') ?>vendor/vendor-information" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group" ng-if="vendorinfo">
                        <li class="list-group-item" ng-click="selectVendor(vend)" style="cursor:pointer" ng-repeat="vend in vendorinfo" ng-bind="vend.organization_name"></li>
                    </ul>
                    <i class="text-danger" ng-show="!po.vendor_id && showError"><small>Please select vendor</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_till">Quotation Valid Till</label>
                    <div class="form-group">
                        <div class="input-group date" id="quotation_till" data-target-input="nearest">
                            <input type="text" placeholder="Quotation Valid Till" ng-model="po.quotation_till" class="form-control datetimepicker-input" data-target="#quotation_till"/>
                            <div class="input-group-append" data-target="#quotation_till" data-toggle="datetimepicker">
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
            </div><br>
            <div class="row">
                <div class="col">
                    <h5 for="card-title">List of Document</h5><hr/>
                    <div class="row">
                        <div class="col">
                        <label for="principal_performa">Principal performa invoce with sign & stamp on company letter head</label>
                        </div>
                        <div class="col">
                            <input type="checkbox" ng-click="getCheckList('principal_performa')" id="principal_performa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="agency_agreement">Agency agreement with sign & stamp on company letter head</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  ng-click="getCheckList('agency_agreement')" id="agency_agreement">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="oem_certificate">OEM Certificate</label>
                        </div>
                        <div class="col">
                            <input type="checkbox" ng-click="getCheckList('oem_certificate')" id="oem_certificate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="atp">ATP</label>
                        </div>
                        <div class="col">
                            <input type="checkbox" ng-click="getCheckList('atp')"  id="atp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="compliance_sheet">Compliance Sheet</label>
                        </div>
                        <div class="col">
                            <input type="checkbox" ng-click="getCheckList('compliance_sheet')"  id="compliance_sheet">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="company_profile">Company Profile/Certificate</label>
                        </div>
                        <div class="col">
                            <input type="checkbox" ng-click="getCheckList('company_profile')" id="company_profile">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="warrenty">Warrenty / Guarantee acceptence as per IT</label>
                        </div>
                        <div class="col">
                            <input type="checkbox" ng-click="getCheckList('warrenty')" id="warrenty">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="special_instruction">Special Instruction Compliance</label>
                        </div>
                        <div class="col">
                            <input type="checkbox" ng-click="getCheckList('special_instruction')"  id="special_instruction">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="technical_offer">Complete Technical Offer</label>
                        </div>
                        <div class="col">
                            <input type="checkbox" ng-click="getCheckList('technical_offer')"  id="technical_offer">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="trade_link">Complete Trade Link</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  ng-click="getCheckList('trade_link')" id="trade_link">
                        </div>
                    </div>
                </div>
            </div><hr/>
            <!-- <div class="row">
                <div class="col-6">
                    <label for="">Delivery Address</label>
                    <input type="text" ng-model="po.delivery_address" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Shipment Status</label>
                    <select ng-model="po.shipment_status" id="" class="form-control">
                        <option value="">Pending</option>
                        <option value="">Shipped</option>
                        <option value="">Droped</option>
                        <option value="">Delivered</option>
                    </select>
                </div>
            </div><br> -->
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
                    <div class="input-group">
                        <input type="search" ng-model="po.product_item" class="form-control" placeholder="Search Your Quotation">
                        <div class="input-group-append">
                            <button type="button" ng-click="getInventory(po.product_item);" class="btn btn-md btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="<?php echo env('APP_URL') ?>add-inventory" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group" ng-if="allinventories">
                        <li class="list-group-item" ng-click="selectProduct(prod)" style="cursor:pointer" ng-repeat="prod in allinventories" ng-bind="prod.product_name"></li>
                    </ul>
                    <i class="text-danger" ng-show="!po.product_id && showError"><small>Please select product</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="text" ng-model="po.unit_price" id="unit_price" placeholder="Unit Price" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="qty">Quantity</label>
                    <input type="text" ng-model="po.quantity" ng-blur="grossPrice();" placeholder="Quantity" id="qty" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="gross_price">Gross Price</label>
                    <input type="text" ng-model="po.gross_price" ng-click="grossPrice()" readonly placeholder="Gross Price" id="gross_price" class="form-control">
                </div>
            </div><br>
            <!-- <div class="row">
                <div class="col-6">
                    <label for="">Cahrt Of Account Debit</label>
                    <select ng-model="po.account_debit" id="" class="form-control">
                        <option value="">Chart of Account Debit</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Chart Of Account Credit</label>
                    <select ng-model="po.account_credit" id="" class="form-control">
                        <option value="">Chart Of Account Credit</option>
                    </select>
                </div>
            </div><br> -->
            <div class="row">
                <div class="col-10"><h5>Add Taxes</h5></div>
                <!-- <div class="col-2 float-right">
                    <button class="btn-primary" onclick="Addrow();">+Add Row</button>
                </div> -->
                <div class="col-2">
                    <div class="btn-group float-right">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#taxModal"><i class="fa fa-plus"></i> Add Tax</button>
                        <button class="btn btn-sm btn-warning" ng-click="cancelTax(); getCompanyTaxes();">Cancel</button>
                    </div>
                    <!-- Tax Modal -->
                    <div id="taxModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">All Taxes</h4>
                                    <div class="btn-group text-right">
                                        <a class="btn btn-sm btn-primary" href="<?php echo env('APP_URL') ?>bank/Taxes"><i class="fa fa-plus"></i> Add New Tax</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> </button>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-sm table-bordered" ng-init="getCompanyTaxes()">
                                        <tr>
                                            <th>Authority Name</th>
                                            <th>Tax Name</th>
                                            <th>Tax Percentage</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr ng-repeat="tx in Taxes">
                                            <td ng-bind="tx.authority_name"></td>
                                            <td ng-bind="tx.tax_name"></td>
                                            <td ng-bind="tx.tax_percentage"></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs btn-success btn-addtax" id="addtax<% tx.id %>" ng-click="selectedTax(tx)">Add</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><br/>
            <table class="table table-sm table-bordered">
                <tr>
                    <th>Authority Name</th>
                    <th>Tax Name</th>
                    <th>Tax Percentage</th>
                </tr>
                <tr ng-repeat="adtx in AddTaxes">
                    <td ng-bind="adtx.authority_name"></td>
                    <td ng-bind="adtx.tax_name"></td>
                    <td ng-bind="adtx.tax_percentage"></td>
                </tr>
                <tr>
                    <th colspan="2">
                        Total Tax
                    </th>
                    <td>
                        <span ng-bind="totalTaxes"></span>
                    </td>
                </tr>
            </table>
            <br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" ng-init="getLogisticInfo()">
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 col-md-8"><h5>Delivery Charges</h5></div>
                        <div class="col-lg-4 col-sm-4 col-md-4">
                            <div class="btn-group float-right">
                                <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#deliverChargesModal"><i class="fa fa-plus"></i> Add Delivery Charges</button>
                                <button class="btn btn-sm btn-warning" ng-click="cancelDeliveryCharges()">Cancel</button>
                            </div>
                            <!-- Tax Modal -->
                            <div id="deliverChargesModal" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">All Logistics</h4>
                                            <div class="btn-group text-right">
                                                <a class="btn btn-sm btn-primary" href="<?php echo env('APP_URL') ?>sourcing/view-logistic"><i class="fa fa-plus"></i> Add New Logistics</a>
                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> </button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Logistic Type</th>
                                                    <th>Delivery Charges</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="logistic in logisticsInfo">
                                                    <td ng-bind="logistic.logistic_type"></td>
                                                    <td>
                                                        <input type="text" ng-model="logistic.delivery_charges" id="" class="form-control">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary" id="addCharges<% logistic.id %>" ng-click="addDeliveryCharges(logistic.delivery_charges, logistic)">Add</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
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
                                <td ng-bind="logc.delivery"></td>
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
                    <input type="text" ng-model="po.discount_name" id="discount_name" placeholder='Discount Name' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Discount Amount</label>
                    <input type="text" ng-model="po.discount_amount" ng-blur="lessDiscount()" id="discount_amount" placeholder='Discount Amount' class="form-control discount_amount">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Net Amount</label>
                    <input type="text" ng-model="po.net_amount" id="net_amount" placeholder='Net Amount' class="form-control net_amount">
                </div>
            </div><br>
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
                    <input type="text" ng-model="po.advance_percentage" id="" placeholder='Advance Percentage' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Time Of Advance</label>
                    <select ng-model="po.time_advance" id="" class="form-control">
                        <option value="">Select Time of Advance</option>
                        <option value="PO Time">PO Time</option>
                        <option value="Delivery Time">Delivery Time</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Payment Type</label>
                    <select ng-model="po.payment_type" id="" class="form-control">
                        <option value="">Select Payment Type</option>
                        <option value="Cash">Cash</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Debit Card">Debit Card</option>
                        <option value="CDR">CDR</option>
                        <option value="Pay Order">Pay Order</option>
                        <option value="LC">LC</option>
                    </select>
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
                    <textarea ng-model="po.description" id="" class="form-control"></textarea>
                </div>
            </div><br/>
            <button class="btn btn-sm float-right btn-success" ng-click="savePurchaseOrder()"> <i class="fa fa-save" id-"loader"></i> Submit</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Purchase Orders</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>PO Number</th>
                        <th>PO Date</th>
                        <th>Quotation Till</th>
                        <th>Delivery Date</th>
                        <th>PO Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getPoInfo()">
                    <tr ng-repeat="pos in POInfo">
                        <td ng-bind="pos.po_number"></td>
                        <td ng-bind="pos.po_date"></td>
                        <td ng-bind="pos.quotation_till"></td>
                        <td ng-bind="pos.delivery_date"></td>
                        <td>
                            <span ng-if="pos.po_status == 0">Pending</span>
                            <span ng-if="pos.po_status == 1">PO Made</span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info">Edit</button>
                                <button class="btn btn-xs btn-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div class="card">
        <div class="card-header">
            <h2 class="card-title">Add Taxes</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Name Of Taxe</label>
                    <select ng-model="po.tax" id="" class="form-control">
                        <option value="">Select Name Of Taxe</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Payment Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Payment Method</label>
                    <select ng-model="po.payment_method" id="" class="form-control">
                        <option value="">COD</option>
                        <option value="">Credit card</option>
                        <option value="">Debit card</option>
                        <option value="">Cash Sales</option>
                        <option value="">Credit Sales</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Percentage of Advance</label>
                    <input type="text" ng-model="po.percentage" id="" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Shipment Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Delivery Date</label>
                    <input type="text" ng-model="po.delivery_date" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Ship Via</label>
                    <select ng-model="po.ship_via" id="" class="form-control">
                        <option value="">By Hand</option>
                        <option value="">By Courier</option>
                        <option value="">By Seaport</option>
                        <option value="">By Airport</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col-6">
                    <label for="">Port of Loading</label>
                    <input type="text" ng-model="po.port_loading" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Port of Unloading</label>
                    <input type="text" ng-model="po.port_unloading" id="" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Attachment</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Item Picture</label>
                    <input type="file" id="" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Required For</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <label for="">Project</label>
                    <select ng-model="po.project" id="" class="form-control">
                        <option value="">Select Project</option>
                    </select>
                </div>
                <div class="col-4">
                <label for="">Activity</label>
                    <sel ect ng-model="po.activity" id="" class="form-control">
                        <option value="">Select Activity</option>
                    </select>
                </div>
                <div class="col-4">
                <label for="">Phase</label>
                    <select ng-model="po.phase" id="" class="form-control">
                        <option value="">Select Phase</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn-success">Save</button>
                </div>
            </div>
        </div>
    </div> -->
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
    <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/purchases/add-po.js')}}"></script>
@endsection