@extends('layouts.admin.creationTier')
@section('title', 'Designation Form')
@section('pagetitle', 'Designation Form')
@section('breadcrumb', 'Designation Form')
@section('content')

<div ng-app="DesigntionApp" ng-controller='DesigntionController'>
<form action="destination" method="get">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class='col-5'>
                    <label>Designation Name</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class='col-5'>
                    <label>Short Name</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-2">
                    <label for="">Status</label><br>
                    <input type="checkbox" name="" id=""><label for="">Active</label>
                </div>
            </div><br>
            <div class="row">
                <div class="col-6">
                    <label for="">Employee Group</label>
                    <select name="" id="" class="form-control">
                        <option value="">DDL</option>
                    </select>
                </div>
                <div class="col-6">
                    <label>Attachment</label>
                    <input type="file" name="" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-12">
                    <label>Breif Description</label>
                    <textarea type="text" name="" id="" class="form-control"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <button class="btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
     var BankDetail = angular.module('DesigntionApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    BankDetail.controller('DesigntionController', function ($scope, $http) {
        $("#company").addClass('menu-open');
        $("#company a[href='#']").addClass('active');
        $("#company-designation").addClass('active');
       
    });
 
</script>
@endsection