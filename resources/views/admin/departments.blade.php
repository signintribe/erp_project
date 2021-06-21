@extends('layouts.admin.master')
@section('title', 'Departments')
@section('content')
<div  ng-app="DepartmentsApp" ng-controller="DepartmentsController" ng-cloak>
    <div class="card">
        <div class="card-body" ng-init="get_companyinfo()">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Department</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
            <div class="row" ng-init="getoffice(0)">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">* Select Office</label>
                    <select ng-model="dept.office_id" ng-options="office.id as office.office_name for office in offices" class="form-control" id="office" required>
                        <option value="">Select Office</option>
                    </select>
                    <i class="text-danger" ng-show="!dept.office_id && showError"><small>Please Select Office</small></i><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department_name">* Department Name</label>
                    <input type="text" id="department_name" ng-model="dept.department_name" class="form-control" placeholder="Department Name"/>
                    <i class="text-danger" ng-show="!dept.department_name && showError"><small>Please Type Department Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="start_date">Department Start</label>
                    <input type="text" id="start_date" ng-model="dept.start_date" datepicker class="form-control" placeholder="Department Start"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="dept_scope">Department Scope</label>
                    <input type="text" id="dept_scope" ng-model="dept.department_scope" class="form-control" placeholder="Department Scope"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Department Status</label><br>
                    <span class="form-control">
                        <input type="checkbox" id="dept_status" ng-model="dept.department_status" placeholder="Department Status"/>
                        <label for="dept_status">Status</label>
                    </span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Phone Number</label>
                            <input type="text" ng-model="dept.phone_number" class="form-control" placeholder="Phone Number">
                            <i class="text-danger" ng-show="!dept.phone_number && showError"><small>Please Type Phone Number</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>* Mobile Number</label>
                            <input type="text" ng-model="dept.mobile_number" class="form-control" placeholder="Mobile Number">
                            <i class="text-danger" ng-show="!dept.mobile_number && showError"><small>Please Type Mobile Number</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group row">
                        <div class="col">
                            <label>Fax Number</label>
                            <input type="text" ng-model="dept.fax_number" class="form-control" placeholder="Fax Number">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Email</label>
                    <div class="input-group">
                        <div class="input-group">
                            <input type="email" class="form-control" ng-model="dept.email" placeholder="Email">
                            <div class="input-group-addon input-group-append"><i class="fa fa-envelope input-group-text"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Whatsapp</label>
                    <div class="input-group">
                        <div class="input-group">
                            <input type="text" class="form-control" ng-model="dept.whatsapp" placeholder="Whatsapp">
                            <div class="input-group-addon input-group-append"><i class="mdi mdi-whatsapp input-group-text"></i></div>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="description">Description</label>
                    <textarea id="description" ng-model="dept.description" class="form-control" placeholder="Description" cols="5" rows="5"></textarea>
                </div>
            </div><hr>
            <h3 class="card-title">Address Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">* Postal Address Line 1</label>
                        <input type="text" id="address_1" class="form-control" ng-model="dept.address_line_1" placeholder="Postal Address Line 1" required/>
                        <i class="text-danger" ng-show="!dept.address_line_1 && showError"><small>Please Type Address Line</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Postal Address Line 2</label>
                        <input type="text" id="address_2" class="form-control" ng-model="dept.address_line_2" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_3">Postal Address Line 3</label>
                        <input type="text" id="address_3" class="form-control" ng-model="dept.address_line_3" placeholder="Postal Address Line 3"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" id="street" class="form-control" ng-model="dept.street" placeholder="Street"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" id="sector" class="form-control" ng-model="dept.sector" placeholder="Sector/Mohallah"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="country">* Country</label>
                        <input type="text" id="country" class="form-control" ng-model="dept.country" placeholder="Country" required/>
                        <i class="text-danger" ng-show="!dept.country && showError"><small>Please Type Country</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="state">State / Province</label>
                        <input type="text" id="state" class="form-control" ng-model="dept.state" placeholder="State / Province"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" class="form-control" ng-model="dept.city" placeholder="City"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal-code">Postal Code</label>
                        <input type="text" id="postal-code" class="form-control" ng-model="dept.postal_code" placeholder="Postal Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip-code">Zip Code</label>
                        <input type="text" id="zip-code" class="form-control" ng-model="dept.zip_code" placeholder="Zip Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
            </div>
            <hr/>
            <h2 class="card-title">Please Add Your Social Media</h2>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Facebook Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="dept.facebook" placeholder="Facebook Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-facebook input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Linkedin</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="dept.linkedin" placeholder="Linkedin">
                        <div class="input-group-addon input-group-append"><i class="fa fa-linkedin input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Youtube Channel</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="dept.youtube" placeholder="Youtube Channel">
                        <div class="input-group-addon input-group-append"><i class="fa fa-youtube input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Twitter Page</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="dept.twitter" placeholder="Twitter Page">
                        <div class="input-group-addon input-group-append"><i class="fa fa-twitter input-group-text"></i></div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Website</label>
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="dept.website" placeholder="Website">
                        <div class="input-group-addon input-group-append"><i class="fa fa-globe input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <div class="input-group">
                        <input type="text" id="instagram" class="form-control" ng-model="dept.instagram" placeholder="Instagram"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-instagram input-group-text"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <div class="input-group">
                        <input type="text" id="pinterest" class="form-control" ng-model="dept.pinterest" placeholder="Pinterest"/>
                        <div class="input-group-addon input-group-append"><i class="fa fa-pinterest input-group-text"></i></div>
                    </div>
                </div>
            </div><hr/>
            <button type="button" class="btn btn-sm btn-success" ng-click="save_department()"><i class="fa fa-save"></i> Save</button>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-body" ng-init="get_departments();">
            <h3 class="card-title">All Departments</h3>
            <table class="table table-bordered" style="font-size: 12px;">
                <tr>
                    <th>Sr#</th>
                    <th>Company Name</th>
                    <th>Office Name</th>
                    <th>Department Name</th>
                    <th>Action</th>
                </tr>
                <tr ng-repeat="dept in departments">
                    <td ng-bind="$index + 1"></td>
                    <td ng-bind="dept.company_name"></td>
                    <td ng-bind="dept.office_name"></td>
                    <td ng-bind="dept.department_name"></td>
                    <td>
                        <button class="btn btn-xs btn-info" ng-click="getoffice(dept.company_id); editDept(dept.id)">Edit</button>
                        <button class="btn btn-xs btn-danger" ng-click="deleteDept(dept.id)">Delete</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>
    var Departments = angular.module('DepartmentsApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    Departments.directive('datepicker', function () {
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

    Departments.controller('DepartmentsController', function ($scope, $http) {
        $scope.get_companyinfo = function () {
            $http.get('getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };
        
        $scope.get_departments = function () {
            $http.get('getdepartments').then(function (response) {
                if (response.data.length > 0) {
                    $scope.departments = response.data;
                }
            });
        };

        $scope.editDept = function (id) {
            $http.get('getonedept/' + id).then(function (response) {
                if (response.data) {
                    $scope.dept = response.data[0];
                    $scope.dept.department_status = response.data[0].department_status == 1 ? true : false;
                    $scope.get_companysocial($scope.dept.social_id);
                    $scope.get_companyaddress($scope.dept.address_id);
                    $scope.get_companycontact($scope.dept.contact_id);
                    $scope.dept.company_id = parseInt( $scope.dept.company_id);
                    $scope.dept.office_id = parseInt( $scope.dept.office_id);
                    $("#ShowPrint").show();
                }
            });
        };

        $scope.get_companysocial = function (social_id) {
            $http.get('getcompanysocial/' + social_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.dept, response.data);
                }
            });
        };

        $scope.get_companyaddress = function (address_id) {
            $http.get('getcompanyaddress/' + address_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.dept, response.data);
                }
            });
        };

        $scope.get_companycontact = function (contact_id) {
            $http.get('getcompanycontact/' + contact_id).then(function (response) {
                if (response.data) {
                    angular.extend($scope.dept, response.data);
                }
            });
        };

        $scope.deleteDept = function (id) {
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
                $http.get('delete-department/' + id).then(function (response) {
                    $scope.get_departments();
                    if(response.data.status === 0){
                        swal("Delete!", response.data.message, "success");
                    }else{
                        swal("Not Delete!", response.data.message, "error");
                    }
                });
            });
        };

        $scope.getoffice = function (company_id) {
            $scope.offices = {};
            $http.get('getoffice/'+company_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.offices = response.data;
                }
            });
        };
        
        $scope.dept = {};
        $scope.save_department = function () {
            console.log($scope.dept);
            if (!$scope.dept.company_id || !$scope.dept.office_id || !$scope.dept.department_name || !$scope.dept.address_line_1 || !$scope.dept.country || !$scope.dept.phone_number || !$scope.dept.mobile_number) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.dept, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('SaveDepartment', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.dept = {};
                    $scope.get_departments();
                });
            }
        };

    });
</script>
@endsection