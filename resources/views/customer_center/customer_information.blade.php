@extends('layouts.admin.creationTier')
@section('title', 'Customer Information')
@section('pagetitle', 'Customer Information')
@section('breadcrumb', 'Customer Information')
@section('content')
<div ng-controller="CustomerController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Customer Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <img ng-if="cuslogo" ng-src="<% cuslogo %>" class="img img-thumbnail" style-="width:100%; height:200px;">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_type">* Type of Customer</label>
                    <select class="form-control" ng-model="customer.customer_type" id="customer_type">
                        <option value="">Type of Customer</option>
                        <option value="Individual">Individual</option>
                        <option value="Organization">Organization</option>
                    </select>
                    <i class="text-danger" ng-show="!customer.customer_type && showError"><small>Please Select Customer Type</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_name">* Customer Name</label>
                    <input type="text" class="form-control" id="customer_name" ng-model="customer.customer_name" placeholder="Cusomer Name"/>
                    <i class="text-danger" ng-show="!customer.customer_name && showError"><small>Please Enter Customer Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_logo">Logo</label>
                    <input type="file" class="form-control" id="customer_logo" onchange="angular.element(this).scope().readUrl(this);"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency_dealing">Currency in dealing</label>
                    <input type="text" class="form-control" id="currency_dealing" ng-model="customer.currency_dealing" placeholder="Currency in dealing"/>
                </div>
            </div>
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
                        <input type="text" id="address_1" class="form-control" ng-model="customer.address_line_1" placeholder="Postal Address Line 1"/>
                        <i class="text-danger" ng-show="!customer.address_line_1 && showError"><small>Please Type Address Line</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Postal Address Line 2</label>
                        <input type="text" id="address_2" class="form-control" ng-model="customer.address_line_2" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_3">Postal Address Line 3</label>
                        <input type="text" id="address_3" class="form-control" ng-model="customer.address_line_3" placeholder="Postal Address Line 3"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" id="street" class="form-control" ng-model="customer.street" placeholder="Street"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" id="sector" class="form-control" ng-model="customer.sector" placeholder="Sector/Mohallah"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" class="form-control" ng-model="customer.country" placeholder="Country"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="state">State / Province</label>
                        <input type="text" id="state" class="form-control" ng-model="customer.state" placeholder="State / Province"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" class="form-control" ng-model="customer.city" placeholder="City"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip_code">Zipp Code</label>
                        <input type="text" id="zip_code" class="form-control" ng-model="customer.zip_code" placeholder="Zip Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" class="form-control" ng-model="customer.postal_code" placeholder="Postal Code"/>
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
                    <input type="text" class="form-control" id="phone_number" ng-model="customer.phone_number" placeholder="Phone Number"/>
                    <i class="text-danger" ng-show="!customer.phone_number && showError"><small>Please Enter Phone no</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="customer.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="customer.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="customer.linkedin" placeholder="Linkedin"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="customer.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="customer.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="customer.email" placeholder="Email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="customer.website" placeholder="Website"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="customer.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="customer.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="customer.instagram" placeholder="Instagram"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-left" ng-click="save_customerInformation()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Customer Information</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Customer Type</th>
                        <th>Customer Name</th>
                        <th>Currency in dealing</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getCustomerInformation()">
                    <tr ng-repeat="customer in customerinformations">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="customer.customer_type"></td>
                        <td ng-bind="customer.customer_name"></td>
                        <td ng-bind="customer.currency_dealing"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editCustomerInformation(customer.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteCustomerInformation(customer.id)">Delete</button>
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
<script src="{{asset('ng_controllers/sales/customer-information.js')}}"></script>
@endsection