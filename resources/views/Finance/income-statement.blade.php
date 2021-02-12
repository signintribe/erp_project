@extends('layouts.admin.master')
@section('title', 'Income Statement')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="IncomeStatementApp" ng-controller="IncomeStatementController">
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
                <h3 class="card-title">STATEMENT OF COMPREHENSIVE INCOME <small>As on 30th June, 2020</small></h3>
                <table class="table table-bordered" id="tblincomeStatement">
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
                        <td>Revenue</td>
                        <td></td>
                        <td>423,985,763</td>
                        <td>409,648,080</td>
                        <td>345,694,582</td>
                    </tr>
                    <tr>
                        <td>Less:  Cost Of Revenue</td>
                        <td></td>
                        <td>325,833,059</td>
                        <td>314,814,550</td>
                        <td>265,666,286</td>
                    </tr>
                    <tr>
                        <th>Gross Profit</th>
                        <th></th>
                        <th>98,152,704</th>
                        <th>94,833,530</th>
                        <th>80,028,296</th>
                    </tr>
                    <tr>
                        <th colspan="5">Operating Expenses</th>
                    </tr>
                    <tr>
                        <td>Operating Expenses</td>
                        <td>4</td>
                        <th>(30,360,196)</th>
                        <th>(27,922,738)</th>
                        <th>(25,694,241)</th>
                    </tr>
                    <tr>
                        <th>Operating Profit/ Loss</th>
                        <td></td>
                        <th>67,792,508</th>
                        <th>66,910,792</th>
                        <th>54,334,055</th>
                    </tr>
                    <tr>
                        <td>Financial Expenses</td>
                        <td></td>
                        <td> (1,650,000)</td>
                        <td> 7,951,947 </td>
                        <td> 6,188,802 </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <th> 66,142,508 </th>
                        <th> 74,862,739 </th>
                        <th> 60,522,857 </th>
                    </tr>
                    <tr>
                        <td>Other Income</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <th> 66,142,508 </th>
                        <th> 74,862,739 </th>
                        <th> 60,522,857 </th>
                    </tr>
                    <tr>
                        <td>Less Provision For Taxation</td>
                        <td></td>
                        <td> (10,582,801)</td>
                        <td> (9,433,415)</td>
                        <td> (7,221,788)</td>
                    </tr>
                    <tr>
                        <th>NET PROFIT/ (LOSS)</th>
                        <td></td>
                        <th> 55,559,707 </th>
                        <th> 65,429,324 </th>
                        <th> 53,301,069 </th>
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
    var IncomeStatement = angular.module('IncomeStatementApp', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    });
    IncomeStatement.directive('datepicker', function () {
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
    IncomeStatement.controller('IncomeStatementController', function ($scope, $http, $filter) {

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