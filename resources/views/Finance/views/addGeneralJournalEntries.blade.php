@extends('layouts.admin.master')
@section('title', 'General Journal Entry')
<link rel="stylesheet" href="{{asset('theme/plugins/datepicker/datepicker3.css')}}">
<style>
    .hover-li:hover{
        cursor: pointer;
        background-color: #ccc;
    }
</style>
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="MyApp" ng-controller="CategoryController" ng-init="resetscope()">
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                       <!--  <button class="btn btn-info btn-xs" ng-click="(Entries.Data.push({}))"><i class="fa fa-plus"></i> Add Other</button><br/><br/> -->
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" datepicker placeholder="To Date" ng-model="Entries.date"/>
                                    </div>
                                </div>
                            </div>
                        </div><br/>
                        <table class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>GL Account</th>
                                    <th> Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <!-- <th>Charge To</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="Entry in Entries.Data">
                                    <td>
                                        <div class="btn-group dropdown form-group" role="group" style="width:100%;" ng-init="(Entry.CategoryName = 'Select Account')">
                                            <button type="button" class="btn filter-button" id="drop-box"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 33px;width: 100%;">
                                                <span class="filter-button-text" style="font-size: 12px;" ng-bind="Entry.CategoryName"></span>
                                                <span style="float: right;margin: 10px;" class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="drop-box" style="width:100%;">
                                                <input type="search" class="form-control input-sm" ng-model="filtername" placeholder="Account Name">
                                                <li style="line-height: 20px; padding: 6px; font-size: 12px; border-bottom: solid 1px #ccc;" ng-click="(Entry.CategoryName = 'Select Account');(Entry.account_Id = '')"> <a role="button">Select Account</a></li>     
                                                <li class="hover-li" style="padding: 6px; font-size: 12px; border-bottom: solid 1px #ccc;" ng-repeat="o in Accounts| filter : {CategoryName:filtername}" ng-click="(Entry.CategoryName = o.CategoryName);(Entry.account_Id = o.id)"><a role="button" ng-bind="o.CategoryName + '=>' + o.ParentCategory "></a></li>     
                                            </ul>
                                        </div>
                                    </td>
                                    <td><input type="text" class="form-control" ng-model="Entry.description"/></td>
                                    <td><input type="number" class="form-control" ng-change="totatl()" ng-model="Entry.debit"/></td>
                                    <td><input type="number" class="form-control" ng-change="totatl()" ng-model="Entry.credit"/></td>
                                    <!-- <td><select class="form-control" ng-options="x.id as x.type_name for x in Types" ng-model="Entry.user_type_id"></select></td> -->
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right">Totals</td>
                                    <td class="text-right" ng-bind="TotalDebit"></td>
                                    <td class="text-right" ng-bind="TotalCredit"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="2">Out Of Balance</td>
                                    <td class="text-right" ng-bind="((TotalDebit) - (TotalCredit))"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5"><button class="btn btn-success btn-md" ng-click="SaveEntries()" ng-if="(Entries.date) && (TotalCredit) && (TotalDebit) && !((TotalDebit) - (TotalCredit))"><i class="fa fa-save"></i> Save</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('public/js/angular.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.6.2/angular-sanitize.min.js">
</script>
<script src="{{ asset('theme/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script>
    var Finance = angular.module('MyApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Finance.directive('datepicker', function () {
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
    Finance.controller('CategoryController', function ($scope, $http, $compile, $filter) {
        $scope.CategoryName = "";
        $scope.resetscope = function () {
            $scope.Accounts = [];
            $scope.Types = [];
            $scope.Entries = {};
            $scope.Entries.Data = [{}, {}];
            $scope.getAccounts();
        };
        $scope.getAccounts = function () {
            var Accounts = $http.get('AllchartofAccount');
            Accounts.then(function (r) {
                $scope.Accounts = r.data;
            });
        };

        $http.get('user-types').then(function (res) {
            $scope.Types = res.data;
        });
        $scope.totatl = function () {
            $scope.TotalDebit = 0;
            $scope.TotalCredit = 0;
            angular.forEach($scope.Entries.Data, function (v, k) {
                if (v.debit) {
                    $scope.TotalDebit += v.debit;
                }
                if (v.credit) {
                    $scope.TotalCredit += v.credit;
                }
            });

        };

        $scope.settype = function (Entry, a) {
            console.log(Entry, a);
            Entry.account_type_id = a.parent;
            Entry.account_Id = a.id;
        };

        $scope.SaveEntries = function () {
            $http.post('Save-General-Entries', $scope.Entries).then(function (res) {
                $scope.Entries = {};
                $scope.Entries.Data = [{}, {}, {}, {}, {}];
            });
        };

    });
</script>
@endsection