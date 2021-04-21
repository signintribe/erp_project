@extends('layouts.admin.master')
@section('title', 'View Store Requisition')
@section('content')
<div  ng-app="RequisitionApp" ng-controller="RequisitionController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Veiew Store Requisition</h3>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Requisition = angular.module('RequisitionApp', []);
    Requisition.controller('RequisitionController', function ($scope, $http) {

    });
</script>
@endsection