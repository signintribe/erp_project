@extends('layouts.admin.taskTier')
@section('title', 'Receipt Voucher')
@section('pagetitle', 'Receipt Voucher')
@section('breadcrumb', 'Receipt Voucher')
@section('content')

<form action="receipt-voucher" method="get">
    <div class="card">
        <div class='card-header'>
            <h2 class="card-title">Receipt Voucher</h2>
        </div>
        <div class='card-body'>
            <div class='row'>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Date</label>
                    <input type="text" name="date" class="form-control" placeholder="Date">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Date On Instrument</label>
                    <input type='text' name='date-on-instrument' class='form-control' placeholder='Date On Instrument'>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Instrument Number</label>
                    <input type='text' name='instrument-number' class='form-control' placeholder='Instrument Number'>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Payment Method</label>
                    <select name='' class='form-control'>
                        <option value="">Select Payment Method</option>
                    </select>
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class='card-header'>
            <h2 class="card-title">Apply to pending Invoice</h2>
        </div>
        <div class='card-body'>
            <div class='row'>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Invoice Number</label>
                    <input type="text" name="invoice-number" class="form-control" placeholder="Invoice Number">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Amount Due</label>
                    <input type='text' name='amount-due' class='form-control' placeholder='Amount Due'>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                <label>GL Account</label>
                    <select name='' class='form-control'>
                        <option value="">Select GL Account</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Debit Account</label>
                    <select name='' class='form-control'>
                        <option value="">Select Debit Account</option>
                    </select>
                </div>
            </div><br>
            <div class='row'>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Credit Account</label>
                    <select name='' class='form-control'>
                        <option value="">Select Credit Account</option>
                    </select>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9">
                <label>Description</label>
                    <textarea type='text' name='description' class='form-control' placeholder='Description'></textarea>
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