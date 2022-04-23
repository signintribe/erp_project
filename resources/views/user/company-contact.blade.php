@extends('layouts.admin.creationTier')
@section('title', 'Company Contact')
@section('pagetitle', 'Company Contact')
@section('breadcrumb', 'Company Contact')
@section('content')
<div ng-controller="ComContactController">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h2 class="card-title">Please Add Your Company Contact</h2>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>  
        </div>
        <div class="card-body">          
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Email</label>
                    <div class="input-group">
                        <div class="input-group">
                            <input type="email" class="form-control" ng-model="company.email" placeholder="Email">
                            <div class="input-group-addon input-group-append"><i class="fa fa-envelope input-group-text"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Phone Number</label>
                            <input type="text" ng-model="company.phone_number" class="form-control" placeholder="Phone Number">
                            <i class="text-danger" ng-show="!company.phone_number && showError"><small>Please Type Phone Number</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Mobile Number</label>
                            <input type="text" ng-model="company.mobile_number" class="form-control" placeholder="Mobile Number">
                            <i class="text-danger" ng-show="!company.mobile_number && showError"><small>Please Type Mobile Number</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Fax Number</label>
                            <input type="text" ng-model="company.fax_number" class="form-control" placeholder="Fax Number">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Facebook Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.facebook" placeholder="Facebook Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-facebook input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>* Linkedin</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.linkedin" placeholder="Linkedin">
                        <div class="input-group-addon input-group-append"><i class="fa fa-linkedin input-group-text"></i></div>
                    </div>
                    <i class="text-danger" ng-show="!company.linkedin && showError"><small>Please Type Linkedin</small></i>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Youtube Channel</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.youtube" placeholder="Youtube Channel">
                        <div class="input-group-addon input-group-append"><i class="fa fa-youtube input-group-text"></i></div>
                    </div>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Twitter Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.twitter" placeholder="Twitter Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-twitter input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>* Website</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.website" placeholder="Website">
                        <div class="input-group-addon input-group-append"><i class="fa fa-globe input-group-text"></i></div>
                    </div>
                    <i class="text-danger" ng-show="!company.linkedin && showError"><small>Please Type Website</small></i>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <div class="input-group">
                        <input type="text" id="instagram" class="form-control" ng-model="company.instagram" placeholder="Instagram"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-instagram input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <div class="input-group">
                        <input type="text" id="pinterest" class="form-control" ng-model="company.pinterest" placeholder="Pinterest"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-pinterest input-group-text"></i></div>
                    </div>
                </div>
            </div><br/>
            <button type="submit" id="restrict" class="btn btn-success btn-sm float-right" ng-click="save_comContactInfo();"> <i class="fa fa-save" id="loader"></i> Submit</button>
            <!-- <button type="submit" id="updatebtn" class="btn btn-success btn-sm float-right" ng-click="update_companyinfo();">Submit</button> -->
        </div>
    </div><br/>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Company Contacts</h3>
        </div>
        <div class="card-body" ng-init="get_companycontact();">
            <small class="text text-danger" ng-bind="deletemessage" ng-if="deletemessage"></small><br/>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="company in contacts">
                        <td ng-bind="$index + 1"></td>
                        <td ng-bind="company.company_name"></td>
                        <td ng-bind="company.mobile_number"></td>
                        <td ng-bind="company.email"></td>
                        <td ng-bind="company.website"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info btn-xs" ng-click="editComContact(company.id)">Edit</button>
                                <button class="btn btn-danger btn-xs" ng-click="deleteComContact(company.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" id="baseurl" value="<?php echo env('APP_URL'); ?>">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_company/company-contact.js')}}"></script>
@endsection