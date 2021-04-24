@extends('layouts.admin.master')
@section('title', 'Contact Person')
@section('content')
<div  ng-app="PersonApp" ng-controller="PersonController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Organizations Contact Person</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getVendors()">
                    <label for="organization_name">Name of Organization</label>
                    <select class="form-control"  ng-options="vendor.id as vendor.organization_name for vendor in vendorinformations" ng-model="contactperson.vendor_id">
                        <option value="">Select Organization Name</option>
                    </select>
                    <i class="text-danger" ng-show="!contactperson.vendor_id && showError"><small>Please Select Organization Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" ng-model="contactperson.title" placeholder="Title"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" ng-model="contactperson.first_name" placeholder="First Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" ng-model="contactperson.last_name" placeholder="Last Name"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="cat-img">Picture</label>
                        <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);" >
                        <img ng-if="catimg" ng-src="<% catimg %>" class="img img-thumbnail" style-="width:100%; height:200px;">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="contactperson.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="contactperson.phone_number" placeholder="Phone Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="contactperson.mobile_number" placeholder="Mobile Number"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="contactperson.fax_number" placeholder="Fax Number"/>
                </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="contactperson.website" placeholder="Website"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="contactperson.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="contactperson.instagram" placeholder="Instagram"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="contactperson.linkedin" placeholder="Linkedin"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="contactperson.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="contactperson.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="contactperson.email" placeholder="Email"/>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Address detail of contact person</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line1">Postal Address Line 1</label>
                    <input type="text" class="form-control" id="address_line1" ng-model="contactperson.address_line_1" placeholder="Postal Address Line 1"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line2">Postal Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" ng-model="contactperson.address_line_2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector" ng-model="contactperson.sector" placeholder="Sector/Mohallah"/>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="contactperson.city" placeholder="City"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="contactperson.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="contactperson.country" placeholder="Country"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="save_contactPerson()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Organization Name</th>
                        <th>Title</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getContactPersons()">
                    <tr ng-repeat="vendor in contactpersons">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="vendor.organization_name"></td>
                        <td ng-bind="vendor.title "></td>
                        <td ng-bind="vendor.first_name"></td>
                        <td ng-bind="vendor.email"></td>
                        <td ng-bind="vendor.mobile_number"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editContactPerson(vendor.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteContactPerson(vendor.id)">Delete</button>
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
    var OrgContact = angular.module('PersonApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    OrgContact.controller('PersonController', function ($scope, $http) {
        $scope.contactperson = {};
        $scope.appurl = $("#app_url").val();
        $scope.getVendors = function () {
            $scope.vendorinformations = {};
            $http.get('maintain-vendor-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.vendorinformations = response.data;
                }
            });
        };

        $scope.save_contactPerson = function(){
            if (!$scope.contactperson.vendor_id) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.contactperson, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-vendor-contactperson', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.contactperson = {};
                    $scope.getContactPersons();
                });
            }
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.catimg = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.contactperson.picture = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };

        $scope.deleteContactPerson = function (id) {
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
                $http.delete('maintain-vendor-contactperson/' + id).then(function (response) {
                    $scope.getContactPersons();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.getContactPersons = function(){
            $scope.contactpersons = {};
            $http.get('maintain-vendor-contactperson').then(function (response) {
                if (response.data) {
                    $scope.contactpersons = response.data;
                }
            });
        };

        $scope.editContactPerson = function (id) {
            $http.get('maintain-vendor-contactperson/' + id + '/edit').then(function (response) {
                $scope.contactperson = response.data;
                $scope.getContact($scope.contactperson.contact_id);
                $scope.getSocialMedia($scope.contactperson.social_id);
                $scope.getAddress($scope.contactperson.address_id);
                $scope.catimg = $scope.appurl +"public/contactperson_picture/" + $scope.contactperson.picture;
            });
        };

        $scope.getContact = function(contact_id){
            $http.get($scope.appurl+'getContact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.contactperson, response.data);
                }
            });
        };

        $scope.getSocialMedia = function(social_id){
            $http.get($scope.appurl+'getSocialMedia/' + social_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.contactperson, response.data);
                }
            });
        };

        $scope.getAddress = function(address_id){
            $http.get($scope.appurl+'getAddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.contactperson, response.data);
                }
            });
        };
    });
</script>
@endsection