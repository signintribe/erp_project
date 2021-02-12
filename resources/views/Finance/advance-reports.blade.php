@extends('layouts.admin.master')
@section('title', 'Income Statement')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="AdvanceReportApp" ng-controller="AdvanceReportController">
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
                    <div class="col-lg-4">
                        <select class="form-control" style="height: 45px;" ng-model="filters.reportType">
                            <option value="">Select Report</option>
                            <option value="Balance Sheet">Balance Sheet</option>
                            <option value="Cash Flow">Cash Flow</option>
                            <option value="Income Statement">Income Statement</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-md btn-info" ng-click="getData()"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col" align="right">

                    </div>
                </div>
            </div>
        </div><br/>
        <div class="card">
            <div class="card-body">
                <div class="row d-none d-print-block">
                    <div class="col">
                        <h3>Name of Company</h3>
                    </div>
                </div><br/>
                <h3 class="card-title">
                    STATEMENT OF <span style="text-transform: uppercase" ng-if="filters.reportType" ng-bind="filters.reportType"></span> <small>As on <span ng-bind="filters.datefrom"></span> - <span ng-bind="filters.dateto"></span></small>
                    <button class="btn btn-xs btn-secondary float-right" onclick="window.print();">Print</button>
                </h3><br/>
                <table class="table table-bordered" id="tblbalanceSheet">
                    <thead>
                        <tr>
                            <td colspan="3" align="right">
                                <button class="btn btn-xs btn-primary float-right" onclick="exportTableToExcel('tblbalanceSheet',{{Date('Ymdhms')}})">Export Excel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Particulars</td>
                            <td>Note</td>
                            <td>Projected (Rs)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3"><b>Current Asset</b></td>
                        </tr>
                        <tr ng-repeat="ca in Accounts.CurrentAsset">
                            <td ng-bind="ca.CategoryName"></td>
                            <td></td>
                            <td ng-bind="ca.Total"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Fixed Asset</b></td>
                        </tr>
                        <tr ng-repeat="fa in Accounts.FixedAsset">
                            <td ng-bind="fa.CategoryName"></td>
                            <td></td>
                            <td ng-bind="fa.Total"></td>
                        </tr>
                        <tr>
                            <th>Total Asset</th>
                            <th></th>
                            <th ng-if="TotalAsset" ng-bind="TotalAsset"></th>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Liabilities</b></td>
                        </tr>
                        <tr ng-repeat="cl in Accounts.CurrentLiablites">
                            <td ng-bind="cl.CategoryName"></td>
                            <td></td>
                            <td ng-bind="cl.Total"></td>
                        </tr>
                        <tr>
                            <th>Total Liabilities</th>
                            <th></th>
                            <th ng-if="liabilities" ng-bind="liabilities"></th>
                        </tr>
                        <tr>
                            <td ng-bind="Accounts.BbusinessCapital[0].CategoryName"></td>
                            <td></td>
                            <td ng-bind="Accounts.BbusinessCapital[0].Total"></td>
                        </tr>
                        <tr>
                            <th>Net Profit/Loss</th>
                            <td></td>
                            <th ng-bind="netProfitLoss"></th>
                        </tr>
                        <tr>
                            <th>Total Business Capital after Net Profit/Loss</th>
                            <td></td>
                            <th ng-bind="totalCapital"></th>
                        </tr>
                        <tr>
                            <th>Total Liability including Net Profit</th>
                            <td></td>
                            <th ng-bind="totalLiability"></th>
                        </tr>
                        <tr>
                            <th>Difference</th>
                            <td></td>
                            <th ng-bind="difference"></th>
                        </tr>
                    </tbody>
                </table>

                <table id="incomeStatement" class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="3" align="right">
                                <button class="btn btn-xs btn-primary float-right" onclick="exportTableToExcel('incomeStatement',{{Date('Ymdhms')}})">Export Excel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Particulars</td>
                            <td>Note</td>
                            <td>Projected (Rs)</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3"><b>Income</b></td>
                        </tr>
                        <tr ng-repeat="income in IncomeAccounts.income">
                            <td ng-bind="income.CategoryName"></td>
                            <td></td>
                            <td ng-bind="income.Total"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Cost of Sales</b></td>
                        </tr>
                        <tr ng-repeat="cos in IncomeAccounts.COS">
                            <td ng-bind="cos.CategoryName"></td>
                            <td></td>
                            <td ng-bind="cos.Total"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Expenses</b></td>
                        </tr>
                        <tr ng-repeat="expense in IncomeAccounts.FinancialExpenses">
                            <td ng-bind="expense.CategoryName"></td>
                            <td></td>
                            <td ng-bind="expense.Total"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><b>Operating Cost</b></td>
                        </tr>
                        <tr ng-repeat="oc in IncomeAccounts.operatingCost">
                            <td ng-bind="oc.CategoryName"></td>
                            <td></td>
                            <td ng-bind="oc.Total"></td>
                        </tr>
                        <tr>
                            <th>Gross Profit</th>
                            <td></td>
                            <th ng-bind="grossProfit"></th>
                        </tr>
                        <tr>
                            <th>Net Profit/Loss</th>
                            <td></td>
                            <th ng-bind="netProfitLoss"></th>
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
    </section>
    <!--</form>-->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('public/js/angular.min.js')}}" type="text/javascript">
</script>
<script>
    var AdvanceReport = angular.module('AdvanceReportApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    AdvanceReport.directive('datepicker', function () {
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
    AdvanceReport.controller('AdvanceReportController', function ($scope, $http, $filter) {
        $scope.filters = {};
        $scope.TotalIcome = 0;
        $scope.TotalCostOfSale = 0;
        $scope.TotalExpanse = 0;
        $scope.Accounts = [];
        $("#tblbalanceSheet").hide();
        $("#incomeStatement").hide();
        $scope.getData = function(){
            if($scope.filters.reportType == 'Balance Sheet'){
                $scope.TotalIcome = 0;
                $scope.TotalCostOfSale = 0;
                $scope.TotalExpanse = 0;
                $http.post('BalanceSheet-report', $scope.filters).then(function (res) {
                    $("#tblbalanceSheet").show();
                    $("#incomeStatement").hide();
                    $scope.Accounts = res.data;
                    $scope.currentAsset = 0;
                    for(var i = 0; i<$scope.Accounts.CurrentAsset.length; i++){
                        $scope.currentAsset = parseInt($scope.currentAsset) + parseInt($scope.Accounts.CurrentAsset[i].Total);
                    }
                    $scope.fixedAsset = 0;
                    for(var i = 0; i<$scope.Accounts.FixedAsset.length; i++){
                        $scope.fixedAsset = parseInt($scope.fixedAsset) + parseInt($scope.Accounts.FixedAsset[i].Total);
                    }
                    $scope.TotalAsset = $scope.currentAsset + $scope.fixedAsset;
                    $scope.liabilities = 0;
                    for(var i = 0; i<$scope.Accounts.CurrentLiablites.length; i++){
                        $scope.liabilities = parseInt($scope.liabilities) + parseInt($scope.Accounts.CurrentLiablites[i].Total);
                    }
                    
                    $scope.expense = 0;
                    for(var i = 0; i<$scope.Accounts.expance.length; i++){
                        $scope.expense = parseInt($scope.expense) + parseInt($scope.Accounts.expance[i].Total);
                    }
                    
                    $scope.income = 0;
                    for(var i = 0; i<$scope.Accounts.expance.length; i++){
                        $scope.expense = parseInt($scope.expense) + parseInt($scope.Accounts.expance[i].Total);
                    }
                    
                    $scope.totalIncome = 0;
                    for(var i = 0; i<$scope.Accounts.income.length; i++){
                        $scope.totalIncome = parseInt($scope.totalIncome) + parseInt($scope.Accounts.income[i].Total);
                    }
                    $scope.totalCos = 0;
                    for(var i = 0; i<$scope.Accounts.COS.length; i++){
                        $scope.totalCos = parseInt($scope.totalCos) + parseInt($scope.Accounts.COS[i].Total);
                    }
                    $scope.totalOc = 0;
                    for(var i = 0; i<$scope.Accounts.operatingCost.length; i++){
                        $scope.totalOc = parseInt($scope.totalOc) + parseInt($scope.Accounts.operatingCost[i].Total);
                    }
                    $scope.grossProfit = $scope.totalIncome - $scope.totalCos;
                    $scope.netProfitAndLoss = $scope.grossProfit - $scope.totalOc;
                    $scope.netProfitLoss = $scope.netProfitAndLoss;
                    $scope.NetIncome = parseInt(res.data.NetIncome);

                    $scope.totalExp = 0;
                    console.log($scope.Accounts.FinancialExpenses);
                    for(var i = 0; i<$scope.Accounts.FinancialExpenses.length; i++){
                        $scope.totalExp = parseInt($scope.totalExp) + parseInt($scope.Accounts.FinancialExpenses[i].Total);
                    }
                    
                    $scope.totalIncome = 0;
                    for(var i = 0; i<$scope.Accounts.income.length; i++){
                        $scope.totalIncome = parseInt($scope.totalIncome) + parseInt($scope.Accounts.income[i].Total);
                    }
                    $scope.totalCos = 0;
                    for(var i = 0; i<$scope.Accounts.COS.length; i++){
                        $scope.totalCos = parseInt($scope.totalCos) + parseInt($scope.Accounts.COS[i].Total);
                    }
                    $scope.totalOc = 0;
                    for(var i = 0; i<$scope.Accounts.operatingCost.length; i++){
                        $scope.totalOc = parseInt($scope.totalOc) + parseInt($scope.Accounts.operatingCost[i].Total);
                    }
                    $scope.grossProfit = $scope.totalIncome - $scope.totalCos;
                    $scope.netProfitLoss = $scope.grossProfit - $scope.totalOc - $scope.totalExp;
                    $scope.totalCapital = parseInt(res.data.BbusinessCapital[0].Total) + parseInt($scope.netProfitLoss);
                    $scope.totalLiability = $scope.liabilities + $scope.totalCapital;
                    $scope.difference = $scope.TotalAsset - $scope.totalLiability;
                });
            }else if($scope.filters.reportType == 'Income Statement'){
                $scope.TotalIcome =0;
                $scope.TotalCostOfSale =0;
                $scope.TotalExpanse =0;
                $http.post('incomeStatement-report',$scope.filters).then(function(res){
                    $("#tblbalanceSheet").hide();
                    $("#incomeStatement").show();
                    $scope.IncomeAccounts = res.data;
                    $scope.totalIncome = 0;
                    for(var i = 0; i<$scope.IncomeAccounts.income.length; i++){
                        $scope.totalIncome = parseInt($scope.totalIncome) + parseInt($scope.IncomeAccounts.income[i].Total);
                    }
                    $scope.totalCos = 0;
                    for(var i = 0; i<$scope.IncomeAccounts.COS.length; i++){
                        $scope.totalCos = parseInt($scope.totalCos) + parseInt($scope.IncomeAccounts.COS[i].Total);
                    }

                    $scope.totalOc = 0;
                    for(var i = 0; i<$scope.IncomeAccounts.operatingCost.length; i++){
                        $scope.totalOc = parseInt($scope.totalOc) + parseInt($scope.IncomeAccounts.operatingCost[i].Total);
                    }
                    $scope.totalExp = 0;
                    for(var i = 0; i<$scope.IncomeAccounts.FinancialExpenses.length; i++){
                        $scope.totalExp = parseInt($scope.totalExp) + parseInt($scope.IncomeAccounts.FinancialExpenses[i].Total);
                    }

                    $scope.grossProfit = $scope.totalIncome - $scope.totalCos - $scope.totalExp;
                    $scope.netProfitLoss = $scope.grossProfit - $scope.totalOc;
                });
            }
        };
    });
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        // Specify file name
        filename = tableID + filename + '.xls';
        // Create download link element
        downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
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