@extends('layouts.admin.creationTier')
@section('title', 'Company Profile')
@section('pagetitle', 'Company Profile')
@section('breadcrumb', 'Company Profile')
@section('content')
<div ng-controller="CompanyController">
    <div class="card" ng-init="editCompany('<?php echo Auth::user()->id; ?>')">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
            <div class="row" ng-if="comLogo">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <img ng-src="<% comLogo %>" class="img-lg rounded"/><br/><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Choose Logo</label>
                            <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Company Name</label>
                            <input type="text" ng-model="company.company_name" ng-blur="check_company(company.company_name);" id="companyname" class="form-control" placeholder="Company Name">
                            <i class="text-danger" ng-show="!company.company_name && showError"><small>Please Type Company Name</small></i>
                            <p ng-if="checkcompany" ng-bind="checkcompany"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Office Timing</label>
                    <div class="input-group">
                        <div class="input-group">
                            <input type="text" class="form-control" ng-model="company.office_timing" placeholder="Office Timing">
                            <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Company Established</label>
                            <select class="form-control" ng-model="company.established">
                                <option value="">Select Year</option>
                                <?php for ($i = 1950; $i <= date('Y'); $i++) { ?>
                                    <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label>Description</label>
                    <textarea ng-model="company.desription" class="form-control" placeholder="Description" rows="3" cols="3"></textarea>
                </div>
            </div><br><hr/>
            <!-- <button type="submit" id="restrict" class="btn btn-success btn-sm float-right" ng-click="save_companyinfo();">Submit</button> -->
            <button type="submit" id="updatebtn" class="btn btn-success btn-sm float-right" ng-click="update_companyinfo();"> <i id="loader" class="fa fa-save"></i> Submit</button>
        </div>
    </div><br/>
<!-- <div class="card d-print-none">
        <div class="card-body" ng-init="get_allcompanyinfo();">
            <h3 class="card-title">All Compaines</h3>
            <small class="text text-danger" ng-bind="deletemessage" ng-if="deletemessage"></small>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>Established</th>
                        <th>Office Timing</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="company in companies">
                        <td ng-bind="$index + 1"></td>
                        <td ng-bind="company.company_id"></td>
                        <td ng-bind="company.company_name"></td>
                        <td ng-bind="company.established"></td>
                        <td ng-bind="company.office_timing"></td>
                        <td ng-bind="company.created_at"></td>
                        <td>
                            <button class="btn btn-info btn-xs" ng-click="editCompany(company.id)">Edit</button>
                            <button class="btn btn-danger btn-xs" ng-click="deleteCompany(company.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div> -->
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_company/company-profile.js')}}"></script>
@endsection