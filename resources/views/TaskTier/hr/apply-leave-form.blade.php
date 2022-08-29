@extends('layouts.admin.taskTier')
@section('title', 'Leave Application Form')
@section('pagetitle', 'Leave Application Form')
@section('breadcrumb', 'Leave Application Form')
@section('content')
<style>
    .unread{
        color: black;
        font-weight: bold;
        background-color: #f4f0f0;
    }

    .reject{
        color: red;
        font-weight: normal;
        background-color: #f4f0f0;
    }

    .approve{
        color: green;
        font-weight: normal;
        background-color: #f4f0f0;
    }
</style>
<div ng-controller='ApplyleaveController' ng-cloak>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Leave Application Form <small><i class="text-danger" ng-if="servermessage" ng-bind="servermessage"></i></small></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <label for="required_from">* Leave Required From</label>
                    <div class="form-group">
                        <div class="input-group date" id="required_from" data-target-input="nearest">
                            <input type="text" placeholder="Leave Required From" ng-model="aplv.fromdate" class="form-control datetimepicker-input" data-target="#required_from"/>
                            <div class="input-group-append" data-target="#required_from" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <i class="text-danger" ng-show="!aplv.fromdate && showError"><small>Please Type Required From</small></i>
                </div>
                <div class="col-3">
                    <label for="required_to">* Leave Required To</label>
                    <div class="form-group">
                        <div class="input-group date" id="required_to" data-target-input="nearest">
                            <input type="text" placeholder="Leave Required To" ng-blur="dateDiff()" ng-model="aplv.todate" class="form-control datetimepicker-input" data-target="#required_to"/>
                            <div class="input-group-append" data-target="#required_to" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <i class="text-danger" ng-show="!aplv.todate && showError"><small>Please Type Required To</small></i>
                </div>
                <div class="col-3">
                    <label for="avail_leave">Leave availed so far</label>
                    <input type="text" ng-model="aplv.avail_leave" id="avail_leave" readonly ng-click="dateDiff()" placeholder="Leave availed so far" class="form-control">
                </div>
                <div class="col-3" ng-init="get_leaves();getEmployees();getLeaves();">
                    <label for="">* Type of Leave</label>
                    <div class="btn-group" style="width: 100%">
                        <button class="btn btn-secondary btn-md" type="button">
                            <span id="leave_type">Select Leave Type</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" style="width: 100%;">
                            <a class="dropdown-item" ng-click="leaveDetail(lv)" ng-repeat="lv in leaves" ng-bind="lv.leave_type" href="#"></a>
                        </div>
                    </div>
                    <i class="text-danger" ng-show="!aplv.leave_id && showError"><small>Please Select Leave Type</small></i>
                </div>
            </div><br>
            <div class="row">
                <div class="col-3">
                    <label for="available_balance">Leave Balance</label>
                    <input type="text" ng-model="aplv.available_balance" readonly id="available_balance" placeholder="Available Balance" class="form-control">
                </div>
                <div class="col-3">
                    <label for="attachment">Attacthment <small id="prfmsg"></small></label>
                    <input type="file" id="attachment" onchange="angular.element(this).scope().readUrl(this);" class="form-control">
                </div>
                <div class="col-3">
                    <label for="look_after">* Look after by</label>
                    <select ng-model="aplv.look_after" id="look_after" ng-options="user.id as user.first_name for user in Users" class="form-control">
                        <option value="">Select Look After By</option>
                    </select>
                    <i class="text-danger" ng-show="!aplv.look_after && showError"><small>Please Select Employee Look After By</small></i>
                </div> 
                <div class="col-3">
                    <label for="">Total Number of Leaves</label>
                    <input type="text"  ng-model="aplv.total_leave" readonly placeholder="Total Number of Leaves" id="" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-3">
                    <label for="">Perious Leave Balance</label>
                    <input type="text" ng-model="aplv.prev_balance" id="" readonly placeholder="Privious Leave Balance" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="leave_perpous">Leave Perpous</label>
                    <textarea ng-model="aplv.description" id="leave_perpous" class="form-control" cols="30" rows="5" placeholder="Leave Perpous. . ."></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <button class="btn-success btn btn-sm" ng-click="saveLeave()"> <i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Your Leaves History</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Available Balance</th>
                            <th>Leave So Far</th>
                            <th>Look After</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getLeaves();">
                        <tr ng-repeat="lvs in Leaves" ng-class="{unread: lvs.leave_status == 0, reject: lvs.leave_status == 2,  approve: lvs.leave_status == 1}">
                            <td ng-bind="lvs.leave_type"></td>
                            <td ng-bind="lvs.fromdate"></td>
                            <td ng-bind="lvs.todate"></td>
                            <td ng-bind="lvs.available_balance"></td>
                            <td ng-bind="lvs.avail_leave"></td>
                            <td ng-bind="lvs.first_name"></td>
                            <td>
                                <span ng-if="lvs.leave_status == 0" class="text-info">Pending</span>
                                <span ng-if="lvs.leave_status == 1" class="text-success">Approve</span>
                                <span ng-if="lvs.leave_status == 2" class="text-danger">Reject</span>
                                <!-- <div class="btn-group">
                                    <button class="btn btn-xs btn-info">Edit</button>
                                    <button class="btn btn-xs btn-danger">Delete</button>
                                </div> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-center">
                    <i id="data-loader"></i>
                </p>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/task_hr/apply-leave.js')}}"></script>
@endsection