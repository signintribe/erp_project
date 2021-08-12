@extends('layouts.admin.creationTier')
@section('title', 'Employee Address')
@section('pagetitle', 'Employee Address')
@section('breadcrumb', 'Employee Address')
@section('content')
<div  ng-app="AddressApp" ng-controller="AddressController" ng-cloak>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Address Detail</h3>
                </div>
                <div class="card-body">
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
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="zip_code">Zipp Code</label>
                                <input type="text" id="zip_code" class="form-control" ng-model="address.zip_code" placeholder="Zip Code"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" id="postal_code" class="form-control" ng-model="address.postal_code" placeholder="Postal Code"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{url('hr/employee-personal-information')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                                    <i class="mdi mdi-arrow-left"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-success" ng-click="save_address()" data-toggle="tooltip" data-placement="bottom" title="Save">
                                    <i class="fa fa-save"></i>
                                </button>
                                <a href="{{url('hr/spouse-detail')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                                    <i class="mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="card">
                <div class="card-title">
                    <h3 class="card-title">All Address</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Employee Name</th>
                                <th>Street</th>
                                <th>Sector</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getAddress(0)">
                            <tr ng-repeat="addr in Addresses">
                                <td ng-bind="$index+1"></td>
                                <td ng-bind="addr.employee_name"></td>
                                <td ng-bind="addr.street"></td>
                                <td ng-bind="addr.sector"></td>
                                <td ng-bind="addr.city"></td>
                                <td ng-bind="addr.state"></td>
                                <td ng-bind="addr.country"></td>
                                <td>
                                    <button class="btn btn-xs btn-info" ng-click="editAddress(addr.id)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteAddress(addr.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><br/>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Address = angular.module('AddressApp', []);
    Address.controller('AddressController', function ($scope, $http) {
        $("#employee").addClass('menu-open');
        $("#employee a[href='#']").addClass('active');
        $("#employee-address").addClass('active');
        $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };

        $scope.getAddress = function (address_id) {
            $http.get('maintain-employee-address').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Addresses = response.data;
                }
            });
        };

        $scope.editAddress = function (address_id) {
            $http.get('maintain-employee-address/' + address_id + '/edit').then(function (response) {
                if (response.data.length > 0) {
                    $scope.address = response.data[0];
                    $scope.address.employee_id = parseInt($scope.address.employee_id);
                }
            });
        };

        $scope.deleteAddress = function (address_id) {
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('maintain-employee-address/' + address_id).then(function (response) {
                    $scope.getAddress(0);
                    if(response.data.status === 'true'){
                        swal("Delete!", response.data.message, "success");
                    }else{
                        swal("Not Delete!", response.data.message, "error");
                    }
                });
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
                angular.forEach($scope.address, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-employee-address', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.address = {};
                    $scope.getAddress(0);
                });
            }
        };
    });
</script>
@endsection