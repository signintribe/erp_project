@extends('layouts.admin.master')
@section('title', 'Employee Leaves')
@section('content')
<div  ng-app="LeavesApp" ng-controller="LeavesController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h3 class="card-title btn btn-sm btn-link" style="cursor: text; text-decoration: none;">Employee Leaves</h3>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <a href="" class="btn btn-sm btn-info float-right">Assign Leaves</a>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>Total Leave</th>
                        <th>Availed Leave</th>
                        <th>Remaining Leave</th>
                        <th>Absent</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="leave in elavedetails">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Leaves = angular.module('LeavesApp', []);
    Leaves.controller('LeavesController', function ($scope, $http) {

    });
</script>
@endsection