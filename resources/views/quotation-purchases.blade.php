@extends('layouts.admin.taskTier')
@section('title', 'Quotation For Purchases')
@section('pagetitle', 'Quotation For Purchases')
@section('breadcrumb', 'Quotation For Purchases')
@section('content')
<form action="quotation-purchases" method="get">
    <div class="card">
        <div class="card-header">
           <h2 class="card-title">Quotation Deatil</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <label for="">Quotation No</label>
                    <input type="text" name="quotation-no" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Quotation Date</label>
                    <input type="text" name="quotation-date" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Apply to Pending Requisition/Tender</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Apply to Pending Requisition/Tender</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="">Quotation Status</label><br>
                    <input type="checkbox" name="quotation-status" id="">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
           <h2 class="card-title">Vendor Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <label for="">Vendor</label>
                    <select name="vendor" id="" class="form-control">
                        <option value="">Select Vendor</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="">Vendor Address</label>
                    <input type="text" name="vendor-address" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Delivery Address</label>
                    <input type="text" name="delivery-address" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Shipment Status</label>
                    <select name="shipment-status" id="" class="form-control">
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
                <div class="col-3">
                    <label for="">Product/Item</label>
                    <input type="text" name="search" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Quantity</label>
                    <input type="text" name="quantity" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Unite Price</label>
                    <input type="text" name="unite-price" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Gross Total</label>
                    <input type="text" name="gross-total" id="" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-3">
                    <label for="">Cahrt Of Account Debit</label>
                    <select name="" id="" class="form-control">
                        <option value="">Chart of Account Debit</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="">Chart Of Account Credit</label>
                    <select name="" id="" class="form-control">
                        <option value="">Chart Of Account Credit</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col-12">
                    <label for="">Description</label>
                    <textarea name="" id="" class="form-control"></textarea>
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
                <div class="col-3">
                    <label for="">Name Of Taxe</label>
                    <select name="" id="" class="form-control">
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
                <div class="col-3">
                    <label for="">Payment Method</label>
                    <select name="" id="" class="form-control">
                        <option value="">COD</option>
                        <option value="">Credit card</option>
                        <option value="">Debit card</option>
                        <option value="">Cash Sales</option>
                        <option value="">Credit Sales</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="">Percentage of Advance</label>
                    <input type="text" name="" id="" class="form-control">
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
                <div class="col-3">
                    <label for="">Delivery Date</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Ship Via</label>
                    <select name="" id="" class="form-control">
                        <option value="">By Hand</option>
                        <option value="">By Courier</option>
                        <option value="">By Seaport</option>
                        <option value="">By Airport</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="">Port of Loading</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Port of Unloading</label>
                    <input type="text" name="" id="" class="form-control">
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
                <div class="col-3">
                    <label for="">Item Picture</label>
                    <input type="file" name="" id="" class="form-control">
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
                <div class="col-3">
                    <label for="">Project</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Project</option>
                    </select>
                </div>
                <div class="col-3">
                <label for="">Activity</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Activity</option>
                    </select>
                </div>
                <div class="col-3">
                <label for="">Phase</label>
                    <select name="" id="" class="form-control">
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
</form>
@endsection