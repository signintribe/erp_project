@extends('layouts.superadmin.superadmin')
@section('title', 'Sidebar Menu')
@section('pagetitle', 'Sidebar Menu')
@section('breadcrumb', 'Sidebar Menu')
@section('content')
<div ng-app="SidebarApp" ng-controller="SidebarController">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Menu</h3>
                </div>
                <div class="card-body">
                    <label for="menu-name">Menu Name</label>
                    <input type="text" ng-model="menu.menu_name" id="menu-name" class="form-control" placeholder="Type Menu Name"><br/>
                    <label for="menu-link">Menu Link</label>
                    <input type="text" ng-model="menu.menu_link" id="menu-link" class="form-control" placeholder="Type Menu Link"><br/>
                    <label for="menu-description">Description</label>
                    <textarea ng-model="menu.menu_description" id="menu-description" cols="30" rows="5" class="form-control" placeholder="Type Menu Description. . ."></textarea><br/>
                    <button class="btn btn-success btn-sm"><i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Menus</h3>
                </div>
                <div class="card-body">

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
       
    });
</script>
@endsection