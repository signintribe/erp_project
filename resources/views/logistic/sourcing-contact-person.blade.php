@extends('layouts.admin.creationTier')
@section('title', 'Contact Person')
@section('pagetitle', 'Contact Person')
@section('breadcrumb', 'Contact Person')
@section('content')
<div ng-controller="CompanyController" ng-cloak>
<div class="card">
        <div class="card-header">
            <h3 class="card-title">Contact Person</h3>
            <a href="#viewContactPerson" class="float-right">View Details</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img ng-if="catimg" ng-src="<% catimg %>" class="img img-thumbnail" style="width:200px; height:200px;">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getLogisticInfo();">
                    <label for="select_employee">Select Organization</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.organization_name for user in Users" ng-model="contactperson.actor_id">
                        <option value="">Select Organization</option>
                    </select>
                    <i class="text-danger" ng-show="!contactperson.actor_id && showError"><small>Please Select Organization</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" ng-model="contactperson.title" placeholder="Title"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" ng-model="contactperson.first_name" placeholder="First Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" ng-model="contactperson.last_name" placeholder="Last Name"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="cat-img">Picture</label>
                        <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);" >
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="contactperson.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="wechat">WeChat</label>
                    <input type="text" class="form-control" id="wechat" ng-model="contactperson.wechat" placeholder="WeChat"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="contactperson.phone_number" placeholder="Phone Number"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="contactperson.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="contactperson.fax_number" placeholder="Fax Number"/>
                </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="contactperson.website" placeholder="Website"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="contactperson.pinterest" placeholder="Pinterest"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="contactperson.instagram" placeholder="Instagram"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="contactperson.linkedin" placeholder="Linkedin"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="contactperson.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="contactperson.facebook" placeholder="Facebook"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="contactperson.email" placeholder="Email"/>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Address detail of contact person</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line1">Postal Address Line 1</label>
                    <input type="text" class="form-control" id="address_line1" ng-model="contactperson.address_line_1" placeholder="Postal Address Line 1"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line2">Postal Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" ng-model="contactperson.address_line_2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector" ng-model="contactperson.sector" placeholder="Sector/Mohallah"/>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="contactperson.city" placeholder="City"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="contactperson.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="contactperson.country" placeholder="Country"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="save_contactPerson()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" id="viewContactPerson">Contact Person</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Phone Number</th>
                        <th>Whatsapp Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getContactPersons()">
                    <tr ng-repeat="contact in contactpersons">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="contact.first_name"></td>
                        <td ng-bind="contact.email"></td>
                        <td ng-bind="contact.mobile_number"></td>
                        <td ng-bind="contact.phone_number"></td>
                        <td ng-bind="contact.whatsapp"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editContactPerson(contact.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteContactPerson(contact.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
   <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
   <input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/logistics/sourcing-contact-person.js')}}"></script>
@endsection