@extends('layouts.admin.master')
@section('title', 'Companies Reports')
@section('content')
<div  ng-app="ComplaintApp" ng-controller="ComplaintController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Customer Complaints</h4>
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
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>
    var Complaint = angular.module('ComplaintApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Complaint.controller('ComplaintController', function ($scope, $http) {
        $scope.all_complaints = function () {
            $(".loader").html('<div class="square-path-loader"></div>');
            $http.get('get-all-complaints').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Complaints = response.data;
                    $(".loader").html('');
                }
            });
        };

    });
</script>
@endsection