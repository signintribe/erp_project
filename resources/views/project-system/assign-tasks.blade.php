@extends('layouts.admin.taskTier')
@section('title', 'Assign Tasks')
@section('pagetitle', 'Assign Tasks')
@section('breadcrumb', 'Assign Tasks')
@section('content')
<div ng-controller="AssignTaskController">
    <div class="card" ng-init="resetscope()">
        <div class="card-header">
            <h3 class="card-title">Add Project, Activity, Phase and Task</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office_id">* Select Office</label>
                    <select ng-model="task.office_id" ng-change="getDepartments(task.office_id)" ng-options="office.id as office.office_name for office in offices" id="office_id" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                    <i class="text-danger" ng-show="!task.office_id && showError"><small>Please Select Office</small></i><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department_id">* Select Department</label>
                    <select ng-model="task.department_id" id="department_id" ng-change="getGroups(task.department_id)" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!task.department_id && showError"><small>Please Select Department</small></i><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="group_id">* Select Employee Group</label>
                    <select ng-model="task.group_id" id="group_id" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!task.group_id && showError"><small>Please Select Employee Group</small></i><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="assign_employee_id">* Assign to Employee Name</label>
                    <select class="form-control" ng-options="user.id as user.first_name for user in Users" ng-model="task.assign_employee_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!task.assign_employee_id && showError"><small>Please Select Employee</small></i><br/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="supervise_employee_id">Supervis by</label>
                    <select class="form-control" ng-options="user.id as user.first_name for user in Users" ng-model="task.supervise_employee_id">
                        <option value="">Select Employee</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="reported_employee_id">Reported To</label>
                    <select class="form-control" ng-options="user.id as user.first_name for user in Users" ng-model="task.reported_employee_id">
                        <option value="">Select Employee</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="assignmentdate">Date of Assignment</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="assignmentdate" data-target-input="nearest">
                            <input type="text" placeholder="Assign Date" ng-model="task.assignment_date" class="form-control datetimepicker-input" data-target="#assignmentdate"/>
                            <div class="input-group-append" data-target="#assignmentdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Select Project</h3>
                </div>
                <div class="card-body" style="height:400px; overflow-y:scroll">
                    <i class="text-danger" ng-show="!tasks.project_id && showError"><small>Please select Project</small></i>
                    <div class="form-group clearfix" ng-repeat="proj in allProjects">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary<% proj.id %>" name="project" ng-click="getActivities(proj.id);" ng-model="task.project_id" ng-value="proj.id">
                            <label for="radioPrimary<% proj.id %>" ng-bind="proj.project_name"></label>
                        </div>
                    </div>
                    <div class="text-center">
                        <i id="loader"></i>
                        <span ng-bind="nomoreproject" ng-if="nomoreproject"></span><br/>
                        <button class="btn btn-sm btn-primary" ng-if="allProjects.length > 19" ng-click="loadMore()" id="loadmore-btn"> <i class='fa fa-spinner'></i> Load More</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Select Activity</h3>
                </div>
                <div class="card-body" style="height:400px; overflow-y:scroll">
                    <div class="form-group clearfix" ng-repeat="act in activities">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="activity<% act.id %>" name="activity" ng-click="getActivityPhases(act.id)" ng-model="task.activity_id" ng-value="act.id">
                            <label for="activity<% act.id %>" ng-bind="act.activity_name"></label>
                        </div>
                    </div>
                    <p ng-if="nomoreactivity" ng-bind="nomoreactivity"></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Select Phases</h3>
                </div>
                <div class="card-body" style="height:400px; overflow-y:scroll">
                    <div class="form-group clearfix" ng-if="phases" ng-repeat="phs in phases">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="phases<% phs.id %>" name="phase" ng-click="getPhasesTasks(phs.id)" ng-model="task.phase_id" ng-value="phs.id">
                            <label for="phases<% phs.id %>" ng-bind="phs.phase_name"></label>
                        </div>
                    </div>
                    <p ng-if="nomorephase" ng-bind="nomorephase"></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Select Tasks</div>
                <div class="card-body" style="height:400px; overflow-y:scroll">
                    <i class="text-danger" ng-show="!tasks.task_id && showError"><small>Please select Task</small></i>
                    <div class="form-group clearfix" ng-if="tasks" ng-repeat="tsk in tasks">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="tasks<% tsk.id %>" name="task" ng-model="task.task_id" ng-value="tsk.id">
                            <label for="tasks<% tsk.id %>" ng-bind="tsk.task_name"></label>
                        </div>
                    </div>
                    <p ng-if="nomoretask" ng-bind="nomoretask"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <button class="btn btn-md btn-success float-right" id="save-btn" ng-click="assignTask()"><i id="save-loader" class="fa fa-save"></i> Save</button>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo env("APP_URL"); ?>" id="app_url">
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/project_system/assign-task.js')}}"></script>
@endsection