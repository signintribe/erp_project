@extends('layouts.admin.creationTier')
@section('title', 'Chart of Account')
@section('pagetitle', 'Chart of Account')
@section('breadcrumb', 'Chart of Account')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div ng-app="MyApp" ng-controller="CategoryController" ng-init="resetscope()">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <div class="card">
                <!-- /.box-header -->
                <div class="card-body">
                    <p ng-if="savemessage" ng-bind="savemessage"></p>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" >
                                <label>Account ID</label>  
                                <input type="number" class="form-control" ng-model="Category.AccountId" placeholder="Account ID"  autofocus/>
                                <i class="text-danger" ng-show="!Category.AccountId && showError"><small>Please type account ID</small></i>
                            </div>
                        </div>
                    <!-- </div>
                    <div class="row"> -->
                        <div class="col">
                            <div class="form-group" id="CategoryName">
                                <label>Account Name</label>  
                                <input class="form-control" ng-model="Category.CategoryName" placeholder="Account Name"/>
                                <i class="text-danger" ng-show="!Category.CategoryName && showError"><small>Please type account name</small></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Account Description</label>  
                                <textarea rows='5' max='300' class="form-control" placeholder="Add Account Description" ng-model="Category.AccountDescription"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="openingBalance">
                <div class="card-header">
                    <h3 class="card-title">Opening Balance</h3>
                </div>
                <div class="card-body">
                     <div class="row">
                        <div class="col">
                            <input type="number" ng-model="Category.credit" class="form-control" placeholder="Credit Amount">
                        </div>
                        <div class="col">
                            <input type="number" ng-model="Category.debit" class="form-control" placeholder="Debit Amount">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group date" id="account_date" data-target-input="nearest">
                                    <input type="text" placeholder="End Date" ng-model="Category.account_date" class="form-control datetimepicker-input" data-target="#account_date"/>
                                    <div class="input-group-append" data-target="#account_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7">
           <div class="card" style="height: 520px;">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Select Account Type</h3>
                        </div>
                        <div class="col">
                            <a href="#showAccounts" class="btn btn-xs btn-warning float-right">Show All Accounts</a>
                        </div>
                    </div>
                </div>
               <div class="card-body">
                   <div class="row">
                       <div class="col" style="overflow-y: scroll; height: 430px;">
                            <i class="text-danger" ng-show="!Category.ParentcategoryId && showError"><small>Please select account type</small></i>
                            <div ng-repeat="(key, value) in allcats">
                                <strong ng-bind="key"></strong><br/>
                                <ul class="list-unstyled" style="margin-left: 20px;">
                                    <li ng-repeat="cats in value">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio<%cats.id%>" ng-model="Category.ParentcategoryId" ng-click="getCategory(cats)" ng-value="cats.id" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" style="font-weight: normal" for="customRadio<%cats.id%>" ng-bind="cats.CategoryName"></label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                       </div>
                       <div class="col">
                           <p ng-bind="selectedCate.AccountDescription"></p>
                           <div id="Save-button">
                                <button class="btn btn-success btn-md pull-right" ng-click="save_category()">
                                    <i class="fa fa-save" id="savebtn"></i> <span ng-bind="SaveLabel"></span>
                                </button> 
                            </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" id="showAccounts">All Accounts</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Account ID</th>
                                    <th>Account Name</th>
                                    <th>Parent Account</th>
                                    <th>Account Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="acc in Accounts">
                                    <td ng-bind="$index+1"></td>
                                    <td ng-bind="acc.AccountId"></td>
                                    <td ng-bind="acc.CategoryName"></td>
                                    <td ng-bind="acc.ParentCategory"></td>
                                    <td ng-bind="acc.created_at"></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-info btn-xs" ng-click="editAccount(acc)">Edit</button>
                                            <button class="btn btn-danger btn-xs" ng-click="delete_category(acc.id)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('public/js/angular.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.6.2/angular-sanitize.min.js">
</script>
<script>
    var Finance = angular.module('MyApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Finance.controller('CategoryController', function ($scope, $http, $compile, $filter) {
        $('#account_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $("#banking-finance").addClass('menu-open');
        $("#banking-finance a[href='#']").addClass('active');
        $("#chart-account").addClass('active');
        $scope.resetscope = function () {
            $scope.Category = {};
            $scope.C = {};
            $scope.categories = [];
            $scope.SaveLabel = 'Save';
            $scope.getcategories();
            $scope.getAccounts();
        };
        $scope.getcategories = function () {
            $scope.parent = [];
            var categories = $http.get('get-account-categories');
            categories.then(function (r) {
                $scope.allcats = r.data;
            });
        };

        $scope.getAccounts = function () {
            var Accounts = $http.get('AllchartofAccount');
            Accounts.then(function (r) {
                $scope.Accounts = r.data;
            });
        };
        //save Category
        $scope.save_category = function () {
            if (!$scope.Category.ParentcategoryId || !$scope.Category.CategoryName || !$scope.Category.AccountId) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#savebtn").removeClass('fa-save').addClass('fa-spinner fa-pulse');
                $scope.Category.date = $("#account_date input").val();
                if (!$scope.Category.ParentcategoryId) {
                    $scope.Category.ParentcategoryId = 1;
                }
                $("#CategoryName").removeClass('has-error');
                $http.post('save-account', $scope.Category).then(function (res) {
                    //var button = $compile(angular.element('<button class="btn btn-success float-right btn-md" ng-click="save_category()"><i class="fa fa-save" id="savebtn"></i> Save</button>'))($scope);
                    $("#savebtn").removeClass('fa-spinner fa-pulse').addClass('fa-save');
                    swal("Save!", res.data, "success");
                    $scope.resetscope();
                });
            }
        };

        $scope.getCategory = function (category) {
            $scope.selectedCate = category;
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

        $scope.editAccount = function(account){
            $scope.Category = account;
            $("#openingBalance").hide();
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
                var delete_category = $http.get('delete-account-category/' + id);
                delete_category.then(function (result) {
                    swal("Deleted!", result.data, "success");
                    $scope.resetscope();
                });
            });
        };
    });
</script>
@endsection
