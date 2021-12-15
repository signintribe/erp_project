@extends('layouts.admin.creationTier')
@section('title', 'View Inventory')
@section('pagetitle', 'View Inventory')
@section('breadcrumb', 'View Inventory')
@section('content')
<div  ng-app="ViewInventoryApp" ng-controller="ViewInventoryController" ng-cloak>
    <div class="card" ng-init="getInventoryInfo();">
        <div class="card-header">
            <h3 class="card-title">View Inventory</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="search">Search</label>
                    <div class="input-group">
                      <input type="search" autofocus ng-model="barcode" ng-keyup="getInventory(barcode);" class="form-control" placeholder="Search By Name or BARCODE">
                      <div class="input-group-append">
                          <button type="button" ng-click="getInventory(barcode);" class="btn btn-md btn-default">
                              <i class="fa fa-search"></i>
                          </button>
                      </div>
                    </div>
                    <p ng-if="fillBox" ng-bind="fillBox" class="text text-danger"></p>
                  </div>
                </div><br/>
                <p ng-if="noinventories">
                  Your search - <strong ng-bind="noinventories"></strong> - did not match any documents. <br>

                  Suggestions: <br>

                  Make sure that all words are spelled correctly. <br>
                  Try different keywords. <br>
                  Try more general keywords.
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered" ng-if="allinventories">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Barcode ID</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="data in allinventories">
                                <td ng-bind="$index+1"></td>
                                <td ng-bind="data.barcode_id"></td>
                                <td ng-bind="data.product_name" style="text-transform: capitalize;"></td>
                                <td ng-bind="data.product_description" style="text-transform: capitalize;"></td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="edit-inventory/<% data.id %>">Edit</a>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteInventoryInfo(data.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Inventory = angular.module('ViewInventoryApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Inventory.controller('ViewInventoryController', function ($scope, $http) {
        $("#mstrial-management").addClass('menu-open');
        $("#mstrial-management a[href='#']").addClass('active');
        $("#view-inventory").addClass('active');
        $scope.getInventoryInfo = function(){
            $scope.inventoryinfo = {};
            $http.get('get-inventory').then(function (response) {
                if (response.data.length > 0) {
                    $scope.allinventories = response.data;
                }
            });
        };

        $scope.getInventory = function (barcode) {
            $http.get('search-inventory/' + barcode).then(function (response) {
                if (response.data.length > 0) {
                    $scope.allinventories = response.data;
                    $scope.noinventories = "";
                }else{
                  $scope.noinventories = barcode;
                  $scope.allinventories = "";
                }
            });
        };

        $scope.deleteInventoryInfo = function (id) {
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
                $http.delete('delete-inventory/' + id).then(function (response) {
                    $scope.getInventoryInfo();
                    swal("Deleted!", response.data, "success");
                });
            });
        };;

    });
</script>
@endsection