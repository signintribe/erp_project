@extends('layouts.subuser.master')
@section('title', 'Add Freight Forward Det')
@section('content')
<div  ng-app="FreightApp" ng-controller="FreightController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Organization Information</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_name">Name of Organization</label>
                    <input type="text" class="form-control" id="organization_name" ng-model="freight.organization_name" placeholder="Name of Organization"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="ntn_no">NTN</label>
                    <input type="text" class="form-control" id="ntn_no" ng-model="freight.ntn_no" placeholder="NTN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="incroporation_no">Incroporation/License No.</label>
                    <input type="text" class="form-control" id="incroporation_no" ng-model="freight.incroporation_no" placeholder="Incroporation/License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_logo">Organization Logo</label>
                    <input type="file" class="form-control" id="organization_logo"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="strn">STRN</label>
                    <input type="text" class="form-control" id="strn" ng-model="freight.strn" placeholder="STRN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="import_license">Import License No.</label>
                    <input type="text" class="form-control" id="import_license" ng-model="freight.import_license" placeholder="Import License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="export_license">Export License No.</label>
                    <input type="text" class="form-control" id="export_license" ng-model="freight.export_license" placeholder="Export License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="chamber_no"><abbr title="Chamber of Commerce License No.">CC License No.</abbr></label>
                    <input type="text" class="form-control" id="chamber_no" ng-model="freight.chamber_no" placeholder="Chamber of Commerce License No."/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency_dealing">Currency in dealing</label>
                    <input type="text" class="form-control" id="currency_dealing" ng-model="freight.currency_dealing" placeholder="Currency in dealing"/>
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
            <h3 class="card-title">Address Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line1">Postal Address Line 1</label>
                    <input type="text" class="form-control" id="address_line1" ng-model="freight.address_line1" placeholder="Postal Address Line 1"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line2">Postal Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" ng-model="freight.address_line2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector" ng-model="freight.sector" placeholder="Sector/Mohallah"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="freight.city" placeholder="City"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="freight.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="freight.country" placeholder="Country"/>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Organizational Contact</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="freight.phone_number" placeholder="Phone Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="freight.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="freight.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="freight.linkedin" placeholder="Linkedin"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="freight.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="freight.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="freight.email" placeholder="Email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="freight.website" placeholder="Website"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="freight.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="freight.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="freight.instagram" placeholder="Instagram"/>
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
    var Freight = angular.module('FreightApp', []);
    Freight.controller('FreightController', function ($scope, $http) {

    });
</script>
@endsection