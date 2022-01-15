@extends('layouts.admin.creationTier')
@section('title', 'Add Vendor')
@section('pagetitle', 'Add Vendor')
@section('breadcrumb', 'Add Vendor')
@section('content')
<div  ng-app="VendorApp" ng-controller="VendorController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Vendor</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <img ng-if="orglogo" ng-src="<% orglogo %>" class="img img-thumbnail" style-="width:100%; height:200px;">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="logistic_type">Select Logistic</label>
                    <select id="logistic_type" class="form-control" ng-model="organization.vendor_type">
                        <option value="">* Select Logistic</option>
                        <option value="Local">Local Vendor</option>
                        <option value="International">International Vendor</option>
                    </select>
                    <i class="text-danger" ng-show="!organization.vendor_type && showError"><small>Please Select Vendor Type</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_name">* Name of Organization</label>
                    <input type="text" class="form-control" id="organization_name" ng-model="organization.organization_name" placeholder="Name of Organization"/>
                    <i class="text-danger" ng-show="!organization.organization_name && showError"><small>Please Enter Organization</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency_dealing">Currency in dealing</label>
                    <input type="text" class="form-control" id="currency_dealing" ng-model="organization.currency_dealing" placeholder="Currency in dealing"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_logo">Organization Logo</label>
                    <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"/>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Address Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">* Postal Address Line 1</label>
                        <input type="text" id="address_1" class="form-control" ng-model="organization.address_line_1" placeholder="Postal Address Line 1"/>
                        <i class="text-danger" ng-show="!organization.address_line_1 && showError"><small>Please Type Address Line</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Postal Address Line 2</label>
                        <input type="text" id="address_2" class="form-control" ng-model="organization.address_line_2" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_3">Postal Address Line 3</label>
                        <input type="text" id="address_3" class="form-control" ng-model="organization.address_line_3" placeholder="Postal Address Line 3"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="street">* Street</label>
                        <input type="text" id="street" class="form-control" ng-model="organization.street" placeholder="Street"/>
                        <i class="text-danger" ng-show="!organization.street && showError"><small>Please Type Street</small></i>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" id="sector" class="form-control" ng-model="organization.sector" placeholder="Sector/Mohallah"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="country">* Country</label>
                        <input type="text" id="country" class="form-control" ng-model="organization.country" placeholder="Country"/>
                        <i class="text-danger" ng-show="!organization.country && showError"><small>Please Type Country</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="state">* State / Province</label>
                        <input type="text" id="state" class="form-control" ng-model="organization.state" placeholder="State / Province"/>
                        <i class="text-danger" ng-show="!organization.state && showError"><small>Please Type State / Province</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">* City</label>
                        <input type="text" id="city" class="form-control" ng-model="organization.city" placeholder="City"/>
                        <i class="text-danger" ng-show="!organization.city && showError"><small>Please Type City</small></i>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip_code">Zipp Code</label>
                        <input type="text" id="zip_code" class="form-control" ng-model="organization.zip_code" placeholder="Zip Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" class="form-control" ng-model="organization.postal_code" placeholder="Postal Code"/>
                    </div>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Contact Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">* Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="organization.phone_number" placeholder="Phone Number"/>
                    <i class="text-danger" ng-show="!organization.phone_number && showError"><small>Please Enter Phone no</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="organization.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="organization.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="organization.linkedin" placeholder="Linkedin"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="organization.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="organization.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="organization.email" placeholder="Email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="organization.website" placeholder="Website"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="organization.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="organization.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="organization.instagram" placeholder="Instagram"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="save_vendorInformation()"><i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Vendors</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Organization Logo</th>
                        <th>Organization Name</th>
                        <th>Currency in dealing</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getVendorInformation()">
                    <tr ng-repeat="vendor in vendorinformations">
                        <td ng-bind="$index+1"></td>
                        <td>
                            <img ng-src="{{asset('public/organization_logo/<% vendor.organization_logo %>')}}" alt="" class="img img-sm">
                        </td>
                        <td ng-bind="vendor.organization_name"></td>
                        <td ng-bind="vendor.currency_dealing"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editVendorInformation(vendor.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteVendorInformation(vendor.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> 
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
    <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Vendor = angular.module('VendorApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });


    Vendor.controller('VendorController', function ($scope, $http) {
        $("#purchase").addClass('menu-open');
        $("#purchase a[href='#']").addClass('active');
        $("#add-vendor").addClass('active');
        $scope.organization = {};
        $scope.appurl = $("#appurl").val();
        $scope.save_vendorInformation = function(){
            if (!$scope.organization.organization_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $scope.organization.company_id = $("#company_id").val();
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
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
                   $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                });
            }
        };


        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.orglogo = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.organization.org_logo = element.files[0];
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
                $scope.editAddress($scope.organization.address_id);
                $scope.editContact($scope.organization.contact_id);
                $scope.editSocial($scope.organization.social_id);
            });
        };

        $scope.editAddress = function (address_id) {
            $http.get($scope.appurl + 'sourcing/get-log-address/' + address_id).then(function (response) {
                angular.extend($scope.organization, response.data[0]);
                //console.log($scope.inventory);
            });
        };

        $scope.editContact = function (contact_id) {
            $http.get($scope.appurl + 'sourcing/get-log-contact/' + contact_id).then(function (response) {
                angular.extend($scope.organization, response.data[0]);
                //console.log($scope.inventory);
            });
        };

        $scope.editSocial = function (social_id) {
            $http.get($scope.appurl + 'sourcing/get-log-social/' + social_id).then(function (response) {
                angular.extend($scope.organization, response.data[0]);
                //console.log($scope.inventory);
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
                    if(response.data.status == true){
                        $scope.getVendorInformation();
                        swal("Deleted!", response.data.message, "success");
                    }else{
                        swal("Not Deleted!", response.data.message, "error");
                    }
                });
            });
        };

    });
</script>
@endsection