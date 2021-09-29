@extends('layouts.admin.reportTier')
@section('title', 'Report General Ledger')
@section('pagetitle', 'Report General Ledger')
@section('breadcrumb', 'Report General Ledger')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div ng-app="ReportGeneralJournalApp" ng-controller="ReportGeneralJournalController">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row d-print-none">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="input-group date" id="start_date" data-target-input="nearest">
                                    <input type="text" placeholder="Start Date" class="form-control datetimepicker-input" data-target="#start_date"/>
                                    <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="input-group date" id="end_date" data-target-input="nearest">
                                    <input type="text" placeholder="End Date" class="form-control datetimepicker-input" data-target="#end_date"/>
                                    <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
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
                                <tr ng-repeat="Account in Accounts" ng-init="calculateDEbitCredit(E)">
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
                                    <td ng-bind="(Account.debitTotal - Account.CreditTotal)"></td>
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
    <!--</form>-->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('public/js/angular.min.js')}}" type="text/javascript">
</script>
<script>
    var LedgerReport = angular.module('ReportGeneralJournalApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    LedgerReport.controller('ReportGeneralJournalController', function ($scope, $http, $filter) {
        $("#banking-finance").addClass('menu-open');
        $("#financial-report").addClass('menu-open');
        $("#banking-open").addClass('active');
        $("#report-open").addClass('active');
        $("#general-ledger").addClass('active');
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $scope.filters = {};
        $scope.TotalDebit = 0;
        $scope.TotalCredit = 0;
        $scope.Accounts = [];
        $scope.getData = function () {
            $scope.filters.datefrom = $("#start_date input").val();
            $scope.filters.dateto = $("#end_date input").val();
            $http.post('get-General-ledger-report', $scope.filters).then(function (res) {
                $scope.Accounts = res.data;
            });
        };
        
        $scope.calculateDEbitCredit = function (E) {
            //$scope.TotalCredit += E.credit?parseInt(E.credit):0;
            //$scope.TotalDebit += E.debit?parseInt(E.debit):0;
        };
    });
    
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        // Specify file name
        filename = 'general_ledger-' + filename + '.xls';
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