@extends('layouts.admin.master')
@section('title', 'Companies Reports')
@section('content')
<div  ng-app="UsersApp" ng-controller="UsersController" ng-cloak>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Companies</h4>
                    <div class="table-responsive" ng-init="all_companies();">
                        <p ng-if="approve_status" ng-bind="approve_status"></p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Office Timing</th>
                                    <th>Established</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="company in CompanyInfo">
                                    <td ng-bind="company.company_name"></td>
                                    <td ng-bind="company.office_timing"></td>
                                    <td ng-bind="company.established"></td>
                                    <td ng-bind="company.created_at"></td>
                                    <td>
                                        <!-- Button to Open the Modal -->
                                        <button type="button" ng-if="company.company_name" ng-click="getportfolio(company.id, company.user_id)" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal<%company.company_id%>">Detail</button>
                                        <!-- The Modal -->
                                        <div class="modal" id="myModal<%company.company_id%>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                                        <div class="border-bottom text-center pb-4">
                                                                            <img ng-src="public/company_logs/<%company.company_logo%>" style="width: 150px; height: 150px; border-radius: 0px;" alt="profile" class="img-responsive mb-3"/>
                                                                        </div>
                                                                        <div class="border-bottom py-4" ng-if="company.office_timing">
                                                                            <p>Office Timing</p>
                                                                            <div>
                                                                                <label class="badge badge-outline-dark" ng-bind="company.office_timing"></label>  
                                                                            </div>                                                               
                                                                        </div>
                                                                        <div class="border-bottom py-4">
                                                                            <p class="clearfix">
                                                                                <span class="float-left">
                                                                                    Status
                                                                                </span>
                                                                                <span class="float-right text-muted" ng-if="CompanyUser.is_verify == 1">
                                                                                    Active
                                                                                </span>
                                                                            </p>
                                                                            <p class="clearfix" ng-if="CompanyAddress.mobile_number">
                                                                                <span class="float-left">
                                                                                    Mobile
                                                                                </span>
                                                                                <span class="float-right text-muted" ng-bind="CompanyAddress.mobile_number"></span>
                                                                            </p>
                                                                            <p class="clearfix" ng-if="CompanyAddress.whatsapp">
                                                                                <span class="float-left">
                                                                                    Whatsapp
                                                                                </span>
                                                                                <span class="float-right text-muted" ng-bind="CompanyAddress.whatsapp"></span>
                                                                            </p>
                                                                            <p class="clearfix" ng-if="CompanyUser.email">
                                                                                <span class="float-left">
                                                                                    Mail
                                                                                </span>
                                                                                <span class="float-right text-muted" ng-bind="CompanyUser.email"></span>
                                                                            </p>
                                                                            <p class="clearfix">
                                                                                <span class="float-left">
                                                                                    Facebook
                                                                                </span>
                                                                                <span class="float-right text-muted">
                                                                                    <a href="http://<%SocialMedia.facebook%>" ng-bind="CompanyUser.name"></a>
                                                                                </span>
                                                                            </p>
                                                                            <p class="clearfix">
                                                                                <span class="float-left">
                                                                                    Twitter
                                                                                </span>
                                                                                <span class="float-right text-muted">
                                                                                    <a href="http://<%SocialMedia.twitter%>">@<%CompanyUser.name%></a>
                                                                                </span>
                                                                            </p>
                                                                        </div>
                                                                        <div class="py-4">
                                                                            <p class="clearfix">
                                                                                <span class="float-left">Phone Number</span>
                                                                                <span class="float-right text-muted" ng-bind="CompanyAddress.phone_number"></span>
                                                                            </p>
                                                                            <p class="clearfix">
                                                                                <span class="float-left">Fax Number</span>
                                                                                <span class="float-right text-muted" ng-bind="CompanyAddress.fax_number"></span>
                                                                            </p>
                                                                            <p class="clearfix">
                                                                                <span>Address</span><br/>
                                                                            <p class="text-muted" ng-bind="CompanyAddress.address"></p>
                                                                            </p>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                                                        <div class="d-block d-md-flex justify-content-between mt-4 mt-md-0">
                                                                            <div>
                                                                                <h3 class="text-center text-md-left" ng-bind="company.company_name"></h3>
                                                                                <div class="d-flex align-items">
                                                                                    <h5 class="mb-0 mr-2 text-muted">Established : <span ng-bind="company.established"></span></h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-center mt-4 mt-md-0">
                                                                                <button class="btn btn-success btn-icon" ng-if="CompanyUser.is_verify==1">
                                                                                    <i class="mdi mdi-verified"></i>
                                                                                </button>
                                                                                <button class="btn btn-success" ng-if="CompanyUser.is_verify==0" ng-class="approve_user(CompanyUser.id, 1)">Approve</button>
                                                                                <button class="btn btn-danger" ng-if="CompanyUser.is_verify==1" ng-click="approve_user(CompanyUser.id, 0)">Un Approve</button>
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div><hr/>
                                                                        <p ng-bind="company.desription" class="lead text-center"></p><hr/>
                                                                        <label>Portfolio Images</label><br/>
                                                                        <div class="companyloader" align='center'></div>
                                                                        <div class="row portfolio-grid">
                                                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12" ng-repeat="portf in CompanyPortfolios" style="padding-bottom: 15px;">
                                                                                <figure class="effect-text-in">
                                                                                    <img ng-src="public/company_portfolio/<%portf.portfolio_image%>" alt="image" style="width: 100%; height:200px; border-radius: 0px"/>
                                                                                    <figcaption>
                                                                                        <h4>Image <%$index + 1%></h4>
                                                                                    </figcaption>
                                                                                </figure>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="loader" align='center'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>
    var Users = angular.module('UsersApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Users.controller('UsersController', function ($scope, $http) {
        $scope.all_companies = function () {
            $(".loader").html('<div class="square-path-loader"></div>');
            $http.get('get-all-companies').then(function (response) {
                if (response.data.length > 0) {
                    $scope.CompanyInfo = response.data;
                    $(".loader").html('');
                }
            });
        };

        $scope.approve_user = function (user_id, status) {
            $http.get('approve_user/' + user_id + '/' + status).then(function (response) {
                $scope.all_users();
                $scope.approve_status = response.data;
            });
        };

        $scope.getportfolio = function (company_id, user_id) {
            $(".companyloader").html('<div class="square-path-loader"></div>');
            $http.get('get-company-portfolio/' + company_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.CompanyPortfolios = response.data;
                    $(".companyloader").html('');
                    $scope.companyaddress(user_id);
                    $scope.userinformation(user_id);
                    $scope.companysocialmedia(company_id);
                }
            });
        };

        $scope.companyaddress = function (user_id) {
            $(".addressloader").html('<div class="square-path-loader"></div>');
            $http.get('get-company-address/' + user_id).then(function (response) {
                $scope.CompanyAddress = response.data;
                $(".addressloader").html('');
            });
        };

        $scope.userinformation = function (user_id) {
            $http.get('get-company-user/' + user_id).then(function (response) {
                $scope.CompanyUser = response.data;
            });
        };
        
        $scope.companysocialmedia = function (company_id) {
            $http.get('get-company-socialmedia/' + company_id).then(function (response) {
                $scope.SocialMedia = response.data;
            });
        };

    });
</script>
@endsection