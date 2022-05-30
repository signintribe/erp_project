@extends('layouts.admin.creationTier')
@section('title', 'Requestion Form')
@section('pagetitle', 'Requestion')
@section('breadcrumb', 'Requestion')
@section('content')

<form action="requestion" method="get">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Requistion Detail</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Requition Date</label>
                    <input type="text" name="requistion-date" id="" placeholder='Requistion Date' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Required From Date</label>
                    <input type="text" name="required-from-date" id="" placeholder='Required From Date' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Required till Date</label>
                    <input type="text" name="required-till-date" id="" placeholder='Required till Date' class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="">Description of Requirement</label>
                    <textarea name="" id="" placeholder='Description of Requirement' class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Required Form</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Select Department</label>
                    <select name="" id="" class="form-control">
                        <option value="">Please Select Department</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Select Product</label>
                    <select name="" id="" class="form-control">
                        <option value="">Please Select Product</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Select HR Resource</label>
                    <select name="" id="" class="form-control">
                        <option value="">Please Select Employee</option>
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