@extends('layouts.admin.taskTier')
@section('title', 'Quotation')
@section('pagetitle', 'Quotation')
@section('breadcrumb', 'Quotation')
@section('content')

<div ng-controller='QuotationController' ng-app='QuotationApp'>
    <form action="quotation-for-purchases" method="get">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Quotation Details</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <label for="">Quotation Date</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="">Apply to Pending Requisition/Tender</label>
                        <select name="" id="" class="form-control">
                            <option value="">DDL</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="">Quotation Status</label><br>
                        <input type="checkbox" name="" id="">
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
                        <select name="" id="" class="form-control">
                            <option value="">DDL</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="">Delivery Address</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="">Shipment Status</label>
                        <select name="" id="" class="form-control">
                            <option value="">Pending</option>
                            <option value="">Shipped</option>
                            <option value="">Dropped</option>
                            <option value="">Deliverd</option>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12">
                        <label for="">Vendor Address</label>
                        <textarea name="" id="" class="form-control"></textarea>
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
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="">Quantity</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="">Unit Price</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="">Gross Total</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-3">
                        <label for="">Chart Of Account Debit</label>
                        <select name="" id="" class="form-control">
                            <option value="">Chart Of Account</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="">Chart Of Account Credit</label>
                        <select name="" id="" class="form-control">
                            <option value="">Chart Of Account</option>
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
                <h2 class="card-title">Add Texes</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <label for="">Add Texes</label>
                        <select name="" id="" class="form-control">
                            <option value="">DDL</option>
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
                    <div class="col-3">
                        <label for="">Payment Method</label>
                        <select name="" id="" class="form-control">
                            <option value="">COD</option>
                            <option value="">Credit Card</option>
                            <option value="">Debit Card</option>
                            <option value="">Cash Sales</option>
                            <option value="">Credit Sales</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="">Percentage Of Advance</label>
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
                            <option value="">BY Courier</option>
                            <option value="">BY Seaport</option>
                            <option value="">By Airport</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="">Port Of Loading</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-3">
                        <label for="">Port Of Unloading</label>
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
                </div><br>
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
                            <option value="">DDL</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="">Activity</label>
                        <select name="" id="" class="form-control">
                            <option value="">DDL</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="">Phase</label>
                        <select name="" id="" class="form-control">
                            <option value="">DDL</option>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <button class="btn-success">Save</button>
                    </div>
                </div><br>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var SalesOrder = angular.module('QuotationApp', []);
    SalesOrder.controller('QuotationController', function ($scope, $http) {
        $("#purchases").addClass('menu-open');
        $("#purchases-active").addClass('active');
        $("#quotation").addClass('active');
    });
</script>
@endsection