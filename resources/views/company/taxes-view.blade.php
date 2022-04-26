@extends('layouts.admin.creationTier')
@section('title', 'Company Taxes')
@section('pagetitle', 'Company Taxes')
@section('breadcrumb', 'Company Taxes')
@section('content')
<div ng-controller="TaxController" ng-cloak>
    <div class="row" ng-init="restScope()">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Add Taxes</h3>
                        </div>
                        <div class="col">
                            <div class="btn-group float-right">
                                <a href="#allTaxes" class="btn btn-xs btn-warning">Show Company Taxes</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label for="authority">* Select Tax Authority</label>
                            <select ng-model="tax.tax_authority" id="authority" class="form-control" ng-options="reg.id as reg.authority_name for reg in allregistration">
                                <option value="">Select Tax Autrority</option>
                            </select>
                            <i class="text-danger" ng-show="!tax.tax_authority && showError"><small>Please select registration authority</small></i>
                        </div>
                        <div class="col">
                            <label for="tax_demography">Tax Demography</label>
                            <input type="text" ng-model="tax.tax_demography" class="form-control">
                        </div>
                        <div class="col">
                            <label for="start_limit">Tax Start Limit</label>
                            <input type="number" ng-model="tax.start_limit" id="start_limit" class="form-control">
                        </div>
                        <div class="col">
                            <label for="end_limit">Tax End Limit</label>
                            <input type="number" ng-model="tax.end_limit" id="end_limit" class="form-control">
                        </div>
                    </div> <br/>
                    <div class="row">
                        <div class="col">
                            <label for="tax_percentage">Tax Percentage</label>
                            <input type="number" ng-model="tax.tax_percentage" id="tax_percentage" class="form-control">
                        </div>
                        <div class="col">
                            <label for="tax_levid">Taxt Levid On</label>
                            <input type="text" ng-model="tax.tax_levid" id="tax_levid" class="form-control">
                        </div>
                        <div class="col">
                            <label for="tax_nature">Tax Nature</label>
                            <input type="text" ng-model="tax.tax_nature" id="tax_nature" class="form-control">
                        </div>
                        <div class="col">
                            <label for="liability_head">Tax Liability A/C Head</label>
                            <select ng-model="tax.liability_head" id="liability_head" class="form-control" ng-options="acc.id as acc.CategoryName for acc in accountHeads">
                                <option value="">Select Liability A/C Head</option>
                            </select>
                        </div>
                    </div> <br/>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="expanse_head">Tax Expanse A/C Head</label>
                            <select ng-model="tax.expanse_head" id="expanse_head" class="form-control" ng-options="acc.id as acc.CategoryName for acc in accountHeads">
                                <option value="">Select Expanse A/C Head</option>
                            </select>
                        </div>
                        <div class="col">
                           
                        </div>
                    </div> <br/>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-sm btn-success" ng-click="saveTax()"> <i class="fa fa-save" id="loader"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" id="allTaxes">All Taxes</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Authority</th>
                                    <th>Demography</th>
                                    <th>Start Limit</th>
                                    <th>End Limit</th>
                                    <th>Laibility Head</th>
                                    <th>Expanse Head</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="t in Taxes">
                                    <td ng-bind="t.authority_name"></td>
                                    <td ng-bind="t.tax_demography"></td>
                                    <td ng-bind="t.start_limit"></td>
                                    <td ng-bind="t.end_limit"></td>
                                    <td ng-bind="t.liabAcc"></td>
                                    <td ng-bind="t.expAcc"></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-info" ng-click="editTaxes(t.id)">Edit</button>
                                            <button class="btn btn-xs btn-danger" ng-click="deleteTaxes(t.id)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<input type="hidden" value="<?php echo env('APP_URL'); ?>" id="appurl">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_finance/taxes.js')}}"></script>
@endsection