@extends('layouts.admin.master')
@section('title', 'Cash Flow')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="CashFlowApp" ng-controller="CashFlowController">
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
        <div class="card">
            <div class="card-body">
                <div class="row d-none d-print-block">
                    <div class="col">
                        <h3>Name of Company</h3>
                    </div>
                </div><br/>
                <h3 class="card-title">STATEMENT OF CASH FLOW <small>As on 30th June, 2020</small></h3>
                <table class="table table-bordered" id="tblcashFlow">
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
                        <th colspan="5">CASH FLOW OPERATING ACTIVITIES</th>
                    </tr>
                    <tr>
                        <td>Net Profit/(Loss) For The Year</td>
                        <td></td>
                        <td>55,559,707</td>
                        <td>49,525,430</td>
                        <td>40,923,465</td>
                    </tr>
                    <tr>
                        <td>Adjustments for Non Cash Items</td>
                        <td></td>
                        <td>358,042</td>
                        <td>397,825</td>
                        <td>442,027</td>
                    </tr>
                    <tr>
                        <th>Profit Before Working Capital Change</th>
                        <th></th>
                        <th>55,201,665</th>
                        <th>5,358,800</th>
                        <th>5,756,625</th>
                    </tr>
                    <tr>
                        <th colspan="5">Effect On Cash Flow Due To Working Capital Changes</th>
                    </tr>
                    <tr>
                        <td>Stocks, Store & Spares</td>
                        <td></td>
                        <td>358,042</td>
                        <td>397,825</td>
                        <td>442,027</td>
                    </tr>
                    <tr>
                        <td>Advances, deposits & prepayments</td>
                        <td></td>
                        <td>358,042</td>
                        <td>397,825</td>
                        <td>442,027</td>
                    </tr>
                    <tr>
                        <td>Accounts Receivables</td>
                        <td></td>
                        <td>358,042</td>
                        <td>397,825</td>
                        <td>442,027</td>
                    </tr>
                    <tr>
                        <td>Work in Process</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Accrued & other liabilities</td>
                        <td></td>
                        <td>358,042</td>
                        <td>397,825</td>
                        <td>442,027</td>
                    </tr>
                    <tr>
                        <td>Less Provision For Taxation</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>NET CASH FLOW FROM W.C. CHANGE</th>
                        <th></th>
                        <th>55,201,665</th>
                        <th>5,358,800</th>
                        <th>5,756,625</th>
                    </tr>
                    <tr>
                        <th>NET CASH FLOW FROM O.A.</th>
                        <th></th>
                        <th>55,201,665</th>
                        <th>5,358,800</th>
                        <th>5,756,625</th>
                    </tr>
                    <tr>
                        <th colspan="5">CASH FLOW INVESTING ACTIVITIES</th>
                    </tr>
                    <tr>
                        <td>Fixed Assets</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Securities/ Investments</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>NET CASH FLOW FROM I.A.</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                    </tr>
                    <tr>
                        <th>CASH FLOW FINANCING ACTIVITES</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                    </tr>
                    <tr>
                        <td>Receipt from Capital</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Less Drawing</td>
                        <td></td>
                        <td>116,924,429</td>
                        <td>114,631,793</td>
                        <td>108,965,583</td>
                    </tr>
                    <tr>
                        <td>Bank Borrowing</td>
                        <td></td>
                        <td>14,761,736</td>
                        <td>13,668,274</td>
                        <td>12,655,809</td>
                    </tr>
                    <tr>
                        <td>Lease Amount</td>
                        <td></td>
                        <td> 79,749,557 </td>
                        <td> 83,946,902 </td>
                        <td> 91,745,248 </td>
                    </tr>
                    <tr>
                        <td>Cash & Bank balances</td>
                        <td></td>
                        <td> 23,852,704 </td>
                        <td> 8,394,447 </td>
                        <td> 9,845,870 </td>
                    </tr>
                    <tr>
                        <th>NET CASH FLOW FROM F.A.</th>
                        <td></td>
                        <th> 235,288,426 </th>
                        <th> 220,641,416 </th>
                        <th> 223,212,510 </th>
                    </tr>
                    <tr>
                        <th>Net Cash/ Cash eq.Balance increase/decrease</th>
                        <td></td>
                        <th> 240,289,184 </th>
                        <th> 226,000,216 </th>
                        <th> 228,969,135 </th>
                    </tr>
                    <tr>
                        <td>Cash at the beginning of the period</td>
                        <td></td>
                        <td> 23,852,704 </td>
                        <td> 8,394,447 </td>
                        <td> 9,845,870 </td>
                    </tr>
                    <tr>
                        <th>Cash at the end of the period</th>
                        <td></td>
                        <th> 240,289,184 </th>
                        <th> 226,000,216 </th>
                        <th> 228,969,135 </th>
                    </tr>
                    <tr>
                        <th colspan="5">ANALYSIS</th>
                    </tr>
                    <tr>
                        <th>Operating Cash Flow Analysis:</th>
                        <td></td>
                        <th> 240,289,184 </th>
                        <th> 226,000,216 </th>
                        <th> 228,969,135 </th>
                    </tr>
                    <tr>
                        <td colspan="5">Net cash flow has beem generated due to increase(decrease) in current asstes.</td>
                    </tr>
                    <tr>
                        <th>Investing Cash Flow Analysis:</th>
                        <td></td>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                    </tr>
                    <tr>
                        <td colspan="5">Investing Cash flo has been increased (decrease) due to appreciation (depreciation) in value of fixed assets.</td>
                    </tr>
                    <tr>
                        <th>Financing Cash Flow Analysis:</th>
                        <td></td>
                        <th> 240,289,184 </th>
                        <th> 226,000,216 </th>
                        <th> 228,969,135 </th>
                    </tr>
                    <tr>
                        <td colspan="5">Financing Cash Flow has been generated</td>
                    </tr>
                    <tr>
                        <th>Total Cash Flow shows positive (Negative) growth in business.</th>
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
    var CashFlow = angular.module('CashFlowApp', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    CashFlow.directive('datepicker', function () {
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
    CashFlow.controller('CashFlowController', function ($scope, $http, $filter) {

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
    //triggering CashFlow
    downloadLink.click();
    }
    }
</script>
@endsection