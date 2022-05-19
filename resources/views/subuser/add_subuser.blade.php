@extends('layouts.admin.userAuthTier')
@section('title', 'Add User')
@section('pagetitle', 'Add User')
@section('breadcrumb', 'Add User')
@section('content')
<div ng-controller="AddSubuserController">
    <div class="row" ng-init="getEmployees(); get_designations(); getMenus();">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <select ng-model="subuser.user_id" ng-change="getusermenus(subuser.user_id, 1)" ng-options="usr.user_id as usr.first_name for usr in Users" class="form-control">
                <option value="">Select User</option>
            </select>
            <i class="text-danger" ng-show="!subuser.user_id && showError"><small>Please Select User</small></i><br/>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <p class="form-control" ng-bind="user.email"></p>
        </div>
    </div><br/>
    <div class="row" id="user-menus" ng-if="Tiers">
        <i class="text-danger" ng-show="!subuser.removemenu && showError"><small>Please Select Menu</small></i><br/>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card-tools">
                <button type="button" class="btn btn-md btn-danger" ng-click="removeUserMenu()">
                    <i class="fas fa-times" id="rmloder"></i> Remove
                </button>
            </div><br/>
            <div class="row">
                <div class="col" ng-repeat="(tk, tv) in Tiers">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" ng-bind="tk"></h3>
                        </div>
                        <div class="card-body" style="height: 400px; overflow-y: scroll;">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6" ng-repeat="(mk, mv) in tv">
                                    <label ng-bind="mk" style="border-bottom: 1px solid;font-size:14px"></label>
                                    <ul class="list-unstyled">
                                        <li ng-repeat="frms in mv">
                                            <input type="checkbox" name="cat" id="edcat<%frms.id%>" ng-click="removeCheckMenus(frms.id)">
                                            <label ng-bind="frms.from_name" style="font-size:12px; font-weight: normal" for="edcat<%frms.id%>"></label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5>Assign menu to user</h5>
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
    <button class="btn btn-success btn-md" ng-click="saveUser();"> <i class="fa fa-save" id="loader"></i> Save</button><br/><br/>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/subuser/add_users.js')}}"></script>
@endsection