@extends('layouts.admin.taskTier')
@section('title', 'Sales Invoice')
@section('pagetitle', 'Sales Invoice')
@section('breadcrumb', 'Sales Invoice')
@section('content')

<form action="sales-invoice" method="get">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title"></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Invoice Date</label>
                    <input type="text" name="" id="" placeholder='Invoice Date' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Shipment Status</label>
                    <select name="" id="" class="form-control">
                        <option value="">Pending</option>
                        <option value="">Shipped</option>
                        <option value="">Dropped</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="">Apply to Pending Sales Order No</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Apply to Pending Sales Order No</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <label for="">SO Status</label><br>
                    <input type="checkbox" name="" id="">
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
                    <input type="text" name="" id="" placeholder='Delivery Date' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Port Of Unloading</label>
                    <input type="text" name="" id="" placeholder='Port of Unloading' class="form-control">
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
            </div>
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
                <div class="col-lg-3 col-sm-3 col-md-3">
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