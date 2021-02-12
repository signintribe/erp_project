@extends('layouts.admin.master')
@section('title', 'Certification/Training Detail')
@section('content')
<div  ng-app="EmolumentsApp" ng-controller="EmolumentsController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Pay and Emoluments</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_employee">Select Employee</label>
                    <select class="form-control" id="select_employee" ng-model="emoluments.select_employee">
                        <option value="">Select Employee</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="basic_pay">Basic Pay</label>
                    <input type="text" class="form-control" id="basic_pay" ng-model="emoluments.basic_pay" placeholder="Basic Pay"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="medical_allowance">Medical Allowance</label>
                    <input type="text" class="form-control" id="medical_allowance" ng-model="emoluments.medical_allowance" placeholder="Medical Allowance"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="conveyance_allowance">Conveyance Allowance</label>
                    <input type="text" class="form-control" id="conveyance_allowance" ng-model="emoluments.conveyance_allowance" placeholder="Conveyance Allowance"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_type">Training Type</label>
                    <input type="text" class="form-control" id="training_type" ng-model="emoluments.training_type" placeholder="Training Type"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_institute">Training Institute</label>
                    <input type="text" class="form-control" id="training_institute" ng-model="emoluments.training_institute" placeholder="Training Institute"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_venue">Training Venue</label>
                    <input type="text" class="form-control" id="training_venue" ng-model="emoluments.training_venue" placeholder="Training Venue"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_referred_by">Training Referred by</label>
                    <input type="text" class="form-control" id="training_referred_by" ng-model="emoluments.training_referred_by" placeholder="Training Referred by"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="subjects">Subjects</label>
                    <input type="text" class="form-control" id="subjects" ng-model="emoluments.subjects" placeholder="Subjects"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_purpose">Purpose of Training</label>
                    <input type="text" class="form-control" id="training_purpose" ng-model="emoluments.training_purpose" placeholder="Purpose of Training"/>
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
    var Emoluments = angular.module('EmolumentsApp', []);
    Emoluments.controller('EmolumentsController', function ($scope, $http) {

    });
</script>
@endsection