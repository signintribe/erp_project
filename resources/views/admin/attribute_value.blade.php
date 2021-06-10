@extends('layouts.admin.master')
@section('title', 'Attributes')
@section('content')
<link rel="stylesheet" href="{{ asset('public/dashboard/vendors/icheck/skins/all.css')}}">
<div class="row" ng-app="AttributeValueApp" ng-controller="AttributeValueController">
    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Attribute</h4>
                <p class="card-description" ng-if="save_message" ng-bind="save_message"></p>
                <div class="form-group row">
                    <div class="col">
                        <label>* Attribute Name:</label>
                        <input type="text" class="form-control" placeholder="Attribute Name" ng-model="value.value_name"/>
                        <i class="text-danger" ng-show="!value.value_name && showError"><small>Please Type Attribute Name</small></i>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col" ng-init="productCategory();">
                        <label for="category_id">* Select Category:</label>
                        <select ng-model="value.category_id" class="form-control" ng-change="get_allattributes(value.category_id)" id="category_id" ng-options="cats.id as cats.category_name for cats in productCategories">
                            <option value="">Select Category</option>
                        </select>
                        <i class="text-danger" ng-show="!value.value_name && showError"><small>Please Type Attribute Name</small></i>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>Attribute Name:</label>
                        <select class="form-control" style="text-transform: capitalize;" ng-options="atr.id as atr.attribute_name for atr in attributes" ng-model="value.attribute_id">
                            <option value="">Select Attribute</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm" ng-click="save_attributevalueInfo()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Category Name</th>
                            <th>Attribute Name</th>
                            <th>Value Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAttributeValueInfo()">
                        <tr ng-repeat="atrvalue in attributevalueinfo">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="atrvalue.category_name" style="text-transform: capitalize;"></td>
                            <td ng-bind="atrvalue.attribute_name" style="text-transform: capitalize;"></td>
                            <td ng-bind="atrvalue.value_name " style="text-transform: capitalize;"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-info" ng-click="editAttributeValueInfo(atrvalue.id)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteAttributeValueInfo(atrvalue.id)">Delete</button>
                                </div>
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
    var AttributeValue = angular.module('AttributeValueApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    
    AttributeValue.controller('AttributeValueController', function ($scope, $http) {
        $scope.get_allattributes = function (category_id) {
            $http.get('get-attributes/'+category_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.attributes = response.data;
                }
            });
        };
        $scope.value = {};
        $scope.appurl = $("#appurl").val();
        $scope.save_attributevalueInfo = function(){
            if (!$scope.value.value_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.value, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-attribute-values', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data.message,
                        type: "success"
                    });
                    $scope.value = {};
                   $scope.getAttributeValueInfo();
                });
            }
        };


        $scope.getAttributeValueInfo = function () {
            $scope.attributevalueinfo = {};
            $http.get('maintain-attribute-values').then(function (response) {
                if (response.data.length > 0) {
                    $scope.attributevalueinfo = response.data;
                }
            });
        };

        $scope.productCategory = function () {
            $http.get('product-categories').then(function (response) {
                if (response.data.length > 0) {
                    $scope.productCategories = response.data;
                }
            });
        };

        $scope.editAttributeValueInfo = function (id) {
            $http.get('maintain-attribute-values/'+id+'/edit').then(function (response) {
                $scope.get_allattributes(response.data[0].category_id);
                $scope.value = response.data[0];
            });
        };

        $scope.deleteAttributeValueInfo = function (id) {
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
                $http.delete('maintain-attribute-values/' + id).then(function (response) {
                    $scope.getAttributeValueInfo();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

    });
</script>
@endsection