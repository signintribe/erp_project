@extends('layouts.admin.master')
@section('title', 'Vendor Address')
@section('content')
<div  ng-app="OrgAddressApp" ng-controller="OrgAddressController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Organizationals Address</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getVendors();">
                    <label for="organization_name">* Name of Organization</label>
                    <select class="form-control" ng-options="organization.id as organization.organization_name for organization in vendorinformations" ng-model="address.vendor_id">
                        <option value="">Select Organization Name</option>
                    </select>
                    <i class="text-danger" ng-show="!organization.organization_name && showError"><small>Please Enter Organization</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="address_1">* Postal Address Line 1</label>
                                <input type="text" id="address_1" class="form-control" ng-model="address.address_line_1" placeholder="Postal Address Line 1"/>
                                <i class="text-danger" ng-show="!address.address_line_1 && showError"><small>Please Type Address Line</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="address_2">Postal Address Line 2</label>
                                <input type="text" id="address_2" class="form-control" ng-model="address.address_line_2" placeholder="Postal Address Line 2"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="address_3">Postal Address Line 3</label>
                                <input type="text" id="address_3" class="form-control" ng-model="address.address_line_3" placeholder="Postal Address Line 3"/>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="street">* Street</label>
                                <input type="text" id="street" class="form-control" ng-model="address.street" placeholder="Street"/>
                                <i class="text-danger" ng-show="!address.street && showError"><small>Please Type Street</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="sector">Sector/Mohallah</label>
                                <input type="text" id="sector" class="form-control" ng-model="address.sector" placeholder="Sector/Mohallah"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="country">* Country</label>
                                <input type="text" id="country" class="form-control" ng-model="address.country" placeholder="Country"/>
                                <i class="text-danger" ng-show="!address.country && showError"><small>Please Type Country</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="state">* State / Province</label>
                                <input type="text" id="state" class="form-control" ng-model="address.state" placeholder="State / Province"/>
                                <i class="text-danger" ng-show="!address.state && showError"><small>Please Type State / Province</small></i>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="city">* City</label>
                                <input type="text" id="city" class="form-control" ng-model="address.city" placeholder="City"/>
                                <i class="text-danger" ng-show="!address.city && showError"><small>Please Type City</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="zip_code">Zipp Code</label>
                                <input type="text" id="zip_code" class="form-control" ng-model="address.zip_code" placeholder="Zip Code"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" id="postal_code" class="form-control" ng-model="address.postal_code" placeholder="Postal Code"/>
                            </div>
                        </div>
                
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" ng-click="save_address()" class="btn btn-sm btn-success float-right">Save</button>
                </div>
            </div>
        </div>
   </div><br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">All Address</h3>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Organizations Name</th>
                        <th>Street</th>
                        <th>Sector</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Zip Code</th>
                        <th>Postal Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getVendorAddress()">
                    <tr ng-repeat="addr in addresses">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="addr.organization_name"></td>
                        <td ng-bind="addr.street"></td>
                        <td ng-bind="addr.sector"></td>
                        <td ng-bind="addr.country"></td>
                        <td ng-bind="addr.state"></td>
                        <td ng-bind="addr.city"></td>
                        <td ng-bind="addr.zip_code"></td>
                        <td ng-bind="addr.postal_code"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editAddress(addr.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteAddress(addr.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" id="app_url" value="<?php echo env('APP_URL'); ?>">
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Address = angular.module('OrgAddressApp', []);
    Address.controller('OrgAddressController', function ($scope, $http) {
        $scope.appurl = $("#app_url").val();
        $scope.getVendors = function () {
            $scope.vendorinformations = {};
            $http.get('maintain-vendor-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.vendorinformations = response.data;
                }
            });
        };

        $scope.getVendorAddress = function () {
            $http.get('maintain-vendor-address').then(function (response) {
                if (response.data.length) {
                    $scope.addresses = response.data;
                }
            });
        };

        $scope.getAddress = function(address_id){
            $http.get($scope.appurl+'getAddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.address, response.data);
                }
            });
        };

        $scope.editAddress = function (id) {
            $http.get('maintain-vendor-address/' + id + '/edit').then(function (response) {
                if (response.data) {
                    $scope.address = response.data;
                    $scope.address.vendor_id = parseInt(response.data.vendor_id);
                    //console.log($scope.address);
                    $scope.getAddress($scope.address.address_id);
                }
            });
        };

        $scope.deleteAddress = function (id) {
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
                $http.delete('maintain-vendor-address/' + id).then(function (response) {
                    $scope.getVendorAddress();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.address = {};
        $scope.save_address = function () {
            if (!$scope.address.vendor_id || !$scope.address.address_line_1 || !$scope.address.street || !$scope.address.country || !$scope.address.state || !$scope.address.city) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.address, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-vendor-address', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.address = {};
                    $scope.getVendorAddress();
                });
            }
        };


    });
</script>
@endsection