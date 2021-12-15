@extends('layouts.admin.creationTier')
@section('title', 'Autorities')
@section('pagetitle', 'Autorities')
@section('breadcrumb', 'Autorities')
@section('content')
<div  ng-app="RegistrationApp" ng-controller="RegistrationController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Autority</h3>
                </div>
                <div class="col">
                    <div class="btn-group float-right">
                        <button class="btn btn-xs btn-primary" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                        <a href="#allAuthorities" class="btn btn-xs btn-warning">Show Authorities</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="registration-authority">* Registration Authority</label>
                    <input type="text" class="form-control" ng-model="authority.authority_name" placeholder="Authority Name">
                    <i class="text-danger" ng-show="!authority.authority_name && showError"><small>Please type registration authority</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_1">* Postal Address Line 1</label>
                    <input type="text" id="address_1" class="form-control" ng-model="authority.address_line_1" placeholder="Postal Address Line 1"/>
                    <i class="text-danger" ng-show="!authority.address_line_1 && showError"><small>Please Type Address Line</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_2">Postal Address Line 2</label>
                    <input type="text" id="address_2" class="form-control" ng-model="authority.address_line_2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_3">Postal Address Line 3</label>
                    <input type="text" id="address_3" class="form-control" ng-model="authority.address_line_3" placeholder="Postal Address Line 3"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="street">Street</label>
                    <input type="text" id="street" class="form-control" ng-model="authority.street" placeholder="Street"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" id="sector" class="form-control" ng-model="authority.sector" placeholder="Sector/Mohallah"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">* Country</label>
                    <input type="text" id="country" class="form-control" ng-model="authority.country" placeholder="Country"/>
                    <i class="text-danger" ng-show="!authority.country && showError"><small>Please Type Country</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State / Province</label>
                    <input type="text" id="state" class="form-control" ng-model="authority.state" placeholder="State / Province"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" id="city" class="form-control" ng-model="authority.city" placeholder="City"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="postal-code">Postal Code</label>
                    <input type="text" id="postal-code" class="form-control" ng-model="authority.postal_code" placeholder="Postal Code"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="zip-code">Zip Code</label>
                    <input type="text" id="zip-code" class="form-control" ng-model="authority.zip_code" placeholder="Zip Code"/>
                </div>
            </div><br/>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" id="allAuthorities">Please Add Contact Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Email</label>
                    <div class="input-group">
                        <div class="input-group">
                            <input type="email" class="form-control" ng-model="authority.email" placeholder="Email">
                            <div class="input-group-addon input-group-append"><i class="fa fa-envelope input-group-text"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Phone Number</label>
                            <input type="text" ng-model="authority.phone_number" class="form-control" placeholder="Phone Number">
                            <i class="text-danger" ng-show="!authority.phone_number && showError"><small>Please Type Phone Number</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Mobile Number</label>
                            <input type="text" ng-model="authority.mobile_number" class="form-control" placeholder="Mobile Number">
                            <i class="text-danger" ng-show="!authority.mobile_number && showError"><small>Please Type Mobile Number</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Fax Number</label>
                            <input type="text" ng-model="authority.fax_number" class="form-control" placeholder="Fax Number">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Facebook Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.facebook" placeholder="Facebook Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-facebook input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Linkedin</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.linkedin" placeholder="Linkedin">
                        <div class="input-group-addon input-group-append"><i class="fa fa-linkedin input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Youtube Channel</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.youtube" placeholder="Youtube Channel">
                        <div class="input-group-addon input-group-append"><i class="fa fa-youtube input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Twitter Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.twitter" placeholder="Twitter Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-twitter input-group-text"></i></div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>* Website</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="authority.website" placeholder="Website">
                        <div class="input-group-addon input-group-append"><i class="fa fa-globe input-group-text"></i></div>
                    </div>
                    <i class="text-danger" ng-show="!authority.website && showError"><small>Please Type Website</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <div class="input-group">
                        <input type="text" id="instagram" class="form-control" ng-model="authority.instagram" placeholder="Instagram"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-instagram input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <div class="input-group">
                        <input type="text" id="pinterest" class="form-control" ng-model="authority.pinterest" placeholder="Pinterest"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-pinterest input-group-text"></i></div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <button class="btn btn-md btn-success" ng-click="save_companyregistration();"> <i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">All Registration</h3>
        </div>
        <div class="card-body" ng-init="allcompany_registrations()">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Authority Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Company Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="r in allregistration">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="r.authority_name"></td>
                            <td ng-bind="r.address_line_1"></td>
                            <td ng-bind="r.city"></td>
                            <td ng-bind="r.company_name"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-info" ng-click="editRegistration(r.id)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteRegistration(r.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<input type="hidden" value="<?php echo env('APP_URL'); ?>" id="appurl">
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Company = angular.module('RegistrationApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    Company.controller('RegistrationController', function ($scope, $http) {
        $("#authorities").addClass('menu-open');
        $("#authorities a[href='#']").addClass('active');
        $("#authority-lists").addClass('active');
        $scope.url = $("#appurl").val();
        $scope.registration = {};

        $scope.all_companies = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };

        $scope.allcompany_registrations = function () {
            $scope.allregistration = {};
            $http.get($scope.url + 'manage-authorities/'+$("#company_id").val()).then(function (response) {
                if (response.data.length > 0) {
                    $scope.allregistration = response.data;
                }
            });
        };

        $scope.editRegistration = function (id) {
            $http.get($scope.url + 'manage-authorities/' + id + '/edit').then(function (response) {
                $scope.authority = response.data;
                $scope.getContact($scope.authority.contact_id);
                $scope.getSocialMedia($scope.authority.social_id);
                $scope.getAddress($scope.authority.address_id);
                $("#ShowPrint").show();
            });
        };

        $scope.getContact = function(contact_id){
            $http.get($scope.url+'getContact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.authority, response.data);
                }
            });
        };

        $scope.getSocialMedia = function(social_id){
            $http.get($scope.url+'getSocialMedia/' + social_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.authority, response.data);
                }
            });
        };

        $scope.getAddress = function(address_id){
            $http.get($scope.url+'getAddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.authority, response.data);
                }
            });
        };

        $scope.save_companyregistration = function () {
            $scope.authority.company_id = $("#company_id").val();
            if (!$scope.authority.authority_name || !$scope.authority.address_line_1 || !$scope.authority.country || !$scope.authority.phone_number || !$scope.authority.mobile_number || !$scope.authority.website) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-pulse fa-fw');
                var Data = new FormData();
                angular.forEach($scope.authority, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.url + 'manage-authorities', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.authority = {};
                    $scope.allcompany_registrations();
                    $("#loader").removeClass('fa-spinner fa-pulse fa-fw').addClass('fa-save');
                });
            }
        };

        $scope.deleteRegistration = function(id){
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
                $http.delete($scope.url + 'manage-authorities/'+id).then(function (response) {
                    $scope.allcompany_registrations();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
    });
</script>
@endsection