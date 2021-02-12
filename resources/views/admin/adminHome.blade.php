@extends('layouts.admin.master')
@section('title', 'Dashboard')
@section('content')
<div ng-app="AdminDashboardApp" ng-controller="AdminDashboardController">
    <div class="row">
        <div class="col-lg-8 grid-margin d-flex flex-column">
            <div class="row">
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card" ng-init="all_getcustomer()">
                        <div class="card-body text-center">
                            <div class="text-primary mb-4">
                                <i class="mdi mdi-account-multiple mdi-36px"></i>
                                <p class="font-weight-medium mt-2">Customers</p>
                            </div>
                            <h1 class="font-weight-light" ng-bind="Customers"></h1>
                            <div class="loader" align="center"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card" ng-init="all_queriesinadmin();">
                        <div class="card-body text-center">
                            <div class="text-danger mb-4">
                                <i class="mdi mdi-chart-pie mdi-36px"></i>
                                <p class="font-weight-medium mt-2">Orders</p>
                            </div>
                            <h1 class="font-weight-light" ng-bind="AQuery"></h1>
                            <div class="loaderQ" align="center"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card" ng-init="all_queriesstatusinadmin();">
                        <div class="card-body text-center">
                            <div class="text-info mb-4">
                                <i class="mdi mdi-car mdi-36px"></i>
                                <p class="font-weight-medium mt-2">Delivery</p>
                            </div>
                            <h1 class="font-weight-light" ng-bind="SQuery"></h1>
                            <div class="loaderS" align="center"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card" ng-init="all_companiesinadmin()">
                        <div class="card-body text-center">
                            <div class="text-success mb-4">
                                <i class="mdi mdi-verified mdi-36px"></i>
                                <p class="font-weight-medium mt-2">Vendors</p>
                            </div>
                            <h1 class="font-weight-light" ng-bind="Companies"></h1>
                            <div class="loaderC" align="center"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card d-flex flex-column justify-content-between">
                <div class="card-body" ng-init="all_totalrevenue()">
                    <div class="d-flex justify-content-between align-items-start">
                        <h4 class="card-title">Revenue</h4>
                    </div>
                    <h1 class="font-weight-normal" ng-bind="Revenue.TotalRevenue">36568</h1>
                    <div class="loaderR" align="center"></div>
                    <h4 class="font-weight-light mb-0">Total revenue</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Complaints</h4>
                    <div class="table-responsive">
                        <table border="0" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Company Name</th>
                                    <th>Complaint</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody ng-init="all_complaints()">
                                <tr ng-repeat="complain in Complaints">
                                    <td ng-bind="complain.customer_name"></td>
                                    <td ng-bind="complain.customer_email"></td>
                                    <td ng-bind="complain.company_name"></td>
                                    <td ng-bind="complain.complaint"></td>
                                    <td ng-bind="complain.created_at"></td>
                                </tr>
                            </tbody>
                        </table>        
                        <div class="loader" align="center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var AdminDashboard = angular.module('AdminDashboardApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    AdminDashboard.controller('AdminDashboardController', function ($scope, $http) {
        $scope.all_getcustomer = function () {
            $(".loader").html('<div class="square-path-loader"></div>');
            $http.get('all-customers').then(function (response) {
                $scope.Customers = response.data;
                $(".loader").html('');
            });
        };

        $scope.all_queriesinadmin = function () {
            $(".loaderQ").html('<div class="square-path-loader"></div>');
            $http.get('all-queriesinadmin').then(function (response) {
                $scope.AQuery = response.data;
                $(".loaderQ").html('');
            });
        };

        $scope.all_queriesstatusinadmin = function () {
            $(".loaderS").html('<div class="square-path-loader"></div>');
            $http.get('all-queriesstatusinadmin').then(function (response) {
                $scope.SQuery = response.data;
                $(".loaderS").html('');
            });
        };

        $scope.all_companiesinadmin = function () {
            $(".loaderC").html('<div class="square-path-loader"></div>');
            $http.get('all-companiesinadmin').then(function (response) {
                $scope.Companies = response.data;
                $(".loaderC").html('');
            });
        };

        $scope.all_complaints = function () {
            $(".loader").html('<div class="square-path-loader"></div>');
            $http.get('get-all-complaints').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Complaints = response.data;
                    $(".loader").html('');
                }
            });
        };

        $scope.all_totalrevenue = function () {
            $(".loaderR").html('<div class="square-path-loader"></div>');
            $http.get('get-all-totalrevenue').then(function (response) {
                $scope.Revenue = response.data[0];
                $(".loaderR").html('');
            });
        };
    });
</script>
@endsection