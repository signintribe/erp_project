@extends('layouts.admin.taskTier')
@section('title', 'Add Sale Order')
@section('pagetitle', 'Add Sale Order')
@section('breadcrumb', 'Add Sale Order')
@section('content')
<div ng-controller="SalesOrderController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sales Order Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="po_number">SO Number</label>
                    <input type="text" id="so_number" class="form-control"  ng-model="so.so_number" placeholder="SO Number">
                    <i class="text-danger" ng-show="!so.po_number && showError"><small>Please type SO number</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="po_date">SO Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="so_date" data-target-input="nearest">
                            <input type="text" placeholder="SO Date" ng-model="so.so_date" class="form-control datetimepicker-input" data-target="#so_date"/>
                            <div class="input-group-append" data-target="#so_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="apply_to">Apply To Quotation</label>
                    <div class="input-group">
                        <input type="search" ng-model="so.apply_to" class="form-control" placeholder="Search Your Quotation">
                        <div class="input-group-append">
                            <button type="button" ng-click="getAppliedTo(so.apply_to);" class="btn btn-md btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="<?php echo env('APP_URL') ?>sales/quotation-sale" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item" style="cursor: pointer" ng-click="assignQuotation(quot)" ng-repeat="quot in quotation" ng-bind="quot.quotation_number"></li>
                    </ul>
                    <i class="text-danger" ng-show="!so.quotation_id && showError"><small>Please select Quotation</small></i>
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
                    <div class="input-group">
                        <input type="search" ng-model="so.customer_name" class="form-control" placeholder="Search Your Customer">
                        <div class="input-group-append">
                            <button type="button" ng-click="searchCustomer(so.customer_name);" class="btn btn-md btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="<?php echo env('APP_URL') ?>customer/customer-information" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group" ng-if="customerinfo">
                        <li class="list-group-item" ng-click="selectCustomer(cust)" style="cursor:pointer" ng-repeat="cust in customerinfo" ng-bind="cust.customer_name"></li>
                    </ul>
                    <i class="text-danger" ng-show="!so.customer_id && showError"><small>Please select customer</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_till">Quotation Valid Till</label>
                    <div class="form-group">
                        <div class="input-group date" id="quotation_till" data-target-input="nearest">
                            <input type="text" placeholder="Quotation Valid Till" ng-model="so.quotation_till" class="form-control datetimepicker-input" data-target="#quotation_till"/>
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
                            <input type="text" placeholder="Delivery Date" ng-model="so.delivery_date" class="form-control datetimepicker-input" data-target="#delivery_date"/>
                            <div class="input-group-append" data-target="#delivery_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row" id="checklist">
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
            </div>
            <div class="row" id="getchecklist" style="display:none;">
                <div class="col">
                    <button class="btn btn-sm btn-primary float-right" ng-click="chnageCheckList()">Change</button>
                    <ul style="list-style:none;" ng-repeat="chklst in getselectedchecklist">
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
            </div><hr/>
            <!-- <div class="row">
                <div class="col-6">
                    <label for="">Delivery Address</label>
                    <input type="text" ng-model="so.delivery_address" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Shipment Status</label>
                    <select ng-model="so.shipment_status" id="" class="form-control">
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
                        <input type="search" ng-model="so.product_name" class="form-control" placeholder="Search Your Quotation">
                        <div class="input-group-append">
                            <button type="button" ng-click="getInventory(so.product_name);" class="btn btn-md btn-success">
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
                    <i class="text-danger" ng-show="!so.product_id && showError"><small>Please select product</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="text" ng-model="so.unit_price" ng-blur="grossPrice();" id="unit_price" placeholder="Unit Price" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="qty">Quantity</label>
                    <input type="text" ng-model="so.quantity" ng-blur="grossPrice();" placeholder="Quantity" id="qty" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="gross_price">Gross Price</label>
                    <input type="text" ng-model="so.gross_price" ng-click="grossPrice()" readonly placeholder="Gross Price" id="gross_price" class="form-control">
                </div>
            </div><br>
            <!-- <div class="row">
                <div class="col-6">
                    <label for="">Cahrt Of Account Debit</label>
                    <select ng-model="so.account_debit" id="" class="form-control">
                        <option value="">Chart of Account Debit</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Chart Of Account Credit</label>
                    <select ng-model="so.account_credit" id="" class="form-control">
                        <option value="">Chart Of Account Credit</option>
                    </select>
                </div>
            </div><br> -->
            <div class="row" id="TaxRow" style="display:none">
                <div class="col-lg-12 col-md-12 col-sm-12">
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
                            <th>Tax Name</th>
                            <th>Tax Percentage</th>
                        </tr>
                        <tr ng-repeat="adtx in AddTaxes">
                            <td ng-bind="adtx.tax_name"></td>
                            <td ng-bind="adtx.tax_percentage"></td>
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
            <div class="row" id="LogisticRow" style="display:none">
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
                    <input type="text" ng-model="so.discount_name" id="discount_name" placeholder='Discount Name' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Discount Amount</label>
                    <input type="text" ng-model="so.discount_amount" ng-blur="lessDiscount()" id="discount_amount" placeholder='Discount Amount' class="form-control discount_amount">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Net Amount</label>
                    <input type="text" ng-model="so.net_amount" id="net_amount" placeholder='Net Amount' class="form-control net_amount">
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
                    <input type="text" ng-model="so.advance_percentage" id="" placeholder='Advance Percentage' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Time Of Advance</label>
                    <select ng-model="so.time_advance" id="" class="form-control">
                        <option value="">Select Time of Advance</option>
                        <option value="SO Time">SO Time</option>
                        <option value="Delivery Time">Delivery Time</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Payment Type</label>
                    <select ng-model="so.payment_type" id="" class="form-control">
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
                    <textarea ng-model="so.description" id="" class="form-control"></textarea>
                </div>
            </div><br/>
            <div class="btn-group float-right">
                <button class="btn btn-sm btn-success" ng-click="saveSaleOrder()"> <i class="fa fa-save" id="loader"></i> Submit</button>
                <button class="btn btn-sm btn-warning" ng-click="cancelSaleOrder()"> <i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Sales Orders</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>SO Number</th>
                        <th>SO Date</th>
                        <th>Quotation Till</th>
                        <th>Delivery Date</th>
                        <th>SO Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getSoInfo()">
                    <tr ng-repeat="sos in SOInfo">
                        <td ng-bind="sos.so_number"></td>
                        <td ng-bind="sos.so_date"></td>
                        <td ng-bind="sos.quotation_till"></td>
                        <td ng-bind="sos.delivery_date"></td>
                        <td>
                            <span ng-if="sos.so_status == 0">Pending</span>
                            <span ng-if="sos.so_status == 1">SO Made</span>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editSO(sos.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteSO(sos.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <p ng-if="nomore" ng-bind="nomore"></p>
                <button class="btn btn-sm btn-primary" id="loadMorebtn" ng-click="loadMore()"> <i class="fa fa-spinner"></i> Load More</button>
            </div>
        </div>
    </div>
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
    <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/sales/add-so.js')}}"></script>
@endsection