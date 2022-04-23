@extends('layouts.admin.taskTier')
@section('title', 'Payment Voucher')
@section('pagetitle', 'Payment Voucher')
@section('breadcrumb', 'Payment Voucher')
@section('content')

<div ng-app='PaymentVoucherApp' ng-controller='PaymentVoucherController'>
<form action="payment-voucher" method="get">
    <div class='card'>
        <div class="card-body">
        <div class="row">
            <div class="col-6">
                <label for="">Date</label>
                <input type="text" name="" id="" class="form-control">
            </div>
            <div class="col-6">
                <label for="">Payment Method</label>
                <select name="" id="" class="form-control">
                    <option value="">DDL</option>
                </select>
            </div>
        </div><br/>
        <div class="row">
            <div class="col-6">
                <label for="">Instrument Number</label>
                <input type="text" name="" id="" class="form-control">
            </div>
            <div class="col-6">
                <label for="">Date On Instrument</label>
                <input type="text" name="" id="" class="form-control">
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
            <div class='col-6'>
                <label>Invoice Number</label>
                <input type='text' name='' class='form-control'>
            </div>
            <div class='col-6'>
                <label for="">Amount Due</label>
                <input type="text" name="" id="" class="form-control">
            </div>
        </div><br/>
        <div class='row'>
            <div class="col-6">
                <label for="">Debit Account</label>
                <input type="text" name="" id="" class="form-control">
            </div>
            <div class="col-6">
                <label for="">Credit Account</label>
                <input type="text" name="" id="" class="form-control">
            </div>
        </div><br/>
        <div class='row'>
            <div class='col-6'>
                <label>GL Account</label>
                <select name="" id="" class="form-control">
                    <option value="">1</option>
                    <option value="">2</option>
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
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var SalesOrder = angular.module('PaymentVoucherApp', []);
    SalesOrder.controller('PaymentVoucherController', function ($scope, $http) {
        $("#sales").addClass('menu-open');
        $("#sales a[href='#']").addClass('active');
        $("#payment-voucher").addClass('active');
    });
</script>
@endsection