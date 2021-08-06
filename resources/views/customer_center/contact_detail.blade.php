@extends('layouts.admin.master')
@section('title', 'Contact Detail')
@section('content')
<div  ng-app="CustomerContactApp" ng-controller="CustomerContactController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Customer Contact</h3>
            <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_name" ng-init="getCustomers();">* Name of Customer</label>
                    <select class="form-control" id="customer_name" ng-options="customer.id as customer.customer_name for customer in customerinformations" ng-model="contact.customer_id">
                        <option value="">Select Customer Name</option>
                    </select>
                    <i class="text-danger" ng-show="!contact.customer_id && showError"><small>Please Select Customer</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="contact.phone_number" placeholder="Phone Number"/>
                    <i class="text-danger" ng-show="!contact.phone_number && showError"><small>Please Select Customer</small></i>
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
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="save_customerdetail()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body table-responsive">
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
                <tbody ng-init="getDetails()">
                    <tr ng-repeat="customer in details">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="customer.customer_name"></td>
                        <td ng-bind="customer.email "></td>
                        <td ng-bind="customer.mobile_number"></td>
                        <td ng-bind="customer.facebook"></td>
                        <td ng-bind="customer.website"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editDetail(customer.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteDetail(customer.id)">Delete</button>
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
    var CustomerContact = angular.module('CustomerContactApp', []);
    CustomerContact.controller('CustomerContactController', function ($scope, $http) {
        $scope.appurl = $("#app_url").val();
        $scope.getCustomers = function () {
            $scope.customerinformations = {};
            $http.get('maintain-customer-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.customerinformations = response.data;
                }
            });
        };

        $scope.contact = {};
        $scope.save_customerdetail = function(){
            if (!$scope.contact.customer_id || !$scope.contact.phone_number) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.contact, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-customer-contacts', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.contact = {};
                    $scope.getDetails();
                });
            }
        };

        $scope.deleteDetail = function (id) {
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
                $http.delete('maintain-customer-contacts/' + id).then(function (response) {
                    $scope.getDetails();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.getDetails = function(){
            $scope.details = {};
            $http.get('maintain-customer-contacts').then(function (response) {
                if (response.data) {
                    $scope.details = response.data;
                    $scope.details.customer_id = parseInt(response.data.customer_id);
                }
            });
        };

        $scope.editDetail = function (id) {
            $http.get('maintain-customer-contacts/' + id + '/edit').then(function (response) {
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