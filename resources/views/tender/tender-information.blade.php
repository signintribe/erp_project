@extends('layouts.admin.creationTier')
@section('title', 'Tender Information')
@section('pagetitle', 'Tender Information')
@section('breadcrumb', 'Tender Information')
@section('content')
<link rel="stylesheet" href="{{ asset('public/dashboard/vendors/icheck/skins/all.css')}}">
<div class="row" ng-app="TenderApp" ng-controller="TenderController">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Tender Information</h3>
            </div>
            <div class="card-body" ng-init="resetScope()">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-no">Tender No</label>
                        <input type="text" class="form-control" id="tender-no" placeholder="Tender No" ng-model="tender.tender_no">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="office-id">* Select Office</label>
                        <select ng-model="tender.office_id" ng-change="getDepartments(tender.office_id)" class="form-control" id="office-id" ng-options="office.id as office.office_name for office in offices">
                            <option value="">Select Office</option>
                        </select>
                        <i class="text-danger" ng-show="!tender.office_id && showError"><small>Please select office</small></i>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="department-id">* Select Department</label>
                        <select ng-model="tender.department_id" class="form-control" ng-options="dept.id as dept.department_name for dept in departments" id="department-id">
                            <option value="">Select Department</option>
                        </select>
                        <i class="text-danger" ng-show="!tender.department_id && showError"><small>Please select department</small></i>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-name">Tender Name</label>
                        <input type="text" class="form-control" id="tender-name" placeholder="Tender Name" ng-model="tender.tender_name">
                        <i class="text-danger" ng-show="!tender.tender_name && showError"><small>Please type tender name</small></i>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-qty">Qty</label>
                        <input type="text" class="form-control" id="tender-qty" placeholder="Qty" ng-model="tender.qty">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="tender-date">Tender Date</label>
                        <div class="form-group">
                            <div class="input-group date" id="tender_date" data-target-input="nearest">
                                <input type="text" placeholder="Tender Date" ng-model="tender.tender_date" class="form-control datetimepicker-input" data-target="#tender_date"/>
                                <div class="input-group-append" data-target="#tender_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <label for="submission_date">Submission Date</label>
                        <div class="form-group">
                            <div class="input-group date" id="submission_date" data-target-input="nearest">
                                <input type="text" placeholder="Tender Submission Date" ng-model="tender.submission_date" class="form-control datetimepicker-input" data-target="#submission_date"/>
                                <div class="input-group-append" data-target="#submission_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                    
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-success float-right" ng-click="saveTender()"><i id="loader" class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </div><br/>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tender Information</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tender No</th>
                            <th>Tender Name</th>
                            <th>Department</th>
                            <th>Qty</th>
                            <th>Tender Date</th>
                            <th>Submission Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="t in alltenders">
                            <td ng-bind="t.tender_no"></td>
                            <td ng-bind="t.tender_name"></td>
                            <td ng-bind="t.department_name"></td>
                            <td ng-bind="t.qty"></td>
                            <td ng-bind="t.tender_date"></td>
                            <td ng-bind="t.submission_date"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-info" ng-click="editTender(t.id)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteTender(t.id)">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p id="get-loader" class="text-center"></p>
                <div class="text-center">
                    <button class="btn btn-sm btn-primary" id="loadMore" ng-click="loadMore()"> <i class="fa fa-spinner"></i> Load More</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
<script src="{{ asset('public/dashboard/js/iCheck.js')}}"></script>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var AttributeValue = angular.module('TenderApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    
    AttributeValue.controller('TenderController', function ($scope, $http) {
        $("#tender").addClass('menu-open');
        $("#tender a[href='#']").addClass('active');
        $("#tender-information").addClass('active');
        $('#tender_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        
        $('#submission_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $scope.resetScope = function(){
            $scope.app_url = $("#appurl").val();
            $scope.getoffice($("#company_id").val());
            $scope.getTendersInfo();
        };

        $scope.getoffice = function (company_id) {
            $scope.offices = {};
            $http.get($scope.app_url + 'company/getoffice/'+company_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.offices = response.data;
                }
            });
        };

        $scope.getDepartments = function (office_id) {
            $scope.departments = {};
            $http.get($scope.app_url + 'company/get-departments/'+office_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.departments = response.data;
                }
            });
        };

        $scope.get_allattributes = function (category_id) {
            $http.get('get-attributes/'+category_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.attributes = response.data;
                }
            });
        };
        $scope.tender = {};
        $scope.appurl = $("#appurl").val();
        $scope.saveTender = function(){
            if (!$scope.tender.office_id || !$scope.tender.department_id || !$scope.tender.tender_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $scope.tender.company_id = $("#company_id").val();
                $scope.tender.tender_date = $("#tender_date input").val();
                $scope.tender.submission_date = $("#submission_date input").val();
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
                var Data = new FormData();
                angular.forEach($scope.tender, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('tender-information', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal({
                            title: "Save!",
                            text: res.data.message,
                            type: "success"
                        });
                        $("#loader").removeClass('fa-spinner fa-fw fa-pulse').addClass('fa-save');
                        $scope.tender = {};
                        $scope.getTendersInfo();
                    }else{
                        swal({
                            title: "Not Save!",
                            text: res.data.message,
                            type: "error"
                        });
                    }
                });
            }
        };


        $scope.getTendersInfo = function () {
            $scope.allTenders = {};
            $scope.offset = 0;
            $scope.limit = 20;
            var arr = {
                'offset':$scope.offset,
                'limit':$scope.limit,
                'company_id': $("#company_id").val()
            };
            $("#get-loader").html('<i class="fa fa-spinner fa-sw fa-3x fa-pulse"></i>');
            $http.get('tender-information/'+ JSON.stringify(arr)).then(function (response) {
                if (response.data.status == true) {
                    if(response.data.data.length > 0){
                        $scope.alltenders = response.data.data;
                        $scope.offset += $scope.limit;
                        $("#loadMore").show();
                    }else{
                        $("#loadMore").hide();
                    }
                    $("#get-loader").html('');
                }else{
                    swal({
                        title: "Not Save!",
                        text: res.data.message,
                        type: "error"
                    });
                    $("#get-loader").html('');
                }
            });
        };

        $scope.loadMore = function () {
            var arr = {
                'offset':$scope.offset,
                'limit':$scope.limit,
                'company_id': $("#company_id").val()
            };
            $("#get-loader").html('<i class="fa fa-spinner fa-sw fa-3x fa-pulse"></i>');
            $http.get('tender-information/'+ JSON.stringify(arr)).then(function (response) {
                if (response.data.data > 0) {
                    $scope.alltenders = $scope.alltenders.concat(response.data.data);
                    $("#get-loader").html('');
                    $("#loadMore").show();
                }else{
                    $("#loadMore").hide();
                    $("#get-loader").html('');

                }
            });
        };

        $scope.productCategory = function () {
            $http.get('product-categories').then(function (response) {
                if (response.data.length > 0) {
                    $scope.productCategories = response.data;
                }
            });
        };

        $scope.editTender = function (tender_id) {
            $http.get('tender-information/'+tender_id+'/edit').then(function (response) {
                $scope.getDepartments(response.data.data[0].office_id);
                $scope.tender = response.data.data[0];
                $scope.tender.office_id = parseInt(response.data.data[0].office_id);
                $scope.tender.department_id = parseInt(response.data.data[0].department_id);
            });
        };

        $scope.deleteTender = function (id) {
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
                $http.delete('tender-information/' + id).then(function (response) {
                    if(response.data.status == true){
                        $scope.getTendersInfo();
                        swal("Deleted!", response.data.message, "success");
                    }else{
                        swal("Not Deleted!", response.data.message, "error");
                    }
                });
            });
        };

    });
</script>
@endsection