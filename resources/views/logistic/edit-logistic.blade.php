@extends('layouts.admin.creationTier')
@section('title', 'View Logistics')
@section('pagetitle', 'View Logistics')
@section('breadcrumb', 'View Logistics')
@section('content')
<div  ng-app="EditLogisticApp" ng-controller="EditLogisticController" ng-cloak>
    <div class="card" ng-init="editlogisticInfo({{$id}}); logistic{{$id}}">
        <div class="card-header">
            <h3 class="card-title">Edit Logistic Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img ng-if="catimage" ng-src="<% catimage %>" class="img img-responsive" style="width: 100px; height: 100px;"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="logistic_type">Logistic Type</label>
                    <select id="logistic_type" class="form-control" ng-model="logistic.logistic_type">
                        <option value="">Logistic Type</option>
                        <option value="Freight Forward Det">Freight Forward Det</option>
                        <option value="Customer Clearance">Customer Clearance</option>
                        <option value="Carriage Company">Carriage Company</option>
                    </select>
                </div> 
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_name">Name of Organization</label>
                    <input type="text" class="form-control" id="organization_name" ng-model="logistic.organization_name" placeholder="Name of Organization"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Organizational Logo:</label>
                    <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency">*Currency in Dealing</label>
                    <select class="form-control" id="currency" ng-model="logistic.currency_dealing">
                        <option value="">Select Currency Type</option>
                        <option value="Dollar">Dollar</option>
                        <option value="RMB">RMB</option>
                        <option value="Euro">Euro</option>
                        <option value="Pounds">Pounds</option>
                        <option value="Pak Rupees">Pak Rupees</option>
                    </select>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Address Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line1">Postal Address Line 1</label>
                    <input type="text" class="form-control" id="address_line1" ng-model="logistic.address_line_1" placeholder="Postal Address Line 1"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line2">Postal Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" ng-model="logistic.address_line_2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector" ng-model="logistic.sector" placeholder="Sector/Mohallah"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="logistic.city" placeholder="City"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="logistic.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="logistic.country" placeholder="Country"/>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Organizational Contact</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="logistic.phone_number" placeholder="Phone Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="logistic.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="logistic.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="logistic.linkedin" placeholder="Linkedin"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="logistic.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="logistic.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="logistic.email" placeholder="Email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="logistic.website" placeholder="Website"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="logistic.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="logistic.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="logistic.instagram" placeholder="Instagram"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="saveLogistic()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <!-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">Select product categories and attributes</h3>
        </div>
        <div class="card-body">
            
        </div>
    </div> -->
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var EditLogistic = angular.module('EditLogisticApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    EditLogistic.controller('EditLogisticController', function ($scope, $http) {
        $("#sourcing").addClass('menu-open');
        $("#sourcing a[href='#']").addClass('active');
        $("#view-logistics").addClass('active');

        $scope.logistic = {};
        $scope.appurl = $("#appurl").val();
        $scope.saveLogistic = function(){
            if (!$scope.logistic.organization_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
                var Data = new FormData();
                angular.forEach($scope.logistic, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.appurl + 'sourcing/save-logistic', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                });
            }
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.catimage = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.logistic.logo_file = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };

        $scope.editlogisticInfo = function (id) {
            $http.get($scope.appurl + 'sourcing/edit-logistic-info/' + id).then(function (response) {
                $scope.logistic = response.data[0];
                if($scope.logistic.organization_logo){
                    $scope.catimage = $scope.appurl +  "public/organization_logo/" + $scope.logistic.organization_logo;
                }
                $scope.editAddress($scope.logistic.address_id);
                $scope.editContact($scope.logistic.contact_id);
                $scope.editSocial($scope.logistic.social_id);
            });
        };

        $scope.editAddress = function (address_id) {
            $http.get($scope.appurl + 'sourcing/get-log-address/' + address_id).then(function (response) {
                angular.extend($scope.logistic, response.data[0]);
                //console.log($scope.inventory);
            });
        };

        $scope.editContact = function (contact_id) {
            $http.get($scope.appurl + 'sourcing/get-log-contact/' + contact_id).then(function (response) {
                angular.extend($scope.logistic, response.data[0]);
                //console.log($scope.inventory);
            });
        };

        $scope.editSocial = function (social_id) {
            $http.get($scope.appurl + 'sourcing/get-log-social/' + social_id).then(function (response) {
                angular.extend($scope.logistic, response.data[0]);
                //console.log($scope.inventory);
            });
        };
    });
</script>
@endsection