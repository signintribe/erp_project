@extends('layouts.admin.creationTier')
@section('title', 'Company Registration')
@section('pagetitle', 'Company Registration')
@section('breadcrumb', 'Company Registration')
@section('content')
<div ng-app="RegistrationApp" ng-controller="RegistrationController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Registration</h3>
                </div>
                <div class="col">
                    <div class="btn-group float-right">
                        <button class="btn btn-xs btn-primary" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                        <a href="#viewRegristration" class="btn btn-xs btn-warning" >View Registrations</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="get_authorities();">
                    <label for="registration-authority">* Registration Authority</label>
                    <select class="form-control" ng-options="authority.id as authority.authority_name for authority in allauthorities" id="registration-authority" ng-model="registration.authority_id">
                        <option value="">Registration Authority</option>
                    </select>
                    <i class="text-danger" ng-show="!registration.authority_id && showError"><small>Please select registration authority</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="reg-id">* Registration Id/No</label>
                    <input type="text" id="reg-id" class="form-control" placeholder="Registration Id/No" ng-model="registration.registration_id"/>
                    <i class="text-danger" ng-show="!registration.registration_id && showError"><small>Please type registration id</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="reg-name">* Name of Registration</label>
                    <input type="text" id="reg-name" class="form-control" placeholder="Name of Registration" ng-model="registration.registration_name"/>
                    <i class="text-danger" ng-show="!registration.registration_name && showError"><small>Please type registration Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_start">Issue Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="start_date" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="registration.issue_date" class="form-control datetimepicker-input" data-target="#start_date"/>
                            <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_end">Expiry Date</label>
                    <div class="form-group">
                    <div class="input-group date" id="end_date" data-target-input="nearest">
                        <input type="text" placeholder="End Date" ng-model="registration.expiry_date" class="form-control datetimepicker-input" data-target="#end_date"/>
                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="cat-img">Picture</label>
                        <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);" >
                    </div>
                </div>
                <div class="col">
                    <img ng-if="certificate_picture" ng-src="<% certificate_picture %>" class="img img-thumbnail" style="width:200px; height:200px;">
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_companyregistration();"> <i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title" id="viewRegristration">All Registration</h3>
        </div>
        <div class="card-body" ng-init="allcompany_registrations()">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Registration Name</th>
                        <th>Registration ID</th>
                        <th>Registration Authority</th>
                        <th>Issue Date</th>
                        <th>Expire Date</th>
                        <th>Company Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="r in allregistration">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="r.registration_name"></td>
                        <td ng-bind="r.registration_id"></td>
                        <td ng-bind="r.authority_name"></td>
                        <td ng-bind="r.issue_date"></td>
                        <td ng-bind="r.expiry_date"></td>
                        <td ng-bind="r.company_name"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editRegistration(r.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteRegistration(r.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Company = angular.module('RegistrationApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    Company.controller('RegistrationController', function ($scope, $http) {
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $("#company").addClass('menu-open');
        $("#company a[href='#']").addClass('active');
        $("#company-registration").addClass('active');
        $scope.appurl = $("#appurl").val();
        $scope.registration = {};

        $scope.get_authorities = function () {
            $scope.allregistration = {};
            $http.get($scope.appurl + 'manage-authorities').then(function (response) {
                if (response.data.length > 0) {
                    $scope.allauthorities = response.data;
                }
            });
        };
        $scope.all_companies = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };

        $scope.allcompany_registrations = function () {
            $scope.allregistration = {};
            $http.get($scope.appurl + 'manage-registration/company-'+$("#company_id").val()).then(function (response) {
                if (response.data.length > 0) {
                    $scope.allregistration = response.data;
                }
            });
        };

        $scope.editRegistration = function (id) {
            $http.get($scope.appurl + 'manage-registration/' + id + '/edit').then(function (response) {
                $scope.registration = response.data;
                $scope.registration.company_id = parseInt($scope.registration.company_id);
                $scope.certificate_picture = $scope.appurl + 'public/authorities_certificates/' + response.data.certificate_image;
                $("#ShowPrint").show();
            });
        };

        $scope.save_companyregistration = function () {
            $scope.registration.issue_date = $("#start_date input").val();
            $scope.registration.expiry_date = $("#end_date input").val();
            $scope.registration.actor_id = $("#company_id").val();
            $scope.registration.company_id = $("#company_id").val();
            $scope.registration.actor_name = 'company';
            if (!$scope.registration.authority_id || !$scope.registration.registration_id || !$scope.registration.registration_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-pulse fa-fw');
                var Data = new FormData();
                angular.forEach($scope.registration, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.appurl + 'manage-registration', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $("#loader").removeClass('fa-spinner fa-pulse fa-fw').addClass('fa-save');
                    $scope.registration = {};
                    $scope.allcompany_registrations();
                });
            }
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.certificate_picture = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.registration.certificate_picture = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };

        $scope.deleteRegistration = function(id){
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
                $http.delete($scope.appurl + 'manage-registration/'+id).then(function (response) {
                    $scope.allcompany_registrations();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
    });
</script>
@endsection