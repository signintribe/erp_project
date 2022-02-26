@extends('layouts.superadmin.superadmin')
@section('title', 'Sidebar Menu')
@section('pagetitle', 'Sidebar Menu')
@section('breadcrumb', 'Sidebar Menu')
@section('content')
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
                    <input type="checkbox" ng-model="menu.is_child" ng-value="2" id="master"> <label for="master">Is Master Menu</label><br/>
                    <label for="menu-description">Description</label>
                    <textarea ng-model="menu.description" id="menu-description" cols="30" rows="5" class="form-control" placeholder="Type Menu Description. . ."></textarea><br/>
                    <button class="btn btn-success btn-sm" ng-click="SaveMenu()"><i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Menus</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li ng-repeat="m in Menus">
                            <input type="radio" ng-model="menu.parent_id" id="parent<% m.id %>" ng-value="m.id"> <label for="parent<% m.id %>" ng-bind="m.menu_name"></label>
                        </li>
                    </ul>
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
        $scope.resetscope = function(){
            $scope.getMenus();
            $scope.menu = {};
        };
        $scope.SaveMenu = function(){
            if (!$scope.menu.menu_name || !$scope.menu.menu_link) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.menu, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('create-sidebar-menu', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal("Success!", res.data.message, "success");
                        $scope.getMenus();
                        $scope.menu = {};
                    }else{
                        swal("Sorry!", res.data.message, "warning");
                    }
                });
            }
       };

       $scope.getMenus = function(){
        var ParentMenus = $http.get('create-sidebar-menu/2');
            ParentMenus.then(function (r) {
                $scope.Menus = r.data;
            });
       };
    });
</script>
@endsection