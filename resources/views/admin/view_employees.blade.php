@extends('layouts.admin.master')
@section('title', 'Users')
@section('content')
<div  class="row" ng-app="UsersApp" ng-controller="UsersController" ng-cloak>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">All Employees</h3>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Users = angular.module('UsersApp', []);
    Users.controller('UsersController', function ($scope, $http) {
//        $scope.all_users = function () {
//            $(".loader").html('<div class="square-path-loader"></div>');
//            $http.get('getusers').then(function (response) {
//                if (response.data.length > 0) {
//                    $scope.Users = response.data;
//                    $(".loader").html('');
//                }
//            });
//        };
//
//        $scope.approve_user = function (user_id, status) {
//            $http.get('approve_user/' + user_id + '/' + status).then(function (response) {
////                if (response.data.length > 0) {
//                $scope.all_users();
//                $scope.approve_status = response.data;
////                }
//            });
//        };
//        $scope.user = {};
//        $scope.save_user = function () {
//            if (!$scope.user.name || !$scope.user.email || !$scope.user.password) {
//                $scope.showError = true;
//                jQuery("input.required").filter(function () {
//                    return !this.value;
//                }).addClass("has-error");
//            } else {
//                var Data = new FormData();
//                angular.forEach($scope.user, function (v, k) {
//                    Data.append(k, v);
//                });
//                $http.post('SaveUsers', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
//                    swal({
//                        title: "Save!",
//                        text: res.data,
//                        type: "success"
//                    });
//                    $scope.user = {};
//                    $scope.all_users();
//                });
//            }
//        };
    });
</script>
@endsection