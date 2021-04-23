@extends('layouts.admin.master')
@section('title', 'Vendor Information')
@section('content')
<div  ng-app="VendorApp" ng-controller="VendorController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Organizational Information</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_name">Name of Organization</label>
                    <input type="text" class="form-control" id="organization_name" ng-model="organization.organization_name" placeholder="Name of Organization"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="ntn_no">NTN</label>
                    <input type="text" class="form-control" id="ntn_no" ng-model="organization.ntn_no" placeholder="NTN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="incroporation_no">Incroporation/License No.</label>
                    <input type="text" class="form-control" id="incroporation_no" ng-model="organization.incroporation_no" placeholder="Incroporation/License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_logo">Organization Logo</label>
                    <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"/>
                    <img ng-if="orglogo" ng-src="<% orglogo %>" class="img img-thumbnail" style-="width:100%; height:200px;">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="strn">STRN</label>
                    <input type="text" class="form-control" id="strn" ng-model="organization.strn" placeholder="STRN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="import_license">Import License No.</label>
                    <input type="text" class="form-control" id="import_license" ng-model="organization.import_license" placeholder="Import License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="export_license">Export License No.</label>
                    <input type="text" class="form-control" id="export_license" ng-model="organization.export_license" placeholder="Export License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="chamber_no">Chamber of Commerce License No.</label>
                    <input type="text" class="form-control" id="chamber_no" ng-model="organization.chamber_no" placeholder="Chamber of Commerce License No."/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency_dealing">Currency in dealing</label>
                    <input type="text" class="form-control" id="currency_dealing" ng-model="organization.currency_dealing" placeholder="Currency in dealing"/>
                </div>
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
            </div>
        </div>
    </div><br/>
    <!-- <div class="card">
        <div class="card-body">
            <h3 class="card-title">Select product categories and attributes</h3>
        </div>
    </div><br> -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Organization Name</th>
                        <th>NTN</th>
                        <th>Incroporation/License No</th>
                        <th>STRN</th>
                        <th>Chamber of Commerce License No.</th>
                        <th>Currency in dealing</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getVendorInformation()">
                    <tr ng-repeat="vendor in vendorinformations">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="vendor.organization_name"></td>
                        <td ng-bind="vendor.ntn_no "></td>
                        <td ng-bind="vendor.incroporation_no"></td>
                        <td ng-bind="vendor.strn"></td>
                        <td ng-bind="vendor.chamber_no"></td>
                        <td ng-bind="vendor.currency_dealing"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editVendorInformation(vendor.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteVendorInformation(vendor.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
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
            if (!$scope.organization.organization_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.organization, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-vendor-information', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.organization = {};
                   $scope.getVendorInformation();
                });
            }
        };


        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.orglogo = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.organization.organization_logo = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };


        $scope.getVendorInformation = function () {
            $scope.vendorinformations = {};
            $http.get('maintain-vendor-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.vendorinformations = response.data;
                }
            });
        };

        $scope.editVendorInformation = function (id) {
            $http.get('maintain-vendor-information/'+id+'/edit').then(function (response) {
                $scope.organization = response.data;
                $scope.orglogo = $scope.appurl + "public/organization_logo/" + $scope.organization.organization_logo;
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