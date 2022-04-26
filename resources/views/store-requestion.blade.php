@extends('layouts.admin.taskTier')
@section('title', 'Requestion')
@section('pagetitle', 'Requestion')
@section('breadcrumb', 'Requestion')
@section('content')
<div ng-controller="RequestionController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Request</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <label for="select-department">* Select Department</label>
                    <select ng-model="request.department" id="select-department" class="form-control">
                        <option value="">Select Department</option>
                        <option value="1">HR</option>
                        <option value="2">Banking and Finance</option>
                        <option value="3">Matrial Management</option>
                        <option value="4">Project System</option>
                        <option value="5">Sourcing</option>
                        <option value="6">Purchase</option>
                        <option value="7">Sales</option>
                    </select>
                    <i class="text-danger" ng-show="!request.department && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col" ng-init="getInventoryInfo()">
                    <label for="select-inventory">* Select Product</label>
                    <select ng-model="request.product" ng-options="prod.id as prod.product_name for prod in allinventories" id="select-inventory" class="form-control">
                        <option value="">Select Inventory</option>
                    </select>
                    <i class="text-danger" ng-show="!request.product && showError"><small>Please Select Product</small></i>
                </div>
                <div class="col">
                    <label for="requested-person">* Requested Person</label>
                    <select ng-model="request.requested_person" ng-options="user.id as user.first_name for user in Users" id="requested-person" class="form-control">
                        <option value="">Requested Person</option>
                    </select>
                    <i class="text-danger" ng-show="!request.requested_person && showError"><small>Please Select Requested Person</small></i>
                </div>
                <div class="col">
                    <label for="requested-date">Requested Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="requested-date" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="request.requested_date" class="form-control datetimepicker-input" data-target="#requested-date"/>
                            <div class="input-group-append" data-target="#requested-date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <label for="description">Description</label>
                    <textarea ng-model="request.description" id="description" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <button class="btn btn-md btn-success" ng-click="saveRequestions()">Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Your Requests</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Requested Department</th>
                            <th>Product Name</th>
                            <th>Requested Date</th>
                            <th>Requested Person</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="reqs in allrequestion">
                            <td ng-bind="$index+1"></td>
                            <td>
                                <span ng-if="reqs.requested_dept == 1">HR</span>
                                <span ng-if="reqs.requested_dept == 2">Banking and Finance</span>
                                <span ng-if="reqs.requested_dept == 3">Matrial Management</span>
                                <span ng-if="reqs.requested_dept == 4">Project System</span>
                                <span ng-if="reqs.requested_dept == 5">Sourcing</span>
                                <span ng-if="reqs.requested_dept == 6">Purchase</span>
                                <span ng-if="reqs.requested_dept == 7">Sales</span>
                            </td>
                            <td ng-bind="reqs.product_name"></td>
                            <td ng-bind="reqs.requested_date"></td>
                            <td ng-bind="reqs.requested_person_name"></td>
                            <td>
                                <div class="btn-group" ng-if="reqs.department == reqs.requested_dept">
                                    <button class="btn btn-xs btn-info" ng-click="editRequest(reqs)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteRequest(reqs.id)">Delete</button>
                                </div>
                                <div class="btn-group" ng-if="reqs.status == 0">
                                    <button class="btn btn-xs btn-warning" ng-click="changeStatus(reqs.id, 2)">Reject</button>
                                    <button class="btn btn-xs btn-success" ng-click="changeStatus(reqs.id, 1)">Accept</button>
                                </div>
                                <div class="btn-group" ng-if="reqs.status != 0">
                                    <button class="btn btn-xs btn-warning" ng-if="reqs.status == 1" ng-click="changeStatus(reqs.id, 2)">Reject</button>
                                    <button class="btn btn-xs btn-success" ng-if="reqs.status == 2" ng-click="changeStatus(reqs.id, 1)">Accept</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo $_GET['dept_id'] ?>" id="requested_dept">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/task_hr/requestion.js')}}"></script>
@endsection