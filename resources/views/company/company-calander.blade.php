@extends('layouts.admin.creationTier')
@section('title', 'Company Calendar')
@section('pagetitle', 'Company Calendar')
@section('breadcrumb', 'Company Calendar')
@section('content')
<div ng-controller="CalanderController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Company Calendar</h3>
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
                    <select ng-model="calander.company_id" ng-change="getoffice(calander.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">* Select Office</label>
                    <select ng-model="calander.office_id" ng-change="getDepartments(calander.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                    <i class="text-danger" ng-show="!calander.office_id && showError"><small>Please Select Office</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">Select Department</label>
                    <select ng-model="calander.department_id" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_name">* Calander Name</label>
                    <input type="text" ng-model="calander.calender_name" id="calander_name" class="form-control" placeholder="Calander Name">
                    <i class="text-danger" ng-show="!calander.calender_name && showError"><small>Please Type Department Name</small></i>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_type">Calander Type</label>
                    <input type="text" ng-model="calander.calender_type" id="calander_type" class="form-control" placeholder="Calander Type">
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fiscal">Fiscal/Financial</label>
                    <select ng-model="calander.calender_type" id="fiscal" class="form-control">
                        <option value="">Select Fiscal / Financial</option>
                        <option value="Fiscal">Fiscal</option>
                        <option value="Financial">Financial</option>
                    </select>
                    <i class="text-danger" ng-show="!calander.calender_type && showError"><small>Please select fiscal/financial</small></i>
                </div>
            </div><br>
            <div class="row">                
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_year">Calander Year</label>
                    <select ng-model="calander.calender_year" id="calander_year" class="form-control" placeholder="Calander Year">
                        <option value="">Select Year</option>
                        @for ($i = 1970; $i <= 2050; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_start">* Calander Start Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="start_date" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="calander.calender_start_date" class="form-control datetimepicker-input" data-target="#start_date"/>
                            <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <i class="text-danger" ng-show="!calander.calender_start_date && showError"><small>Please type start date</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="calander_end">* Calander End Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="end_date" data-target-input="nearest">
                            <input type="text" placeholder="End Date" ng-model="calander.calender_end_date" class="form-control datetimepicker-input" data-target="#end_date"/>
                            <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <i class="text-danger" ng-show="!calander.calender_end_date && showError"><small>Please type end date</small></i>
                </div>
            </div><br>
            <!-- <div class="row">                
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_month">Total Month</label>
                    <input type="text" ng-model="calander.total_month" id="total_month" class="form-control" placeholder="Total Month">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_weeks">Total Weeks</label>
                    <input type="text" ng-model="calander.total_weeks" id="total_weeks" class="form-control" placeholder="Total Weeks">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_days">Total No. of Days</label>
                    <input type="text" ng-model="calander.total_days" id="total_days" class="form-control" placeholder="Total No. of Days">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_days">Working Days in a week</label>
                    <input type="text" ng-model="calander.daysin_week" id="working_days" class="form-control" placeholder="Working Days in a week">
                </div>
            </div><br>
            <div class="row">                
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_hours_days">Working Hours in a day</label>
                    <input type="text" ng-model="calander.daysin_hours" id="working_hours" class="form-control" placeholder="Working Hours in a day">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_hours_week">Working Hours in a week</label>
                    <input type="text" ng-model="calander.hoursin_week" id="working_hours_week" class="form-control" placeholder="Working Hours in a week">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="working_hours_months">Working Hours in a month</label>
                    <input type="text" ng-model="calander.daysin_month" id="working_hours_months" class="form-control" placeholder="Working Hours in a month">
                </div>
            </div><br> -->
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_calender()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Get All Company Calendars</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Calendar Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_calendars();">
                    <tr ng-repeat="calendar in calendars">
                        <td ng-bind="$index + 1"></td>
                        <td ng-bind="calendar.company_name"></td>
                        <td ng-bind="calendar.office_name"></td>
                        <td ng-bind="calendar.department_name"></td>
                        <td ng-bind="calendar.calender_name"></td>
                        <td ng-bind="calendar.calender_start_date"></td>
                        <td ng-bind="calendar.calender_end_date"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editCalendar(calendar.id, calendar.office_id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteCalendar(calendar.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo env('APP_URL'); ?>" id="appurl">
<input type="hidden" value="<?php echo Auth::user()->id; ?>" id="user_id">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_company/company-calander.js')}}"></script>
@endsection