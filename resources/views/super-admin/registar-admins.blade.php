@extends('layouts.superadmin.superadmin')
@section('title', 'Register Admin')
@section('pagetitle', 'Register Admin')
@section('breadcrumb', 'Register Admin')
@section('content')
<style>
    #all-menus label{
        font-size: 14px;
    }
</style>
<div ng-app="RegisterAdminApp" ng-controller="RegisterAdminController">
    <div class="row" ng-init="resetscope()">
        <div class="col-lg-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="email">* Email Address</label>
                            <input type="text" ng-model="menu.email" id="email" placeholder="Email Address" class="form-control">
                            <i class="text-danger" ng-show="!menu.email && showError"><small>Please Type Email Address</small></i><br/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="name">* Name</label>
                            <input type="text" ng-model="menu.name" id="name" placeholder="Name" class="form-control">
                            <i class="text-danger" ng-show="!menu.name && showError"><small>Please Type Name</small></i><br/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="company-name">* Company Name</label>
                            <input type="text" ng-model="menu.company_name" id="company-name" placeholder="Company Name" class="form-control">
                            <i class="text-danger" ng-show="!menu.company_name && showError"><small>Please Type Company Name</small></i><br/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3" id="hidepass">
                            <label for="password">* Password</label>
                            <input type="password" ng-model="menu.password" id="password" placeholder="Password" class="form-control">
                            <i class="text-danger" ng-show="!menu.password && showError"><small>Please Type Password</small></i><br/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="role">* Select Role</label>
                            <select ng-model="menu.is_admin" id="role" class="form-control">
                                <option value="">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Super Admin</option>
                            </select>
                            <i class="text-danger" ng-show="!menu.is_admin && showError"><small>Please Select Role</small></i><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3 class="m-0">All Menus</h3><br/>
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
    <div class="row" id="user-menus" ng-if="Tiers">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3 class="m-0">Selected Menus</h3><br/>
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
                                            <label for="selected_cat<% frms.id %>" style="font-size:12px; font-weight: normal" ng-bind="frms.from_name"></label>
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
    <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-success btn-sm float-right" ng-click="saveUser();"><i id="loader" class="fa fa-save"></i> Save</button>
        </div>
    </div><br/>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12" id="all-user">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View User</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="data in users">
                                    <td ng-bind="$index+1"></td>
                                    <td ng-bind="data.name"></td>
                                    <td ng-bind="data.email"></td>
                                    <td ng-bind="data.company_name"></td>
                                    <td>
                                        <button class="btn btn-xs btn-info" ng-click="getUserTiers(data.id, 1);">Edit User</button>
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
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script src="{{asset('ng_controllers/super_admin/register-admins.js')}}"></script>
@endsection