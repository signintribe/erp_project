@extends('layouts.admin.master')
@section('title', 'View Vendor Information')
@section('content')
<div class="content-wrapper" ng-app="ViewVendorApp" ng-controller="ViewVendorController" ng-cloak>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">View Vendor information</h4>
                    <p class="card-description">Vendor Approved And Not Aprroved</p>
                    <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-approved" role="tab" aria-controls="pills-home" aria-selected="true">Approved</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-not-approved" role="tab" aria-controls="pills-profile" aria-selected="false">Not Approved</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-approved" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="media">
                            <div class="media-body">
                            <div class="card table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Vendor Type</th>
                                            <th>Company Name</th>
                                            <th>Mobile No</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody ng-init="getVendorInformation()">
                                        <tr ng-repeat="vendor in vendorinformations">
                                            <td ng-bind="$index+1"></td>                                        
                                            <td ng-bind="vendor.vendor_type"></td>
                                            <td ng-bind="vendor.company_name"></td>
                                            <td ng-bind="vendor.mobile_no "></td>
                                            <td ng-bind="vendor.email"></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-info" href="edit-vendor/<% vendor.id %>">Edit</a>
                                                    <button class="btn btn-xs btn-danger" ng-click="deleteVendorInformation(vendor.id)">Delete</button>                                           
                                                    <button class="btn btn-xs btn-success" ng-if="vendor.status == 0" ng-click="changeStatus(vendor.id,1)">Approved</button>
                                                    <button class="btn btn-xs btn-warning" ng-if="vendor.status == 1"  ng-click="changeStatus(vendor.id,0)">Not Approved</button>                                            
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-not-approved" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="media">
                            <img class="mr-3 w-25 rounded" src="https://via.placeholder.com/115x115" alt="sample image">
                            <div class="media-body">
                                <p>I'm thinking two circus clowns dancing. You? Finding a needle in a haystack isn't hard when every straw is computerized. Tell him time is of the essence. 
                                Somehow, I doubt that. You have a good heart, Dexter.</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var ViewVendor = angular.module('ViewVendorApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    ViewVendor.controller('ViewVendorController', function ($scope, $http) {
        $scope.organization = {};
        $scope.appurl = $("#appurl").val();

        $scope.getVendorInformation = function () {
            $scope.vendorinformations = {};
            $http.get('save-vendor-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.vendorinformations = response.data;
                }
            });
        };

        $scope.changeStatus = function (id, status) {
            $http.get('change-vendor-status/' + id + '/' + status).then(function (response) {
                    $scope.vendorinformations = response.data;
                    $scope.getVendorInformation();
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
                $http.delete('save-vendor-information/' + id).then(function (response) {
                    $scope.getVendorInformation();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

    });
</script>
@endsection