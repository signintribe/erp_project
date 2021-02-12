@extends('layouts.penals.master')
@section('title', 'Report General Journal Entry')
@section('content')
<link rel="stylesheet" href="{{asset('theme/plugins/datepicker/datepicker3.css')}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="ReportGeneralJournalApp" ng-controller="ReportGeneralJournalController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Report <?=$report->title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?=$report->title; ?> Report</li>
        </ol>
    </section>
    <!--<form onsubmit="">-->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"><?=$report->title; ?> Report</h3>
                        <input type="hidden" id="url" value="<?=env('BASE_URL'); ?>"/>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <form action="{{env('BASE_URL')}}gentaretPDF" method="get" target="_blank">
                        {{ csrf_field() }}
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                            Date From: <input type="text" name="datefrom"  ng-model="filters.datefrom" class="datepicker"/>
                                </div>
                                <div class="col-lg-4">
                            Date To: <input type="text" name="dateto"  ng-model="filters.dateto" class="datepicker"/>
                                </div>
                                <div class="col-lg-4">
                                    <input type="button" class="btn btn-md btn-info" ng-click="getData()" value="Search"/>
                                    <button class="btn btn-md btn-info" ><i class="fa fa-search"></i> PDF</button>
                                </div>
                                <input type="hidden" name="reportId" id="reportId" value="<?=$report->id; ?>"/>
                                <input type="hidden" name="fileName" id="fileName" value="<?=$report->title; ?>"/>
                            </div>
                        </div>
                    </form>
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        Account Id <br>
                                        Name of Account
                                    </th> 
                                    <th>Date</th>
                                    <th>References</th>
                                    <th>Trans Description</th>
                                    <th>Debit Amt</th>
                                    <th>Credit Amt</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="Account in Accounts" ng-init="(Account.runningbalance = 0);">
                                    <td>
                                        <p ng-bind="Account.AccountId"></p>
                                        <p ng-bind="Account.CategoryName"></p>
                                    </td>
                                    <td><p ng-repeat="E in Account.data" ng-bind="E.date"></p></td>
                                    <td><p ng-repeat="E in Account.data" ng-bind="E.refrance"></p></td>
                                    <td><p ng-repeat="E in Account.data" ng-bind="E.description"></p></td>
                                    <td>
                                        <p ng-repeat="E in Account.data" ng-bind="E.debit"></p>
                                        <p ng-bind="Account.debitTotal"></p>
                                        
                                    </td>
                                    <td>
                                        <p ng-repeat="E in Account.data" ng-bind="E.credit"></p>
                                        <p ng-bind="Account.CreditTotal"></p> 
                                    </td> 
                                    <td>
                                        <p ng-repeat="E in Account.data" ng-init="calculateDEbitCredit(Account,E)" ng-bind="E.runningbalance"></p>
                                        <p ng-bind="Account.runningbalance"></p> 
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
        $('#ReportGeneralLedgerMenu').addClass('active');
        
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    });


    //Angular Part

    angular.module('ReportGeneralJournalApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }).controller('ReportGeneralJournalController', function ($scope, $http, $filter) {
            $scope.filters = {};
            $scope.filters.reportId = $('#reportId').val();
            $scope.filters.fileName = $('#fileName').val();
            $scope.baseurl = $('#url').val();
            $scope.TotalDebit =0;
            $scope.TotalCredit =0;
            $scope.Accounts = [];
            $scope.getData = function(){
                $scope.gentaretPDF();
                $http.post($scope.baseurl+'/get-customize-report-data',$scope.filters).then(function(res){
                    $scope.Accounts =    res.data;
                });
            };
            $scope.gentaretPDF = function(){
                $http.get($scope.baseurl+'/gentaretPDF?datefrom='+$scope.filters.datefrom+'&dateto='+$scope.filters.dateto+'&reportId='+$scope.filters.reportId+'&fileName='+$scope.filters.fileName).then(function(res){
//                    $scope.Accounts =    res.data;
                });
            };
            $scope.calculateDEbitCredit = function(t,E){
                E.runningbalance = t.runningbalance += E.debit - E.credit;
            };
    });
</script>
@stop