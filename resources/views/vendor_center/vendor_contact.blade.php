@extends('layouts.admin.creationTier')
@section('title', 'Vendor Contact')
@section('pagetitle', 'Vendor Contact')
@section('breadcrumb', 'Vendor Contact')
@section('content')
<div  ng-app="OrgContactApp" ng-controller="OrgContactController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Organizational Contact</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getVendors()">
                    <label for="organization_name">* Name of Organization</label>
                    <select class="form-control"  ng-options="vendor.id as vendor.organization_name for vendor in vendorinformations" ng-model="contact.vendor_id">
                        <option value="">Select Organization Name</option>
                    </select>
                    <i class="text-danger" ng-show="!contact.vendor_id && showError"><small>Please Enter Organization</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">* Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="contact.phone_number" placeholder="Phone Number"/>
                    <i class="text-danger" ng-show="!contact.phone_number && showError"><small>Please Enter Phone no</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="contact.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="contact.facebook" placeholder="Facebook"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="contact.linkedin" placeholder="Linkedin"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="contact.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="contact.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="contact.email" placeholder="Email"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="contact.website" placeholder="Website"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="contact.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="contact.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="contact.instagram" placeholder="Instagram"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="save_vendorcontact()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Organizational Contact</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Organization Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Facebook</th>
                        <th>Website</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getContacts()">
                    <tr ng-repeat="vendor in contacts">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="vendor.organization_name"></td>
                        <td ng-bind="vendor.email "></td>
                        <td ng-bind="vendor.mobile_number"></td>
                        <td ng-bind="vendor.facebook"></td>
                        <td ng-bind="vendor.website"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editContact(vendor.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteContact(vendor.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" id="app_url" value="<?php echo env('APP_URL'); ?>">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var OrgContact = angular.module('OrgContactApp', []);
    OrgContact.controller('OrgContactController', function ($scope, $http) {
        $("#purchase").addClass('menu-open');
        $("#purchase a[href='#']").addClass('active');
        $("#vendor-contact").addClass('active');
        $scope.appurl = $("#app_url").val();
        $scope.getVendors = function () {
            $scope.vendorinformations = {};
            $http.get('maintain-vendor-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.vendorinformations = response.data;
                }
            });
        };

        $scope.save_vendorcontact = function(){
            if (!$scope.contact.vendor_id || !$scope.contact.phone_number) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.contact, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-vendor-contact', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.contact = {};
                    $scope.getContacts();
                });
            }
        };

        $scope.deleteContact = function (id) {
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
                $http.delete('maintain-vendor-contact/' + id).then(function (response) {
                    $scope.getContacts();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.getContacts = function(){
            $scope.contacts = {};
            $http.get('maintain-vendor-contact').then(function (response) {
                if (response.data) {
                    $scope.contacts = response.data;
                    $scope.contacts.vendor_id = parseInt(response.data.vendor_id);
                }
            });
        };

        $scope.editContact = function (id) {
            $http.get('maintain-vendor-contact/' + id + '/edit').then(function (response) {
                $scope.contact = response.data;
                $scope.getContact($scope.contact.contact_id);
                $scope.getSocialMedia($scope.contact.social_id);
            });
        };

        $scope.getContact = function(contact_id){
            $http.get($scope.appurl+'getContact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.contact, response.data);
                }
            });
        };

        $scope.getSocialMedia = function(social_id){
            $http.get($scope.appurl+'getSocialMedia/' + social_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.contact, response.data);
                }
            });
        };
    });
</script>
@endsection