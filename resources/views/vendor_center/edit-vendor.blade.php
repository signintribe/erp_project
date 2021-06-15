@extends('layouts.admin.master')
@section('title', 'Add Vendor Information')
@section('content')
<div  ng-app="VendorApp" ng-controller="VendorController" ng-cloak>
    <div class="card" ng-init="editVendorInformation({{$id}}); organization.id={{$id}}">
        <div class="card-body">
            <h3 class="card-title">Organizational Information</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="vendor_type">*Type Of Vendor</label>
                    <select class="form-control" id="vendor_type" ng-model="organization.vendor_type">
                        <option value="">Select Vendor Type</option>
                        <option value="local">Local</option>
                        <option value="foreign">Foreign</option>
                    </select>
                    <i class="text-danger" ng-show="!organization.vendor_type && showError"><small>Please Select Vendor Type</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="com_name">* Company Name</label>
                    <input type="text" class="form-control" id="company_name" ng-model="organization.company_name" placeholder="Name of Company"/>
                    <i class="text-danger" ng-show="!organization.company_name && showError"><small>Please Enter Company Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="com_address">Company Address</label>
                    <input type="text" class="form-control" id="ntn_no" ng-model="organization.company_address" placeholder="Compant Address"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="telephone_no">Telephone No.</label>
                    <input type="text" class="form-control" id="telehone_no" ng-model="organization.telephone_no" placeholder="Telephone No."/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_no">Mobile No.</label>
                    <input type="text" class="form-control" id="mobile_no" ng-model="organization.mobile_no" placeholder="Mobile No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_no">Fax No.</label>
                    <input type="text" class="form-control" id="telehone_no" ng-model="organization.fax_no" placeholder="Fax No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="organization.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Company Website</label>
                    <input type="text" class="form-control" id="website" ng-model="organization.website" placeholder="Import License No."/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="organization.email" placeholder="Incroporation/License No."/>
                </div>                
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" class="form-control" id="contact_person" ng-model="organization.contact_person" placeholder="Export License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="id-passport">Id/Passport</label>
                    <input type="text" class="form-control" id="id-passport" ng-model="organization.passport" placeholder="Id/Passport"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency">*Currency in Dealing</label>
                    <select class="form-control" id="currency" ng-model="organization.currency">
                        <option value="">Select Currency Type</option>
                        <option value="Dollar">Dollar</option>
                        <option value="RMB">RMB</option>
                        <option value="Euro">Euro</option>
                        <option value="Pounds">Pounds</option>
                        <option value="Pak Rupees">Pak Rupees</option>
                    </select>
                </div><br>
                 <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Nature of Business</label><br/>
                    <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                    <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                    <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Sub Nature of Business</label><br/>
                    <input type="checkbox" id="exporter"/> <label for="exporter">Exporter</label><br/>
                    <input type="checkbox" id="importer"/> <label for="importer">Importer</label><br/>
                    <input type="checkbox" id="contractor"/> <label for="contractor">Contractor</label><br/>
                    <input type="checkbox" id="retailer"/> <label for="retriler">Retailer</label><br/>
                    <input type="checkbox" id="whole_seller"/> <label for="whole_saller">Whole Seller</label><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Type of Business</label><br/>
                    <input type="checkbox" id="private"/> <label for="private">Private limited company</label><br/>
                    <input type="checkbox" id="public"/> <label for="public">Public</label><br/>
                    <input type="checkbox" id="partnership"/> <label for="partnership">Partnership</label><br/>
                    <input type="checkbox" id="sole_proprietor"/> <label for="sole_proprietor">Sole Proprietor</label><br/>
                </div> -->
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="save_vendorInformation()">Save</button>
                </div>
            </div><br/>
        </div>
    </div>
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Vendor = angular.module('VendorApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });


    Vendor.controller('VendorController', function ($scope, $http) {
        $scope.organization = {};
        $scope.appurl = $("#appurl").val();
        $scope.save_vendorInformation = function(){
            if (!$scope.organization.company_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.organization, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.appurl + 'vendor/save-vendor-information', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                   $scope.getVendorInformation();
                });
            }
        };

        $scope.editVendorInformation = function (id) {
            $http.get($scope.appurl + 'vendor/save-vendor-information/'+id+'/edit').then(function (response) {
                $scope.organization = response.data;
            });
        };

        $scope.deleteVendorInformation = function (id) {
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('maintain-vendor-information/' + id).then(function (response) {
                    $scope.getVendorInformation();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

    });
</script>
@endsection