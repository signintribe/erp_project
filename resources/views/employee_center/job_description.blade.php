@extends('layouts.admin.master')
@section('title', 'Job Description')
@section('content')
<div  ng-app="JobDescriptiontApp" ng-controller="JobDescriptionController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Job Description</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="select_employee">Select Employee</label>
                    <select class="form-control" id="select_employee" ng-model="jobdescription.select_employee">
                        <option value="">Select Employee</option>
                    </select>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="daily_task">Daily Task</label>
                    <textarea class="form-control" id="daily_task" rows="5" cols="5" ng-model="jobdescription.daily_task" placeholder="Daily Task"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label class="weekly_task">Weekly Task</label>
                    <textarea class="form-control" id="weekly_task" rows="5" cols="5" ng-model="jobdescription.weekly_task" placeholder="Weekly Task"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label class="monthly_task">Monthly Task</label>
                    <textarea class="form-control" id="monthly_task" rows="5" cols="5" ng-model="jobdescription.monthly_task" placeholder="Monthly Task"></textarea>
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
    var JobDescription = angular.module('JobDescriptiontApp', []);
    JobDescription.controller('JobDescriptionController', function ($scope, $http) {

    });
</script>
@endsection