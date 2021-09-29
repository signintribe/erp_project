@extends('layouts.admin.reportTier')
@section('title', 'Report Chart of Account')
@section('pagetitle', 'Report Chart of Account')
@section('breadcrumb', 'Report Chart of Account')
@section('content')
<link rel="stylesheet" href="{{asset('theme/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- Content Wrapper. Contains page content -->
<div ng-app="ReportChartAccountApp" ng-controller="ReportChartAccountController">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row d-print-none">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="input-group date" id="start_date" data-target-input="nearest">
                                    <input type="text" placeholder="Start Date" ng-model="filters.datefrom" class="form-control datetimepicker-input" data-target="#start_date"/>
                                    <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="input-group date" id="end_date" data-target-input="nearest">
                                    <input type="text" placeholder="End Date" ng-model="filters.dateto" class="form-control datetimepicker-input" data-target="#end_date"/>
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
                                    <th>Account ID</th> 
                                    <th>Account Name</th>
                                    <th>Account Description</th>
                                    <th>Active</th>
                                    <th>Account Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($Accounts as $a)
                                <tr>
                                    <td>{{$a->AccountId}}</td>
                                    <td>{{$a->AccountName}}</td>
                                    <td>{{$a->AccountDescription}}</td>
                                    <td>{{$a->status}}</td>
                                    <td>{{$a->acount_type}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><br/>
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
<script src="{{ asset('public/js/angular.min.js')}}" type="text/javascript"></script>
<script>
    var FinanceReport = angular.module('ReportChartAccountApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    
    FinanceReport.controller('ReportChartAccountController', function ($scope, $http, $filter) {
        $("#banking-finance").addClass('menu-open');
        $("#financial-report").addClass('menu-open');
        $("#banking-open").addClass('active');
        $("#report-open").addClass('active');
        $("#chart-account").addClass('active');

        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
       $scope.PrintRecord = function() {  
          printData();  
      } 
    });
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        // Specify file name
        filename = 'chart_of_account-' + filename + '.xls';
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
  
    function printData() {  
        var divToPrint = document.getElementById("tablerecords");  
        newWin = window.open("");  
        newWin.document.write(divToPrint.outerHTML);  
        newWin.print();  
        newWin.close();  
    } 
</script>
@endsection