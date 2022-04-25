@extends('layouts.admin.creationTier')
@section('title', 'Create Projects')
@section('pagetitle', 'Create Projects')
@section('breadcrumb', 'Create Projects')
@section('content')
<div ng-controller="CreateProjectsController">
    <div class="row" ng-init="resetscope();">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Project Detail</h3>
                </div>
                <div class="card-body">
                    <label for="project_name">Project Name</label>
                    <input type="text" ng-model="project.project_name" id="project_name" class="form-control">
                    <i class="text-danger" ng-show="!project.project_name && showError"><small>Please Type Project Name</small></i><br/>                
                    <label for="project_scope">Project Scope</label>
                    <input type="text" ng-model="project.project_scope" id="project_scope" class="form-control"><br/>
                    <label for="start_date">Start Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="todate" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="project.start_date" class="form-control datetimepicker-input" data-target="#todate"/>
                            <div class="input-group-append" data-target="#todate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div><br/>
                    <label for="end_date">End Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="fromdate" data-target-input="nearest">
                            <input type="text" placeholder="End Date" ng-model="project.end_date" class="form-control datetimepicker-input" data-target="#fromdate"/>
                            <div class="input-group-append" data-target="#fromdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div><br/>
                    <button class="btn btn-sm btn-success" ng-click="saveProject()"><i class="fa fa-save"></i> Save</button>
                </div> 
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Project Detail</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Project Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="proj in allprojects">
                                    <td ng-bind="$index+1"></td>
                                    <td ng-bind="proj.project_name"></td>
                                    <td ng-bind="proj.start_date"></td>
                                    <td ng-bind="proj.end_date"></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-info btn-xs" ng-click="eidtProject(proj.id)">Edit</button>
                                            <button class="btn btn-danger btn-xs" ng-click="deleteProject(proj.id)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <i id="loader"></i>
                            <span ng-bind="nomore" ng-if="nomore"></span><br/>
                            <button class="btn btn-sm btn-primary" ng-if="allprojects.length > 19" ng-click="loadMore()" id="loadmore-btn"> <i class='fa fa-spinner'></i> Load More</button>
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
<script src="{{asset('ng_controllers/project_system/projects.js')}}"></script>
@endsection