@extends('layouts.admin.creationTier')
@section('title', 'View Logistics')
@section('pagetitle', 'View Logistics')
@section('breadcrumb', 'View Logistics')
@section('content')
<div ng-controller="viewLogisticsController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">View Logistic Info</h3>
        </div>
        <div class="card-body">
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Logistic Type</th>
                            <th>Organization Name</th>
                            <th>NTN</th>
                            <th>Country</th>
                            <th>Mobile Number</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getLogisticInfo()">
                        <tr ng-repeat="data in logisticsInfo">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="data.logistic_type"></td>
                            <td ng-bind="data.organization_name" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.ntn_no" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.country" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.mobile_number" style="text-transform: capitalize;"></td>
                            <td ng-bind="data.city" style="text-transform: capitalize;"></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="edit-logistic/<% data.id %>">Edit</a>
                                <button class="btn btn-xs btn-danger" ng-click="deleteLogisticInfo(data.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/logistics/view-logistic.js')}}"></script>
@endsection