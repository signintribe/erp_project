@extends('layouts.admin.creationTier')
@section('title', 'Attributes')
@section('pagetitle', 'Attributes')
@section('breadcrumb', 'Attributes')
@section('content')
<link rel="stylesheet" href="{{ asset('public/dashboard/vendors/icheck/skins/all.css')}}">
<div class="row" ng-controller="AttributeController">
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Attribute</h4>
            </div>
            <div class="card-body">
                <p class="card-description" ng-if="save_message" ng-bind="save_message"></p>
                <div class="form-group row">
                    <div class="col">
                        <label>* Attribute Name:</label>
                        <input type="text" class="form-control" placeholder="Attribute Name" ng-model="attribute.attribute_name"/>
                        <i class="text-danger" ng-show="!attribute.attribute_name && showError"><small>Please Type Attribute Name</small></i>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <div class="col">
                        <label>Measurement:</label>
                        <input type="text" class="form-control" placeholder="Measurement" ng-model="category.measurement"/>
                        <small class="text text-muted">Add category measurement if add 3rd level category</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>Category Description:</label>
                        <textarea class="form-control" placeholder="Category Description" ng-model="category.category_description" rows="5" cols="5"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>Category Image:</label>
                        <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"><br/>
                        <img ng-if="catimage" ng-src="<% catimage %>" class="img img-responsive" style="width: 100%; height: 200px;"/>
                    </div>
                </div> -->
                <div class="form-group row">
                    <div class="col" ng-init="get_allcategories()">
                        <label>Parent Category:</label>
                        <select class="form-control" ng-options="cat.id as cat.category_name for cat in categories" ng-model="attribute.category_id">
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm" ng-click="save_attributeInformation()"> <i class="fa fa-save" id="loader"></i> Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Attribute</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Category Name</th>
                            <th>Attributes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAttributeInformation()">
                        <tr ng-repeat="attribute in attributeinformations">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="attribute.category_name"></td>
                            <td ng-bind="attribute.attribute_name "></td>
                            <td>
                                <button class="btn btn-xs btn-info" ng-click="editAttributeInformation(attribute.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteAttributeInformation(attribute.id)">Delete</button>
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
<script src="{{asset('ng_controllers/material_management/attributes.js')}}"></script>
@endsection