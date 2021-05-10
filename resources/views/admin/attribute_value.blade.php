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
                    <div class="col" ng-init="get_allattributes()">
                        <label>Parent Category:</label>
                        <select class="form-control" ng-options="atr.id as atr.attribute_name for atr in attributes" ng-model="value.attribute_id">
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-sm" ng-click="save_attributeInformation()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Attribute Name</th>
                            <th>Value Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAttributeValueInfo()">
                        <tr ng-repeat="atrvalue in attributevalueinfo">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="atrvalue.attribute_name"></td>
                            <td ng-bind="atrvalue.value_name "></td>
                            <td>
                                <button class="btn btn-xs btn-info" ng-click="editAttributeValueInfo(atrvalue.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteAttributeValueInfo(atrvalue.id)">Delete</button>
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
        $scope.get_allattributes = function () {
            $http.get('api/maintain-attributes').then(function (response) {
                if (response.data.length > 0) {
                    $scope.attributes = response.data;
                }
            });
        };
        $scope.value = {};
        $scope.appurl = $("#appurl").val();
        $scope.save_attributeInformation = function(){
            if (!$scope.value.attribute_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.value, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('api/maintain-attribute-values', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
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
            $http.get('api/maintain-attribute-values').then(function (response) {
                if (response.data.length > 0) {
                    $scope.attributevalueinfo = response.data;
                }
            });
        };

        $scope.editAttributeValueInfo = function (id) {
            $http.get('api/maintain-attribute-values/'+id+'/edit').then(function (response) {
                $scope.value = response.data;
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
                $http.delete('api/maintain-attribute-values/' + id).then(function (response) {
                    $scope.getAttributeValueInfo();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

    });
</script>
@endsection