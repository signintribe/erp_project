@extends('layouts.admin.creationTier')
@section('title', 'Attributes')
@section('pagetitle', 'Attributes')
@section('breadcrumb', 'Attributes')
@section('content')
<link rel="stylesheet" href="{{ asset('public/dashboard/vendors/icheck/skins/all.css')}}">
<div class="row" ng-app="AttributeApp" ng-controller="AttributeController">
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Attribute</h4>
            </div>
            <div class="card-body">
                <p class="card-description" ng-if="save_message" ng-bind="save_message"></p>
                <div class="form-group row">
                    <div class="col">
                        <label>* Attribute Name:</label>
                        <input type="text" class="form-control" placeholder="Attribute Name" ng-model="attribute.attribute_name"/>
                        <i class="text-danger" ng-show="!attribute.attribute_name && showError"><small>Please Type Attribute Name</small></i>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <div class="col">
                        <label>Measurement:</label>
                        <input type="text" class="form-control" placeholder="Measurement" ng-model="category.measurement"/>
                        <small class="text text-muted">Add category measurement if add 3rd level category</small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>Category Description:</label>
                        <textarea class="form-control" placeholder="Category Description" ng-model="category.category_description" rows="5" cols="5"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>Category Image:</label>
                        <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"><br/>
                        <img ng-if="catimage" ng-src="<% catimage %>" class="img img-responsive" style="width: 100%; height: 200px;"/>
                    </div>
                </div> -->
                <div class="form-group row">
                    <div class="col" ng-init="get_allcategories()">
                        <label>Parent Category:</label>
                        <select class="form-control" ng-options="cat.id as cat.category_name for cat in categories" ng-model="attribute.category_id">
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm" ng-click="save_attributeInformation()"> <i class="fa fa-save" id="loader"></i> Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Attribute</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Category Name</th>
                            <th>Attributes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAttributeInformation()">
                        <tr ng-repeat="attribute in attributeinformations">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="attribute.category_name"></td>
                            <td ng-bind="attribute.attribute_name "></td>
                            <td>
                                <button class="btn btn-xs btn-info" ng-click="editAttributeInformation(attribute.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteAttributeInformation(attribute.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
</div>
<script src="{{ asset('public/dashboard/js/iCheck.js')}}"></script>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Attribute = angular.module('AttributeApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    
    Attribute.controller('AttributeController', function ($scope, $http) {
        $("#mstrial-management").addClass('menu-open');
        $("#mstrial-management a[href='#']").addClass('active');
        $("#add-attribute").addClass('active');
        $scope.get_allcategories = function () {
            $http.get('product-categories').then(function (response) {
                if (response.data.length > 0) {
                    $scope.categories = response.data;
                }
            });
        };
        $scope.attribute = {};
        $scope.appurl = $("#appurl").val();
        $scope.save_attributeInformation = function(){
            if (!$scope.attribute.attribute_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
                var Data = new FormData();
                angular.forEach($scope.attribute, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-attributes', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                    $scope.attribute = {};
                   $scope.getAttributeInformation();
                });
            }
        };


        $scope.getAttributeInformation = function () {
            $scope.attributeinformations = {};
            $http.get('maintain-attributes').then(function (response) {
                if (response.data.length > 0) {
                    $scope.attributeinformations = response.data;
                }
            });
        };

        $scope.editAttributeInformation = function (id) {
            $http.get('maintain-attributes/'+id+'/edit').then(function (response) {
                $scope.attribute = response.data;
                $scope.attribute.category_id = parseInt($scope.attribute.category_id);
            });
        };

        $scope.deleteAttributeInformation = function (id) {
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('maintain-attributes/' + id).then(function (response) {
                    $scope.getAttributeInformation();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

    });
</script>
@endsection