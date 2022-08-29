@extends('layouts.admin.creationTier')
@section('title', 'Employee Roles')
@section('pagetitle', 'Employee Roles')
@section('breadcrumb', 'Employee Roles')
@section('content')
<div ng-controller="RolesController" ng-cloak>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Employee Roles</h3>
                </div>
                <div class="card-body">
                    <div class="row" ng-init="getoffice(); getRoles();">
                        <div class="col">
                            <label for="office">Select Office</label>
                            <select ng-model="role.office_id" ng-change="getDepartments(role.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                                <option value="">Select Office</option>
                            </select>
                            <i class="text-danger" ng-show="!role.office_id && showError"><small>Please Select Office</small></i>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col">
                            <label for="dpartment">Select Department</label>
                            <select ng-model="role.department_id" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                                <option value="">Select Department</option>
                            </select>
                            <i class="text-danger" ng-show="!role.department_id && showError"><small>Please Select Department</small></i>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col">
                            <label for="role_name">Role Name</label>
                            <input type="text" ng-model="role.role_name" id="role_name" placeholder="Role Name" class="form-control">
                            <i class="text-danger" ng-show="!role.role_name && showError"><small>Please Type Role Name</small></i>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col">
                            <div ng-if="roleAction">
                                <label for="selectedActions">Selected Actions</label>
                                <p ng-repeat="act in roleAction">
                                    <span ng-bind="act.action"></span>
                                </p><hr/>
                            </div>
                            <label for="actions">Actions</label><br/><br/>
                            <p>
                                <input type="checkbox" ng-click="getCheckList('Approval')" id="approval"> <label for="approval">Approval</label>
                            </p>
                            <p>
                                <input type="checkbox" ng-click="getCheckList('Decline')" id="decline"> <label for="decline">Decline</label>
                            </p>
                            <p>
                                <input type="checkbox" ng-click="getCheckList('Discus')" id="discus"> <label for="discus">Discus</label>
                            </p>
                            <p>
                                <input type="checkbox" ng-click="getCheckList('Recommendation')" id="recommendation"> <label for="recommendation">Recommendation</label>
                            </p>
                            <p>
                                <input type="checkbox" ng-click="getCheckList('Other')" id="other"> <label for="other">Other</label>
                            </p>
                        </div>
                    </div><br/>
                    <button class="btn btn-sm btn-success" ng-click="saveRole()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Roles</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Office Name</th>
                                <th>Dept Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="rl in allroles">
                                <td ng-bind="rl.role_name"></td>
                                <td ng-bind="rl.office_name"></td>
                                <td ng-bind="rl.department_name"></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-info" ng-click="editRole(rl.id)">Edit</button>
                                        <button class="btn btn-xs btn-danger" ng-click="deleteRole(rl.id)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
   <input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_company/employee-roles.js')}}"></script>
@endsection