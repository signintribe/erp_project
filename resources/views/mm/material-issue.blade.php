@extends('layouts.admin.master')
@section('title', 'Material Issue')
@section('content')
<div  ng-app="MaterialissueApp" ng-controller="MaterialissueController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Selected Category Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="store_name">Store</label>
                    <input type="text" id="store_name" class="form-control" ng-model="materialissue.store_name" placeholder="Store Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="product-name">Name of product/service</label>
                    <input type="text" id="product-name" class="form-control" ng-model="materialissue.product_name" placeholder="Name of product/service"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="stock-inhand">Stock in hand</label>
                    <input type="text" id="stock-inhand" class="form-control" ng-model="materialissue.stock_inhand" placeholder="Stock in hand"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="required-quantity">Required Quantity</label>
                    <input type="text" id="required-quantity" class="form-control" ng-model="materialissue.required_quantity" placeholder="Required Quantity"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" ng-model="materialissue.description" placeholder="Description"></textarea>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Pending Requisitioner Information</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="company_name">Company Name</label>
                    <input type="text" id="company_name" class="form-control" ng-model="materialissue.company_name" placeholder="Company Name"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="department">Select Department</label>
                    <select id="department" class="form-control" ng-model="materialissue.department">
                        <option value="">Select Department</option>
                    </select>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="employee">Select Employee</label>
                    <select id="employee" class="form-control" ng-model="materialissue.employee">
                        <option value="">Select Employee</option>
                    </select>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="requisition_date">Requisition Date</label>
                    <input type="text" id="requisition_date" class="form-control" ng-model="materialissue.requisition_date" placeholder="Requisition Date"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="delivery_date">Delivery Date</label>
                    <input type="text" id="delivery_date" class="form-control" ng-model="materialissue.delivery_date" placeholder="Delivery Date"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="delivery_location">Delivery Location</label>
                    <input type="text" id="delivery_location" class="form-control" ng-model="materialissue.delivery_location" placeholder="Delivery Location"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="delivery_mode">Delivery Mode</label>
                    <input type="text" id="delivery_mode" class="form-control" ng-model="materialissue.delivery_mode" placeholder="Delivery Mode"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="delivery_status">Delivery Status</label>
                    <select class="form-control" ng-model="materialissue.delivery_status">
                        <option value="">Select Delivery Status</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Approval Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="approver_name">Approver Name</label>
                    <input type="text" class="form-control" ng-model="materialissue.approver_name" placeholder="Approver Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="designation">Designation</label>
                    <input type="text" id="designation" class="form-control" ng-model="materialissue.designation" placeholder="Designation"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="approval_status">Approval Status</label>
                    <select id="approval_status" class="form-control">
                        <option value="">Select Approval Status</option>
                        <option value="Approved">Approved</option>
                        <option value="Declined">Declined</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="approved_quantity">Approved Quantity</label>
                    <input type="text" id="approved_quantity" class="form-control" ng-model="materialissue.approved_quantity" placeholder="Approved Quantity"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="approval_date">Approval Date</label>
                    <input type="text" id="approval_date" class="form-control" ng-model="materialissue.approval_date" placeholder="Approval Date"/>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Material Issue Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quantity_issue">Quantity Issue</label>
                    <input type="text" id="quantity_issue" class="form-control" ng-model="materialissue.quantity_issue" placeholder="Quantity Issue"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="issuance_date">Issuance Date</label>
                    <input type="text" id="issuance_date" class="form-control" ng-model="materialissue.issuance_date" placeholder="Issuance Date"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="store_keeper">Store Keeper Name</label>
                    <input type="text" id="store_keeper" class="form-control" ng-model="materialissue.store_keeper" placeholder="Store Keeper Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="storekeeper_designation">Designation</label>
                    <input type="text" id="storekeeper_designation" class="form-control" ng-model="materialissue.storekeeper_designation" placeholder="Designation"/>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Materialissue = angular.module('MaterialissueApp', []);
    Materialissue.controller('MaterialissueController', function ($scope, $http) {

    });
</script>
@endsection