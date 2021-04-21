@extends('layouts.admin.master')
@section('title', 'Contact Detail')
@section('content')
<div  ng-app="CustomerContactApp" ng-controller="CustomerContactController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Customer Contact</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_name">Name of Customer</label>
                    <select class="form-control" id="customer_name" ng-model="contact.customer_name">
                        <option value="">Select Customer Name</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="contact.phone_number" placeholder="Phone Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="contact.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="contact.facebook" placeholder="Facebook"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="contact.linkedin" placeholder="Linkedin"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="contact.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="contact.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="contact.email" placeholder="Email"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="contact.website" placeholder="Website"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="contact.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="contact.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="contact.instagram" placeholder="Instagram"/>
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
    var CustomerContact = angular.module('CustomerContactApp', []);
    CustomerContact.controller('CustomerContactController', function ($scope, $http) {

    });
</script>
@endsection