@extends('layouts.admin.master')
@section('title', 'Add Vendor')
@section('content')
<div class="row" ng-app="VendorApp" ng-controller="VendorController" ng-cloak>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Organization Information</h3>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="org_name">* Name of Organization</label>
                            <input type="text" id="org_name" ng-model="vendor.org_name" class="form-control" placeholder="Name of Organization"/>
                            <i class="text-danger" ng-show="!vendor.org_name && showError"><small>Please Type Name of Organization</small></i>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="incroporation">Lncroporation/License No.</label>
                            <input type="text" id="incroporation" ng-model="vendor.incroporation_no" class="form-control" placeholder="Incroporation/License No."/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="ntn_number">NTN Number</label>
                            <input type="text" id="ntn_number" ng-model="vendor.ntn_number" class="form-control" placeholder="NTN Number"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="strn_number">STRN Number</label>
                            <input type="text" id="strn_number" ng-model="vendor.strn_number" class="form-control" placeholder="STRN Number"/>
                        </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="import_lincense">Import License No.</label>
                            <input type="text" id="import_lincense" ng-model="vendor.import_lincense" class="form-control" placeholder="Import License No."/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="export_lincense">Export License No.</label>
                            <input type="text" id="export_lincense" ng-model="vendor.export_lincense" class="form-control" placeholder="Export License No."/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="commerce_lincense">Chamber of Commerce License</label>
                            <input type="text" id="commerce_lincense" ng-model="vendor.commerce_lincense" class="form-control" placeholder="Chamber of Commerce License No."/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="vendor_logo">Logo</label>
                            <input type="file" id="vendor_logo" class="form-control"/>
                        </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label for="currency_dealing">Currency in dealing</label>
                            <input type="text" id="currency_dealing" ng-model="vendor.currency_dealing" class="form-control" placeholder="Currency in dealing"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label>Nature of Business</label><br/>
                            <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                            <input type="checkbox" id="trader"/> <label for="trader">Trader</label><br/>
                            <input type="checkbox" id="service_provider"/> <label for="service_provider">Service Provider</label><br/>
                            <input type="checkbox" id="whole_seller"/> <label for="whole_seller">Whole Seller</label><br/>
                            <input type="checkbox" id="retailer"/> <label for="retailer">Retailer</label><br/>
                            <input type="checkbox" id="contractor"/> <label for="contractor">Contractor</label><br/>
                            <input type="checkbox" id="importer"/> <label for="importer">Importer</label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="form-group">
                            <label>Type of Business</label><br/>
                            <input type="checkbox" id="sole_properietor"/> <label for="sole_properietor">Sole Properietor</label><br/>
                            <input type="checkbox" id="partnership"/> <label for="partnership">Partnership</label><br/>
                            <input type="checkbox" id="public"/> <label for="public">Public</label><br/>
                            <input type="checkbox" id="private_limited_company"/> <label for="private_limited_company">Private limited company</label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">

                    </div>
                </div><br/>
            </div>
        </div><br/>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Address Detail of Organization</h3>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">

                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Users = angular.module('VendorApp', []);
    Users.controller('VendorController', function ($scope, $http) {

    });
</script>
@endsection