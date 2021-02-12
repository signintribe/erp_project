@extends('layouts.admin.master')
@section('title', 'Report General Journal Entry')
@section('content')
<link rel="stylesheet" href="{{asset('theme/plugins/datepicker/datepicker3.css')}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="ReportGeneralJournalApp" ng-controller="ReportGeneralJournalController">
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-print-none">
                            <div class="col-lg-3">
                                <input type="text" class="form-control" datepicker placeholder="Date From" ng-model="filters.datefrom"/>
                            </div>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" datepicker placeholder="Date To" ng-model="filters.dateto"/>
                            </div>
                            <div class="col-lg-6">
                                <button class="btn btn-md btn-info" ng-click="getData()"><i class="fa fa-search"></i> Search</button>
                                <button class="btn btn-md btn-primary" onclick="exportTableToExcel('tblData',{{Date('Ymdhms')}})">Export Excel</button>
                                <button class="btn btn-md btn-secondary" onclick="window.print();">Print</button>
                            </div>
                        </div><br/>
                        <div class="row d-none d-print-block">
                            <div class="col">
                                <h3>Name of Company</h3>
                            </div>
                        </div><br/>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tblData">
                                <thead>
                                    <tr>
                                        <th>Account Id</th>
                                        <th>Name of Account</th>
                                        <th>Debit Amt</th>
                                        <th>Credit Amt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="Account in Accounts" ng-init="calculateDEbitCredit(Account)">
                                        <td ng-bind="Account.AccountId"></td>
                                        <td ng-bind="Account.CategoryName"></td>
                                        <td><p ng-if="Account.Total > 0" ng-bind="Account.Total"></p></td>
                                        <td><p ng-if="Account.Total < 0" ng-bind="(Account.Total * -1)"></p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td ng-bind="TotalDebit"></td>
                                        <td ng-bind="TotalCredit"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br/>
                            <div align="center" class="d-none d-print-block">
                                <strong>Address : </strong> | 
                                <strong>Phone Number : </strong> | 
                                <strong>Email Address : </strong> | 
                                <strong>Website : </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--</form>-->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('public/js/angular.min.js')}}" type="text/javascript">
</script>
<script>
    var TrialBalanceReport = angular.module('ReportGeneralJournalApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    TrialBalanceReport.directive('datepicker', function () {
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

    TrialBalanceReport.controller('ReportGeneralJournalController', function ($scope, $http, $filter) {
        $scope.filters = {};
        $scope.TotalDebit = 0;
        $scope.TotalCredit = 0;
        $scope.Accounts = [];
        $scope.getData = function () {
            $scope.TotalDebit = 0;
            $scope.TotalCredit = 0;
            $scope.Accounts = [];
            $http.post('TrialBalance-report', $scope.filters).then(function (res) {
                $scope.Accounts = res.data;
            });
        };
        $scope.calculateDEbitCredit = function (E) {
            $scope.TotalCredit += E.Total < 0 ? ((E.Total) * (-1)) : 0;
            $scope.TotalDebit += E.Total > 0 ? parseInt(E.Total) : 0;
        }
    });
    
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        // Specify file name
        filename = 'trial_balance-' + filename + '.xls';
        // Create download link element
        downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        if (navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            // Setting the file name
            downloadLink.download = filename;
            //triggering the function
            downloadLink.click();
        }
    }
</script>
@endsection