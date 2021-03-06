@extends('layouts.subuser.master')
@section('title', 'Customer Information')
@section('content')
<div  ng-app="CustomerApp" ng-controller="CustomerController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Customer Information</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="customer_type">Type of Customer</label>
                    <select class="form-control" ng-model="customer.customer_type" id="customer_type">
                        <option value="">Type of Customer</option>
                        <option value="Individual">Individual</option>
                        <option value="Organization">Organization</option>
                    </select>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" class="form-control" id="customer_name" ng-model="customer.customer_name" placeholder="Cusomer Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="ntn_no">NTN</label>
                    <input type="text" class="form-control" id="ntn_no" ng-model="customer.ntn_no" placeholder="NTN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="incroporation_no">Incroporation/License No.</label>
                    <input type="text" class="form-control" id="incroporation_no" ng-model="customer.incroporation_no" placeholder="Incroporation/License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_logo">Logo</label>
                    <input type="file" class="form-control" id="customer_logo"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="strn">STRN</label>
                    <input type="text" class="form-control" id="strn" ng-model="customer.strn" placeholder="STRN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="import_license">Import License No.</label>
                    <input type="text" class="form-control" id="import_license" ng-model="customer.import_license" placeholder="Import License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="export_license">Export License No.</label>
                    <input type="text" class="form-control" id="export_license" ng-model="customer.export_license" placeholder="Export License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="chamber_no">Chamber of Commerce License No.</label>
                    <input type="text" class="form-control" id="chamber_no" ng-model="customer.chamber_no" placeholder="Chamber of Commerce License No."/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency_dealing">Currency in dealing</label>
                    <input type="text" class="form-control" id="currency_dealing" ng-model="customer.currency_dealing" placeholder="Currency in dealing"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Nature of Business</label><br/>
                    <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                    <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                    <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Sub Nature of Business</label><br/>
                    <input type="checkbox" id="exporter"/> <label for="exporter">Exporter</label><br/>
                    <input type="checkbox" id="importer"/> <label for="importer">Importer</label><br/>
                    <input type="checkbox" id="contractor"/> <label for="contractor">Contractor</label><br/>
                    <input type="checkbox" id="retailer"/> <label for="retriler">Retailer</label><br/>
                    <input type="checkbox" id="whole_seller"/> <label for="whole_saller">Whole Seller</label><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Type of Business</label><br/>
                    <input type="checkbox" id="private"/> <label for="private">Private limited company</label><br/>
                    <input type="checkbox" id="public"/> <label for="public">Public</label><br/>
                    <input type="checkbox" id="partnership"/> <label for="partnership">Partnership</label><br/>
                    <input type="checkbox" id="sole_proprietor"/> <label for="sole_proprietor">Sole Proprietor</label><br/>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Select product categories and attributes</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Customer = angular.module('CustomerApp', []);
    Customer.controller('CustomerController', function ($scope, $http) {

    });
</script>
@endsection