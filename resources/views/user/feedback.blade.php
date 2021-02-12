@extends('layouts.user.master')
@section('title', 'Customer Feedback')
@section('content')
<div ng-app="FeedBackApp" ng-controller="FeedBackController">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table border="0" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>FeedBack</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody ng-init="all_feeback()">
                        <tr ng-repeat="feedback in feedbacks">
                            <td ng-bind="$index  + 1"></td>
                            <td ng-bind="feedback.full_name"></td>
                            <td ng-bind="feedback.email"></td>
                            <td ng-bind="feedback.feedback"></td>
                            <td ng-bind="feedback.created_at"></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var FeedBack = angular.module('FeedBackApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    FeedBack.controller('FeedBackController', function ($scope, $http) {
        $scope.all_feeback = function () {
            $http.get('all-company-feedback').then(function (response) {
                if (response.data.length > 0) {
                    $scope.feedbacks = response.data;
                }
            });
        };
    });
</script>
@endsection