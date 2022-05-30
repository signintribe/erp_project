@extends('layouts.admin.creationTier')
@section('title', 'Tender Information')
@section('pagetitle', 'Tender Information')
@section('breadcrumb', 'Tender Information')
@section('content')
<link rel="stylesheet" href="{{ asset('public/dashboard/vendors/icheck/skins/all.css')}}">
<div class="row" ng-controller="TenderController">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Tender Information</h3>
            </div>
            <div class="card-body" ng-init="resetScope()">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-no">Tender No</label>
                        <input type="text" class="form-control" id="tender-no" placeholder="Tender No" ng-model="tender.tender_no">
                    </div>
                   <!--  <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="office-id">* Select Office</label>
                        <select ng-model="tender.office_id" ng-change="getDepartments(tender.office_id)" class="form-control" id="office-id" ng-options="office.id as office.office_name for office in offices">
                            <option value="">Select Office</option>
                        </select>
                        <i class="text-danger" ng-show="!tender.office_id && showError"><small>Please select office</small></i>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="department-id">* Select Department</label>
                        <select ng-model="tender.department_id" class="form-control" ng-options="dept.id as dept.department_name for dept in departments" id="department-id">
                            <option value="">Select Department</option>
                        </select>
                        <i class="text-danger" ng-show="!tender.department_id && showError"><small>Please select department</small></i>
                    </div> -->
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-name">Tender Name</label>
                        <input type="text" class="form-control" id="tender-name" placeholder="Tender Name" ng-model="tender.tender_name">
                        <i class="text-danger" ng-show="!tender.tender_name && showError"><small>Please type tender name</small></i>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-date">Advertisment Date</label>
                        <div class="form-group">
                            <div class="input-group date" id="advertisment_date" data-target-input="nearest">
                                <input type="text" placeholder="Tender Date" ng-model="tender.advertisment_date" class="form-control datetimepicker-input" data-target="#advertisment_date"/>
                                <div class="input-group-append" data-target="#advertisment_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="submission_date">Submission Date</label>
                        <div class="form-group">
                            <div class="input-group date" id="submission_date" data-target-input="nearest">
                                <input type="text" placeholder="Tender Submission Date" ng-model="tender.submission_date" class="form-control datetimepicker-input" data-target="#submission_date"/>
                                <div class="input-group-append" data-target="#submission_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="submission-time">Submission Time</label>
                        <input type="text" class="form-control" id="submission-time" placeholder="Submission Time" ng-model="tender.submission_time">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="opening_date">Opening Date</label>
                        <div class="form-group">
                            <div class="input-group date" id="opening_date" data-target-input="nearest">
                                <input type="text" placeholder="Tender Opening Date" ng-model="tender.opening_date" class="form-control datetimepicker-input" data-target="#opening_date"/>
                                <div class="input-group-append" data-target="#opening_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="opening_time">Opening Time</label>
                        <input type="text" class="form-control" id="opening_time" placeholder="Opening Time" ng-model="tender.opening_time">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="opening-venue">Tender Opening Venue</label>
                        <input type="text" class="form-control" id="opening-venue" placeholder="Opening Venue" ng-model="tender.opening_venue">
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="document-required">Documents Required</label>
                        <input type="text" ng-model="tender.documents_required" placeholder="Document Required" class="form-control" id="document-required" class="Document Required">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender_image">Upload Tender Image</label>
                        <input type="file" class="form-control" id="tender_image" onchange="angular.element(this).scope().readUrl(this);">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender_fee">Tender Fee</label>
                        <input type="text" ng-model="tender.tender_fee" id="tender_fee" placeholder="Tender Fee" class="form-control">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="bid_money">Bid Money</label>
                        <input type="text" ng-model="tender.bid_money" placeholder="Bid Money" id="bid_money" class="form-control">
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="mode_bid_money">Mode of Bid Money</label>
                        <select ng-model="tender.bidmoney_mode" id="mode_bid_money" class="form-control">
                            <option value="">Select Mode of Bid Money</option>
                            <option value="BG">BG</option>
                            <option value="CDR">CDR</option>
                            <option value="PO">PO</option>
                            <option value="BD">BD</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="issuance_date">Issuance Date</label>
                        <div class="form-group">
                            <div class="input-group date" id="issuance_date" data-target-input="nearest">
                                <input type="text" placeholder="Issuance Date" ng-model="tender.issuance_date" class="form-control datetimepicker-input" data-target="#issuance_date"/>
                                <div class="input-group-append" data-target="#issuance_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="expiry_date">Date of Expiry</label>
                        <div class="form-group">
                            <div class="input-group date" id="expiry_date" data-target-input="nearest">
                                <input type="text" placeholder="Expiry Date" ng-model="tender.expiry_date" class="form-control datetimepicker-input" data-target="#expiry_date"/>
                                <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">

                    </div>
                </div><br/>
                <div class="row">
                    <div class="col">
                        <label for="description">Tender Description</label>
                        <textarea ng-model="tender.tender_description" placeholder="Type the description of tender" id="description" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div><br/>
            </div>
        </div><br/>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Organization Address Detail</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="address_line1">Postal Address Line 1</label>
                        <input type="text" class="form-control" id="address_line1" ng-model="tender.address_line_1" placeholder="Postal Address Line 1"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="address_line2">Postal Address Line 2</label>
                        <input type="text" class="form-control" id="address_line2" ng-model="tender.address_line_2" placeholder="Postal Address Line 2"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" class="form-control" id="sector" ng-model="tender.sector" placeholder="Sector/Mohallah"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" ng-model="tender.city" placeholder="City"/>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="state">State/Province</label>
                        <input type="text" class="form-control" id="state" ng-model="tender.state" placeholder="State/Province"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" ng-model="tender.country" placeholder="Country"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" ng-model="tender.postal_code" placeholder="Postal Code"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" class="form-control" id="zip_code" ng-model="tender.zip_code" placeholder="Zip Code"/>
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
                        <input type="text" class="form-control" id="phone_number" ng-model="tender.phone_number" placeholder="Phone Number"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile_number" ng-model="tender.org_mobile_number" placeholder="Mobile Number"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="facebook">Facebook</label>
                        <input type="text" class="form-control" id="facebook" ng-model="tender.org_facebook" placeholder="Facebook"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="linkedin">Linkedin</label>
                        <input type="text" class="form-control" id="linkedin" ng-model="tender.org_linkedin" placeholder="Linkedin"/>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="text" class="form-control" id="whatsapp" ng-model="tender.org_whatsapp" placeholder="Whatsapp"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="twitter">Twitter</label>
                        <input type="text" class="form-control" id="twitter" ng-model="tender.org_twitter" placeholder="Twitter"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" ng-model="tender.org_email" placeholder="Email"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" ng-model="tender.org_website" placeholder="Website"/>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="pinterest">Pinterest</label>
                        <input type="text" class="form-control" id="pinterest" ng-model="tender.org_pinterest" placeholder="Pinterest"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="fax_number">Fax Number</label>
                        <input type="text" class="form-control" id="fax_number" ng-model="tender.org_fax_number" placeholder="Fax Number"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="instagram">Instagram</label>
                        <input type="text" class="form-control" id="instagram" ng-model="tender.org_instagram" placeholder="Instagram"/>
                    </div>
                </div><br/>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Person</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <img ng-if="catimg" ng-src="<% catimg %>" class="img img-thumbnail" style="width:200px; height:200px;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="person_name">Name of Contact Person</label>
                        <input type="text" class="form-control" id="person_name" ng-model="tender.person_name" placeholder="First Name"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control" id="designation" ng-model="tender.designation" placeholder="Designation"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="text" class="form-control" id="whatsapp" ng-model="tender.whatsapp" placeholder="Whatsapp"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="phone_office">Phone Office</label>
                        <input type="text" class="form-control" id="phone_office" ng-model="tender.phone_office" placeholder="Phone Office"/>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile_number" ng-model="tender.mobile_number" placeholder="Mobile Number"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" ng-model="tender.email" placeholder="Email"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="fax_number">Fax Number</label>
                        <input type="text" class="form-control" id="fax_number" ng-model="tender.fax_number" placeholder="Fax Number"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" ng-model="tender.website" placeholder="Website"/>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="instagram">Instagram</label>
                        <input type="text" class="form-control" id="instagram" ng-model="tender.instagram" placeholder="Instagram"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="linkedin">Linkedin</label>
                        <input type="text" class="form-control" id="linkedin" ng-model="tender.linkedin" placeholder="Linkedin"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="twitter">Twitter</label>
                        <input type="text" class="form-control" id="twitter" ng-model="tender.twitter" placeholder="Twitter"/>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="facebook">Facebook</label>
                        <input type="text" class="form-control" id="facebook" ng-model="tender.facebook" placeholder="Facebook"/>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-success float-right" ng-click="saveTender()"><i id="loader" class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tender Information</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tender No</th>
                            <th>Tender Name</th>
                            <th>Tender Date</th>
                            <th>Submission Date</th>
                            <th>Opening Date</th>
                            <th>Document Require</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="t in alltenders">
                            <td ng-bind="t.tender_no"></td>
                            <td ng-bind="t.tender_name"></td>
                            <td ng-bind="t.advertisment_date"></td>
                            <td ng-bind="t.submission_date"></td>
                            <td ng-bind="t.opening_date"></td>
                            <td ng-bind="t.documents_required"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-info" ng-click="editTender(t)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteTender(t.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p id="get-loader" class="text-center"></p>
                <div class="text-center">
                    <button class="btn btn-sm btn-primary" id="loadMore" ng-click="loadMore()"> <i class="fa fa-spinner"></i> Load More</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
@endsection
@section('internaljs')
<script src="{{ asset('ng_controllers/tender/tender-information.js')}}"></script>
@endsection