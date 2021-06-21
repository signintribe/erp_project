@extends('layouts.admin.master')
@section('title', 'Company Registration')
@section('content')
<div  ng-app="RegistrationApp" ng-controller="RegistrationController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Registration</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="registration-authority">* Registration Authority</label>
                    <select class="form-control" id="registration-authority" ng-model="registration.registration_authority">
                        <option value="">Registration Authority</option>
                        <option value="NTN">NTN</option>
                        <option value="STRN">STRN</option>
                        <option value="SECP">SECP</option>
                        <option value="FBR">FBR</option>
                        <option value="Chamber of Commerce">Chamber of Commerce</option>
                        <option value="IOT ID">IOT ID</option>
                        <option value="FED">FED</option>
                    </select>
                    <i class="text-danger" ng-show="!registration.registration_authority && showError"><small>Please select registration authority</small></i>
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
                    <div class="form-group">
                        <label for="registration-date">Registration Date</label>
                        <div class="input-group">
                            <input type="text" id="registration-date" class="form-control" datepicker placeholder="Registration Date" ng-model="registration.registration_date"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="expiry-date">Expiry Date</label>
                        <div class="input-group">
                            <input type="text" id="expiry-date" class="form-control" datepicker placeholder="Expiry Date" ng-model="registration.expiry_date"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" class="form-control" placeholder="Phone Number" ng-model="registration.phone_number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" id="website" class="form-control" placeholder="Website" ng-model="registration.website"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" id="email" class="form-control" placeholder="Email" ng-model="registration.email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" id="mobile" class="form-control" placeholder="Mobile Number" ng-model="registration.mobile_number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="authority-address">Address of Authority</label>
                    <input type="text" id="authority-address" class="form-control" placeholder="Address of Registration Authority" ng-model="registration.registration_authority_address"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_companyregistration();">Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card d-print-none">
        <div class="card-body" ng-init="allcompany_registrations()">
            <h3 class="card-title">All Registration</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Registration Name</th>
                        <th>Registration ID</th>
                        <th>Registration Authority</th>
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
                        <td ng-bind="r.registration_authority"></td>
                        <td ng-bind="r.expiry_date"></td>
                        <td ng-bind="r.company_name"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editRegistration(r.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteRegistration(r.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Company = angular.module('RegistrationApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    Company.directive('datepicker', function () {
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

    Company.controller('RegistrationController', function ($scope, $http) {
        $scope.registration = {};

        $scope.all_companies = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };

        $scope.allcompany_registrations = function () {
            $http.get('registration-company').then(function (response) {
                if (response.data.length > 0) {
                    $scope.allregistration = response.data;
                }
            });
        };

        $scope.editRegistration = function (id) {
            $http.get('registration-company/' + id + '/edit').then(function (response) {
                $scope.registration = response.data;
                $scope.registration.company_id = parseInt($scope.registration.company_id);
                $("#ShowPrint").show();
            });
        };

        $scope.save_companyregistration = function () {
            if (!$scope.registration.registration_authority || !$scope.registration.registration_id || !$scope.registration.registration_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.registration, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('registration-company', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.registration = {};
                    $scope.allcompany_registrations();
                });
            }
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
                $http.delete('registration-company/'+id).then(function (response) {
                    $scope.allcompany_registrations();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
    });
</script>
@endsection