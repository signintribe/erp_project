@extends('layouts.admin.master')
@section('title', 'Certification/Training Detail')
@section('content')
<div  ng-app="CertificationApp" ng-controller="CertificationController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Certification/Training Detail (If any)</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_employee">Select Employee</label>
                    <select class="form-control" id="select_employee" ng-model="education.select_employee">
                        <option value="">Select Employee</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="certification_name">Certification Name</label>
                    <input type="text" class="form-control" id="certification_name" ng-model="education.certification_name" placeholder="Certification Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="start_date">Start Date</label>
                    <input type="text" class="form-control" id="start_date" ng-model="education.start_date" placeholder="Start Date"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="end_date">End Date</label>
                    <input type="text" class="form-control" id="end_date" ng-model="education.end_date" placeholder="End Date"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_type">Training Type</label>
                    <input type="text" class="form-control" id="training_type" ng-model="education.training_type" placeholder="Training Type"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_institute">Training Institute</label>
                    <input type="text" class="form-control" id="training_institute" ng-model="education.training_institute" placeholder="Training Institute"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_venue">Training Venue</label>
                    <input type="text" class="form-control" id="training_venue" ng-model="education.training_venue" placeholder="Training Venue"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_referred_by">Training Referred by</label>
                    <input type="text" class="form-control" id="training_referred_by" ng-model="education.training_referred_by" placeholder="Training Referred by"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="subjects">Subjects</label>
                    <input type="text" class="form-control" id="subjects" ng-model="education.subjects" placeholder="Subjects"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_purpose">Purpose of Training</label>
                    <input type="text" class="form-control" id="training_purpose" ng-model="education.training_purpose" placeholder="Purpose of Training"/>
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
    var Certification = angular.module('CertificationApp', []);
    Certification.controller('CertificationController', function ($scope, $http) {

    });
</script>
@endsection