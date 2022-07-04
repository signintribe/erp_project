@extends('layouts.admin.creationTier')
@section('title', 'Requestion Form')
@section('pagetitle', 'Requestion')
@section('breadcrumb', 'Requestion')
@section('content')

<div ng-controller="RequestionController">
    <div class="card" ng-init="resetscope();">
        <div class="card-header">
            <h2 class="card-title">Requistion Detail</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="requestion_no">Requestion Number</label>
                    <input type="text" ng-model="request.requestion_no" id="requestion_no" placeholder="Requestion Number" class="form-control"><br/>
                    <i class="text-danger" ng-show="!request.requestion_no && showError"><small>Please type requestion number</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="requestion_date">Requition Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="requestion_date" data-target-input="nearest">
                            <input type="text" placeholder="Requestion Date" ng-model="request.requestion_date" class="form-control datetimepicker-input" data-target="#requestion_date"/>
                            <div class="input-group-append" data-target="#requestion_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <i class="text-danger" ng-show="!request.requestion_date && showError"><small>Please type request date</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="require_date">Required From Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="require_date" data-target-input="nearest">
                            <input type="text" placeholder="Required From Date" ng-model="request.require_date" class="form-control datetimepicker-input" data-target="#require_date"/>
                            <div class="input-group-append" data-target="#require_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="require_till">Required till Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="require_till" data-target-input="nearest">
                            <input type="text" placeholder="Required Till Date" ng-model="request.require_till" class="form-control datetimepicker-input" data-target="#require_till"/>
                            <div class="input-group-append" data-target="#require_till" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="">Description of Requirement</label>
                    <textarea ng-model="request.description" id="" placeholder='Description of Requirement' class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Required Form</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Select Department</label>
                    <select ng-model="request.department_id" ng-options="dept.id as dept.department_name for dept in departments" id="" class="form-control">
                        <option value="">Please Select Department</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="product_name">Search Products</label>
                    <input type="text" ng-model="request.product_name" placeholder="Search Product" ng-keyup="getInventory(request.product_name)" id="product_name" class="form-control">
                   <!--  <select ng-model="request.product_id" id="" class="form-control">
                        <option value="">Please Select Product</option>
                    </select> -->
                    <div class="row" ng-if="allinventories" id="select_product">
                        <div class="col">
                            <ul class="list-group" style="height: 100px; overflow-y:scroll">
                                <li class="list-group-item" style="cursor: pointer" ng-click="getProductId(inv.id, inv.product_name)" ng-repeat="inv in allinventories" ng-bind="inv.product_name"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Select HR Resource</label>
                    <select ng-model="request.resource_id" ng-options="user.id as user.first_name for user in Users" class="form-control">
                        <option value="">Please Select Employee</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="saveRequestion()"> <i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Your Requests</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4">Request For</th>
                            <th rowspan="2" style="vertical-align:middle">Request Date</th>
                            <th rowspan="2" style="vertical-align:middle">Request From</th>
                            <th rowspan="2" style="vertical-align:middle">Request Till</th>
                            <th rowspan="2" style="vertical-align:middle">Action</th>
                        </tr>
                        <tr>
                            <th>Requestion Number</th>
                            <th>Department</th>
                            <th>Product</th>
                            <th>Resource</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="r in requestion">
                            <td ng-bind="r.requestion_no"></td>
                            <td ng-bind="r.department_name"></td>
                            <td ng-bind="r.product_name"></td>
                            <td ng-bind="r.first_name"></td>
                            <td ng-bind="r.requestion_date"></td>
                            <td ng-bind="r.require_date"></td>
                            <td ng-bind="r.require_till"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-xs" ng-click="getSingleRequestion(r.id)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="deleteRequestion(r.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <i id="recordloader"></i>
                    <p ng-if="nomore" ng-bind="nomore"></p><br/>
                    <button ng-click="loadMore()" class="btn btn-primary btn-sm"> <i id="loading" class="fa fa-spinner"></i> Load More</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
@endsection
@section('internaljs')
<script src="{{ asset('ng_controllers/tender/requestion.js')}}"></script>
@endsection