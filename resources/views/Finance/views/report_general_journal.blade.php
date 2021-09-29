@extends('layouts.admin.reportTier')
@section('title', 'Report General Journal')
@section('pagetitle', 'Report General Journal')
@section('breadcrumb', 'Report General Journal')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div ng-app="ReportGeneralJournalApp" ng-controller="ReportGeneralJournalController">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body pad">
                    <div class="col-lg-12">
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
                                <button class="btn btn-md btn-info" ng-click="getData()">Search</button>
                                <button class="btn btn-md btn-primary" onclick="exportTableToExcel('tblData',{{Date('Ymdhms')}})">Export Excel</button>
                                <button class="btn btn-md btn-secondary" onclick="window.print();">Print</button>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row d-none d-print-block">
                        <div class="col">
                            <h3>Name of Company</h3>
                        </div>
                    </div><br/>
                    <table class="table table-bordered" id="tblData">
                        <thead>
                            <tr>
                                <th>Date</th> 
                                <th>Account ID</th>
                                <th>Account Title</th>
                                <th>References</th>
                                <th>Trans Description</th>
                                <th>Debit Amt</th>
                                <th>Credit Amt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="E in Entris" ng-init="calculateDEbitCredit(E)">
                                <td ng-bind="E.date"></td>
                                <td ng-bind="E.AccountId"></td>
                                <td ng-bind="E.CategoryName"></td>
                                <td ng-bind="E.refrance"></td>
                                <td ng-bind="E.description"></td>
                                <td ng-bind="E.debit"></td>
                                <td ng-bind="E.credit"></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
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
    <!--</form>-->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('public/js/angular.min.js')}}" type="text/javascript">
</script>
<script>
    var GeneralReport = angular.module('ReportGeneralJournalApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    GeneralReport.controller('ReportGeneralJournalController', function ($scope, $http, $filter) {
        $("#banking-finance").addClass('menu-open');
        $("#financial-report").addClass('menu-open');
        $("#banking-open").addClass('active');
        $("#report-open").addClass('active');
        $("#general-journal").addClass('active');
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $scope.filters = {};
        $scope.TotalDebit = 0;
        $scope.TotalCredit = 0;
        $scope.Entris = [];
        $scope.getData = function(){
            $scope.filters.datefrom = $("#start_date input").val();
            $scope.filters.dateto = $("#end_date input").val();
            $scope.TotalDebit = 0;
            $scope.TotalCredit = 0;
            $scope.Entris = [];
            $http.post('getGeneral-journal-report', $scope.filters).then(function(res){
                $scope.Entris = res.data;
            });
        };
        $scope.calculateDEbitCredit = function(E){
            $scope.TotalCredit += E.credit?parseInt(E.credit):0;
            $scope.TotalDebit += E.debit?parseInt(E.debit):0;
        };
    });
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        // Specify file name
        filename = 'generalReport-' + filename + '.xls';
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