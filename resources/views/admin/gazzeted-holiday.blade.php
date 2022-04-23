@extends('layouts.admin.creationTier')
@section('title', 'Gazzeted Holidaies')
@section('pagetitle', 'Gazzeted Holidaies')
@section('breadcrumb', 'Gazzeted Holidaies')
@section('content')
<div ng-controller="GHController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Gazzeted Holiday</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row" ng-init="getoffice(0)">
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="company" ng-init="all_companies();">Select Company</label>
                    <select ng-model="gh.company_id" ng-change="getoffice(gh.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="gh.office_id" ng-change="getDepartments(gh.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="gh.department_id" id="department" ng-change="getGroups(gh.department_id)" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!gh.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="group_id">* Select Employee Group</label>
                    <select ng-model="gh.group_id" id="employee-group" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!gh.group_id && showError"><small>Please Select Employee Group</small></i>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="holiday_name">* Holiday Name</label>
                    <input type="text" ng-model="gh.holiday_name" id="holiday_name" class="form-control" placeholder="Holiday Name">
                    <i class="text-danger" ng-show="!gh.holiday_name && showError"><small>Please Type Holiday Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="holiday_event">Holiday Event</label>
                    <input type="text" class="form-control" id="holiday_event" ng-model="gh.holiday_event" placeholder="Holiday Event">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="start_date">Start Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="start_date" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="gh.start_date" class="form-control datetimepicker-input" data-target="#start_date"/>
                            <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="end_date">End Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="end_date" data-target-input="nearest">
                            <input type="text" placeholder="End Date" ng-model="gh.end_date" class="form-control datetimepicker-input" data-target="#end_date"/>
                            <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_holiday()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Get All Gazzeted Holiday</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Holiday Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_holiday();">
                    <tr ng-repeat="h in holidays">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="h.company_name"></td>
                        <td ng-bind="h.office_name"></td>
                        <td ng-bind="h.department_name"></td>
                        <td ng-bind="h.holiday_name"></td>
                        <td ng-bind="h.start_date"></td>
                        <td ng-bind="h.end_date"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="getoffice(h.company_id); getDepartments(h.office_id); editHoliday(h.id); getGroups(h.department_id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteGazHoliday(h.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo env('APP_URL'); ?>" id="appurl">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_company/holiday.js')}}"></script>
@endsection