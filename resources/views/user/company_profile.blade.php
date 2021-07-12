@extends('layouts.admin.master')
@section('title', 'Company Profile')
@section('content')
<div ng-app="CompanyApp" ng-controller="CompanyController">
    <div class="card" ng-init="editCompany('<?php echo Auth::user()->id; ?>')">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h2 class="card-title">Please Add Your Company Detail</h2>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
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
                    <label>Office Timing</label>
                    <div class="input-group">
                        <div class="input-group">
                            <input type="text" class="form-control" ng-model="company.office_timing" placeholder="Office Timing">
                            <div class="input-group-addon input-group-append"><i class="mdi mdi-clock input-group-text"></i></div>
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
                    <label>Description</label>
                    <textarea ng-model="company.desription" class="form-control" placeholder="Description" rows="3" cols="3"></textarea>
                </div>
            </div><br><hr/>
            <button type="submit" id="restrict" class="btn btn-success btn-sm float-right" ng-click="save_companyinfo();">Submit</button>
            <button type="submit" id="updatebtn" class="btn btn-success btn-sm float-right" ng-click="update_companyinfo();">Submit</button>
        </div>
    </div><br/>
<!-- <div class="card d-print-none">
        <div class="card-body" ng-init="get_allcompanyinfo();">
            <h3 class="card-title">All Compaines</h3>
            <small class="text text-danger" ng-bind="deletemessage" ng-if="deletemessage"></small>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>Established</th>
                        <th>Office Timing</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="company in companies">
                        <td ng-bind="$index + 1"></td>
                        <td ng-bind="company.company_id"></td>
                        <td ng-bind="company.company_name"></td>
                        <td ng-bind="company.established"></td>
                        <td ng-bind="company.office_timing"></td>
                        <td ng-bind="company.created_at"></td>
                        <td>
                            <button class="btn btn-info btn-xs" ng-click="editCompany(company.id)">Edit</button>
                            <button class="btn btn-danger btn-xs" ng-click="deleteCompany(company.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div> -->
</div>
<input type="hidden" id="baseurl" value="<?php echo env('APP_URL'); ?>">
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var CompanyProfile = angular.module('CompanyApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    CompanyProfile.controller('CompanyController', function ($scope, $http) {
        $scope.company = {};
        $scope.app_url = $('#baseurl').val();
        $scope.get_allcompanyinfo = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };

        $scope.deleteCompany = function (id) {
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('maintain-company/' + id).then(function (response) {
                    $scope.get_allcompanyinfo();
                    if(response.data.status === 0){
                        swal("Delete!", response.data.message, "success");
                    }else{
                        swal("Not Delete!", response.data.message, "error");
                    }
                });
            });
        };

        $scope.editCompany = function (id) {
            $http.get('maintain-company/' + id + '/edit').then(function (response) {
                if (response.data) {
                    $scope.company = response.data;
                    $("#companyname").attr('readonly', 'readonly');
                    $("#companyname").attr('disabled', 'disabled');
                    $scope.comLogo = $scope.app_url + 'public/company_logs/' + $scope.company.company_logo;
                    $scope.get_companysocial($scope.company.social_id);
                    $scope.get_companyaddress($scope.company.address_id);
                    $scope.get_companycontact($scope.company.contact_id);
                    $("#restrict").hide();
                    $("#updatebtn").show();
                    $("#ShowPrint").show();
                }
            });
        };

        /* $scope.get_companysocial = function (social_id) {
            $http.get('getcompanysocial/' + social_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.company, response.data);
                }
            });
        };

        $scope.get_companyaddress = function (address_id) {
            $http.get('getcompanyaddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.company, response.data);
                }
            });
        };

        $scope.get_companycontact = function (contact_id) {
            $http.get('getcompanycontact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.company, response.data);
                }
            });
        }; */

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
            if (!$scope.company.company_name || !$scope.company.phone_number || !$scope.company.mobile_number || !$scope.company.address_line_1 || !$scope.company.country || !$scope.company.linkedin || !$scope.company.website) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.company, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-company', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.get_allcompanyinfo();
                });
            }
        };

        $scope.update_companyinfo = function () {
            if (!$scope.company.company_name || !$scope.company.phone_number || !$scope.company.mobile_number || !$scope.company.address_line_1 || !$scope.company.country || !$scope.company.linkedin || !$scope.company.website) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.company, function (v, k) {
                    Data.append(k, v);
                });
                //JSON.stringify($scope.company);
                $http.post('maintain-company' , Data , {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.get_allcompanyinfo();
                    /* $("#restrict").show();
                    $("#updatebtn").hide(); */
                });
            }
        };
        $("#updatebtn").hide();
    });
</script>
@endsection