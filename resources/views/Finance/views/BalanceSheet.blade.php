@extends('layouts.admin.master')
@section('title', 'Balance Sheet')
@section('content')
<link rel="stylesheet" href="{{asset('theme/plugins/datepicker/datepicker3.css')}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="BalanceSheetApp" ng-controller="BalanceSheetController">
    <section class="content">
        <div class="card d-print-none">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <input type="text" class="form-control" datepicker placeholder="Date From" ng-model="filters.datefrom"/>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" datepicker placeholder="Date To" ng-model="filters.dateto"/>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-md btn-info" ng-click="getData()"><i class="fa fa-search"></i> Search</button>
                        <button class="btn btn-md btn-primary" onclick="exportTableToExcel('tblcashFlow',{{Date('Ymdhms')}})">Export Excel</button>
                        <button class="btn btn-md btn-secondary" onclick="window.print();">Print</button>
                    </div>
                </div>
            </div>
        </div><br/>
    </section>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Balance Sheet</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td class="text-center">
                                <h4>Assets</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Current Assets</h5>
                                <ul>
                                    <li ng-repeat="Account in Accounts.CurrentAsset" ng-init="calculateDEbitCredit(Account.Total, 'CurrentAsset')">
                                        <label ng-bind="Account.CategoryName"></label> <label class="pull-right" ng-bind="Account.Total"></label>
                                    </li>
                                    <hr>
                                    <li>
                                        <label>Total Current Assets</label> <label class="pull-right" ng-bind="CurrentAsset"></label>
                                    </li>
                                </ul>
                                <h5>Fixed Assets</h5> 
                                <ul>
                                    <li ng-repeat="Account in Accounts.FixedAsset" ng-init="calculateDEbitCredit(Account.Total, 'FixedAsset')">
                                        <label  ng-bind="Account.CategoryName"></label> <label class="pull-right" ng-bind="Account.Total"></label>
                                    </li>
                                    <hr>
                                    <li>
                                        <label>Total Fixed Assets</label> <label class="pull-right" ng-bind="FixedAsset"></label>
                                    </li>
                                </ul>
                                <h5>Other Assets</h5> 
                                <ul>
                                    <li ng-repeat="Account in Accounts.OtherAsset" ng-init="calculateDEbitCredit(Account.Total, 'OtherAsset')">
                                        <label  ng-bind="Account.CategoryName"></label> <label  class="pull-right" ng-bind="Account.Total"></label>
                                    </li>
                                    <hr>
                                    <li>
                                        <label>Other Assets</label> <label class="pull-right" ng-bind="OtherAsset"></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Total Assets</label> <label class="pull-right" ng-bind="(CurrentAsset + FixedAsset + OtherAsset)"></label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <h4>Libilites</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Current Liablites</h5> 
                                <ul>
                                    <li ng-repeat="Account in Accounts.CurrentLiablites" ng-init="calculateDEbitCredit(Account.Total, 'CurrentLiablites')">
                                        <label  ng-bind="Account.CategoryName"></label> <label  class="pull-right" ng-bind="Account.Total"></label>
                                    </li>
                                    <hr>
                                    <li>
                                        <label>Total Current Liablites</label> <label class="pull-right" ng-bind="CurrentLiablites"></label>
                                    </li>
                                </ul>
                                <h5>Long Term Liablites</h5> 
                                <ul>
                                    <li ng-repeat="Account in Accounts.LongtermLiablites" ng-init="calculateDEbitCredit(Account.Total, 'LongtermLiablites')">
                                        <label  ng-bind="Account.CategoryName"></label> <label  class="pull-right" ng-bind="Account.Total"></label>
                                    </li>
                                    <hr>
                                    <li>
                                        <label>Total Long Term Liablites</label> <label class="pull-right" ng-bind="LongtermLiablites"></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Total Liablites</label> <label class="pull-right" ng-bind="(CurrentLiablites + LongtermLiablites)"></label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <h4>Equity</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Equity</h5> 
                                <ul>
                                    <li ng-repeat="Account in Accounts.Equity" ng-init="(Account.Total = (Account.Total) * ( - 1)); calculateDEbitCredit(Account.Total, 'Equity')">
                                        <label  ng-bind="Account.CategoryName"></label> <label  class="pull-right" ng-bind="Account.Total"></label>
                                    </li>
                                    <hr>
                                    <li>
                                        <label>Net Income</label> <label class="pull-right" ng-bind=" (Accounts.NetIncome)"></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Total Equity</label> <label class="pull-right" ng-bind="(Equity + Accounts.NetIncome)"></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Total Liablites And Capital</label> <label class="pull-right" ng-bind="(Equity + Accounts.NetIncome) + (CurrentLiablites + LongtermLiablites)"></label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--</form>-->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="{{ asset('public/js/angular.min.js')}}" type="text/javascript">
</script>
<script>

    //Angular Part
    var BalanceSheetApp = angular.module('BalanceSheetApp', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    BalanceSheetApp.directive('datepicker', function () {
    return {
    restrict: 'A',
            require: 'ngModel',
            compile: function () {
            return {
            pre: function (scope, element, attrs, ngModelCtrl) {
            var format, dateObj;
            format = (!attrs.dpFormat) ? 'yyyy-mm-dd' : attrs.dpFormat;
            if (!attrs.initDate && !attrs.dpFormat) {
            // If there is no initDate attribute than we will get todays date as the default
            dateObj = new Date();
//                            scope[attrs.ngModel] = dateObj.getFullYear() + '-' + (dateObj.getMonth() + 1) + '-' + dateObj.getDate();
            } else if (!attrs.initDate) {
            // Otherwise set as the init date
            scope[attrs.ngModel] = attrs.initDate;
            } else {
            // I could put some complex logic that changes the order of the date string I
            // create from the dateObj based on the format, but I'll leave that for now
            // Or I could switch case and limit the types of formats...
            }
            // Initialize the date-picker
            $(element).datepicker({
            format: format
            }).on('changeDate', function (ev) {
            // To me this looks cleaner than adding $apply(); after everything.
            scope.$apply(function () {
            ngModelCtrl.$setViewValue(ev.format(format));
            });
            });
            }
            };
            }
    };
    });
    
    
    BalanceSheetApp.controller('BalanceSheetController', function ($scope, $http, $filter) {
    $scope.filters = {};
    $scope.TotalIcome = 0;
    $scope.TotalCostOfSale = 0;
    $scope.TotalExpanse = 0;
    $scope.Accounts = [];
    $scope.getData = function () {
    $scope.TotalIcome = 0;
    $scope.TotalCostOfSale = 0;
    $scope.TotalExpanse = 0;
    $http.post('BalanceSheet-report', $scope.filters).then(function (res) {
    $scope.Accounts = res.data;
    $scope.Accounts.NetIncome = parseInt(res.data.NetIncome);
    });
    };
    $scope.calculateDEbitCredit = function (E, T) {
    $scope[T] = $scope[T] ? $scope[T] : 0;
    $scope[T] += parseInt(E);
    };
    });
</script>
@endsection