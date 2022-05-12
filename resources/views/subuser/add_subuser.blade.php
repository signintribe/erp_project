@extends('layouts.admin.userAuthTier')
@section('title', 'Add User')
@section('pagetitle', 'Add User')
@section('breadcrumb', 'Add User')
@section('content')
<div ng-controller="AddSubuserController">
    <div class="row" ng-init="getEmployees(); get_designations(); getMenus();">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <select ng-model="subuser.employee_id" ng-options="usr.user_id as usr.first_name for usr in Users" class="form-control">
                <option value="">Select User</option>
            </select>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <select ng-model="subuser.designation_id" ng-options="des.id as des.designation_name for des in alldesignations" class="form-control">
                <option value="">Select Designation</option>
            </select>
        </div>
    </div><br/>
    <div class="row" id="all-menus">
        <div class="col-lg-6 col-md-6 col-sm-6" ng-repeat="(key, value) in Menus">
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title" ng-bind="key"></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: scroll;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6" ng-repeat="(key1, value1) in value">
                            <label ng-bind="key1" style="border-bottom: 1px solid;font-size:14px"></label>
                            <ul class="list-unstyled">
                                <li ng-repeat="v in value1">
                                    <input type="checkbox" name="cat" id="cat<%v.id%>" ng-click="getCheckMenus(v.id)">
                                    <label ng-bind="v.menu_name" style="font-size:12px; font-weight: normal" for="cat<%v.id%>"></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br/>
    <button class="btn btn-success btn-md">Save</button>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/subuser/add_users.js')}}"></script>
@endsection