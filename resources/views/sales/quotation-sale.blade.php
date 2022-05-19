@extends('layouts.admin.taskTier')
@section('title', 'Quotation For Sale')
@section('pagetitle', 'Quotation For Sale')
@section('breadcrumb', 'Quotation For Sale')
@section('content')

<form action="quotation-sale" method="get">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Quotation Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Quotation Date</label>
                    <input type="text" name="quotation-date" placeholder='Quotation Date' id="" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Quotation Status</label><br>
                    <input type="checkbox" name="" id="">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Customer Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Customer</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Customer</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Customer Address</label>
                    <input type="text" name="customer-address" id="" class="form-control" placeholder='Customer Address'>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Delivery Address</label>
                    <input type="text" name="delivery-address" id="" class="form-control" placeholder='Delivery Address'>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Shipment Status</label>
                    <select name="" id="" class="form-control">
                        <option value="">Pending</option>
                        <option value="">Shipped</option>
                        <option value="">Dropped</option>
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
                <div class="col-lg-3 col-md--3 col-sm-3">
                    <label for="">Product/Item</label>
                    <input type="text" name="product" id="" placeholder='Product/Item' class="form-control">
                </div>
                <div class="col-lg-3 col-md--3 col-sm-3">
                    <label for="">Quantity</label>
                    <input type="text" name="quantity" id="" placeholder="Quantity" class="form-control">
                </div>
                <div class="col-lg-3 col-md--3 col-sm-3">
                    <label for="">Unit Price</label>
                    <input type="text" name="unit-price" id="" placeholder='Unit Price' class="form-control">
                </div>
                <div class="col-lg-3 col-md--3 col-sm-3">
                    <label for="">Gross Total</label>
                    <input type="text" name="gross-total" id="" placeholder="Gross Total" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md--3 col-sm-3">
                    <label for="">Chart of Account Debit</label>
                    <select name="" id="" class="form-control">
                        <option value="">Chart of Account</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Chart of Account Credit</label>
                    <select name="" id="" class="form-control">
                        <option value="">Chart of Account</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="">Description</label>
                    <textarea name="" id="" placeholder='Description' class="form-control"></textarea>
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Add Taxes</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Name of Taxes</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Name of Taxes</option>
                    </select>
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Payment Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Payment Method</label>
                    <select name="" id="" class="form-control">
                        <option value="">COD</option>
                        <option value="">Credit Card</option>
                        <option value="">Debit Card</option>
                        <option value="">Cash Sales</option>
                        <option value="">Credit Sales</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Percentage Of Advance</label>
                    <input type="text" name="" id="" placeholder='Percentage Of Advance' class="form-control">
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
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Delivery Date</label>
                    <input type="text" name="" id="" placeholder='Delevery Date' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Ship Via</label>
                    <select name="" id="" class="form-control">
                        <option value="">By Hand</option>
                        <option value="">By Courier</option>
                        <option value="">By Seaport</option>
                        <option value="">By Airport</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Port Of Loading</label>
                    <input type="text" name="" id="" placeholder="Port of Loading" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Port of Unloading</label>
                    <input type="text" name="" id="" placeholder="Port of Unloading" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Attachment</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Item Pictures</label>
                    <input type="file" name="" id="" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Required For</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Project</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Project</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Activity</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Activity</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Phase</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Phase</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection