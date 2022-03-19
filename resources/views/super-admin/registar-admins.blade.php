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
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="password">* Password</label>
                            <input type="password" ng-model="menu.password" id="password" placeholder="Password" class="form-control">
                            <i class="text-danger" ng-show="!menu.password && showError"><small>Please Type Password</small></i><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="role">* Select Role</label>
                            <select ng-model="menu.role" id="role" class="form-control">
                                <option value="">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Super Admin</option>
                            </select>
                            <i class="text-danger" ng-show="!menu.role && showError"><small>Please Select Role</small></i><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12" id="all-menus">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Menus</h3>
                </div>
                <div class="card-body" style="height:350px">
                    <div class="row">
                        <div class="col" ng-repeat="(key, value) in Menus">
                            <!-- Mega Menu 2-->
                            <div class="meganavbar">
                                <div class="megadropdown">
                                    <button class="megadropbtn">
                                        <span ng-bind="key"></span>
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="megadropdown-content" style="overflow-y:scroll">
                                        <div class="row" style="height:250px">
                                            <div class="column" ng-repeat="(key1, value1) in value">
                                                <label ng-bind="key1"></label>
                                                <ul class="list-group">
                                                    <li class="list-group-item" ng-repeat="v in value1" style="font-size:12px">
                                                        <input type="checkbox" name="cat" id="cat<%v.id%>">
                                                        <label ng-bind="v.menu_name" for="cat<%v.id%>"></label>
                                                        <!-- <input type="checkbox" name="group" id="group_1" />
                                                        <label for="group_1">description</label> -->
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4" style="overflow-y:scroll; height: 500px;">
                            <ul class="list-group">
                                <li ng-repeat="m in Menus" class="list-group-item">
                                    <input type="radio" ng-model="menu.tier_id" ng-click="getMenusOne(m.id)" id="parent<% m.id %>" ng-value="m.id"> <label for="parent<% m.id %>" ng-bind="m.menu_name"></label><br/>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4" style="overflow-y:scroll; height: 500px;">
                            <ul class="list-group" ng-if="MenusOne.length > 0">
                                <li ng-repeat="om in MenusOne" class="list-group-item">
                                    <input type="radio" ng-model="menu.module_id" ng-click="getMenusTwo(om.id)" id="parent<% om.id %>" ng-value="om.id"> <label for="parent<% om.id %>" ng-bind="om.menu_name"></label><br/>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4" style="overflow-y:scroll; height: 500px;">
                            <ul class="list-group" ng-if="MenusTwo.length > 0">
                                <li ng-repeat="tm in MenusTwo" class="list-group-item">
                                    <input type="checkbox" ng-click="selectForms(tm.id)" id="parent<% tm.id %>" ng-value="tm.id"> <label for="parent<% tm.id %>" ng-bind="tm.menu_name"></label><br/>      
                                </li>
                            </ul>
                        </div>
                    </div><br/>
                    <button type="submit" class="btn btn-success btn-sm float-right" ng-click="saveUser();"><i id="loader" class="fa fa-save"></i> Save</button> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var RegisterAdmin = angular.module('RegisterAdminApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    RegisterAdmin.controller('RegisterAdminController', function ($scope, $http) {
        $("#register-admin").addClass('active');
        $scope.resetscope = function(){
            $scope.getMenus();
            $scope.menu = {};
        };

        $scope.formIds = [];
        $scope.selectForms = function(form_id){
            let index = $scope.formIds.indexOf(form_id);
            if(index == -1){
                $scope.formIds.push(form_id);
            }else{
                $scope.formIds.splice(index, 1);
            }
        };

        $scope.getMenus = function(){
        var ParentMenus = $http.get('get-sidebar-menu');
            ParentMenus.then(function (r) {
                $scope.Menus = r.data;
            });
       };

       $scope.getMenusOne = function(id){
        var ParentMenus = $http.get('create-sidebar-menu/' + id);
            ParentMenus.then(function (r) {
                $scope.MenusOne = r.data;
            });
       };

       $scope.getMenusTwo = function(id){
        var ParentMenus = $http.get('create-sidebar-menu/' + id);
            ParentMenus.then(function (r) {
                $scope.MenusTwo = r.data;
            });
       };

       $scope.saveUser = function(){
            $scope.menu.forms = JSON.stringify($scope.formIds);
            console.log($scope.menu);
            if (!$scope.menu.email || !$scope.menu.name || !$scope.menu.company_name || !$scope.menu.password || !$scope.menu.role) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
                var Data = new FormData();
                angular.forEach($scope.menu, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('regiter-admin', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.menu = {};
                    $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                });
            }
       };
    });
</script>
@endsection