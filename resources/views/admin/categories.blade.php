@extends('layouts.admin.creationTier')
@section('title', 'Categories')
@section('pagetitle', 'Categories')
@section('breadcrumb', 'Categories')
@section('content')
<link rel="stylesheet" href="{{ asset('public/dashboard/vendors/icheck/skins/all.css')}}">
<div class="row" ng-app="CategoryApp" ng-controller="CategoryController">
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Category</h4>
            </div>
            <div class="card-body" ng-init="get_allcategories(0)">
                <p class="card-description" ng-if="save_message" ng-bind="save_message"></p>
                <label>* Category Name:</label>
                <input type="text" class="form-control" placeholder="Category Name" ng-model="category.category_name"/>
                <i class="text-danger" ng-show="!category.category_name && showError"><small>Please Type Category Name</small></i><br/>
                <label>Parent Category:</label>
                <select class="form-control" ng-options="cat.id as cat.category_name for cat in categories" ng-model="category.parent_id">
                    <option value="">Select Parent Category</option>
                </select><br/>
                <!-- <div class="form-group row">
                    <div class="col">
                        <label>Measurement:</label>
                        <input type="text" class="form-control" placeholder="Measurement" ng-model="category.measurement"/>
                        <small class="text text-muted">Add category measurement if add 3rd level category</small>
                    </div>
                </div> -->
                <label>Category Description:</label>
                <textarea class="form-control" placeholder="Category Description" ng-model="category.category_description" rows="3" cols="3"></textarea><br/>
                <label>Category Image:</label>
                <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"><br/>
                <img ng-if="catimage" ng-src="<% catimage %>" class="img img-responsive" style="width: 100%; height: 200px;"/>
                <button type="submit" class="btn btn-success btn-sm" ng-click="save_category()">Submit</button>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Categories</h2>
            </div>
            <div class="card-body">
                <p class="card-description" ng-if="delete_status" ng-bind="delete_status"></p>
                <div class="row">
                    <div class="col">
                        <div align='center' id="catone"></div>
                        <div class="form-group" ng-init="get_categorywithitsparents(1)">
                            <div class="form-check form-check-primary" ng-repeat="cats in categorywithparents">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="catone" ng-click="get_categoriesone(cats.id)">
                                    <%cats.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="cattwo"></div>
                        <div class="form-group">
                            <div class="form-check form-check-warning" ng-repeat="catsone in categoryiesone">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="cattwo" ng-click="get_categoriestwo(catsone.id)">
                                    <%catsone.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="catthree"></div>
                        <div class="form-group">
                            <div class="form-check form-check-success" ng-repeat="catstwo in categoryiestwo">
                                <label class="form-check-label">
                                    <input type="radio" name="catthree" class="form-check-input"  ng-click="get_categoriesthree(catstwo.id)">
                                    <%catstwo.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="catfour"></div>
                        <div class="form-group">
                            <div class="form-check form-check-success" ng-repeat="catsthree in categoryiesthree">
                                <label class="form-check-label">
                                    <input type="radio" name="catfour" class="form-check-input"  ng-click="get_categoriesfour(catsthree.id)">
                                    <%catsthree.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="catfive"></div>
                        <div class="form-group">
                            <div class="form-check form-check-success" ng-repeat="catsfour in categoryiesfour">
                                <label class="form-check-label">
                                    <input type="radio" name="catfive" class="form-check-input"  ng-click="get_categoriesfive(catsfour.id)">
                                    <%catsfour.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="catsix"></div>
                        <div class="form-group">
                            <div class="form-check form-check-success" ng-repeat="catsfive in categoryiesfive">
                                <label class="form-check-label">
                                    <input type="radio" name="catsix" class="form-check-input"  ng-click="get_categoriessix(catsfive.id)">
                                    <%catsfive.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/dashboard/js/iCheck.js')}}"></script>
@endsection
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Categories = angular.module('CategoryApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Categories.controller('CategoryController', function ($scope, $http) {
        $("#mstrial-management").addClass('menu-open');
        $("#mstrial-management a[href='#']").addClass('active');
        $("#add-category").addClass('active');
        $scope.get_allcategories = function (cat_id) {
            $http.get('get_categories/' + cat_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categories = response.data;
                }
            });
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.catimage = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.category.category_image = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
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

        $scope.get_categoriesthree = function (parent_id) {
            $scope.categoryiesthree = {};
            $("#catfour").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesthree = response.data;
                    $("#catfour").html('');
                } else {
                    $("#catfour").html('');
                }
            });
        };

        $scope.get_categoriesfour = function (parent_id) {
            $scope.categoryiesfour = {};
            $("#catfive").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesfour = response.data;
                    $("#catfive").html('');
                } else {
                    $("#catfive").html('');
                }
            });
        };

        $scope.get_categoriesfive = function (parent_id) {
            $scope.categoryiesfive = {};
            $("#catsix").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesfive = response.data;
                    $("#catsix").html('');
                } else {
                    $("#catsix").html('');
                }
            });
        };

        $scope.get_category = function (category_id) {
            $http.get('get_categories/' + category_id).then(function (response) {
                $scope.category = response.data[0];
            });
        };

        $scope.delete_category = function (category_id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                $http.get('delete_category/' + category_id).then(function (response) {
                    $scope.get_allcategories(0);
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.category = {};
        $scope.save_category = function () {
            console.log($scope.category);
            if (!$scope.category.category_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.category, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('save_category', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.save_message = res.data;
                    $scope.category = {};
                    $scope.get_allcategories(0);
                });
            }
        };
    });
</script>