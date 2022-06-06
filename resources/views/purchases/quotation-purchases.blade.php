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
            <div class="col-6">
                <label for="">Pending Requestion/Tender</label>
                <select ng-model="pq.request" ng-change="getTenderRequestions(pq.request)" class="form-control">
                    <option value="">Pending Requisition/Tender</option>
                    <option value="requestion">Requestion</option>
                    <option value="tender">Tender</option>
                </select>
            </div>
            <div class="col-6">
                <label for="">Apply to Pending Requisition/Tender</label>
                <select ng-model="pq.req_tend" id="" class="form-control">
                    <option value="">Select Apply to Pending Requisition/Tender</option>
                </select>
            </div>
        </div><br/>
        <div class="row">
            <div class="col-6">
                <label for="">Quotation Date</label>
                <input type="text" ng-model="pq.quotation_date" id="" class="form-control">
            </div>
            <div class="col-6">
                <label for="">Quotation Status</label><br>
                <input type="checkbox" ng-model="pq.quotation_status" id="status"> <label for="status">Active</label>
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
            <div class="col-6">
                <label for="">Vendor</label>
                <select ng-model="pq.vendor" id="" class="form-control">
                    <option value="">Select Vendor</option>
                </select>
            </div>
            <div class="col-6">
                <label for="">Vendor Address</label>
                <input type="text" ng-model="pq.vendor_address" id="" class="form-control">
            </div>
        </div><br>
        <div class="row">
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
        </div><br>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Item Details</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <label for="">Product/Item</label>
                <input type="text" ng-model="pq.search" id="" class="form-control">
            </div>
            <diiv class="col-6">
                <label for="">Quantity</label>
                <input type="text" ng-model="pq.quantity" id="" class="form-control">
            </diiv>
        </div><br>
        <div class="row">
            <div class="col-6">
                <label for="">Unite Price</label>
                <input type="text" ng-model="pq.unite_price" id="" class="form-control">
            </div>
            <div class="col-6">
                <label for="">Gross Total</label>
                <input type="text" ng-model="pq.gross_total" id="" class="form-control">
            </div>
        </div><br>
        <div class="row">
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
        </div><br>
        <div class="row">
            <div class="col-12">
                <label for="">Description</label>
                <textarea ng-model="pq.description" id="" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="card">
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
</div>
</div>
@endsection

@section('internaljs')
<script src="{{asset('ng_controllers/task_purchase/quotation_purchases.js')}}"></script>
@endsection