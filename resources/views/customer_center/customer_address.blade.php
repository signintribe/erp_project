@extends('layouts.subuser.master')
@section('title', 'Customer Address')
@section('content')
<div  ng-app="CustomerAddressApp" ng-controller="CustomerAddressController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Customer Address</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_name">Name of Customer</label>
                    <select class="form-control" id="customer_name" ng-model="address.customer_name">
                        <option value="">Select Customer Name</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line1">Postal Address Line 1</label>
                    <input type="text" class="form-control" id="address_line1" ng-model="address.address_line1" placeholder="Postal Address Line 1"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line2">Postal Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" ng-model="address.address_line2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector" ng-model="address.sector" placeholder="Sector/Mohallah"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="address.city" placeholder="City"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="address.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="address.country" placeholder="Country"/>
                </div>
                
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var CustomerAddress = angular.module('CustomerAddressApp', []);
    CustomerAddress.controller('CustomerAddressController', function ($scope, $http) {

    });
</script>
@endsection