@extends('layouts.admin.creationTier')
@section('title', 'Company Shift')
@section('pagetitle', 'Company Shift')
@section('breadcrumb', 'Company Shift')
@section('content')
<div ng-controller="ShiftsController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Company Shifts</h3>
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
                    <select ng-model="shift.company_id" ng-change="getoffice(shift.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="shift.office_id" ng-change="getDepartments(shift.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="shift.department_id" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!shift.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="shift_name">* Shift Name</label>
                    <input type="text" ng-model="shift.shift_name" id="shift_name" class="form-control" placeholder="Shift Name">
                    <i class="text-danger" ng-show="!shift.shift_name && showError"><small>Please Type Shift Name</small></i>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="description">Description</label>
                    <textarea ng-model="shift.description" id="description" cols="30" rows="10" class="form-control" placeholder="Add Description"></textarea>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <h5>Shift Timing</h5>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="start_time">Shift Start Timing</label>
                    <input type="text" ng-model="shift.shift_start_time" id="start_time" class="form-control" placeholder="Shift Start Timing">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="end_time">Shift End Timing</label>
                    <input type="text" ng-model="shift.shift_end_time" id="end_time" ng-blur="totalShiftHours()" class="form-control" placeholder="Shift End Timing">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="shift_hours">Total Shift Hours</label>
                    <p class="form-control" id="totalHours"></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5>Break Timing</h5>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="mealstart_time">Meal Break Start Timing</label>
                    <input type="text" ng-model="shift.mealbreak_start_time" id="mealstart_time" class="form-control" placeholder="Meal Break Start Timing">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="mealend_time">Meal Break End Timing</label>
                    <input type="text" ng-model="shift.mealbreak_end_time" ng-blur="totalMealBrake()" id="mealend_time" class="form-control" placeholder="Meal Break End Timing">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="totalmeal_hours">Meal break Time</label>
                    <p class="form-control" id="totalmeal_hours"></p>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="teastart_time">Tea Break Start Timing</label>
                    <input type="text" ng-model="shift.teabreak_start_time" id="teastart_time" class="form-control" placeholder="Tea Break Start Timing">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="teaend_time">Teak Break End Timing</label>
                    <input type="text" ng-model="shift.teabreak_end_time" ng-blur="totalTeaBreak()" id="teaend_time" class="form-control" placeholder="Teak Break End Timing">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="totaltea_hours">Tea break Time</label>
                    <p class="form-control" id="totaltea_hours"></p>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_breakhours">Total Break Hours</label>
                    <p class="form-control"  ng-bind="TotalBreakHours"></p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_workinghours">Total Working Hours</label>
                    <input type="text" ng-model="shift.total_workinhours" id="total_workinghours" class="form-control" placeholder="Total Working Hours">
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_shifts()"><i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-body">
            <div class="card-header">
                <h3 class="card-title">Get All Shifts</h3>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Shift Name</th>
                        <th>Start Timing</th>
                        <th>End Timing</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_shifts();">
                    <tr ng-repeat="s in shifts">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="s.company_name"></td>
                        <td ng-bind="s.office_name"></td>
                        <td ng-bind="s.department_name"></td>
                        <td ng-bind="s.shift_name"></td>
                        <td ng-bind="s.shift_start_time"></td>
                        <td ng-bind="s.shift_end_time"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="getoffice(s.company_id); getDepartments(s.office_id); editShift(s.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteShifts(s.id)">Delete</button>
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
<script src="{{asset('ng_controllers/creation_company/company-shift.js')}}"></script>
@endsection