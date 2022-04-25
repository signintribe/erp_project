@extends('layouts.admin.creationTier')
@section('title', 'Create Tasks')
@section('pagetitle', 'Create Tasks')
@section('breadcrumb', 'Create Tasks')
@section('content')
<div ng-controller="CreateTasksController">
    <div class="row" ng-init="resetscope();">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Tasks Detail</h3>
                </div>
                <div class="card-body">
                    <label for="Phase_name">Tasks Name</label>
                    <input type="text" ng-model="tasks.task_name" id="Phase_name" class="form-control">
                    <i class="text-danger" ng-show="!tasks.task_name && showError"><small>Please Type Tasks Name</small></i><br/>                
                    <label for="task_scope">Tasks Scope</label>
                    <input type="text" ng-model="tasks.task_scope" id="task_scope" class="form-control"><br/>
                    <label for="start_date">Start Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="todate" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="tasks.start_date" class="form-control datetimepicker-input" data-target="#todate"/>
                            <div class="input-group-append" data-target="#todate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div><br/>
                    <label for="end_date">End Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="fromdate" data-target-input="nearest">
                            <input type="text" placeholder="End Date" ng-model="tasks.end_date" class="form-control datetimepicker-input" data-target="#fromdate"/>
                            <div class="input-group-append" data-target="#fromdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div><br/>
                    <label for="priority">Priority</label>
                    <select ng-model="tasks.priority" id="priority" class="form-control">
                        <option value="">Please Select Priority</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div> 
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card" style="height: 563px">
                <div class="card-header">
                    <h3 class="card-title">Select Selections</h3>
                </div>
                <div class="card-body" style="overflow-y: scroll">
                    <div class="row">
                        <div class="col">
                            <label for="selectProejct">Select Project</label><br/>
                            <i class="text-danger" ng-show="!tasks.project_id && showError"><small>Please select Project</small></i><br/>
                            <div class="form-group clearfix" ng-repeat="proj in allProjects">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary<% proj.id %>" name="project" ng-click="getActivities(proj.id);" ng-model="tasks.project_id" ng-value="proj.id">
                                    <label for="radioPrimary<% proj.id %>" ng-bind="proj.project_name"></label>
                                </div>
                            </div>
                            <div class="text-center">
                                <i id="loader"></i>
                                <span ng-bind="nomore" ng-if="nomore"></span><br/>
                                <button class="btn btn-sm btn-primary" ng-if="allPhases.length > 19" ng-click="loadMore()" id="loadmore-btn"> <i class='fa fa-spinner'></i> Load More</button>
                            </div>
                        </div>
                        <div class="col">
                            <label for="selectActivities">Select Activity</label><br/>
                            <i class="text-danger" ng-if="activities" ng-show="!tasks.activity_id && showError"><small>Please select activity</small></i><br/>
                            <div class="form-group clearfix" ng-repeat="act in activities">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="activity<% act.id %>" name="activity" ng-click="getActivityPhases(act.id)" ng-model="tasks.activity_id" ng-value="act.id">
                                    <label for="activity<% act.id %>" ng-bind="act.activity_name"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label for="selectActivities">Select Phases</label><br/>
                            <i class="text-danger" ng-if="phases" ng-show="!tasks.phase_id && showError"><small>Please select Phases</small></i><br/>
                            <div class="form-group clearfix" ng-if="phases" ng-repeat="phs in phases">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="phases<% phs.id %>" name="phase" ng-model="tasks.phase_id" ng-value="phs.id">
                                    <label for="phases<% phs.id %>" ng-bind="phs.phase_name"></label>
                                </div>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col">
                        <button class="btn btn-sm btn-success" ng-click="saveTasks()"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Tasks</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Task Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Project Name</th>
                                    <th>Activity Name</th>
                                    <th>Phase Name</th>
                                    <th>Priority</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="tsk in allTasks">
                                    <td ng-bind="$index+1"></td>
                                    <td ng-bind="tsk.task_name"></td>
                                    <td ng-bind="tsk.start_date"></td>
                                    <td ng-bind="tsk.end_date"></td>
                                    <td ng-bind="tsk.project_name"></td>
                                    <td ng-bind="tsk.activity_name"></td>
                                    <td ng-bind="tsk.phase_name"></td>
                                    <td ng-bind="tsk.priority"></td>
                                    <td class="btn-group">
                                        <button class="btn btn-info btn-xs" ng-click="editTasks(tsk.id)">Edit</button>
                                        <button class="btn btn-danger btn-xs" ng-click="deletetasks(tsk.id)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <i id="loader-tasks"></i>
                            <span ng-bind="nomoretasks" ng-if="nomoretasks"></span><br/>
                            <button class="btn btn-sm btn-primary" ng-if="allTasks.length > 19" ng-click="loadMoreTasks()" id="loadmore-tasks-btn"> <i class='fa fa-spinner'></i> Load More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/project_system/tasks.js')}}"></script>
@endsection