@extends('layouts.admin.creationTier')
@section('title', 'Chart of Account')
@section('pagetitle', 'Chart of Account')
@section('breadcrumb', 'Chart of Account')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div ng-app="MyApp" ng-controller="CategoryController" ng-init="resetscope()">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <!-- /.box-header -->
                <div class="card-body">
                    <p ng-if="savemessage" ng-bind="savemessage"></p>
                    <div class="form-group" >
                        <label style="font-weight: normal;">Account ID</label>  
                        <input class="form-control" ng-model="Category.AccountId"  autofocus/>
                    </div>
                    <div class="form-group" id="CategoryName">
                        <label style="font-weight: normal;">Account Name</label>  
                        <input class="form-control" ng-model="Category.CategoryName"  autofocus/>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: normal;">Account Description</label>  
                        <textarea rows='5' max='300' class="form-control" ng-model="Category.AccountDescription"></textarea>
                    </div>
                    <div id="Save-button">
                        <button class="btn btn-success btn-xs pull-right" ng-click="save_category()">
                            <i class="fa fa-save"></i> <span ng-bind="SaveLabel"></span>
                        </button> 
                    </div> 
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card">
                <!-- /.box-header -->
                <div class="card-body">
                    <p ng-if="showmessage" ng-bind="showmessage"></p>
                    <div ng-cloak ng-repeat="v in categories" ng-init="parseId(v)" id="par<% v.id %>">
                        <div class="checkbox checkbox-success">
                            <span class="browsedbutton fa fa-plus" ng-if="v.product_category == 0" style="float:left;" id="brows<% v.id %>" ng-click="getchield(v.id, v.id)"></span>
                            <span class="static-div-minus" ng-if="v.product_category"></span>
                            <input type="checkbox" id="<% v.id %>"  ng-model='C["Check" + v.id]' ng-click="associate(v.id)" style="float:left; margin-left: 1px"/>
                            <label style="margin-left: 20px; font-weight: normal;" ng-dblclick="editcat($event, v)" id="categoryforedit<% v.id %>" ng-bind="v.CategoryName + ' => '+ v.AccountId"></label><small ng-if="v.service" class="text-success">Service</small>
                            <Edit id="placeforedit<% v.id %>"></Edit>
                        </div>
                        <div class="catstyle" style='margin-left:20px; border-left:dotted 1px #8080ff; padding-left:23px;'></div>
                    </div>
                    <div class="sk-spinner sk-spinner-wave"  ng-if="!categories"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div><div class="sk-rect5"></div></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('public/js/angular.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.6.2/angular-sanitize.min.js">
</script>
<!--1 9 18 cash 100000
    capita 100000
    
    15  machinery   2000000
        capital     2000000
         bank check      3000000
         to capital 3000000
cash 100000
machinry    20000
bank 30000
to capiaptal 6000000

p 50000
cash`5000
cash to sale 60000
discount to cash 10000-->

<script>
    var Finance = angular.module('MyApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Finance.controller('CategoryController', function ($scope, $http, $compile, $filter) {
        $("#banking-finance").addClass('menu-open');
        $("#banking-finance a[href='#']").addClass('active');
        $("#chart-account").addClass('active');
        $scope.resetscope = function () {
            $scope.Category = {};
            $scope.C = {};
            $scope.categories = [];
            $scope.SaveLabel = 'Save';
            $scope.getcategories();
        };
        $scope.getcategories = function () {
            $scope.parent = [];
            var categories = $http.get('getAccountCategories/1');
            categories.then(function (r) {
                $scope.data = false;
                $scope.categories = r.data;
                for (i in r.data) {
                    $scope.parent.push(r.data[i].id);
                }
            });
        };
        //save Category
        $scope.save_category = function () {
            if ($scope.Category.CategoryName !== '') {
                if (!$scope.Category.ParentcategoryId) {
                    $scope.Category.ParentcategoryId = 1;
                }
                $("#CategoryName").removeClass('has-error');
                $http.post('save-account', $scope.Category)
                        .then(function (res) {
                            var button = $compile(angular.element('<button class="btn btn-success btn-xs" ng-click="save_category()"><i class="fa fa-save"></i> Save</button>'))($scope);
                            $("#Save-button").html(button);
                            $scope.savemessage = res.data;
                            $scope.resetscope();
                        });
            } else {
                $("#CategoryName").addClass('has-error');
            }
        };
        $scope.editcat = function (event, obj) {
            $("#brows" + obj.id).remove();
            $scope.C['Check' + obj.ParentcategoryId] = true;
            $("#par" + obj.id + ' div').eq(1).html('');
            $scope.Category = obj;
            $scope.Category.ParentcategoryId = obj.ParentcategoryId;
            $scope.edittext = obj.CategoryName;
            var input = $compile(angular.element('<span><% Category.CategoryName %></span>'))($scope);
            $("#categoryforedit" + obj.id).html('');
            $("#placeforedit" + obj.id).html(input);
            var button = $compile(angular.element('<input type="button" class="btn btn-xs btn-danger" ng-click="delete_category(' + obj.id + ')" value="Delete"/>\
             <button class="btn btn-success btn-xs" ng-click="save_category()">Update</button>\
             <input type="button" class="btn btn-info btn-xs" ng-click="CancelEditing(' + obj.id + ')" value="Cancel" />'))($scope);
            $("#Save-button").html(button);
        };
        $scope.CancelEditing = function (id) {
            var button = $compile(angular.element('<button class="btn btn-success btn-xs pull-right" ng-click="save_category()"><i class="fa fa-save"></i> Save</button>'))($scope);
            $("#Save-button").html(button);
            $scope.resetscope();
        };
        //set Associated category array
        $scope.associate = function (id) {
            console.log(id);
            var id = parseInt(id);
            if ($scope.Category.ParentcategoryId) {
                $scope.C['Check' + $scope.Category.ParentcategoryId] = false;
            }
            $scope.Category.ParentcategoryId = id;
            console.log($scope.Category);
        };
        $scope.getchield = function (id, objid) {
            var brows = $("#brows" + objid).attr('brows');
            if (typeof brows === "undefined") {
                $("#brows" + objid).attr('brows', 'true').removeClass('fa-plus').addClass('fa-minus');
                $("#par" + objid + " div").eq(1).html('<div class="sk-spinner sk-spinner-wave"  ng-if="!categories"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div><div class="sk-rect5"></div></div>');
                var chields = $http.get('getAccountCategories/' + id);
                chields.then(function (r) {
                    $scope["par" + objid] = '';
                    $scope["par" + objid] = r.data;
                    var content = angular.element('<div ng-cloak ng-repeat="v in par' + objid + '" ng-init="parseId(v)" id="par<% v.id %>" style="width: 435px;">\
                                                    <div class="checkbox checkbox-success"  style="padding-left: 0px;">\
                                                        <span class="browsedbutton fa fa-plus" ng-if="v.product_category === 0" style="float:left;" id="brows<% v.id %>" ng-click="getchield(v.id,v.id)"></span>\
                                                        <span class="static-div-minus" ng-if="v.product_category"></span>\
                                                        <input type="checkbox" id="<% v.id %>"  ng-model="C[\'Check\'+v.id]" ng-click="associate(v.id)" style="float:left; margin-left: 1px"/>\
                                                        <label style="margin-left: 20px; font-weight: normal;" ng-dblclick="editcat($event, v)" id="categoryforedit<% v.id %>" ng-bind="v.CategoryName +\' => \'+ v.AccountId"></label><small ng-if="v.service" class="text-success">Service</small>\
                                                        <Edit id="placeforedit<% v.id %>"></Edit>\
                                                    </div>\
                                                    <div  class="catstyletwo" style="margin-left:20px;"></div>\
                                             </div>');
                    $compile(content)($scope);
                    $("#par" + objid + " div").eq(1).html(content);
                });
            } else {
                $("#brows" + objid).removeAttr('brows').addClass('fa-plus').removeClass('fa-minus');
                $("#par" + objid + " div").eq(1).html('');
            }
        };
        //convert string to integer 
        $scope.parseId = function (val) {

            val.product_category = parseInt(val.product_category);
        };
        $scope.delete_category = function (id) {
            var delete_category = $http.get('delete-account-category/' + id);
            delete_category.then(function (result) {
                var button = $compile(angular.element('<button class="btn btn-success btn-xs pull-right" ng-click="save_category()"><i class="fa fa-save"></i> Save</button>'))($scope);
                $("#Save-button").html(button);
                $scope.showmessage = result.data;
                $scope.resetscope();
            });
        };
    });
</script>
@endsection
