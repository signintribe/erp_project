@extends('layouts.admin.master')
@section('title', 'Educational Detail')
@section('content')
<div  ng-app="EducationApp" ng-controller="EducationController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Educational Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="select_employee">Select Employee</label>
                    <select class="form-control" id="select_employee" ng-model="education.employee">
                        <option value="">Select Employee</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="qualification_name">Qualification Name</label>
                    <input type="text" class="form-control" id="qualification_name" ng-model="education.qualification_name" placeholder="Qualification Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="passing_year">Passing Year</label>
                    <input type="text" class="form-control" id="passing_year" ng-model="education.passing_year" placeholder="Passing Year">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="subject">Specialization/Subjects</label>
                    <input type="text" class="form-control" id="subject" ng-model="education.subject" placeholder="Specialization/Subjects"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="institute">Institute / Board</label>
                    <input type="text" class="form-control" id="institute" ng-model="education.institute" placeholder="Institute/Board"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_marks">Total Marks</label>
                    <input type="text" class="form-control" id="total_marks" ng-model="education.total_marks" placeholder="Total Marks"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="obtain_marks">Obtain Marks</label>
                    <input type="text" class="form-control" id="obtain_marks" ng-model="education.obtain_marks" placeholder="Obtain Marks">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="grade">Grade</label>
                    <input type="text" class="form-control" id="grade" ng-model="education.grade" placeholder="Grade"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="division">Division</label>
                    <input type="text" class="form-control" id="division" ng-model="education.division" placeholder="Division"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="distinction">Distinction</label>
                    <input type="text" class="form-control" id="distinction" ng-model="education.distinction" placeholder="Distinction"/>
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
    var Education = angular.module('EducationApp', []);
    Education.controller('EducationController', function ($scope, $http) {

    });
</script>
@endsection