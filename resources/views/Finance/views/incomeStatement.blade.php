@extends('layouts.penals.master')
@section('title', 'Report General Journal Entry')
@section('content')
<link rel="stylesheet" href="{{asset('theme/plugins/datepicker/datepicker3.css')}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="ReportIncomeStatementApp" ng-controller="ReportIncomeStatementController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Income Statement
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Trial Balance Report</li>
        </ol>
    </section>
    <!--<form onsubmit="">-->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Select Report Criteria</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                            Date From: <input type="text" name="date"  ng-model="filters.datefrom" class="datepicker"/>
                                </div>
                                <div class="col-lg-4">
                            Date To: <input type="text" name="date"  ng-model="filters.dateto" class="datepicker"/>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-md btn-info" ng-click="getData()"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>Name of Account</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Revenues</h5> 
                                        <ul>
                                            <li ng-repeat="Account in Accounts.income" ng-init="(Account.Total = Account.Total*-1);calculateDEbitCredit(Account.Total,'TotalIcome')">
                                                <label  ng-bind="Account.CategoryName"></label> <label class="pull-right" ng-bind="Account.Total"></label>
                                            </li>
                                            <hr>
                                            <li>
                                                <label>Total Income</label> <label class="pull-right" ng-bind="TotalIcome"></label>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Cost of Sale</h5> 
                                        <ul>
                                            <li ng-repeat="Account in Accounts.COS" ng-init="calculateDEbitCredit(Account.Total,'TotalCostOfSale')">
                                                <label  ng-bind="Account.CategoryName"></label> <label class="pull-right" ng-bind="Account.Total"></label>
                                            </li>
                                            <hr>
                                            <li>
                                                <label>Total Cost Of Sale</label> <label class="pull-right" ng-bind="TotalCostOfSale"></label>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Gross Profit</label> <label class="pull-right" ng-bind="(TotalIcome - TotalCostOfSale)"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Expenses</h5> 
                                        <ul>
                                            <li ng-repeat="Account in Accounts.expance" ng-init="calculateDEbitCredit(Account.Total,'TotalExpanse')">
                                                <label  ng-bind="Account.CategoryName"></label> <label  class="pull-right" ng-bind="Account.Total"></label>
                                            </li>
                                            <hr>
                                            <li>
                                                <label>Total Expanse</label> <label class="pull-right" ng-bind="TotalExpanse"></label>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Net Income</label> <label class="pull-right" ng-bind="(TotalIcome - TotalCostOfSale)-(TotalExpanse)"></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--</form>-->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('angularjs')
<script src="{{ asset('theme/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('js/angular/angular.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#DashboardMenu").removeClass("active"); //this will remove the active class from  
        $('#Reports').addClass('active');
        $('#incomeStatement').addClass('active');
        
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    });


    //Angular Part

    angular.module('ReportIncomeStatementApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }).controller('ReportIncomeStatementController', function ($scope, $http, $filter) {
            $scope.filters = {};
            $scope.TotalIcome =0;
            $scope.TotalCostOfSale =0;
            $scope.TotalExpanse =0;
            $scope.Accounts = [];
            $scope.getData = function(){
            $scope.TotalIcome =0;
            $scope.TotalCostOfSale =0;
            $scope.TotalExpanse =0;
                $http.post('incomeStatement-report',$scope.filters).then(function(res){
                    $scope.Accounts =    res.data;
                });
            };
            $scope.calculateDEbitCredit = function(E,T){
                $scope[T] += parseInt(E);
            };
    });
</script>
@stop