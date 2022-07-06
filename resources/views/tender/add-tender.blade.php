@extends('layouts.admin.creationTier')
@section('title', 'Tender Information')
@section('pagetitle', 'Tender Information')
@section('breadcrumb', 'Tender Information')
@section('content')
<div ng-controller="TenderController">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Advertisement Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="tender_no">* Tender Number</label>
                    <input type="text" ng-model="tender.tender_no" id="" placeholder='Tender Number' class="form-control">
                    <i class="text-danger" ng-show="!tender.tender_no && showError"><small>Please type tender number</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">* Tender Name</label>
                    <input type="text" ng-model="tender.tender_name" id="" placeholder='Tender Name' class="form-control">
                    <i class="text-danger" ng-show="!tender.tender_name && showError"><small>Please type tender name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Tender Type</label>
                    <input type="text" ng-model="tender.tender_type" id="" placeholder='Tender Type' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="advertisment_date">Advertisement Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="advertisment_date" data-target-input="nearest">
                            <input type="text" placeholder="Advertisment Date" ng-model="tender.advertisment_date" class="form-control datetimepicker-input" data-target="#advertisment_date"/>
                            <div class="input-group-append" data-target="#advertisment_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Submission Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="submission_date" data-target-input="nearest">
                            <input type="text" placeholder="Submission Date" ng-model="tender.submission_date" class="form-control datetimepicker-input" data-target="#submission_date"/>
                            <div class="input-group-append" data-target="#submission_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="opening_date">Opening Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="opening_date" data-target-input="nearest">
                            <input type="text" placeholder="Opening Date" ng-model="tender.opening_date" class="form-control datetimepicker-input" data-target="#opening_date"/>
                            <div class="input-group-append" data-target="#opening_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Opening Time</label>
                    <input type="text" ng-model="tender.opening_time" id="" placeholder="Opening Time" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Upload Tender File</label>
                    <input type="file" ng-model="tender.tender_file" id="" class="form-control" onchange="angular.element(this).scope().readUrl(this);">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Tender Opening Venue</label>
                    <input type="text" ng-model="tender.opening_venue" id="" placeholder="Tender Opening Venue" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Tender Fee</label>
                    <input type="text" ng-model="tender.tender_fee" id="" placeholder="Tender Fee" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Bid Money</label>
                    <input type="text" ng-model="tender.bid_money" id="" placeholder="Bid Money" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Mode Of Bid Money</label>
                    <select ng-model="tender.bidmoney_mode" id="" class="form-control">
                        <option value="">Please Select Mode</option>
                        <option value="BG">BG</option>
                        <option value="CDR">CDR</option>
                        <option value="PO">PO</option>
                        <option value="BD">BD</option>
                    </select>
                </div>
            </div><br/>
            <div class="row">
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
                    <label for="expiry_date">Expiry Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="expiry_date" data-target-input="nearest">
                            <input type="text" placeholder="Expiry Date" ng-model="tender.expiry_date" class="form-control datetimepicker-input" data-target="#expiry_date"/>
                            <div class="input-group-append" data-target="#expiry_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Organization/Contact Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Name of Organization</label>
                    <input type="text" ng-model="tender.org.org_name" id="" placeholder="Name of Organization" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Phone/Mobile</label>
                    <input type="text" ng-model="tender.org.org_mobile_number" id="" placeholder="Phone/Mobile" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Fax</label>
                    <input type="text" ng-model="tender.org.org_fax_number" id="" placeholder="Fax" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Website</label>
                    <input type="text" ng-model="tender.org.org_website" id="" placeholder="Website" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Email</label>
                    <input type="text" ng-model="tender.org.org_email" id="" placeholder="Email" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Postal Address Line 1</label>
                    <input type="text" ng-model="tender.address.address_line_1" id="" placeholder="Postal Address Line 1" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Postal Address Line 2</label>
                    <input type="text" ng-model="tender.address.address_line_2" id="" placeholder="Postal Address Line 2" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Street</label>
                    <input type="text" ng-model="tender.address.street" id="" placeholder="Street" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Sector/Mohallah</label>
                    <input type="text" ng-model="tender.address.sector" id="" placeholder="Sector/Mohallah" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">City</label>
                    <input type="text" ng-model="tender.address.city" id="" placeholder="City" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">State/Province</label>
                    <input type="text" ng-model="tender.address.state" id="" placeholder="State/Province" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Country</label>
                    <input type="text" ng-model="tender.address.country" id="" placeholder="Country" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Postal Code</label>
                    <input type="text" ng-model="tender.address.postal_code" id="" placeholder="Postal Code" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="zip_code">Zip Code</label>
                    <input type="text" ng-model="tender.address.zip_code" id="zip_code" placeholder="Zip Code" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Phone Number</label>
                    <input type="text" ng-model="tender.org.phone_number" id="" placeholder="Phone Number" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                   <label for="">Facebook</label>
                   <input type="text" ng-model="tender.org.org_facebook" id="" placeholder="Facebook" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Linkedin</label>
                    <input type="text" ng-model="tender.org.org_linkedin" id="" placeholder="Linkedin" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Whatsapp</label>
                    <input type="text" ng-model="tender.org.org_whatsapp" id="" placeholder="Whatsapp" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Twitter</label>
                    <input type="text" ng-model="tender.org.org_twitter" id="" placeholder="Twitter" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Instgram</label>
                    <input type="text" ng-model="tender.org.org_instagram" id="" placeholder="Instgram" class="form-control">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pintrest">Pintrest</label>
                    <input type="text" ng-model="tender.org.org_pinterest" id="pintrest" placeholder="Pintrest" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Contact Person Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Name Of Contact Person</label>
                    <input type="text" ng-model="tender.contact.person_name" id="" placeholder="Name of Contact Person" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Designation</label>
                    <input type="text" ng-model="tender.contact.designation" id="" placeholder="Designation" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Phone Office</label>
                    <input type="text" ng-model="tender.contact.phone_office" id="" placeholder="Phone Office" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Mobile Number</label>
                    <input type="text" ng-model="tender.contact.mobile_number" id="" placeholder="Mobile Number" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax">Fax Number</label>
                    <input type="text" ng-model="tender.contact.fax_number" id="" placeholder="Fax Number" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Email</label>
                    <input type="text" ng-model="tender.contact.email" id="" placeholder="Email" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Facebook</label>
                    <input type="text" ng-model="tender.contact.facebook" id="" placeholder="Facebook" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Linkedin</label>
                    <input type="text" ng-model="tender.contact.linkedin" id="" placeholder="Linkedin" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Whatsapp</label>
                    <input type="text" ng-model="tender.contact.whatsapp" id="" placeholder="Whatsapp" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Twitter</label>
                    <input type="text" ng-model="tender.contact.twitter" id="" placeholder="Twitter" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Instgram</label>
                    <input type="text" ng-model="tender.contact.instagram" id="" placeholder="Instgram" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" ng-model="tender.contact.website" id="website" placeholder="Website" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <button class="btn btn-success btn-sm float-right" ng-click="saveTender()"> <i id="loader" class="fa fa-save"></i> Save</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Tenders</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Tender Number</th>
                            <th>Tender Name</th>
                            <th>Tender Type</th>
                            <th>Opening Date</th>
                            <th>Submission Date</th>
                            <th>Tender Venue</th>
                            <th>Tender Fee</th>
                            <th>Bid Money</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getTendersInfo()">
                        <tr ng-repeat="tend in alltenders">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="tend.tender_no"></td>
                            <td ng-bind="tend.tender_name"></td>
                            <td ng-bind="tend.tender_type"></td>
                            <td ng-bind="tend.opening_date"></td>
                            <td ng-bind="tend.submission_date"></td>
                            <td ng-bind="tend.opening_venue"></td>
                            <td ng-bind="tend.tender_fee"></td>
                            <td ng-bind="tend.bid_money"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-xs" ng-click="editTender(tend.id)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="deleteTender(tend.id)">Delete</button>
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
    <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
</div>
@endsection
@section('internaljs')
<script src="{{ asset('ng_controllers/tender/tender-information.js')}}"></script>
@endsection