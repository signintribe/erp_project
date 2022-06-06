@extends('layouts.admin.taskTier')
@section('title', 'Quotation For Purchases')
@section('pagetitle', 'Quotation For Purchases')
@section('breadcrumb', 'Quotation For Purchases')
@section('content')
<div ng-controller="QuotationPurchaseController">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Quotation Deatil</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_no">Quotation Number</label>
                    <input type="text" ng-model="pq.quotation_number" id="quotation_no" placeholder="Quotation Number" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_date">Quotation Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="quotation_date" data-target-input="nearest">
                            <input type="text" placeholder="Quotation Date" ng-model="pq.quotation_date" class="form-control datetimepicker-input" data-target="#quotation_date"/>
                            <div class="input-group-append" data-target="#quotation_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Quotation Status</label><br>
                    <p class="form-control">
                        <input type="checkbox" ng-model="pq.pending" id="pending"> <label for="pending">Pending</label> 
                        <input type="checkbox" ng-model="pq.po_made" id="po_made"> <label for="po_made">PO Made</label>
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Apply to</label>
                    <select ng-model="pq.apply_to" id="" class="form-control">
                        <option value="">Select Apply to</option>
                        <option value="Tender">Tender</option>
                        <option value="Requestion">Requestion</option>
                    </select>
                </div>
            </div><br/>
            <div class="row">
                <div class="col text-center">
                    <label for="applied_entity">Search Your <span ng-if="pq.apply_to"><% pq.apply_to %></span></label>
                    <input type="text" ng-model="pq.applied_entity" id="applied_entity" placeholder="Search Your <% pq.apply_to %>" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Vendor Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="vendor">Search Vendor</label>
                    <input type="text" ng-model="pq.vendor" placeholder="Search Vendor" id="vendor" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_till">Quotation Till</label>
                    <div class="form-group">
                        <div class="input-group date" id="quotation_till" data-target-input="nearest">
                            <input type="text" placeholder="Quotation Till" ng-model="pq.quotation_till" class="form-control datetimepicker-input" data-target="#quotation_till"/>
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
                            <input type="text" placeholder="Delivery Date" ng-model="pq.delivery_date" class="form-control datetimepicker-input" data-target="#delivery_date"/>
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
            <!-- <div class="row">
                <div class="col-6">
                    <label for="">Delivery Address</label>
                    <input type="text" ng-model="pq.delivery_address" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Shipment Status</label>
                    <select ng-model="pq.shipment_status" id="" class="form-control">
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
                    <input type="text" ng-model="pq.product_item" id="product_item" placeholder="Search Product/Item" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="text" ng-model="pq.unit_price" id="unit_price" placeholder="Unit Price" class="form-control">
                </div>
                <diiv class="col-lg-3 col-md-3 col-sm-3">
                    <label for="qty">Quantity</label>
                    <input type="text" ng-model="pq.quantity" placeholder="Quantity" id="qty" class="form-control">
                </diiv>
                <diiv class="col-lg-3 col-md-3 col-sm-3">
                    <label for="gross_price">Gross Price</label>
                    <input type="text" ng-model="pq.gross_price" placeholder="Gross Price" id="gross_price" class="form-control">
                </diiv>
            </div><br>
            <!-- <div class="row">
                <div class="col-6">
                    <label for="">Cahrt Of Account Debit</label>
                    <select ng-model="pq.account_debit" id="" class="form-control">
                        <option value="">Chart of Account Debit</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Chart Of Account Credit</label>
                    <select ng-model="pq.account_credit" id="" class="form-control">
                        <option value="">Chart Of Account Credit</option>
                    </select>
                </div>
            </div><br> -->
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Add Taxes</h5>
        </div>
        <div class="card-body">

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Special Note Description</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <textarea ng-model="pq.description" id="" class="form-control"></textarea>
                </div>
            </div>
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
                    <select ng-model="pq.tax" id="" class="form-control">
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
                    <select ng-model="pq.payment_method" id="" class="form-control">
                        <option value="">COD</option>
                        <option value="">Credit card</option>
                        <option value="">Debit card</option>
                        <option value="">Cash Sales</option>
                        <option value="">Credit Sales</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Percentage of Advance</label>
                    <input type="text" ng-model="pq.percentage" id="" class="form-control">
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
                    <input type="text" ng-model="pq.delivery_date" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Ship Via</label>
                    <select ng-model="pq.ship_via" id="" class="form-control">
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
                    <input type="text" ng-model="pq.port_loading" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Port of Unloading</label>
                    <input type="text" ng-model="pq.port_unloading" id="" class="form-control">
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
                    <select ng-model="pq.project" id="" class="form-control">
                        <option value="">Select Project</option>
                    </select>
                </div>
                <div class="col-4">
                <label for="">Activity</label>
                    <select ng-model="pq.activity" id="" class="form-control">
                        <option value="">Select Activity</option>
                    </select>
                </div>
                <div class="col-4">
                <label for="">Phase</label>
                    <select ng-model="pq.phase" id="" class="form-control">
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
</div>
@endsection

@section('internaljs')
<script src="{{asset('ng_controllers/task_purchase/quotation_purchases.js')}}"></script>
@endsection