@extends('layouts.admin.creationTier')
@section('title', 'Create Activities')
@section('pagetitle', 'Create Activities')
@section('breadcrumb', 'Create Activities')
@section('content')
<div ng-controller="CreateActivitiesController">
    <div class="row" ng-init="resetscope();">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Activity Detail</h3>
                </div>
                <div class="card-body">
                    <label for="activity_name">Name of activity</label>
                    <input type="text" ng-model="activity.activity_name" id="activity_name" class="form-control">
                    <i class="text-danger" ng-show="!activity.activity_name && showError"><small>Please Type Name of activity</small></i><br/>                
                    <label for="activity_scope">Scope of activity</label>
                    <input type="text" ng-model="activity.activity_scope" id="activity_scope" class="form-control"><br/>
                    <label for="start_date">Start Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="todate" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="activity.start_date" class="form-control datetimepicker-input" data-target="#todate"/>
                            <div class="input-group-append" data-target="#todate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div><br/>
                    <label for="end_date">End Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="fromdate" data-target-input="nearest">
                            <input type="text" placeholder="End Date" ng-model="activity.end_date" class="form-control datetimepicker-input" data-target="#fromdate"/>
                            <div class="input-group-append" data-target="#fromdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div><br/>
                </div> 
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card" style="height: 493px">
                <div class="card-header">
                    <h3 class="card-title">Select Porject</h3>
                </div>
                <div class="card-body" style="overflow-y: scroll">
                    <i class="text-danger" ng-show="!activity.project_id && showError"><small>Please select project</small></i><br/>
                    <div class="form-group clearfix" ng-repeat="proj in allprojects">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary<% proj.id %>" name="project" ng-model="activity.project_id" ng-value="proj.id">
                            <label for="radioPrimary<% proj.id %>" ng-bind="proj.project_name"></label>
                        </div>
                    </div>
                    <div class="text-center">
                        <i id="loader"></i>
                        <span ng-bind="nomore" ng-if="nomore"></span><br/>
                        <button class="btn btn-sm btn-primary" ng-if="allprojects.length > 19" ng-click="loadMore()" id="loadmore-btn"> <i class='fa fa-spinner'></i> Load More</button>
                    </div>
                    <button class="btn btn-sm btn-success" ng-click="saveActivity()"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Project Name</th>
                                    <th>Activity Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="act in allactivities">
                                    <td ng-bind="$index+1"></td>
                                    <td ng-bind="act.project_name"></td>
                                    <td ng-bind="act.activity_name"></td>
                                    <td ng-bind="act.start_date"></td>
                                    <td ng-bind="act.end_date"></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-info" ng-click="editActivites(act.id)">Edit</button>
                                            <button class="btn btn-xs btn-danger" ng-click="deleteActivites(act.id);">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <i id="loader-activities"></i>
                            <span ng-bind="nomoreactivities" ng-if="nomoreactivities"></span><br/>
                            <button class="btn btn-sm btn-primary" ng-if="allactivities.length > 19" ng-click="loadMoreActivities()" id="loadmore-activities-btn"> <i class='fa fa-spinner'></i> Load More</button>
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
<script src="{{asset('ng_controllers/project_system/activities.js')}}"></script>
@endsection