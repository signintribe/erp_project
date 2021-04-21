@extends('layouts.admin.master')
@section('title', 'Contact Person')
@section('content')
<div  ng-app="PersonApp" ng-controller="PersonController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Organization Contact Person</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_name">Name of Organization</label>
                    <select class="form-control" ng-model="contactperson.org_name">
                        <option value="">Select Organization Name</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" ng-model="contactperson.title" placeholder="Title"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" ng-model="contactperson.first_name" placeholder="First Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" ng-model="contactperson.last_name" placeholder="Last Name"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="picture">Picture</label>
                    <input type="file" class="form-control" id="picture" ng-model="contactperson.picture" placeholder="Picture"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="contactperson.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="contactperson.phone_number" placeholder="Phone Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="contactperson.mobile_number" placeholder="Mobile Number"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="contactperson.fax_number" placeholder="Fax Number"/>
                </div>
               <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="contactperson.website" placeholder="Website"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="contactperson.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="contactperson.instagram" placeholder="Instagram"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="contactperson.linkedin" placeholder="Linkedin"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="contactperson.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="contactperson.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="contactperson.email" placeholder="Email"/>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Address detail of contact person</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line1">Postal Address Line 1</label>
                    <input type="text" class="form-control" id="address_line1" ng-model="contactperson.address_line1" placeholder="Postal Address Line 1"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line2">Postal Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" ng-model="contactperson.address_line2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector" ng-model="contactperson.sector" placeholder="Sector/Mohallah"/>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="contactperson.city" placeholder="City"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="contactperson.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="contactperson.country" placeholder="Country"/>
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
    var OrgContact = angular.module('PersonApp', []);
    OrgContact.controller('PersonController', function ($scope, $http) {

    });
</script>
@endsection