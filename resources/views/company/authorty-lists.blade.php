@extends('layouts.admin.creationTier')
@section('title', 'Autorities')
@section('pagetitle', 'Autorities')
@section('breadcrumb', 'Autorities')
@section('content')
<div ng-controller="RegistrationController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Autority</h3>
                </div>
                <div class="col">
                    <div class="btn-group float-right">
                        <button class="btn btn-xs btn-primary" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                        <a href="#allAuthorities" class="btn btn-xs btn-warning">Show Authorities</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="registration-authority">* Registration Authority</label>
                    <input type="text" class="form-control" ng-model="authority.authority_name" placeholder="Authority Name">
                    <i class="text-danger" ng-show="!authority.authority_name && showError"><small>Please type registration authority</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_1">* Postal Address Line 1</label>
                    <input type="text" id="address_1" class="form-control" ng-model="authority.address_line_1" placeholder="Postal Address Line 1"/>
                    <i class="text-danger" ng-show="!authority.address_line_1 && showError"><small>Please Type Address Line</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_2">Postal Address Line 2</label>
                    <input type="text" id="address_2" class="form-control" ng-model="authority.address_line_2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_3">Postal Address Line 3</label>
                    <input type="text" id="address_3" class="form-control" ng-model="authority.address_line_3" placeholder="Postal Address Line 3"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="street">Street</label>
                    <input type="text" id="street" class="form-control" ng-model="authority.street" placeholder="Street"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" id="sector" class="form-control" ng-model="authority.sector" placeholder="Sector/Mohallah"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">* Country</label>
                    <input type="text" id="country" class="form-control" ng-model="authority.country" placeholder="Country"/>
                    <i class="text-danger" ng-show="!authority.country && showError"><small>Please Type Country</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State / Province</label>
                    <input type="text" id="state" class="form-control" ng-model="authority.state" placeholder="State / Province"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" id="city" class="form-control" ng-model="authority.city" placeholder="City"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="postal-code">Postal Code</label>
                    <input type="text" id="postal-code" class="form-control" ng-model="authority.postal_code" placeholder="Postal Code"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="zip-code">Zip Code</label>
                    <input type="text" id="zip-code" class="form-control" ng-model="authority.zip_code" placeholder="Zip Code"/>
                </div>
            </div><br/>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" id="allAuthorities">Please Add Contact Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Email</label>
                    <div class="input-group">
                        <div class="input-group">
                            <input type="email" class="form-control" ng-model="authority.email" placeholder="Email">
                            <div class="input-group-addon input-group-append"><i class="fa fa-envelope input-group-text"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Phone Number</label>
                            <input type="text" ng-model="authority.phone_number" class="form-control" placeholder="Phone Number">
                            <i class="text-danger" ng-show="!authority.phone_number && showError"><small>Please Type Phone Number</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Mobile Number</label>
                            <input type="text" ng-model="authority.mobile_number" class="form-control" placeholder="Mobile Number">
                            <i class="text-danger" ng-show="!authority.mobile_number && showError"><small>Please Type Mobile Number</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Fax Number</label>
                            <input type="text" ng-model="authority.fax_number" class="form-control" placeholder="Fax Number">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Facebook Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.facebook" placeholder="Facebook Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-facebook input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Linkedin</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.linkedin" placeholder="Linkedin">
                        <div class="input-group-addon input-group-append"><i class="fa fa-linkedin input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Youtube Channel</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.youtube" placeholder="Youtube Channel">
                        <div class="input-group-addon input-group-append"><i class="fa fa-youtube input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Twitter Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.twitter" placeholder="Twitter Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-twitter input-group-text"></i></div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>* Website</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.website" placeholder="Website">
                        <div class="input-group-addon input-group-append"><i class="fa fa-globe input-group-text"></i></div>
                    </div>
                    <i class="text-danger" ng-show="!authority.website && showError"><small>Please Type Website</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <div class="input-group">
                        <input type="text" id="instagram" class="form-control" ng-model="authority.instagram" placeholder="Instagram"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-instagram input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <div class="input-group">
                        <input type="text" id="pinterest" class="form-control" ng-model="authority.pinterest" placeholder="Pinterest"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-pinterest input-group-text"></i></div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_companyregistration();"> <i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">All Registration</h3>
        </div>
        <div class="card-body" ng-init="allcompany_registrations()">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Authority Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Company Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="r in allregistration">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="r.authority_name"></td>
                            <td ng-bind="r.address_line_1"></td>
                            <td ng-bind="r.city"></td>
                            <td ng-bind="r.company_name"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-info" ng-click="editRegistration(r.id)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteRegistration(r.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-center" id="record-loader"></p>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<input type="hidden" value="<?php echo env('APP_URL'); ?>" id="appurl">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_authorities/creation-authorities.js')}}"></script>
@endsection