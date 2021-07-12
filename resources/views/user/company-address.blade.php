@extends('layouts.admin.master')
@section('title', 'Company Address')
@section('content')
<div ng-app="ComAddressApp" ng-controller="ComAddressController">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h2 class="card-title">Please Add Your Company Address</h2>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">* Postal Address Line 1</label>
                        <input type="text" id="address_1" class="form-control" ng-model="company.address_line_1" placeholder="Postal Address Line 1"/>
                        <i class="text-danger" ng-show="!company.address_line_1 && showError"><small>Please Type Address Line</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Postal Address Line 2</label>
                        <input type="text" id="address_2" class="form-control" ng-model="company.address_line_2" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_3">Postal Address Line 3</label>
                        <input type="text" id="address_3" class="form-control" ng-model="company.address_line_3" placeholder="Postal Address Line 3"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" id="street" class="form-control" ng-model="company.street" placeholder="Street"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" id="sector" class="form-control" ng-model="company.sector" placeholder="Sector/Mohallah"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="country">* Country</label>
                        <input type="text" id="country" class="form-control" ng-model="company.country" placeholder="Country"/>
                        <i class="text-danger" ng-show="!company.country && showError"><small>Please Type Country</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="state">State / Province</label>
                        <input type="text" id="state" class="form-control" ng-model="company.state" placeholder="State / Province"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" class="form-control" ng-model="company.city" placeholder="City"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal-code">Postal Code</label>
                        <input type="text" id="postal-code" class="form-control" ng-model="company.postal_code" placeholder="Postal Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip-code">Zip Code</label>
                        <input type="text" id="zip-code" class="form-control" ng-model="company.zip_code" placeholder="Zip Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
            </div>
            <hr/><br/>
            <button type="submit" id="restrict" class="btn btn-success btn-sm float-right" ng-click="save_comAddressInfo();">Submit</button>
            <!-- <button type="submit" id="updatebtn" class="btn btn-success btn-sm float-right" ng-click="update_companyinfo();">Submit</button> -->
        </div>
    </div><br/>
    <div class="card d-print-none">
        <div class="card-body" ng-init="get_companyaddress();">
            <h3 class="card-title">Company Addresses</h3>
            <small class="text text-danger" ng-bind="deletemessage" ng-if="deletemessage"></small>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="company in addresses">
                        <td ng-bind="$index + 1"></td>
                        <td ng-bind="company.com_id"></td>
                        <td ng-bind="company.company_name"></td>
                        <td ng-bind="company.street"></td>
                        <td ng-bind="company.city"></td>
                        <td ng-bind="company.country"></td>
                        <td>
                            <button class="btn btn-info btn-xs" ng-click="editComAddress(company.id)">Edit</button>
                            <button class="btn btn-danger btn-xs" ng-click="deleteComAddress(company.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<input type="hidden" id="baseurl" value="<?php echo env('APP_URL'); ?>">
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var CompanyAddress = angular.module('ComAddressApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    CompanyAddress.controller('ComAddressController', function ($scope, $http) {
        $scope.company = {};
        $scope.app_url = $('#baseurl').val();
        $scope.get_allcompanyinfo = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };

        $scope.get_companyaddress = function () {
            $http.get('maintain-company-address').then(function (response) {
                if (response.data.length > 0) {
                    $scope.addresses = response.data;
                }
            });
        };

        $scope.deleteComAddress = function (id) {
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
                $http.delete('maintain-company-address/' + id).then(function (response) {
                    $scope.get_allcompanyinfo();
                    if(response.data.status === 0){
                        swal("Delete!", response.data.message, "success");
                    }else{
                        swal("Not Delete!", response.data.message, "error");
                    }
                });
            });
        };

        $scope.editComAddress = function (id) {
            $http.get('maintain-company-address/' + id + '/edit').then(function (response) {
                if (response.data[0]) {
                    $scope.company = response.data[0];
                }
            });
        };

        $scope.save_comAddressInfo = function () {
            //console.log($scope.company);
            if (!$scope.company.address_line_1) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.company, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-company-address', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.get_allcompanyinfo();
                });
            }
        };
    });
</script>
@endsection