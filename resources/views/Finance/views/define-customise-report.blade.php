@extends('layouts.penals.master')
@section('title', 'Report General Journal Entry')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="DefineReportApp" ng-controller="DefineReportController" ng-init="getAccounts();getAllReports()">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Report</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <label>Report Name</label>
                    <input class="form-control" ng-model="Report.title"type="text" name="name" placeholder="Report Name"/><br/>
                    <label>Account Name</label>
                    <button class="btn btn-success btn-sm pull-right" ng-click="(AccountList.push({CategoryName:'Select Account'}))"><i class="fa fa-plus"></i></button><br/>
                    <div class="btn-group dropdown form-group" role="group" style="width:100%;" ng-repeat="list in AccountList">
                        <button type="button" class="btn filter-button" id="drop-box"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 33px;width: 100%;">
                            <span class="filter-button-text" style="font-size: 12px;" ng-bind="list.CategoryName"></span>
                            <span style="float: right;margin: 10px;" class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="drop-box" style="width:100%;">
                            <input type="search" class="form-control input-sm" ng-model="filtername" placeholder="Account Name">
                            <li ng-click="(list.CategoryName = 'Select Account');selectAccount({id:''},$index)"> <a role="button">Select Account</a></li>     
                            <li ng-repeat="o in Accounts| filter : {CategoryName:filtername}" ng-click="(list.CategoryName = o.CategoryName);selectAccount(o,$index)"><a role="button" ng-bind="o.CategoryName"></a></li>     
                        </ul>
                    </div>
                    <label>Description</label>
                    <textarea class="form-control" ng-model="Report.description" placeholder="Description"></textarea><br/>
                    <button class="btn btn-md btn-success" ng-click="saveReport()">Save</button>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">View Reports</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <th>Sr.No</th>
                            <th>Report Name</th>
                            <th>Edit</th>
                        </tr>
                        <tr ng-repeat="p in Reports">
                            <td ng-bind="$index + 1"></td>
                            <td ng-bind="p.title"></td>
                            <td>
                                <button ng-click="deleteAccount(p.id,$index)" class="btn btn-danger btn-md"><i class="fa fa-trash"></i> Delete</button>
                                <a href="genrate-report/<%p.id%>" class="btn btn-info btn-md"><i class="fa fa-book"></i> View Report</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection
@section('angularjs')
<script src="{{ asset('js/angular/angular.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#DashboardMenu").removeClass("active"); //this will remove the active class from  
        $('#CustomizeReport').addClass('active');
        $('#Define-Report').addClass('active');
    });


    //Angular Part

    angular.module('DefineReportApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    }).controller('DefineReportController', function ($scope, $http, $filter) {
        $scope.Report = {};
        $scope.Report.accounts = [];
        $scope.Reports = [];
        $scope.AccountList = [{CategoryName:'Select Account'}];
        $scope.Accounts = [];
        
        $scope.saveReport = function () {
            console.log($scope.Report.accounts.length);
            if($scope.Report.accounts.length > 0){
            $http.post('save-custom-report', $scope.Report).then(function (res) {
                $scope.Reports.push(res.data);
            });
            }else{
                alert('Select an account for save the account Defination');
            }
        };

        $scope.getAccounts = function () {
            var Accounts = $http.get('AllchartofAccount');
            Accounts.then(function (r) {
                $scope.Accounts = r.data;
            });
        };

        $scope.getAllReports = function () {
            var Accounts = $http.get('All-customize-Reports');
            Accounts.then(function (r) {
                $scope.Reports = r.data;
            });
        };

        $scope.selectAccount = function (o,i) {
            if(o.id){
                $scope.Report.accounts.push(o.id);
            }else{
                $scope.Report.accounts.splice(i,1);
                $scope.AccountList.splice(i,1);
            }
        };

        $scope.deleteAccount = function (o,i) {
            if(confirm('Are you sure to delete this Account')){
            $http.get('delete-Account/'+o).then(function(res){
                $scope.Reports.splice(i,1);
            });
        }
        };

    });
</script>
@stop