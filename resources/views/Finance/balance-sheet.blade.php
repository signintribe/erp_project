@extends('layouts.admin.master')
@section('title', 'Balance Sheet')
@section('content')
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
                        <button class="btn btn-md btn-primary" onclick="exportTableToExcel('tblbalanceSheet',{{Date('Ymdhms')}})">Export Excel</button>
                        <button class="btn btn-md btn-secondary" onclick="window.print();">Print</button>
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
                <h3 class="card-title">STATEMENT OF FINANCIAL POSITION <small>As on 30th June, 2020</small></h3>
                <table class="table table-bordered" id="tblbalanceSheet">
                    <tr>
                        <td rowspan="3">Particulars</td>
                        <td rowspan="3">Note</td>
                        <td>Projected</td>
                        <td rowspan="2">2020</td>
                        <td rowspan="2">2019</td>
                    </tr>
                    <tr>
                        <td>2021</td>
                    </tr>
                    <tr>
                        <td>(Rs)</td>
                        <td>(Rs)</td>
                        <td>(Rs)</td>
                    </tr>
                    <tr>
                        <th colspan="5">Fixed Asset</th>
                    </tr>
                    <tr>
                        <td rowspan="2">Property Plant & Equipment</td>
                        <td rowspan="2">3</td>
                        <td>5,000,758</td>
                        <td>5,358,800</td>
                        <td>5,756,625</td>
                    </tr>
                    <tr>
                        <th>5,000,758</th>
                        <th>5,358,800</th>
                        <th>5,756,625</th>
                    </tr>
                    <tr>
                        <th colspan="5">Long term investment</th>
                    </tr>
                    <tr>
                        <td>Investment</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th colspan="5">Current Asset</th>
                    </tr>
                    <tr>
                        <td>Stocks, Store & Spares</td>
                        <td>5</td>
                        <td>116,924,429</td>
                        <td>114,631,793</td>
                        <td>108,965,583</td>
                    </tr>
                    <tr>
                        <td>Advances, Deposits & Prepayments</td>
                        <td></td>
                        <td>14,761,736</td>
                        <td>13,668,274</td>
                        <td>12,655,809</td>
                    </tr>
                    <tr>
                        <td>Accounts Receivables</td>
                        <td>6</td>
                        <td> 79,749,557 </td>
                        <td> 83,946,902 </td>
                        <td> 91,745,248 </td>
                    </tr>
                    <tr>
                        <td>Cash & Bank balances</td>
                        <td>7</td>
                        <td> 23,852,704 </td>
                        <td> 8,394,447 </td>
                        <td> 9,845,870 </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <th> 235,288,426 </th>
                        <th> 220,641,416 </th>
                        <th> 223,212,510 </th>
                    </tr>
                    <tr>
                        <th>TOTAL ASSETS</th>
                        <td></td>
                        <th> 240,289,184 </th>
                        <th> 226,000,216 </th>
                        <th> 228,969,135 </th>
                    </tr>
                    <tr>
                        <th colspan="5">NON Current Liabilities</th>
                    </tr>
                    <tr>
                        <td>Lease Financing</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th colspan="5">Current Liabilities</th>
                    </tr>
                    <tr>
                        <td>Running Financing</td>
                        <td></td>
                        <td> 15,000,000 </td>
                        <td> 9,091,570 </td>
                        <td> 33,989,654 </td>
                    </tr>
                    <tr>
                        <td>Short Term Borrowing</td>
                        <td></td>
                        <td> 4,742,110 </td>
                        <td> 9,484,220 </td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Accounts Payable</td>
                        <td>8</td>
                        <td> 2,958,500 </td>
                        <td> 2,665,315 </td>
                        <td> 2,399,023 </td>
                    </tr>
                    <tr>
                        <td>Accrued & Other Liabilities</td>
                        <td>9</td>
                        <td> 11,849,266 </td>
                        <td> 10,687,341 </td>
                        <td> 8,463,299 </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <th> 34,549,876 </th>
                        <th> 31,928,446 </th>
                        <th> 44,851,976 </th>
                    </tr>
                    <tr>
                        <th colspan="5">Capital</th>
                    </tr>
                    <tr>
                        <td>Business Capital</td>
                        <td>11</td>
                        <th> 205,739,308 </th>
                        <th> 194,071,770 </th>
                        <th> 184,117,159 </th>
                    </tr>
                    <tr>
                        <th>Capital and Liabilities</th>
                        <td></td>
                        <th> 240,289,184 </th>
                        <th> 226,000,216 </th>
                        <th> 228,969,135 </th>
                    </tr>
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
    var BalanceSheet = angular.module('BalanceSheetApp', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    BalanceSheet.directive('datepicker', function () {
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
    BalanceSheet.controller('BalanceSheetController', function ($scope, $http, $filter) {

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