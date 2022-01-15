@extends('layouts.admin.creationTier')
@section('title', 'Pay & Emoluments')
@section('pagetitle', 'Pay & Emoluments')
@section('breadcrumb', 'Pay & Emoluments')
@section('content')
<div  ng-app="EmolumentsApp" ng-controller="EmolumentsController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="Pay & Emoluments"></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <label for="select_employee">* Select Employee</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="emoluments.employee_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!emoluments.employee_id && showError"><small>Please Select Employee</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="basic_pay">* Basic Pay</label>
                    <input type="text" class="form-control" id="basic_pay" ng-model="emoluments.basic_pay" placeholder="Basic Pay"/>
                    <i class="text-danger" ng-show="!emoluments.basic_pay && showError"><small>Please Type Basic Pay</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="medical_allowance">Medical Allowance</label>
                    <input type="text" class="form-control" id="medical_allowance" ng-model="emoluments.medical_allowance" placeholder="Medical Allowance"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="conveyance_allowance">Conveyance Allowance</label>
                    <input type="text" class="form-control" id="conveyance_allowance" ng-model="emoluments.conveyance_allowance" placeholder="Conveyance Allowance"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/organizational-assignment')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_payEmolument()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/employee-bank-detail')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Pay and Emoluments</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Basic Pay</th>
                        <th>Conveyance Allowance</th>
                        <th>Medical Allowance</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getPayEmoluments();">
                    <tr ng-repeat="pay in payEmoluments">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="pay.employee_name"></td>
                        <td ng-bind="pay.basic_pay"></td>
                        <td ng-bind="pay.conveyance_allowance"></td>
                        <td ng-bind="pay.medical_allowance"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editPay(pay.id);">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deletePay(pay.id);">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p ng-if='norecord' ng-bind='norecord'></p>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Emoluments = angular.module('EmolumentsApp', []);
    Emoluments.controller('EmolumentsController', function ($scope, $http) {
        $("#employee").addClass('menu-open');
        $("#employee a[href='#']").addClass('active');
        $("#pay-emoluments").addClass('active');
        $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };

        $scope.getPayEmoluments = function () {
            $scope.payEmoluments = {};
            $http.get('maintain-pay-emoluments').then(function (response) {
                if (response.data.length > 0) {
                    $scope.payEmoluments = response.data;
                    $scope.norecord = "";
                }else{
                    $scope.norecord = "There is no record found";
                }
            });
        };

        $scope.editPay = function (id) {
            $http.get('maintain-pay-emoluments/'+id+'/edit').then(function (response) {
                $scope.emoluments = response.data;
                $scope.emoluments.employee_id = parseInt($scope.emoluments.employee_id);
            });
        };

        $scope.deletePay = function (id) {
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('maintain-pay-emoluments/' + id).then(function (response) {
                    $scope.getPayEmoluments();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

        $scope.emoluments = {};
        $scope.save_payEmolument = function(){
            if (!$scope.emoluments.employee_id || !$scope.emoluments.basic_pay) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
                var Data = new FormData();
                angular.forEach($scope.emoluments, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-pay-emoluments', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.emoluments = {};
                   $scope.getPayEmoluments();
                   $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                });
            }
        };
    });
</script>
@endsection