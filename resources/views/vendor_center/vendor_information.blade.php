@extends('layouts.admin.creationTier')
@section('title', 'Add Vendor')
@section('pagetitle', 'Add Vendor')
@section('breadcrumb', 'Add Vendor')
@section('content')
<div ng-controller="VendorController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Vendor</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <img ng-if="orglogo" ng-src="<% orglogo %>" class="img img-thumbnail" style-="width:100%; height:200px;">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="logistic_type">Select Logistic</label>
                    <select id="logistic_type" class="form-control" ng-model="organization.vendor_type">
                        <option value="">* Select Logistic</option>
                        <option value="Local">Local Vendor</option>
                        <option value="International">International Vendor</option>
                    </select>
                    <i class="text-danger" ng-show="!organization.vendor_type && showError"><small>Please Select Vendor Type</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_name">* Name of Organization</label>
                    <input type="text" class="form-control" id="organization_name" ng-model="organization.organization_name" placeholder="Name of Organization"/>
                    <i class="text-danger" ng-show="!organization.organization_name && showError"><small>Please Enter Organization</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency_dealing">Currency in dealing</label>
                    <input type="text" class="form-control" id="currency_dealing" ng-model="organization.currency_dealing" placeholder="Currency in dealing"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_logo">Organization Logo</label>
                    <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"/>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Address Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">* Postal Address Line 1</label>
                        <input type="text" id="address_1" class="form-control" ng-model="organization.address_line_1" placeholder="Postal Address Line 1"/>
                        <i class="text-danger" ng-show="!organization.address_line_1 && showError"><small>Please Type Address Line</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Postal Address Line 2</label>
                        <input type="text" id="address_2" class="form-control" ng-model="organization.address_line_2" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_3">Postal Address Line 3</label>
                        <input type="text" id="address_3" class="form-control" ng-model="organization.address_line_3" placeholder="Postal Address Line 3"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="street">* Street</label>
                        <input type="text" id="street" class="form-control" ng-model="organization.street" placeholder="Street"/>
                        <i class="text-danger" ng-show="!organization.street && showError"><small>Please Type Street</small></i>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" id="sector" class="form-control" ng-model="organization.sector" placeholder="Sector/Mohallah"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="country">* Country</label>
                        <input type="text" id="country" class="form-control" ng-model="organization.country" placeholder="Country"/>
                        <i class="text-danger" ng-show="!organization.country && showError"><small>Please Type Country</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="state">* State / Province</label>
                        <input type="text" id="state" class="form-control" ng-model="organization.state" placeholder="State / Province"/>
                        <i class="text-danger" ng-show="!organization.state && showError"><small>Please Type State / Province</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">* City</label>
                        <input type="text" id="city" class="form-control" ng-model="organization.city" placeholder="City"/>
                        <i class="text-danger" ng-show="!organization.city && showError"><small>Please Type City</small></i>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip_code">Zipp Code</label>
                        <input type="text" id="zip_code" class="form-control" ng-model="organization.zip_code" placeholder="Zip Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" class="form-control" ng-model="organization.postal_code" placeholder="Postal Code"/>
                    </div>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Contact Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">* Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="organization.phone_number" placeholder="Phone Number"/>
                    <i class="text-danger" ng-show="!organization.phone_number && showError"><small>Please Enter Phone no</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="organization.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="organization.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="organization.linkedin" placeholder="Linkedin"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="organization.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="organization.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="organization.email" placeholder="Email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="organization.website" placeholder="Website"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="organization.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="organization.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="organization.instagram" placeholder="Instagram"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="save_vendorInformation()"><i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Vendors</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Organization Logo</th>
                        <th>Organization Name</th>
                        <th>Currency in dealing</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getVendorInformation()">
                    <tr ng-repeat="vendor in vendorinformations">
                        <td ng-bind="$index+1"></td>
                        <td>
                            <img ng-src="{{asset('public/organization_logo/<% vendor.organization_logo %>')}}" alt="" class="img img-sm">
                        </td>
                        <td ng-bind="vendor.organization_name"></td>
                        <td ng-bind="vendor.currency_dealing"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editVendorInformation(vendor.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteVendorInformation(vendor.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> 
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
    <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/purchases/vendor_information.js')}}"></script>
@endsection