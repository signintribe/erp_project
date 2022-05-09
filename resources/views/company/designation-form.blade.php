@extends('layouts.admin.creationTier')
@section('title', 'Designation Form')
@section('pagetitle', 'Designation Form')
@section('breadcrumb', 'Designation Form')
@section('content')

<div ng-controller='DesigntionController' ng-init="resetscope();">
    <div class="card">
        <div class="card-body">
            <ul>
                <li class="text-danger" ng-show="!designation.designation_name && showError">
                    <i><small>Please Type Designation</small></i>
                </li>
                <li class="text-danger" ng-show="!designation.group_id && showError">
                    <i><small>Please Select Employee Group</small></i>
                </li>
            </ul>
            <div class="row">
                <div class='col-lg-3 col-md-3 col-sm-3'>
                    <label>* Designation Name</label>
                    <input type="text" ng-model="designation.designation_name" id="" class="form-control" placeholder="Designation Name">
                    <i class="text-danger" ng-show="!designation.designation_name && showError"><small>Please Type Designation Name</small></i>
                </div>
                <div class='col-lg-3 col-md-3 col-sm-3'>
                    <label>Short Name</label>
                    <input type="text" ng-model="designation.short_name" id="" class="form-control" placeholder="Short Name">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Attachment</label>
                    <input type="file" onchange="angular.element(this).scope().readUrl(this);" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Status</label><br>
                    <p class="form-control">
                        <input type="checkbox" ng-model="designation.status" id="status"> <label for="status">Active</label>
                    </p>
                </div>
            </div>
            <div class="row" ng-init="getoffice(0)">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="office">Select Office</label>
                    <select ng-model="designation.office_id" ng-change="getDepartments(group.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select><br/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="department">Select Department</label>
                    <select ng-model="designation.department_id" ng-change="get_groups(group.department_id)" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!group.department_id && showError"><small>Please Select Department</small></i><br/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="">* Employee Group</label>
                    <select ng-model="designation.group_id" ng-options="g.id as g.group_name for g in allgroups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!designation.group_id && showError"><small>Please Select Employee Group</small></i>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label>Breif Description</label>
                    <textarea type="text" ng-model="designation.description" id="" class="form-control" placeholder="Breif Description"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="saveDesignation()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Designations</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Designation Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Group Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="des in alldesignations">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="des.designation_name"></td>
                        <td ng-bind="des.office_name"></td>
                        <td ng-bind="des.department_name"></td>
                        <td ng-bind="des.group_name"></td>
                        <td ng-bind="des.created_at"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info btn-xs" ng-click="editDesignation(des)">Edit</button>
                                <button class="btn btn-danger btn-xs" ng-click="deleteDesignation(des.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="text-center">
                <span ng-if="norecord" ng-bind="norecord"></span>
                <i id="spinner"></i>
            </p>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_company/designation.js')}}"></script>
@endsection