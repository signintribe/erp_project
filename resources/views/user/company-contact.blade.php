@extends('layouts.admin.master')
@section('title', 'Company Contact')
@section('content')
<div ng-app="ComContactApp" ng-controller="ComContactController">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h2 class="card-title">Please Add Your Company Contact</h2>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>            
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Email</label>
                    <div class="input-group">
                        <div class="input-group">
                            <input type="email" class="form-control" ng-model="company.email" placeholder="Email">
                            <div class="input-group-addon input-group-append"><i class="fa fa-envelope input-group-text"></i></div>
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
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Fax Number</label>
                            <input type="text" ng-model="company.fax_number" class="form-control" placeholder="Fax Number">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Facebook Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.facebook" placeholder="Facebook Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-facebook input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>* Linkedin</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.linkedin" placeholder="Linkedin">
                        <div class="input-group-addon input-group-append"><i class="fa fa-linkedin input-group-text"></i></div>
                    </div>
                    <i class="text-danger" ng-show="!company.linkedin && showError"><small>Please Type Linkedin</small></i>
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
                    <label>* Website</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="company.website" placeholder="Website">
                        <div class="input-group-addon input-group-append"><i class="fa fa-globe input-group-text"></i></div>
                    </div>
                    <i class="text-danger" ng-show="!company.linkedin && showError"><small>Please Type Website</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <div class="input-group">
                        <input type="text" id="instagram" class="form-control" ng-model="company.instagram" placeholder="Instagram"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-instagram input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <div class="input-group">
                        <input type="text" id="pinterest" class="form-control" ng-model="company.pinterest" placeholder="Pinterest"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-pinterest input-group-text"></i></div>
                    </div>
                </div>
            </div><br/>
            <button type="submit" id="restrict" class="btn btn-success btn-sm float-right" ng-click="save_comContactInfo();">Submit</button>
            <!-- <button type="submit" id="updatebtn" class="btn btn-success btn-sm float-right" ng-click="update_companyinfo();">Submit</button> -->
        </div>
    </div><br/>
    <div class="card d-print-none">
        <div class="card-body" ng-init="get_companycontact();">
            <h3 class="card-title">Company Contacts</h3>
            <small class="text text-danger" ng-bind="deletemessage" ng-if="deletemessage"></small>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="company in contacts">
                        <td ng-bind="$index + 1"></td>
                        <td ng-bind="company.com_id"></td>
                        <td ng-bind="company.company_name"></td>
                        <td ng-bind="company.mobile_number"></td>
                        <td ng-bind="company.email"></td>
                        <td ng-bind="company.website"></td>
                        <td>
                            <button class="btn btn-info btn-xs" ng-click="editComContact(company.id)">Edit</button>
                            <button class="btn btn-danger btn-xs" ng-click="deleteComContact(company.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" id="baseurl" value="<?php echo env('APP_URL'); ?>">
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var CompanyContact = angular.module('ComContactApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    CompanyContact.controller('ComContactController', function ($scope, $http) {
        $scope.company = {};
        $scope.app_url = $('#baseurl').val();
        $scope.get_allcompanyinfo = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };

        $scope.get_companycontact = function () {
            $http.get('maintain-company-contact').then(function (response) {
                if (response.data.length > 0) {
                    $scope.contacts = response.data;
                }
            });
        };

        $scope.deleteComContact = function (id) {
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
                $http.delete('maintain-company-contact/' + id).then(function (response) {
                    $scope.get_companycontact();
                    if(response.data){
                        swal("Delete!", response.data.message, "success");
                    }else{
                        swal("Not Delete!", response.data.message, "error");
                    }
                });
            });
        };

        $scope.editComContact = function (id) {
            $http.get('maintain-company-contact/' + id + '/edit').then(function (response) {
                if (response.data[0]) {
                    $scope.company = response.data[0];
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

        /* $scope.check_company = function (company_name) {
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
        }; */


        $scope.save_comContactInfo = function () {
            //console.log($scope.company);
            if (!$scope.company.mobile_number) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.company, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-company-contact', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.get_companycontact();
                });
            }
        };

        /* $scope.update_companyinfo = function () {
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
                    $("#updatebtn").hide(); 
                });
            }
        };
        $("#updatebtn").hide(); */
    });
</script>
@endsection