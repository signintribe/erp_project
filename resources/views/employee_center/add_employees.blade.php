@extends('layouts.admin.creationTier')
@section('title', 'Employee Information')
@section('pagetitle', 'Employee Information')
@section('breadcrumb', 'Employee Information')
@section('content')
<div  ng-app="UsersApp" ng-controller="UsersController" ng-cloak>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Personal Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>* Employee ID</label>
                                <input type="text" ng-model="user.employee_id" class="form-control" placeholder="Employee ID"/>
                                <i class="text-danger" ng-show="!user.employee_id && showError"><small>Please Type Employee ID</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>* User Type</label>
                                <select class="form-control form-control-lg" ng-model="user.user_type">
                                    <option value="">Select User Type</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Employee</option>
                                </select>
                                <i class="text-danger" ng-show="!user.user_type && showError"><small>Please User Type</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>* First Name:</label>
                                <input type="text" class="form-control" placeholder="Name" ng-model="user.first_name"/>
                                <i class="text-danger" ng-show="!user.first_name && showError"><small>Please Type Name</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Middle Name:</label>
                                <input type="text" class="form-control" placeholder="Middle Name" ng-model="user.middle_name"/>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" ng-model="user.last_name" class="form-control" placeholder="Last Name"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>* Father Name</label>
                                <input type="text" ng-model="user.father_name" class="form-control" placeholder="Father Name"/>
                                <i class="text-danger" ng-show="!user.father_name && showError"><small>Please Type Father Name</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Religion</label>
                                <input type="text" class="form-control" placeholder="Religion" ng-model="user.religion"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Sect</label>
                                <input type="text" ng-model="user.sect" class="form-control" placeholder="Sect"/>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Next of Kin</label>
                                <input type="text" ng-model="user.next_of_kin" class="form-control" placeholder="Next of Kin"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="text" ng-model="user.dob" class="form-control" placeholder="Date of Birth"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Nationality</label>
                                <input type="text" class="form-control" placeholder="Nationality" ng-model="user.nationality"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Marital Status</label>
                                <select class="form-control" ng-model="user.marital_status">
                                    <option value="">Select Marital Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                </select>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Domicile</label>
                                <input type="text" ng-model="user.domicile" class="form-control" placeholder="Domicile"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Proficiency in Languages</label>
                                <select class="form-control" ng-model="user.proficiency_languages">
                                    <option value="">Proficiency in Languages</option>
                                    <option value="Reading">Reading</option>
                                    <option value="Writing">Writing</option>
                                    <option value="Listening">Listening</option>
                                    <option value="Speaking">Speaking</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>* Gender</label>
                                <select class="form-control" ng-model="user.gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <i class="text-danger" ng-show="!user.gender && showError"><small>Please Select Gender</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>CNIC</label>
                                <input type="text" ng-model="user.cnic" class="form-control" placeholder="CNIC"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Contact Information</h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>* Email:</label>
                                <input type="email" class="form-control" ng-model="user.email" placeholder="Email Address"/>
                                <i class="text-danger" ng-show="!user.email && showError"><small>Please Type Email</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" ng-model="user.phone_number" placeholder="Phone Number"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>* Mobile Number</label>
                                <input type="text" class="form-control" ng-model="user.mobile_number" placeholder="Mobile Number"/>
                                <i class="text-danger" ng-show="!user.mobile_number && showError"><small>Please Type Mobile Number</small></i>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Fax Number</label>
                                <input type="text" class="form-control" ng-model="user.fax_number" placeholder="Fax Number"/>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text" class="form-control" ng-model="user.facebook" placeholder="Facebook"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Linkedin</label>
                                <input type="text" class="form-control" ng-model="user.linkedin" placeholder="Linkedin"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Whatsapp</label>
                                <input type="text" class="form-control" ng-model="user.whatsapp" placeholder="Whatsapp"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Twitter</label>
                                <input type="text" class="form-control" ng-model="user.twitter" placeholder="Twitter"/>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Instgram</label>
                                <input type="text" class="form-control" ng-model="user.instgram" placeholder="Instgram"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" class="form-control" ng-model="user.website" placeholder="Website"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Pinterest</label>
                                <input type="text" class="form-control" ng-model="user.pinterest" placeholder="Pinterest"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" class="form-control" ng-model="user.password" placeholder="Password"/>
                                <i class="text-danger" ng-show="!user.password && showError"><small>Please Type Password</small></i>
                            </div>
                        </div>
                    </div><br/>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-sm btn-info" ng-click="save_user()" data-toggle="tooltip" data-placement="bottom" title="Save">
                                    <i class="fa fa-save"></i>
                                </button>
                                <a href="{{url('hr/employees-addresses')}}" data-toggle="tooltip" data-placement="top" title="Next" type="button" class="btn btn-sm btn-primary">
                                    <i class="mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Employees</h3>
                </div>
                <div class="card-body">
                    <table border="0" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Employee Name</th>
                                <th>Employee ID</th>
                                <th>Nationality</th>
                                <th>Domicile</th>
                                <th>CNIC</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody ng-init="getEmployees();">
                            <tr ng-repeat="u in Users">
                                <td ng-bind="$index + 1"></td>
                                <td ng-bind="u.first_name"></td>
                                <td ng-bind="u.employee_id"></td>
                                <td ng-bind="u.nationality"></td>
                                <td ng-bind="u.domicile"></td>
                                <td ng-bind="u.cnic"></td>
                                <td>
                                    <button class="btn btn-xs btn-info" ng-click="editEmployeeInfo(u.id)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteEmployeeInfo(u.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div><br/>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Users = angular.module('UsersApp', []);
    Users.controller('UsersController', function ($scope, $http) {
        $("#employee").addClass('menu-open');
        $("#employee a[href='#']").addClass('active');
        $("#employee-info").addClass('active');
        $scope.getEmployees = function () {
            $(".loader").html('<div class="square-path-loader"></div>');
            $http.get('getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                    $(".loader").html('');
                }else{
                    $(".loader").html('');
                }
            });
        };
        //
        //        $scope.approve_user = function (user_id, status) {
        //            $http.get('approve_user/' + user_id + '/' + status).then(function (response) {
        ////                if (response.data.length > 0) {
        //                $scope.all_users();
        //                $scope.approve_status = response.data;
        ////                }
        //            });
        //        };
        $scope.user = {};
        $scope.save_user = function () {
            if (!$scope.user.first_name || !$scope.user.father_name || !$scope.user.password || !$scope.user.user_type || !$scope.user.gender) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.user, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('SaveUsers', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.user = {};
                    $scope.getEmployees();
                });
            }
        };

        $scope.editEmployeeInfo = function(id){
            $http.get('editEmployee/'+ id).then(function (response) {
                $scope.user = response.data;
                $scope.editContactInfo(response.data.contact_id);
                $scope.editSocialInfo(response.data.social_id);
                $("#ShowPrint").show();
            });
        };

        $scope.editContactInfo = function(con_id){
            $http.get('editContact/'+ con_id).then(function (response) {
                angular.extend($scope.user, response.data);
                /* $scope.user.email = parseInt(response.data.email);
                $scope.user.mobile_number = parseInt(response.data.mobile_number);
                $scope.user.phone_number = parseInt(response.data.phone_number);
                $scope.user.fax_number = parseInt(response.data.fax_number);
                $scope.user.whatsapp = parseInt(response.data.whatsapp); */
                $("#ShowPrint").show();
            });
        };

        $scope.editSocialInfo = function(soc_id){
            $http.get('editSocial/'+ soc_id).then(function (response) {
                angular.extend($scope.user, response.data);
                $("#ShowPrint").show();
            });
        };

        $scope.deleteEmployeeInfo = function(id){
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
                $http.delete('deleteEmployees/'+id).then(function (response) {
                    $scope.getEmployees();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

    });
</script>
@endsection