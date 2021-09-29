@extends('layouts.admin.creationTier')
@section('title', 'Your Bank Detail')
@section('pagetitle', 'Your Budget Detail')
@section('breadcrumb', 'Your Budget Detail')
@section('content')
<div  ng-app="BankApp" ng-controller="BankController" ng-cloak>
   <div class="card">
       <div class="card-header">
           <div class="row">
               <div class="col">
                    <h3 class="card-title">Enter Your Budget Detail</h3>
               </div>
               <div class="col">
                   <div class="btn-group float-right">
                       <!-- <button class="btn btn-xs btn-info">Search</button> -->
                       <a href="#Budgets" class="btn btn-xs btn-secondary" ng-if="budgetDetail">View Accounts</a>
                   </div>
               </div>
           </div>
       </div>
       <div class="card-body">
            <div class="table-responsive" ng-init="getAccounts()">
                <table class="table table-sm" style="font-size: 14px;" ng-if="Accounts">
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>Jul</th>
                            <th>Aug</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dec</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="acc in Accounts">
                            <td ng-bind="acc.CategoryName"></td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="jul<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="aug<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="sep<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="oct<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="nov<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="dec<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="jan<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="feb<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="mar<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="apr<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="may<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="jun<% acc.id %>">
                            </td>
                            <td>
                                <button class="btn btn-md btn-success" ng-click="addBudget(acc.id);">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p align="center" ng-if="!Accounts">There is no more account</p>
            </div>
       </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title" id="Budgets">All Budgets</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive" ng-init="getBudgetDetail()">
                <table class="table table-sm table-bordered" ng-if="budgetDetail">
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>Jul</th>
                            <th>Aug</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dec</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="b in budgetDetail">
                            <td ng-bind="b.CategoryName"></td>
                            <td ng-bind="b.july"></td>
                            <td ng-bind="b.august"></td>
                            <td ng-bind="b.september"></td>
                            <td ng-bind="b.october"></td>
                            <td ng-bind="b.november"></td>
                            <td ng-bind="b.december"></td>
                            <td ng-bind="b.january"></td>
                            <td ng-bind="b.february"></td>
                            <td ng-bind="b.march"></td>
                            <td ng-bind="b.april"></td>
                            <td ng-bind="b.may"></td>
                            <td ng-bind="b.june"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-danger" ng-click="deleteBudget(b.id)">Delete</button>
                                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#editBudget" ng-click="editBudget(b)">Edit</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p align="center" ng-bind="nobudget" ng-if="nobudget"></p>
                <!-- Modal -->
                <div id="editBudget" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Budget for <span ng-bind="budget.CategoryName"></span></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="jul">Jul</label>
                                <input type="number" class="form-control" id="jul" ng-model="budget.july"><br/>
                            </div>
                            <div class="col">
                                <label for="aug">Aug</label>
                                <input type="number" class="form-control" id="aug" ng-model="budget.august"><br/>
                            </div>
                            <div class="col">
                                <label for="sep">September</label>
                                <input type="number" class="form-control" id="sep" ng-model="budget.september"><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="oct">October</label>
                                <input type="number" class="form-control" id="oct" ng-model="budget.october"><br/>
                            </div>
                            <div class="col">
                                <label for="nov">November</label>
                                <input type="number" class="form-control" id="nov" ng-model="budget.november"><br/>
                            </div>
                            <div class="col">
                                <label for="dec">December</label>
                                <input type="number" class="form-control" id="dec" ng-model="budget.december"><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="nov">January</label>
                                <input type="number" class="form-control" id="jan" ng-model="budget.january"><br/>
                            </div>
                            <div class="col">
                                <label for="feb">February</label>
                                <input type="number" class="form-control" id="feb" ng-model="budget.february"><br/>
                            </div>
                            <div class="col">
                                <label for="mar">March</label>
                                <input type="number" class="form-control" id="mar" ng-model="budget.march"><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="apr">April</label>
                                <input type="number" class="form-control" id="apr" ng-model="budget.april"><br/>
                            </div>
                            <div class="col">
                                <label for="may">May</label>
                                <input type="number" class="form-control" id="may" ng-model="budget.may"><br/>
                            </div>
                            <div class="col">
                                <label for="jun">June</label>
                                <input type="number" class="form-control" id="jun" ng-model="budget.june"><br/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updateBudget()">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Company = angular.module('BankApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    
    Company.controller('BankController', function ($scope, $http) {
        $("#banking-finance").addClass('menu-open');
        $("#banking-finance a[href='#']").addClass('active');
        $("#budget").addClass('active');
        $scope.url = $("#appurl").val();
        $scope.budget = {};

        $scope.getAccounts = function () {
            var Accounts = $http.get('get-accounts-budget');
            Accounts.then(function (r) {
                $scope.Accounts = r.data;
            });
        };

        $scope.getBudgetDetail = function () {
            var Accounts = $http.get('get-budget-detail');
            Accounts.then(function (r) {
                if(r.data.status==true){
                    $scope.budgetDetail = r.data.data;
                }else{
                    $scope.nobudget = "Budget Not Define";
                }
            });
        };

        $scope.addBudget = function(acc_id){
            $scope.budget.account_id = acc_id;
            $scope.budget.company_id = $("#company_id").val();
            $scope.budget.july = $("#jul"+acc_id).val();
            $scope.budget.august = $("#aug"+acc_id).val();
            $scope.budget.september = $("#sep"+acc_id).val();
            $scope.budget.october = $("#oct"+acc_id).val();
            $scope.budget.november = $("#nov"+acc_id).val();
            $scope.budget.december = $("#dec"+acc_id).val();
            $scope.budget.january = $("#jan"+acc_id).val();
            $scope.budget.february = $("#feb"+acc_id).val();
            $scope.budget.march = $("#mar"+acc_id).val();
            $scope.budget.april = $("#apr"+acc_id).val();
            $scope.budget.may = $("#may"+acc_id).val();
            $scope.budget.june = $("#jun"+acc_id).val();
            if (!$scope.budget.account_id) {
                alert("please select account id");
            } else {
                var Data = new FormData();
                angular.forEach($scope.budget, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('save-budget', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal("Save!", res.data.message, "success");
                        $scope.budget = {};
                        $scope.getAccounts();
                        $scope.getBudgetDetail();
                    }else{
                        swal("Sorry!", res.data.message, "error");
                    }
                });
            }
        };

        $scope.updateBudget = function(){
            if (!$scope.budget.account_id) {
                alert("please select account id");
            } else {
                $scope.budget.company_id = $scope.budget.company_id == 0 ? $("#company_id").val() : $scope.budget.company_id ;
                console.log($scope.budget);
                var Data = new FormData();
                angular.forEach($scope.budget, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('save-budget', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal("Save!", res.data.message, "success");
                        $scope.budget = {};
                        $scope.getAccounts();
                        $scope.getBudgetDetail();
                        $("#editBudget").modal('hide');
                    }else{
                        swal("Sorry!", res.data.message, "error");
                    }
                });
            }
        };

        $scope.deleteBudget = function(budget_id){
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
                var delete_category = $http.get('delete-budget/' + budget_id);
                delete_category.then(function (result) {
                    if(result.data.status == true){
                        swal("Deleted!", result.data.message, "success");
                        $scope.getAccounts();
                        $scope.getBudgetDetail();
                    }
                });
            });
        };

        $scope.editBudget = function(budget){
            $scope.budget = budget;
            console.log($scope.budget);

        };
    });
</script>
@endsection