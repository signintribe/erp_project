@extends('layouts.subuser.master')
@section('title', 'View Quotations')
@section('content')
<div  ng-app="QuotationApp" ng-controller="QuotationController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Quotation</h3>
            
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Quotation = angular.module('QuotationApp', []);
    Quotation.controller('QuotationController', function ($scope, $http) {

    });
</script>
@endsection