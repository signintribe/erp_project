@extends('layouts.admin.taskTier')
@section('title', 'Payment Voucher')
@section('pagetitle', 'Payment Voucher')
@section('breadcrumb', 'Payment Voucher')
@section('content')

<form action="payment-voucher" method="get">
    <div class='card'>
        <div class="card-body">
        <div class="row">
            <div class="col-3">
                <label for="">Date</label>
                <input type="date" name="" id="" datepicker class="form-control">
            </div>
            <div class="col-3">
                <label for="">Payment Method</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Payment Method</option>
                </select>
            </div>
            <div class="col-3">
                <label for="">Instrument Number</label>
                <input type="text" name="" id="" class="form-control">
            </div>
            <div class="col-3">
                <label for="">Date On Instrument</label>
                <input type="date" name="" id="" datepicker class="form-control">
            </div>
        </div><br/>
    </div>
</div>
<div class="card">
    <div class="card-header">
            <h2 class='card-title'>Apply To Pending Invoices From Vendor</h2>
     </div>
    <div class="card-body">
        <div class='row'>
            <div class='col-3'>
                <label>Invoice Number</label>
                <input type='text' name='' class='form-control'>
            </div>
            <div class='col-3'>
                <label for="">Amount Due</label>
                <input type="text" name="" id="" class="form-control">
            </div>
            <div class="col-3">
                <label for="">Debit Account</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Debit Account</option>
                </select>
            </div>
            <div class="col-3">
                <label for="">Credit Account</label>
                <select name="" id="" class="form-control">
                    <option value="">Select Credit Account</option>
                </select>
            </div>
        </div><br/>
        <div class='row'>
            <div class='col-3'>
                <label>GL Account</label>
                <select name="" id="" class="form-control">
                    <option value="">Select GL Account</option>
                </select>
            </div>
        </div><br/>
        <div class='row'>
            <div class="col-12">
                <label for="">Description</label>
                <textarea type='text' name='' class='form-control'></textarea>
            </div>
        </div><br/>
        <div class="row">
            <div class="col">
                <button class="btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection