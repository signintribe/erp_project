@extends('layouts.admin.creationTier')
@section('title', 'View Inventory')
@section('pagetitle', 'View Inventory')
@section('breadcrumb', 'View Inventory')
@section('content')
<div ng-controller="ViewInventoryController" ng-cloak>
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
                      <input type="search" autofocus ng-model="barcode" class="form-control" placeholder="Search By Name or BARCODE">
                      <div class="input-group-append">
                          <button type="button" ng-click="getInventory(barcode);" class="btn btn-md btn-success">
                              <i class="fa fa-search"></i>
                          </button>
                          <button type="button" ng-click="getInventoryInfo();" class="btn btn-md btn-info">
                              <i class="fa fa-redo"></i>
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
                    <div class="text-center">
                        <i id="loader"></i><br/>
                        <p ng-if="norecord" ng-bind="norecord"></p>
                        <button class="btn btn-sm btn-primary" ng-if="allinventories.length > 49" id="load-more-btn" ng-click="loadMore()"> <i class="fa fa-spinner" id="load-more"></i> Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{ asset('ng_controllers/material_management/view_inventory.js')}}"></script>
@endsection