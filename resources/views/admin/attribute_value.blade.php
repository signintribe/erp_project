@extends('layouts.admin.creationTier')
@section('title', 'Attribute Values')
@section('pagetitle', 'Attribute Values')
@section('breadcrumb', 'Attribute Values')
@section('content')
<link rel="stylesheet" href="{{ asset('public/dashboard/vendors/icheck/skins/all.css')}}">
<div class="row" ng-controller="AttributeValueController">
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Attribute Values</h4>
            </div>
            <div class="card-body">
                <p class="card-description" ng-if="save_message" ng-bind="save_message"></p>
                <div class="form-group row">
                    <div class="col">
                        <label>* Attribute Value Name:</label>
                        <input type="text" class="form-control" placeholder="Attribute Name" ng-model="value.value_name"/>
                        <i class="text-danger" ng-show="!value.value_name && showError"><small>Please Type Attribute Name</small></i>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col" ng-init="productCategory();">
                        <label for="category_id">* Select Category:</label>
                        <select ng-model="value.category_id" class="form-control" ng-change="get_allattributes(value.category_id)" id="category_id" ng-options="cats.id as cats.category_name for cats in productCategories">
                            <option value="">Select Category</option>
                        </select>
                        <i class="text-danger" ng-show="!value.value_name && showError"><small>Please Type Attribute Name</small></i>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>Attribute Name:</label>
                        <select class="form-control" style="text-transform: capitalize;" ng-options="atr.id as atr.attribute_name for atr in attributes" ng-model="value.attribute_id">
                            <option value="">Select Attribute</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm" ng-click="save_attributevalueInfo()"> <i class="fa fa-save" id='loader'></i> Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Attribute Values</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Category Name</th>
                            <th>Attribute Name</th>
                            <th>Value Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAttributeValueInfo()">
                        <tr ng-repeat="atrvalue in attributevalueinfo">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="atrvalue.category_name" style="text-transform: capitalize;"></td>
                            <td ng-bind="atrvalue.attribute_name" style="text-transform: capitalize;"></td>
                            <td ng-bind="atrvalue.value_name " style="text-transform: capitalize;"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-info" ng-click="editAttributeValueInfo(atrvalue.id)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteAttributeValueInfo(atrvalue.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/material_management/attribute_value.js')}}"></script>
@endsection