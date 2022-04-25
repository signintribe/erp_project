@extends('layouts.admin.creationTier')
@section('title', 'Add Logistics')
@section('pagetitle', 'Add Logistics')
@section('breadcrumb', 'Add Logistics')
@section('content')
<div ng-controller="LogisticController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Organization Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="logistic_type">Select Logistic</label>
                    <select id="logistic_type" class="form-control" ng-model="logistic.logistic_type">
                        <option value="">* Select Logistic</option>
                        <option value="Freight Forward Det">Freight Forward Det</option>
                        <option value="Customer Clearance">Customer Clearance</option>
                        <option value="Carriage Company">Carriage Company</option>
                        <option value="Courier">courier</option>
                    </select>
                    <i class="text-danger" ng-show="!logistic.logistic_type && showError"><small>Please Select Logistic Type</small></i>
                </div> 
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_name">* Name of Organization</label>
                    <input type="text" class="form-control" id="organization_name" ng-model="logistic.organization_name" placeholder="Name of Organization"/>
                    <i class="text-danger" ng-show="!logistic.organization_name && showError"><small>Please Type Org Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Organizational Logo:</label>
                    <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"><br/>
                    <img ng-if="catimage" ng-src="<% catimage %>" class="img img-responsive" style="width: 100%; height: 200px;"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency">Currency in Dealing</label>
                    <select class="form-control" id="currency" ng-model="logistic.currency_dealing">
                        <option value="">Select Currency Type</option>
                        <option value="Dollar">Dollar</option>
                        <option value="RMB">RMB</option>
                        <option value="Euro">Euro</option>
                        <option value="Pounds">Pounds</option>
                        <option value="Pak Rupees">Pak Rupees</option>
                    </select>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Address Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line1">Postal Address Line 1</label>
                    <input type="text" class="form-control" id="address_line1" ng-model="logistic.address_line_1" placeholder="Postal Address Line 1"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line2">Postal Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" ng-model="logistic.address_line_2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector" ng-model="logistic.sector" placeholder="Sector/Mohallah"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="logistic.city" placeholder="City"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="logistic.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="logistic.country" placeholder="Country"/>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Organizational Contact</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="logistic.phone_number" placeholder="Phone Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="logistic.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="logistic.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="logistic.linkedin" placeholder="Linkedin"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="logistic.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="logistic.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="logistic.email" placeholder="Email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="logistic.website" placeholder="Website"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="logistic.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="logistic.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="logistic.instagram" placeholder="Instagram"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="saveLogistic()"><i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
    <!-- <div class="card">
        <div class="card-body">
            <h3 class="card-title">Select product categories and attributes</h3>
            
        </div>
    </div> -->
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/logistics/add-logistic.js')}}"></script>
@endsection