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
                    <div class="col-lg-3 col-md-3 col-sm-3">
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
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-name">Tender Name</label>
                        <input type="text" class="form-control" id="tender-name" placeholder="Tender Name" ng-model="tender.tender_name">
                        <i class="text-danger" ng-show="!tender.tender_name && showError"><small>Please type tender name</small></i>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-qty">Qty</label>
                        <input type="text" class="form-control" id="tender-qty" placeholder="Qty" ng-model="tender.qty">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-date">Tender Date</label>
                        <div class="form-group">
                            <div class="input-group date" id="tender_date" data-target-input="nearest">
                                <input type="text" placeholder="Tender Date" ng-model="tender.tender_date" class="form-control datetimepicker-input" data-target="#tender_date"/>
                                <div class="input-group-append" data-target="#tender_date" data-toggle="datetimepicker">
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
                    <div class="col-lg-3 col-md-3 col-sm-3">
                    
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-success float-right" ng-click="saveTender()"><i id="loader" class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </div><br/>
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
                            <th>Department</th>
                            <th>Qty</th>
                            <th>Tender Date</th>
                            <th>Submission Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="t in alltenders">
                            <td ng-bind="t.tender_no"></td>
                            <td ng-bind="t.tender_name"></td>
                            <td ng-bind="t.department_name"></td>
                            <td ng-bind="t.qty"></td>
                            <td ng-bind="t.tender_date"></td>
                            <td ng-bind="t.submission_date"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-info" ng-click="editTender(t.id)">Edit</button>
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