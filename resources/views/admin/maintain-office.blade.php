@extends('layouts.admin.master')
@section('title', 'Company Registration')
@section('content')
<div  ng-app="OfficeApp" ng-controller="OfficeController" ng-cloak>
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
                <div class="col">
                    <label for="select-company" ng-init="all_companies();">Select Company</label>
                    <select class="form-control" id="select-company" ng-options="c.id as c.company_name for c in companies" ng-model="office.company_id">
                        <option value="">Select Company</option>
                    </select>
                </div>
                <div class="col">
                    <label for="office-name">* Name of Office</label>
                    <input type="text" id="office-name" class="form-control" ng-model="office.office_name" placeholder="Name of Office">
                </div>
                <div class="col">
                    <label for="office-type">Type of Office</label>
                    <input type="text" id="office-type" class="form-control" placeholder="Type of Office" ng-model="office.office_type"/>
                </div>
                <div class="col">
                    <label for="start-date">Start Date</label>
                    <div class="input-group">
                        <input type="text" id="start-date" class="form-control" datepicker placeholder="Start Date" ng-model="office.start_date"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <label>Office Status</label><br>
                    <span class="form-control">
                        <input type="checkbox" id="office-status" ng-model="office.office_status"/> <label for="office-status">Status</label>
                    </span>
                </div>
                <div class="col">
                    <label for="office-scope">Office Scope</label>
                    <input type="text" id="expiry-date" class="form-control" placeholder="Expiry Date" ng-model="registration.expiry_date"/>
                </div>
                <div class="col">
                    <label for="postal-code">Postal Code</label>
                    <input type="text" id="postal-code" class="form-control" placeholder="Postal Code" ng-model="registration.postal_code"/>
                </div>
                <div class="col">
                <label for="zip-code">Zip Code</label>
                    <input type="text" id="zip-code" class="form-control" placeholder="Zip Code" ng-model="registration.zip_code"/>                    
                </div>
            </div><hr/>
            <h3 class="card-title">Address Information</h3>
            <div class="row">
                <div class="col">
                    <label for="postal-address-1">Postal Address Line 1</label>
                    <input type="text" class="form-control" placeholder="Postal Address Line 1" ng-model="office.address_line_1">
                </div>
                <div class="col">
                    <label for="postal-address-2">Postal Address Line 2</label>
                    <input type="text" class="form-control" id="postal-address-2" ng-model="office.address_line_2">
                </div>
                <div class="col">
                    <label for="street">Street</label>
                    <input type="text" class="form-control" id="street" ng-model="office.street" placeholder="Street">
                </div>
                <div class="col">
                    <label for="sector_mohallah">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector_mohallah" ng-model="office.sector" placeholder="Sector/Mohallah">
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" placeholder="City" ng-model="office.city">
                </div>
                <div class="col">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" placeholder="State/Province" ng-model="office.state">
                </div>
                <div class="col">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" placeholder="Country" ng-model="office.country">
                </div>
                <div class="col">
                    <label for="postal-code">Postal Code</label>
                    <input type="text" id="postal-code" class="form-control" placeholder="Postal Code" ng-model="office.postal_code"/>
                </div>
                <div class="col">
                    <label for="zip-code">Zip Code</label>
                    <input type="text" id="zip-code" class="form-control" placeholder="Zip Code" ng-model="office.zip_code"/>                    
                </div>
            </div><hr>
            <h3 class="card-title">Contact Information</h3>
            <div class="row">
                <div class="col">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" class="form-control" placeholder="Phone Number" ng-model="office.phone_number"/>
                </div>
                <div class="col">
                    <label for="mobile-number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile-number" placeholder="Mobile Number" ng-model="office.mobile_number">
                </div>
                <div class="col">
                    <label for="fax">Fax</label>
                    <input type="text" class="form-control" id="fax" placeholder="Fax" ng-model="office.fax_number">
                </div>
                <div class="col">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" placeholder="Whatsapp" ng-model="office.whatsapp">
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Email" ng-model="office.email">
                </div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
            </div><hr>
            <h3 class="card-title">Social Media</h3>
            <div class="row">
                <div class="col">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" placeholder="Website" ng-model="office.website">
                </div>
                <div class="col">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" placeholder="Twitter" ng-model="office.twitter">
                </div>
                <div class="col">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" placeholder="Instagram" ng-model="office.instagram">
                </div>
                <div class="col">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" placeholder="Facebook" ng-model="office.facebook">
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" placeholder="Linkedin" ng-model="office.linkedin">
                </div>
                <div class="col">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" placeholder="Pinterest" ng-model="office.pinterest">
                </div>
                <div class="col"></div>
                <div class="col"></div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_companyoffice()">Save</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card d-print-none">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Office Type</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody ng-init="alloffice()">
                    <tr ng-repeat="office in alloffice">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="office.company_name"></td>
                        <td ng-bind="office.office_name"></td>
                        <td ng-bind="office.office_type"></td>
                        <td ng-bind="office.start_date"></td>
                        <td>
                            <p ng-if="office.office_status == 0" class="text text-danger">Closed</p>
                            <p ng-if="office.office_status == 1" class="text text-success">Opened</p>
                        </td>
                        <td>
                            <button class="btn btn-xs btn-danger" ng-click="deleteOffice(office.id);">Delete</button>
                            <button class="btn btn-xs btn-info" ng-click="editOffice(office.id);">Edit</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Company = angular.module('OfficeApp', [], function ($interpolateProvider) {
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

    Company.controller('OfficeController', function ($scope, $http) {
        $scope.office = {};

        $scope.all_companies = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };

        $scope.editOffice = function (id) {
            $http.get('office-settings/' + id + '/edit').then(function (response) {
                $scope.office = response.data;
                $scope.office.company_id = parseInt($scope.office.company_id);
                $scope.get_companysocial($scope.office.social_id);
                $scope.get_companyaddress($scope.office.address_id);
                $scope.get_companycontact($scope.office.contact_id);
                $("#ShowPrint").show();
            });
        };

        $scope.get_companysocial = function (social_id) {
            $http.get('getcompanysocial/' + social_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.office, response.data);
                }
            });
        };

        $scope.get_companyaddress = function (address_id) {
            $http.get('getcompanyaddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.office, response.data);
                }
            });
        };

        $scope.get_companycontact = function (contact_id) {
            $http.get('getcompanycontact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.office, response.data);
                }
            });
        };

        $scope.alloffice = function () {
            $http.get('office-settings').then(function (response) {
                if (response.data.length > 0) {
                    $scope.alloffice = response.data;
                }
            });
        };

        $scope.save_companyoffice = function () {
            console.log($scope.office);
            if (!$scope.office.company_id || !$scope.office.office_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.office, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('office-settings', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.office = {};
                });
            }
        };
    });
</script>
@endsection