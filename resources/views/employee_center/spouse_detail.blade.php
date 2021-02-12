@extends('layouts.admin.master')
@section('title', 'Family/Spouse Emergency Contact Person Details')
@section('content')
<div  ng-app="SpouseApp" ng-controller="SpouseController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Family/Spouse Emergency Contact Person Details</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="employee_name">* Select Employee Name</label>
                        <select id="employee_name" ng-model="user.employee_name" class="form-control">
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
                        <input type="text" id="dob" ng-model="user.dob" class="form-control" placeholder="Date of Birth"/>
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
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" ng-model="user.phone_number" class="form-control" placeholder="Phone Number"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" id="mobile_number" ng-model="user.mobile_number" class="form-control" placeholder="Mobile Number"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="fax_number">Fax Number</label>
                        <input type="text" id="fax_number" ng-model="user.fax_number" class="form-control" placeholder="Fax Number"/>
                    </div>
                </div>
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
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" id="twitter" ng-model="user.twitter" class="form-control" placeholder="Twitter"/>
                    </div>
                </div>
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
                        <label for="email">Email</label>
                        <input type="text" id="email" ng-model="user.email" class="form-control" placeholder="Email"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">Postal Address Line 1</label>
                        <input type="text" id="address_1" ng-model="user.address_1" class="form-control" placeholder="Postal Address Line 1"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Postal Address Line 2</label>
                        <input type="text" id="address_2" ng-model="user.address_2" class="form-control" placeholder="Postal Address Line 2"/>
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
                        <label for="country">Country</label>
                        <input type="text" id="country" ng-model="user.country" class="form-control" placeholder="Country"/>
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
                        <label for="city">City</label>
                        <input type="text" id="city" ng-model="user.city" class="form-control" placeholder="City"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button class="btn btn-sm btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Spouse = angular.module('SpouseApp', []);
    Spouse.controller('SpouseController', function ($scope, $http) {

    });
</script>
@endsection