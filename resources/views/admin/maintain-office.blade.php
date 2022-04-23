@extends('layouts.admin.creationTier')
@section('title', 'Company Office')
@section('pagetitle', 'Company Office')
@section('breadcrumb', 'Company Office')
@section('content')
<div ng-controller="OfficeController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Registration</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office-name">* Name of Office</label>
                    <input type="text" id="office-name" class="form-control" ng-model="office.office_name" placeholder="Name of Office">
                    <i class="text-danger" ng-show="!office.office_name && showError"><small>Please type office name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office-type">Type of Office</label>
                    <input type="text" id="office-type" class="form-control" placeholder="Type of Office" ng-model="office.office_type"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="start-date">Start Date</label>
                    <div class="input-group">
                        <input type="text" id="start-date" class="form-control form-control-sm" datepicker placeholder="Start Date" ng-model="office.start_date"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Office Status</label><br>
                    <span class="form-control">
                        <input type="checkbox" id="office-status" ng-model="office.office_status"/> <label for="office-status">Opened</label>
                    </span>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office-scope">Office Scope</label>
                    <input type="text" id="expiry-date" class="form-control" placeholder="Office Scope" ng-model="office.scope_office"/>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Address Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="postal-address-1">Postal Address Line 1</label>
                    <input type="text" class="form-control" placeholder="Postal Address Line 1" ng-model="office.address_line_1">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="postal-address-2">Postal Address Line 2</label>
                    <input type="text" class="form-control" placeholder="Postal Address Line 2" id="postal-address-2" ng-model="office.address_line_2">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="street">Street</label>
                    <input type="text" class="form-control" id="street" ng-model="office.street" placeholder="Street">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector_mohallah">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector_mohallah" ng-model="office.sector" placeholder="Sector/Mohallah">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" placeholder="City" ng-model="office.city">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" placeholder="State/Province" ng-model="office.state">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" placeholder="Country" ng-model="office.country">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="postal-code">Postal Code</label>
                    <input type="text" id="postal-code" class="form-control" placeholder="Postal Code" ng-model="office.postal_code"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="zip-code">Zip Code</label>
                    <input type="text" id="zip-code" class="form-control" placeholder="Zip Code" ng-model="office.zip_code"/>                    
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contact Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" class="form-control" placeholder="Phone Number" ng-model="office.phone_number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile-number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile-number" placeholder="Mobile Number" ng-model="office.mobile_number">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax">Fax</label>
                    <input type="text" class="form-control" id="fax" placeholder="Fax" ng-model="office.fax_number">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" placeholder="Whatsapp" ng-model="office.whatsapp">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Email" ng-model="office.email">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Social Media</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" placeholder="Website" ng-model="office.website">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" placeholder="Twitter" ng-model="office.twitter">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" placeholder="Instagram" ng-model="office.instagram">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" placeholder="Facebook" ng-model="office.facebook">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" placeholder="Linkedin" ng-model="office.linkedin">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" placeholder="Pinterest" ng-model="office.pinterest">
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_companyoffice()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Company Offices</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Office Type</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody ng-init="getalloffice()">
                    <tr ng-repeat="office in alloffice">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="office.company_name"></td>
                        <td ng-bind="office.office_name"></td>
                        <td ng-bind="office.office_type"></td>
                        <td ng-bind="office.start_date"></td>
                        <td>
                            <p ng-if="office.office_status == 0" class="text text-danger">Closed</p>
                            <p ng-if="office.office_status == 1" class="text text-success">Opened</p>
                        </td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-danger" ng-click="deleteOffice(office.id);">Delete</button>
                                <button class="btn btn-xs btn-info" ng-click="editOffice(office.id);">Edit</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_company/maintain-office.js')}}"></script>
@endsection