@extends('layouts.admin.master')
@section('title', 'Company Profile')
@section('content')
<div ng-app="CompanyApp" ng-controller="CompanyController">
    <div class="card" ng-init="get_companyinfo();">
        <div class="card-body">
            <h2 class="card-title">Please Add Your Company Detail</h2>
            <div class="row" ng-if="comLogo">
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <img ng-src="<% comLogo %>" class="img-lg rounded"/><br/><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Choose Logo</label>
                            <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Company Name</label>
                            <input type="text" ng-model="company.company_name" ng-blur="check_company(company.company_name);" id="companyname" class="form-control" placeholder="Company Name">
                            <i class="text-danger" ng-show="!company.company_name && showError"><small>Please Type Company Name</small></i>
                            <p ng-if="checkcompany" ng-bind="checkcompany"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Phone Number</label>
                            <input type="text" ng-model="company.phone_number" class="form-control" placeholder="Phone Number">
                            <i class="text-danger" ng-show="!company.phone_number && showError"><small>Please Type Phone Number</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Mobile Number</label>
                            <input type="text" ng-model="company.mobile_number" class="form-control" placeholder="Mobile Number">
                            <i class="text-danger" ng-show="!company.mobile_number && showError"><small>Please Type Mobile Number</small></i>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Fax Number</label>
                            <input type="text" ng-model="company.fax_number" class="form-control" placeholder="Fax Number">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Whatsapp</label>
                            <input type="text" ng-model="company.whatsapp" class="form-control" placeholder="Whatsapp">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Office Timing</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" ng-model="company.office_timing" placeholder="Office Timing">
                                    <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Company Established</label>
                            <select class="form-control form-control-lg" ng-model="company.established">
                                <option value="">Select Year</option>
                                <?php for ($i = 1950; $i <= date('Y'); $i++) { ?>
                                    <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label>Address</label>
                    <textarea ng-model="company.address" class="form-control" placeholder="Company Address" rows="3" cols="3"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label>Description</label>
                    <textarea ng-model="company.desription" class="form-control" placeholder="Description" rows="3" cols="3"></textarea>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Please Add Your Company Social Media</h2>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Facebook Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.facebook" placeholder="Facebook Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-facebook input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Linkedin</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.linkedin" placeholder="Linkedin">
                        <div class="input-group-addon input-group-append"><i class="fa fa-linkedin input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Youtube Channel</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.youtube" placeholder="Youtube Channel">
                        <div class="input-group-addon input-group-append"><i class="fa fa-youtube input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Twitter Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.twitter" placeholder="Twitter Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-twitter input-group-text"></i></div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Website</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.website" placeholder="Website">
                        <div class="input-group-addon input-group-append"><i class="fa fa-globe input-group-text"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <button type="submit" id="restrict" class="btn btn-success btn-md float-right" ng-click="save_companyinfo();">Submit</button>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var CompanyProfile = angular.module('CompanyApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    CompanyProfile.controller('CompanyController', function ($scope, $http) {
        $scope.company = {};

        $scope.get_companyinfo = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data) {
                    $scope.company = response.data;
                    $("#companyname").attr('readonly', 'readonly');
                    $("#companyname").attr('disabled', 'disabled');
                    $scope.comLogo = 'public/company_logs/' + $scope.company.company_logo;
                    $scope.get_companysocial($scope.company.id);
                    $scope.get_companyaddress();
                    $scope.get_companyportfolio($scope.company.id);
                }
            });
        };

        $scope.get_companysocial = function (company_id) {
            $http.get('getcompanysocial/' + company_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.company, response.data);
                }
            });
        };
        
        $scope.get_companyaddress = function () {
            $http.get('getcompanyaddress').then(function (response) {
                if (response.data) {
                    angular.extend($scope.company, response.data);
                }
            });
        };

        $scope.check_company = function (company_name) {
            $http.get('check_company/' + company_name).then(function (response) {
                if (response.data) {
                    $scope.checkcompany = response.data.company_name + " is already exist";
                    $('#restrict').attr('disabled', 'disabled');
                } else {
                    $scope.checkcompany = "This company is not exist";
                    $('#restrict').removeAttr('disabled', 'disabled');
                }
            });
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.comLogo = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.company.companyLogo = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };


        $scope.save_companyinfo = function () {
            console.log($scope.company);
            if (!$scope.company.company_name || !$scope.company.phone_number || !$scope.company.mobile_number) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.company, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('SaveCompany', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.get_companyinfo();
                });
            }
        };
    });
</script>
@endsection