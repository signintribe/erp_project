@extends('layouts.user.master')
@section('title', 'Company Profile')
@section('content')
<div ng-app="CompanyApp" ng-controller="CompanyController" ng-cloak>
    <div class="card" ng-if="company_first === 'false'">
        <div class="card-body">
            <h2 class="card-title">Please add <a href="{{ url('company-profile')}}">company information</a> first</h2>
        </div>
    </div>
    <div class="card" ng-if="company_first !== 'false'">
        <div class="card-body" ng-init="approve_user(); get_companyportfolio();">
            <h2 class="card-title">Please Add Company Portfolio</h2>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <input type="file" ng-if="portfolios === 0" id="attachments" attachment-file="prtflio.attached_files" onchange="angular.element(this).scope().previewAttachments(event);" class="form-control" multiple>
                    <label class="text text-small" ng-if="portfolios === 0">You Can Select Multiple Images</label>
                    <input type="file" ng-if="portfolios.length > 0" onchange="angular.element(this).scope().readUrl(this);" class="form-control">
                    <label class="text text-small" ng-if="portfolios.length > 0">Choose Image</label>
                    <img ng-if="comPortf" ng-src="<%comPortf%>" class="img img-thumbnail"/><br/><br/>
                    <button type="button" class="btn btn-md btn-success" ng-if="portfolios === 0" ng-click="save_companyportfolio();">Submit</button>
                    <button type="button" class="btn btn-md btn-success" ng-if="portfolios.length > 0" ng-click="save_portfolio();">Submit</button>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div ng-if="approve_status.is_verify === 1">
                        <div class="row" ng-if="uploadUrls.length <= 6">
                            <div class="col-md-3 col-lg-3 col-sm-3" style="line-height: 30px;" ng-repeat="urls in uploadUrls">
                                <img ng-if="urls" ng-src="<%urls%>" style="height: 150px; width: 100%;" class="img img-thumbnail">
                            </div>
                        </div>
                        <p ng-if="uploadUrls.length >= 6">
                            You can add only 6 images
                        </p>
                    </div>
                    <div ng-if="approve_status.is_verify === 0">
                        <div class="row" ng-if="uploadUrls.length <= 3">
                            <div class="col-md-3 col-lg-3 col-sm-3" style="line-height: 30px;" ng-repeat="urls in uploadUrls">
                                <img ng-if="urls" ng-src="<%urls%>" style="height: 150px; width: 100%;" class="img img-thumbnail">
                            </div>
                        </div>
                        <p ng-if="uploadUrls.length >= 3">
                            You can add only 3 images
                        </p>
                    </div>
                    <div id="portfolio_status" align="center"></div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3" ng-repeat="portfolio in portfolios" style="padding-bottom: 15px;">
                            <img ng-src="public/company_portfolio/<%portfolio.portfolio_image%>" class="img img-thumbnail" style="width: 100%; height: 150px;"/><br/><br/>
                            <button type="button" class="btn btn-xs btn-info" ng-click="eidt_portfolio(portfolio.id)">Edit</button>
                            <button type="button" class="btn btn-xs btn-danger" ng-click="delete_portfolio_image(portfolio.id);">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var CompanyPortfolio = angular.module('CompanyApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    CompanyPortfolio.directive("attachmentFile", function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attributes) {
                var model = $parse(attributes.attachmentFile);
                var assign = model.assign;
                element.bind('change', function () {
                    var files = [];
                    angular.forEach(element[0].files, function (file) {
                        files.push(file);
                    });
                    scope.$apply(function () {
                        assign(scope, files);
                    });
                });
            }
        };
    });
    CompanyPortfolio.controller('CompanyController', function ($scope, $http) {
        $scope.prtflio = {};
        $scope.prtflio.attached_files = [];
        $scope.previewAttachments = function (event) {
            var files = event.target.files;
            $scope.attachments = [];
            $scope.uploadUrls = [];
            console.log(files);
            angular.forEach(files, function (file) {
                $scope.attachments.push(file.name);
                var reader = new FileReader();
                reader.onload = function (event) {
                    $scope.uploadUrls.push(event.target.result);
                    $scope.$apply();
                };
                reader.readAsDataURL(file);
            });
        };

        $scope.delete_portfolio_image = function (portfolio_id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $http.get('delete_portfolio_image/' + portfolio_id).then(function (response) {
                    swal("Deleted!", response.data, "success");
                    $scope.get_companyportfolio();
                });
            });
        };

        $scope.eidt_portfolio = function (portfolio_id) {
            $http.get('edit_portfolio_image/' + portfolio_id).then(function (response) {
                $scope.prtflio = response.data;
                $scope.comPortf = 'public/company_portfolio/' + $scope.prtflio.portfolio_image;
            });
        };

        $scope.get_companyportfolio = function () {
            $("#portfolio_status").html('<div class="square-path-loader"></div>');
            $http.get('getcompanyportfolio').then(function (response) {
                if (response.data != 'false') {
                    if (response.data.length > 0) {
                        $scope.portfolios = response.data;
                        $("#portfolio_status").html("");
                    } else {
                        $("#portfolio_status").html("");
                        $scope.portfolios = 0;
                    }
                } else {
                    $scope.company_first = 'false';
                }
            });
        };

        $scope.approve_user = function () {
            $http.get('check_user_approve').then(function (response) {
                $scope.approve_status = response.data;
            });
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.comPortf = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.prtflio.companyPortfolio = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };

        $scope.save_companyportfolio = function () {
            if ($scope.uploadUrls.length <= 6 || $scope.uploadUrls.length <= 3) {
                var Data = new FormData();
                angular.forEach($scope.prtflio.attached_files, function (file) {
                    Data.append('userfile[]', file);
                });

                $http.post('SaveCompanyPortfolio', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.get_companyportfolio();
                    $scope.uploadUrls = [];
                    $scope.prtflio = {};
                });
            } else {
                if ($scope.approve_status.is_verify === 1) {
                    swal({
                        title: "Warning!",
                        text: "Please add 6 or less than 6 portfolio images",
                        type: "warning"
                    });
                } else {
                    swal({
                        title: "Warning!",
                        text: "Please add 3 or less than 3 portfolio images",
                        type: "warning"
                    });
                }
            }
        };

        $scope.save_portfolio = function () {
            var Data = new FormData();
            angular.forEach($scope.prtflio, function (v, k) {
                Data.append(k, v);
            });

            $http.post('SaveCompanyPortfolio', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "",
                    text: res.data
                });
                $scope.get_companyportfolio();
                $scope.prtflio = {};
                $scope.comPortf= "";
            });
        };
    });
</script>
@endsection