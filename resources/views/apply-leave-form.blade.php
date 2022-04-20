@extends('layouts.admin.taskTier')
@section('title', 'Leave Application Form') 
@section('pagetitle', 'Leave Application Form')
@section('breadcrumb', 'Leave Application Form')
@section('content')

<div ng-controller='ApplyleaveController' ng-app='ApplyleaveApp'>
    <form action="apply-leave-form" method="get">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Leave Application Form</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <label for="">Name Of Employee</label>
                        <select name="" id="" class="form-control">
                            <option value="">DDL</option>
                        </select>
                    </div>
                    <div class="col-4">
                    <label for=""> Department</label>
                    <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="">Designation</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-4">
                        <label for="">Type of Leave</label>
                        <select name="" id="" class="form-control">
                            <option value="">Short Leave</option>
                            <option value="">Casual Leave</option>
                            <option value="">Sick Leave</option>
                            <option value="">Maternity Leave</option>
                            <option value="">Annual Leave</option>
                            <option value="">Earned Leave</option>
                            <option value="">LPR</option>
                            <option value="">Marriage Leave</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="">Reason Of Leave</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="">Alternative</label>
                        <select name="" id="" class="form-control">
                            <option value="">DDL(employee)</option>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-4">
                        <label for="">To</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="">From</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="">Total Number oF Leaves</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-4">
                        <label for="">Perious Leave Balance</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <button class="btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="{{asset('public/js/angular.min.js')}}"></script>
<script>
    var Approval = angular.module('ApplyleaveApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    Approval.controller('ApplyleaveController', function ($scope, $http) {
        $("#hr").addClass('menu-open');
        $("#hr-active").addClass('active');
        $("#applyleave").addClass('active');
       
    });
 
</script>
@endsection