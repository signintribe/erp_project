@extends('layouts.superadmin.superadmin')
@section('title', 'Sidebar Menu')
@section('pagetitle', 'Sidebar Menu')
@section('breadcrumb', 'Sidebar Menu')
@section('content')
<style>
    #all-menus label{
        font-size: 14px;
    }
</style>
<div ng-app="SidebarApp" ng-controller="SidebarController">
    <div class="row" ng-init="resetscope();">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Menu</h3>
                </div>
                <div class="card-body">
                    <label for="menu-name">* Menu Name</label>
                    <input type="text" ng-model="menu.menu_name" id="menu-name" class="form-control" placeholder="Type Menu Name">
                    <i class="text-danger" ng-show="!menu.menu_name && showError"><small>Please Type Menu Name</small></i><br/>
                    <label for="menu-link">* Menu Link</label>
                    <input type="text" ng-model="menu.menu_link" id="menu-link" class="form-control" placeholder="Type Menu Link">
                    <i class="text-danger" ng-show="!menu.menu_name && showError"><small>Please Type Menu Link</small></i><br/>
                    <label for="menu-description">Description</label>
                    <textarea ng-model="menu.description" id="menu-description" cols="30" rows="5" class="form-control" placeholder="Type Menu Description. . ."></textarea><br/>
                    <button class="btn btn-success btn-sm" ng-click="SaveMenu()"><i id="loader" class="fa fa-save"></i> Save</button>
                    <button class="btn btn-warning btn-sm" id="reset-btn" ng-click="resetscope()"><i id="loader" class="fa fa-redo"></i> Reset</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8" id="all-menus">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Menus</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4" style="overflow-y:scroll; height:408px;">
                            <ul class="list-group">
                                <li ng-repeat="m in Menus" class="list-group-item">
                                    <input type="radio" ng-model="menu.parent_id" ng-click="getMenusOne(m.id)" id="parent<% m.id %>" ng-value="m.id"> <label for="parent<% m.id %>" ng-bind="m.menu_name"></label><br/>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-info" ng-click="editMenu(m)">Edit</button>
                                        <button class="btn btn-xs btn-danger" ng-click="deleteMenu(m.id)">Delete</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4" style="overflow-y:scroll; height:408px;">
                        <ul class="list-group" ng-if="MenusOne.length > 0">
                                <li ng-repeat="om in MenusOne" class="list-group-item">
                                    <input type="radio" ng-model="menu.parent_id" ng-click="getMenusTwo(om.id)" id="parent<% om.id %>" ng-value="om.id"> <label for="parent<% om.id %>" ng-bind="om.menu_name"></label><br/>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-info" ng-click="editMenu(om)">Edit</button>
                                        <button class="btn btn-xs btn-danger" ng-click="deleteMenu(om.id)">Delete</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4" style="overflow-y:scroll; height:408px;">
                            <ul class="list-group" ng-if="MenusTwo.length > 0">
                                <li ng-repeat="tm in MenusTwo" class="list-group-item">
                                    <!-- <input type="radio" ng-model="menu.parent_id" id="parent<% tm.id %>" ng-value="tm.id"> --> <label for="parent<% tm.id %>" ng-bind="tm.menu_name"></label><br/>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-info" ng-click="editMenu(tm)">Edit</button>
                                        <button class="btn btn-xs btn-danger" ng-click="deleteMenu(tm.id)">Delete</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var Sidebar = angular.module('SidebarApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    Sidebar.controller('SidebarController', function ($scope, $http) {
        $("#sidebar-menu").addClass('active');
        $scope.resetscope = function(){
            $scope.getMenus();
            $scope.MenusOne = {};
            $scope.MenusTwo = {};
            $scope.menu = {};
            $("#reset-btn").hide('slow');
        };
        $scope.SaveMenu = function(){
            if (!$scope.menu.menu_name || !$scope.menu.menu_link) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass("fa-save").addClass('fa-spinner fa-fw fa-pulse');
                var Data = new FormData();
                angular.forEach($scope.menu, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('create-sidebar-menu', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal("Success!", res.data.message, "success");
                        $scope.getMenus();
                        $scope.menu = {};
                        $("#loader").removeClass("fa-spinner fa-fw fa-pulse").addClass('fa-save');
                    }else{
                        swal("Sorry!", res.data.message, "warning");
                        $("#loader").removeClass("fa-spinner fa-fw fa-pulse").addClass('fa-save');
                    }
                });
            }
       };

       $scope.getMenus = function(){
        var ParentMenus = $http.get('create-sidebar-menu/0');
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
       
       $scope.editMenu = function(menu){
           $("#reset-btn").show('slow');
           $scope.menu = menu; 
       };

       $scope.deleteMenu = function (id) {
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('create-sidebar-menu/' + id).then(function (response) {
                    if(response.data.status == true){
                        $scope.getMenus();
                        swal("Deleted!", response.data.message, "success");
                    }else{
                        swal("Not Deleted!", response.data.message, "error");
                    }
                });
            });
        };
    });
</script>
@endsection