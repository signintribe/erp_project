@extends('layouts.user.master')
@section('title', 'Dashboard')
@section('content')
<div ng-app="CompanyDashboardApp" ng-controller="CompanyDashboardController">
    <div class="row">
        <div class="col-lg-8 grid-margin d-flex flex-column">
            <div class="row">
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="text-primary mb-4">
                                <i class="mdi mdi-chart-pie mdi-36px"></i>
                                <p class="font-weight-medium mt-2">Total Queries</p>
                            </div>
                            <h1 class="font-weight-light" ng-if="Queries" ng-bind="Queries.length"></h1>
                            <h1 class="font-weight-light" ng-if="!Queries">0</h1>
                            <div class="loader"></div>
                            <!--<p class="text-muted mb-0">Increase by 20%</p>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card" ng-init="noquerywithstatus('Pending')">
                        <div class="card-body text-center">
                            <div class="text-warning mb-4">
                                <i class="mdi mdi-bell mdi-36px"></i>
                                <p class="font-weight-medium mt-2">Pending</p>
                            </div>
                            <h1 class="font-weight-light" ng-if="NoPending" ng-bind="NoPending"></h1>
                            <div class="loader"></div>
                            <!--<p class="text-muted mb-0">Increase by 60%</p>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card" ng-init="noquerywithstatus('Reject')">
                        <div class="card-body text-center">
                            <div class="text-danger mb-4">
                                <i class="mdi mdi-comment-alert mdi-36px"></i>
                                <p class="font-weight-medium mt-2">Rejected</p>
                            </div>
                            <h1 class="font-weight-light" ng-if="NoReject" ng-bind="NoReject"></h1>
                            <div class="loader"></div>
                            <!--<p class="text-muted mb-0">Decrease by 2%</p>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card" ng-init="noquerywithstatus('Accept')">
                        <div class="card-body text-center">
                            <div class="text-success mb-4">
                                <i class="mdi mdi-verified mdi-36px"></i>
                                <p class="font-weight-medium mt-2">Accepted</p>
                            </div>
                            <h1 class="font-weight-light" ng-if="NoAccept" ng-bind="NoAccept"></h1>
                            <div class="loader"></div>
                            <!--<p class="text-muted mb-0">Steady growth</p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card d-flex flex-column justify-content-between">
                <div class="card-body" ng-init="all_totalrevenue();">
                    <div class="d-flex justify-content-between align-items-start">
                        <h4 class="card-title">Revenue</h4>
                    </div>
                    <h1 class="font-weight-normal" ng-bind="Revenue.TotalRevenue"></h1>
                    <div class="loaderR"></div>
                    <h4 class="font-weight-light mb-0">Total revenue</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Queries</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Whatsapp</th>
                                    <th>Mobile Number</th>
                                    <th>Status</th>
                                    <th>Expected Date</th>
                                </tr>
                            </thead>
                            <tbody ng-init="all_queries()">
                                <tr ng-repeat="Q in Queries">
                                    <td ng-bind="$index + 1"></td>
                                    <td ng-bind="Q.full_name"></td>
                                    <td ng-bind="Q.email"></td>
                                    <td ng-bind="Q.whatsapp"></td>
                                    <td ng-bind="Q.mobile_number"></td>
                                    <td ng-bind="Q.status"></td>
                                    <td ng-bind="Q.expected_date"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var CompanyDashboard = angular.module('CompanyDashboardApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    CompanyDashboard.controller('CompanyDashboardController', function ($scope, $http) {
        $scope.all_queries = function () {
            $http.get('all-company-queries').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Queries = response.data;
                }
            });
        };

        $scope.noquerywithstatus = function (status) {
            $(".loader").html('<div class="square-path-loader"></div>');
            $http.get('nostatus-company-queries/' + status).then(function (response) {
                if (status === 'Pending') {
                    $scope.NoPending = response.data;
                }
                if (status === 'Reject') {
                    $scope.NoReject = response.data;
                }
                if (status === 'Accept') {
                    $scope.NoAccept = response.data;
                }
                $(".loader").html('');
            });
        };

        $scope.all_totalrevenue = function () {
            $(".loaderR").html('<div class="square-path-loader"></div>');
            $http.get('get-my-totalrevenue').then(function (response) {
                $scope.Revenue = response.data[0];
                $(".loaderR").html('');
            });
        };
    });
</script>
@endsection