@extends('layouts.subuser.master')
@section('title', 'View Material Returned')
@section('content')
<div  ng-app="MaterialreturnedApp" ng-controller="MaterialreturnedController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">View Material Returned</h3>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Materialreturned = angular.module('MaterialreturnedApp', []);
    Materialreturned.controller('MaterialreturnedController', function ($scope, $http) {

    });
</script>
@endsection