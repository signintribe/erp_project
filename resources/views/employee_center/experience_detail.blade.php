@extends('layouts.admin.master')
@section('title', 'Experience Detail')
@section('content')
<div  ng-app="ExperienceApp" ng-controller="ExperienceController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Experience Detail (If any)</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_employee">Select Employee</label>
                    <select class="form-control" id="select_employee" ng-model="experience.select_employee">
                        <option value="">Select Employee</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="designation">Worked as/Designation</label>
                    <input type="text" class="form-control" id="designation" ng-model="experience.designation" placeholder="Worked as/Designation"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="organization">Name of Organization</label>
                    <input type="text" class="form-control" id="organization" ng-model="experience.organization" placeholder="Name of Organization"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="reference_number">Contact Person</label>
                    <input type="text" class="form-control" id="reference_number" ng-model="experience.reference_number" placeholder="Contact Person in Organization"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="experience.phone_number" placeholder="Phone Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="experience.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="experience.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="experience.facebook" placeholder="Facebook"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="subjects" ng-model="experience.subjects" placeholder="Linkedin"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="experience.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="experience.instagram" placeholder="Instagram"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="experience.twitter" placeholder="Twitter"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="experience.email" placeholder="Email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="postal_address">Postal Address</label>
                    <input type="text" class="form-control" id="postal_address" ng-model="experience.postal_address" placeholder="Postal Address"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="street">Street</label>
                    <input type="text" class="form-control" id="street" ng-model="experience.street" placeholder="Street"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_purpose">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="experience.linkedin" placeholder="Sector/Mohallah"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="experience.country" placeholder="Country"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="experience.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="experience.city" placeholder="City"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="worked_from">Worked from</label>
                    <input type="text" class="form-control" id="worked_from" ng-model="experience.worked_from" placeholder="Worked from"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="worked_to">Worked to</label>
                    <input type="text" class="form-control" id="worked_to" ng-model="experience.worked_to" placeholder="Worked to"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_period">Total Period</label>
                    <input type="text" class="form-control" id="total_period" ng-model="experience.total_period" placeholder="Total Period"/>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="remarks_employee">Remarks of Employer</label>
                    <textarea class="form-control" id="remarks_employee" ng-model="experience.remarks_employee" placeholder="Remarks of Employer"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Experience = angular.module('ExperienceApp', []);
    Experience.controller('ExperienceController', function ($scope, $http) {

    });
</script>
@endsection