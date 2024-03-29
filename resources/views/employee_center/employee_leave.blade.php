@extends('layouts.admin.creationTier')
@section('title', 'Employee Leave')
@section('pagetitle', 'Employee Leave')
@section('breadcrumb', 'Employee Leave')
@section('content')
<div ng-controller="LeavesController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <h3 class="card-title">Employee Leaves</h3>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <a href="" class="btn btn-sm btn-info float-right">Assign Leaves</a>
                </div>
            </div>
        </div>
        <div class="card-body">
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
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/employee_leave.js')}}"></script>
@endsection