@extends('layouts.admin.creationTier')
@section('title', 'Create Phases')
@section('pagetitle', 'Create Phases')
@section('breadcrumb', 'Create Phases')
@section('content')
<div ng-app="CreatePhasesApp" ng-controller="CreatePhasesController">
    <div class="row" ng-init="resetscope();">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Phase Detail</h3>
                </div>
                <div class="card-body">
                    <label for="Phase_name">Phase Name</label>
                    <input type="text" ng-model="phase.phase_name" id="Phase_name" class="form-control">
                    <i class="text-danger" ng-show="!phase.phase_name && showError"><small>Please Type Phase Name</small></i><br/>                
                    <label for="Phase_scope">Phase Scope</label>
                    <input type="text" ng-model="phase.phase_scope" id="Phase_scope" class="form-control"><br/>
                    <label for="start_date">Start Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="todate" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="phase.start_date" class="form-control datetimepicker-input" data-target="#todate"/>
                            <div class="input-group-append" data-target="#todate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div><br/>
                    <label for="end_date">End Date</label>
                    <div class="form-group">
                        <div class="input-group date" class="" id="fromdate" data-target-input="nearest">
                            <input type="text" placeholder="End Date" ng-model="phase.end_date" class="form-control datetimepicker-input" data-target="#fromdate"/>
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
                    <h3 class="card-title">Select Selections</h3>
                </div>
                <div class="card-body" style="overflow-y: scroll">
                    <div class="row">
                        <div class="col">
                            <label for="selectProejct">Select Project</label><br/>
                            <i class="text-danger" ng-show="!phase.project_id && showError"><small>Please select Project</small></i><br/>
                            <div class="form-group clearfix" ng-repeat="proj in allProjects">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary<% proj.id %>" name="project" ng-click="getActivities(proj.id);" ng-model="phase.project_id" ng-value="proj.id">
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
                            <i class="text-danger" ng-if="activities" ng-show="!phase.activity_id && showError"><small>Please select activity</small></i><br/>
                            <div class="form-group clearfix" ng-repeat="act in activities">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="activity<% act.id %>" name="activity" ng-model="phase.activity_id" ng-value="act.id">
                                    <label for="activity<% act.id %>" ng-bind="act.activity_name"></label>
                                </div>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col">
                        <button class="btn btn-sm btn-success" ng-click="savePhase()"><i class="fa fa-save"></i> Save</button>
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
                    <h3 class="card-title">All Phases</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Phase Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Project Name</th>
                                    <th>Activity Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="phs in allPhases">
                                    <td ng-bind="$index+1"></td>
                                    <td ng-bind="phs.phase_name"></td>
                                    <td ng-bind="phs.start_date"></td>
                                    <td ng-bind="phs.end_date"></td>
                                    <td ng-bind="phs.project_name"></td>
                                    <td ng-bind="phs.activity_name"></td>
                                    <td class="btn-group">
                                        <button class="btn btn-info btn-xs" ng-click="editPhase(phs.id)">Edit</button>
                                        <button class="btn btn-danger btn-xs" ng-click="deletePhases(phs.id)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <i id="loader-phases"></i>
                            <span ng-bind="nomorephases" ng-if="nomorephases"></span><br/>
                            <button class="btn btn-sm btn-primary" ng-if="allPhases.length > 19" ng-click="loadMorePhases()" id="loadmore-phases-btn"> <i class='fa fa-spinner'></i> Load More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/project_system/phases.js')}}"></script>
@endsection