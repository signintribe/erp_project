@extends('layouts.admin.master')
@section('title', 'Employees Address Detail')
@section('content')
<div  ng-app="AddressApp" ng-controller="AddressController" ng-cloak>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Address Detail</h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                            <div class="form-group">
                                <label for="employee_name">* Employee Name</label>
                                <select class="form-control" ng-options="user.id as user.first_name for user in Users" ng-model="address.employee_id">
                                    <option value="">Select Employee</option>
                                </select>
                                <i class="text-danger" ng-show="!address.employee_id && showError"><small>Please Select Employee</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="address_1">* Postal Address Line 1</label>
                                <input type="text" id="address_1" class="form-control" ng-model="address.address_line_1" placeholder="Postal Address Line 1"/>
                                <i class="text-danger" ng-show="!address.address_line_1 && showError"><small>Please Type Address Line</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="address_2">Postal Address Line 2</label>
                                <input type="text" id="address_2" class="form-control" ng-model="address.address_line_2" placeholder="Postal Address Line 2"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="address_3">Postal Address Line 3</label>
                                <input type="text" id="address_3" class="form-control" ng-model="address.address_line_3" placeholder="Postal Address Line 3"/>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="street">* Street</label>
                                <input type="text" id="street" class="form-control" ng-model="address.street" placeholder="Street"/>
                                <i class="text-danger" ng-show="!address.street && showError"><small>Please Type Street</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="sector">Sector/Mohallah</label>
                                <input type="text" id="sector" class="form-control" ng-model="address.sector" placeholder="Sector/Mohallah"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="country">* Country</label>
                                <input type="text" id="country" class="form-control" ng-model="address.country" placeholder="Country"/>
                                <i class="text-danger" ng-show="!address.country && showError"><small>Please Type Country</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="state">* State / Province</label>
                                <input type="text" id="state" class="form-control" ng-model="address.state" placeholder="State / Province"/>
                                <i class="text-danger" ng-show="!address.state && showError"><small>Please Type State / Province</small></i>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="city">* City</label>
                                <input type="text" id="city" class="form-control" ng-model="address.city" placeholder="City"/>
                                <i class="text-danger" ng-show="!address.city && showError"><small>Please Type City</small></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button type="button" class="btn btn-md btn-success float-right" ng-click="save_address()">Save</button>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">All Address</h3>
                </div>
            </div>
        </div>
    </div><br/>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Address = angular.module('AddressApp', []);
    Address.controller('AddressController', function ($scope, $http) {
        $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };
        
        $scope.address = {};
        $scope.save_address = function () {
            if (!$scope.address.employee_id || !$scope.address.address_line_1 || !$scope.address.street || !$scope.address.country || !$scope.address.state || !$scope.address.city) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.user, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('SaveAddress', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.user = {};
                    $scope.all_users();
                });
            }
        };
    });
</script>
@endsection