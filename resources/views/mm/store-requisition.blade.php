@extends('layouts.admin.master')
@section('title', 'Store Requisition')
@section('content')
<div  ng-app="RequisitionApp" ng-controller="RequisitionController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Selected Category Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="store-name">Store Name</label>
                    <input type="text" id="store-name" class="form-control" ng-model="requisition.store_name" placeholder="Store Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="product-name">Name of product/service</label>
                    <input type="text" id="product-name" class="form-control" ng-model="requisition.product_name" placeholder="Name of product/service"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="stock-inhand">Stock in hand</label>
                    <input type="text" id="stock-inhand" class="form-control" ng-model="requisition.stock_inhand" placeholder="Stock in hand"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="required-quantity">Required Quantity</label>
                    <input type="text" id="required-quantity" class="form-control" ng-model="requisition.required_quantity" placeholder="Required Quantity"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" ng-model="requisition.description" placeholder="Description"></textarea>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Requisitioner Information</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="company_name">Company Name</label>
                    <input type="text" id="company_name" class="form-control" ng-model="requisition.company_name" placeholder="Company Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="circle_office">Circle/Zonal Office</label>
                    <input type="text" id="circle_office" class="form-control" ng-model="requisition.circle_office" placeholder="Circle/Zonal Office"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="division">Division</label>
                    <input type="text" id="division" class="form-control" ng-model="requisition.division" placeholder="Division"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sub_division">Sub Division</label>
                    <input type="text" id="sub_division" class="form-control" ng-model="requisition.sub_division" placeholder="Sub Division"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="department">Select Department</label>
                    <select id="department" class="form-control" ng-model="requisition.department">
                        <option value="">Select Department</option>
                    </select>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="employee">Select Employee</label>
                    <select id="employee" class="form-control" ng-model="requisition.employee">
                        <option value="">Select Employee</option>
                    </select>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="requisition_date">Requisition Date</label>
                    <input type="text" id="requisition_date" class="form-control" ng-model="requisition.requisition_date" placeholder="Requisition Date"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="delivery_date">Delivery Date</label>
                    <input type="text" id="delivery_date" class="form-control" ng-model="requisition.delivery_date" placeholder="Delivery Date"/>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Requisition = angular.module('RequisitionApp', []);
    Requisition.controller('RequisitionController', function ($scope, $http) {

    });
</script>
@endsection