@extends('layouts.admin.master')
@section('title', 'Family/Spouse Emergency Contact Person Details')
@section('content')
<div  ng-app="SpouseApp" ng-controller="SpouseController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Family/Spouse Emergency Contact Person Details</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <div class="form-group">
                        <label for="employee_name">* Select Employee Name</label>
                        <select id="employee_name"  ng-options="user.id as user.first_name for user in Users" ng-model="user.employee_id" class="form-control">
                            <option value="">Select Employee</option>
                        </select>
                        <i class="text-danger" ng-show="!user.employee_name && showError"><small>Please Select Employee</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="first_name">* First Name</label>
                        <input type="text" id="first_name" ng-model="user.spouse_first_name" class="form-control" placeholder="First Name"/>
                        <i class="text-danger" ng-show="!user.spouse_first_name && showError"><small>Please Type First Name</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" ng-model="user.spouse_middle_name" class="form-control" placeholder="Middle Name"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" ng-model="user.spouse_last_name" class="form-control" placeholder="Last Name"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="relation">* Relation with employee</label>
                            <input type="text" id="relation" ng-model="user.relation" class="form-control" placeholder="Relation with employee"/>
                            <i class="text-danger" ng-show="!user.relation && showError"><small>Please Type Relation with employee</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <input type="text" id="gender" ng-model="user.gender" class="form-control" placeholder="Gender"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="text" id="dob" ng-model="user.dob" datepicker class="form-control" placeholder="Date of Birth"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="domicile">Domicile</label>
                        <input type="text" id="domicile" ng-model="user.domicile" class="form-control" placeholder="Domicile"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="marital_status">Marital Status</label>
                        <select class="form-control" ng-model="user.marital_status">
                            <option value="">Select Marital Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="patronage">Dependant/Independentat</label>
                        <select id="patronage" ng-model="user.patronage" class="form-control">
                            <option value="">Select Dependant/Independentat</option>
                            <option value="Dependant">Dependant</option>
                            <option value="Independant">Independant</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Contact Information</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" ng-model="user.phone_number" class="form-control" placeholder="Phone Number"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="mobile_number">* Mobile Number</label>
                        <input type="text" id="mobile_number" ng-model="user.mobile_number" class="form-control" placeholder="Mobile Number"/>
                        <i class="text-danger" ng-show="!user.mobile_number && showError"><small>Please Type Mobile Number</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="fax_number">Fax Number</label>
                        <input type="text" id="fax_number" ng-model="user.fax_number" class="form-control" placeholder="Fax Number"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" ng-model="user.email" class="form-control" placeholder="Email"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">* Address Line 1</label>
                        <input type="text" id="address_1" ng-model="user.address_line_1" class="form-control" placeholder="Postal Address Line 1"/>
                        <i class="text-danger" ng-show="!user.address_line_1 && showError"><small>Please Type Address Line 1</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Address Line 2</label>
                        <input type="text" id="address_2" ng-model="user.address_line_2" class="form-control" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Address Line 3</label>
                        <input type="text" id="address_2" ng-model="user.address_line_3" class="form-control" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" id="street" ng-model="user.street" class="form-control" placeholder="Street"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" id="sector" ng-model="user.sector" class="form-control" placeholder="Sector/Mohallah"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" ng-model="user.city" class="form-control" placeholder="City"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="state">State/Province</label>
                        <input type="text" id="state" ng-model="user.state" class="form-control" placeholder="State/Province"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" ng-model="user.country" class="form-control" placeholder="Country"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" ng-model="user.postal_code" class="form-control" placeholder="Postal Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" id="zip_code" ng-model="user.zip_code" class="form-control" placeholder="Zip Code"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/employees-addresses')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="mdi mdi-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_spouse()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save"></i>
                        </button>
                        <a href="{{url('hr/education-detail')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <!--  <div class="card">
        <div class="card-body">
            <h3 class="card-title">Social Media</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" id="facebook" ng-model="user.facebook" class="form-control" placeholder="Facebook"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="linkedin">Linkedin</label>
                        <input type="text" id="linkedin" ng-model="user.linkedin" class="form-control" placeholder="Linkedin"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="text" id="whatsapp" ng-model="user.whatsapp" class="form-control" placeholder="Whatsapp"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" id="twitter" ng-model="user.twitter" class="form-control" placeholder="Twitter"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="instgram">Instgram</label>
                        <input type="text" id="instgram" ng-model="user.instgram" class="form-control" placeholder="Instgram"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="text" id="whatsapp" ng-model="user.whatsapp" class="form-control" placeholder="Whatsapp"/>
                    </div>
                </div>
            </div><br/> 
        </div>
    </div> -->
    <br>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Spouse Detail</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Employee Name</th>
                            <th>Spouse Name</th>
                            <th>Spouse Relation</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getSpouseDetail();">
                        <tr ng-repeat='spouse in spousedetails'>
                            <td ng-bind="$index + 1"></td>
                            <td ng-bind="spouse.first_name"></td>
                            <td ng-bind="spouse.spouse_first_name"></td>
                            <td ng-bind="spouse.relation"></td>
                            <td ng-bind="spouse.mobile_number"></td>
                            <td ng-bind="spouse.email"></td>
                            <td>
                                <button class="btn btn-xs btn-info" ng-click="eidtSpouse(spouse.id);">Edit</button>
                                <button class="btn btn-xs btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="app_url" value="<?php echo env('APP_URL'); ?>">
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Spouse = angular.module('SpouseApp', []);

    Spouse.directive('datepicker', function () {
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

    Spouse.controller('SpouseController', function ($scope, $http) {
        $scope.user = {};
        $scope.appurl = $("#app_url").val();
        $scope.getEmployees = function () {
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };

        $scope.getSpouseDetail = function () {
            $http.get('maintain-spouse-detail').then(function (response) {
                if (response.data.length > 0) {
                    $scope.spousedetails = response.data;
                }
            });
        };

        $scope.eidtSpouse = function (id) {
            $http.get('maintain-spouse-detail/' + id + '/edit').then(function (response) {
                //if (response.data.length > 0) {
                    $scope.user = response.data;
                    $scope.getAddress($scope.user.address_id);
                //}
            });
        };

        $scope.getAddress = function(address_id){
            $http.get($scope.appurl+'getAddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.user, response.data);
                    $scope.getContact($scope.user.contact_id);
                }
            });
        };

        $scope.getContact = function(contact_id){
            $http.get($scope.appurl+'getContact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.user, response.data);
                }
            });
        };

        $scope.save_spouse = function(){
            if (!$scope.user.employee_id || !$scope.user.spouse_first_name || !$scope.user.relation || !$scope.user.mobile_number || !$scope.user.address_line_1) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.user, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-spouse-detail', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.user = {};
                    $scope.getSpouseDetail();
                });
            }
        };
    });
</script>
@endsection