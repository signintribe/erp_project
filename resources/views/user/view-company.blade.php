@extends('layouts.admin.master')
@section('title', 'Company Profile')
@section('content')
<div ng-app="CompanyApp" ng-controller="CompanyController">
    <div class="card">
        <div class="card-body" ng-init="get_companyinfo();">
            <h3 class="card-title">All Compaines</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>Established</th>
                        <th>Office Timing</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="company in companies">
                        <td ng-bind="$index + 1"></td>
                        <td ng-bind="company.company_id"></td>
                        <td ng-bind="company.company_name"></td>
                        <td ng-bind="company.established"></td>
                        <td ng-bind="company.office_timing"></td>
                        <td ng-bind="company.created_at"></td>
                        <td>
                            <button class="btn btn-info btn-xs" ng-click="editCompany(company.id)">Edit</button>
                            <button class="btn btn-danger btn-xs" ng-model="deleteCompany(company.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var CompanyProfile = angular.module('CompanyApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    CompanyProfile.controller('CompanyController', function ($scope, $http) {
        $scope.company = {};

        $scope.get_companyinfo = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };

        $scope.get_companysocial = function (company_id) {
            $http.get('getcompanysocial/' + company_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.company, response.data);
                }
            });
        };

        $scope.get_companyaddress = function () {
            $http.get('getcompanyaddress').then(function (response) {
                if (response.data) {
                    angular.extend($scope.company, response.data);
                }
            });
        };

        $scope.check_company = function (company_name) {
            $http.get('check_company/' + company_name).then(function (response) {
                if (response.data) {
                    $scope.checkcompany = response.data.company_name + " is already exist";
                    $('#restrict').attr('disabled', 'disabled');
                } else {
                    $scope.checkcompany = "This company is not exist";
                    $('#restrict').removeAttr('disabled', 'disabled');
                }
            });
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.comLogo = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.company.companyLogo = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };


        $scope.save_companyinfo = function () {
            console.log($scope.company);
            if (!$scope.company.company_name || !$scope.company.phone_number || !$scope.company.mobile_number || !$scope.company.address_line_1 || !$scope.company.country || !$scope.company.linkedin || !$scope.company.website) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.company, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('SaveCompany', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                });
            }
        };
    });
</script>
@endsection