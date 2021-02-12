@extends('layouts.user.master')
@section('title', 'Company Profile')
@section('content')
<div ng-app="SelectCategoryApp" ng-controller="SelectCategoryController" ng-cloak>
    <div ng-init="getcompanyinformation()"></div>
    <div class="card" ng-if="!companyinfo">
        <div class="card-body">
            <h4 class="card-title">Please add <a href="{{ url('company-profile')}}">company information</a> first</h4>
        </div>
    </div>
    <div  ng-if="companyinfo">
        <div ng-if="save_status"><p ng-bind="save_status"></p></div>
        <div class="row">
            <div class="col" ng-init="get_categorywithitsparents(1)">
                <div class="card">
                    <div class="card-body">
                        <div align='center' id="catone"></div>
                        <div class="form-group">
                            <div class="form-check form-check-warning" ng-repeat="cats in categorywithparents">
                                <label class="form-check-label" style="text-transform: capitalize">
                                    <input type="radio" class="form-check-input" name="catone" ng-click="get_categoriesone(cats.id)">
                                    <%cats.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div align='center' id="cattwo"></div>
                        <div class="form-group">
                            <div class="form-check form-check-warning" ng-repeat="catsone in categoryiesone">
                                <label class="form-check-label" style="text-transform: capitalize">
                                    <input type="radio" class="form-check-input" name="cattwo" ng-click="get_categoriestwo(catsone.id)">
                                    <%catsone.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Select Category</h4>
                        <div align='center' id="catthree"></div>
                        <div class="form-group">
                            <div class="form-check form-check-success" ng-repeat="catstwo in categoryiestwo">
                                <label class="form-check-label">
                                    <input type="checkbox" id="catthree<%catstwo.id%>" name="catthree" class="form-check-input check_box" ng-click="pushcat(catstwo.id)">
                                    <%catstwo.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br/>
        <div class="row">
            <div class="col">
                <button class="btn btn-md btn-success pull-right" ng-click="select_category(companyinfo.id);"><i class="fa fa-save"></i> Save</button>
            </div>
        </div><br/>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Your Selected Categories</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Category Name</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody ng-init="getcompanycategories(companyinfo.id)">
                                    <tr ng-repeat="scat in selectedcategories">
                                        <td ng-bind="$index + 1"></td>
                                        <td ng-bind="scat.category_name" style="text-transform: capitalize"></td>
                                        <td ng-bind="scat.created_at"></td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger" ng-click="delete_category(scat.selectedcat_id);">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var SelectCategoryProfile = angular.module('SelectCategoryApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    SelectCategoryProfile.controller('SelectCategoryController', function ($scope, $http) {
        $scope.getcompanyinformation = function () {
            $http.get('getcompanyinfo').then(function (response) {
                $scope.companyinfo = response.data;
            });
        };

        $scope.getcompanycategories = function (company_id) {
            $http.get('get-company-categories/' + company_id).then(function (response) {
                $scope.selectedcategories = response.data;
            });
        };

        $scope.get_categorywithitsparents = function (parent_id) {
            $scope.categorywithparents = {};
            $("#catone").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categorywithparents = response.data;
                    $("#catone").html('');
                } else {
                    $("#catone").html('');
                }
            });
        };

        $scope.get_categoriesone = function (parent_id) {
            $scope.categoryiesone = {};
            $scope.categoryiestwo = {};
            $("#cattwo").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesone = response.data;
                    $("#cattwo").html('');
                } else {
                    $("#cattwo").html('');
                }
            });
        };

        $scope.get_categoriestwo = function (parent_id) {
            $scope.categoryiestwo = {};
            $("#catthree").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiestwo = response.data;
                    $("#catthree").html('');
                } else {
                    $("#catthree").html('');
                }
            });
        };
        $scope.categories = {};
        $scope.categoryids = [];

        $scope.pushcat = function (cat_id) {
            if ($('#catthree' + cat_id).is(':checked')) {
                $scope.categoryids.push(cat_id);
                console.log($scope.categoryids);
            }
        };

        $scope.delete_category = function (cat_id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $http.get('delete-selectedcategory/' + cat_id).then(function (response) {
                    swal("Deleted!", response.data, "success");
                    $scope.getcompanycategories($scope.companyinfo.id);
                });
            });
        };

        $scope.select_category = function (company_id) {
            if ($scope.categoryids.length !== 0) {
                $scope.categories.company_id = company_id;
                $scope.categories.categoryids = $scope.categoryids;
                var Data = new FormData();
                angular.forEach($scope.categories, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('save-selected-categories', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.categories = {};
                    $scope.categoryids = [];
                    $scope.categoryiesone = {};
                    $scope.categoryiestwo = {};
                    swal("Save!", res.data, "success");
                    $scope.getcompanycategories($scope.companyinfo.id);
                });
            } else {
                $scope.save_status = "Select Categories";
            }
        };
    });
</script>
@endsection