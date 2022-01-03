@extends('layouts.admin.creationTier')
@section('title', 'Create Tasks')
@section('pagetitle', 'Create Tasks')
@section('breadcrumb', 'Create Tasks')
@section('content')
<div ng-app="CreateTasksApp" ng-controller="CreateTasksController">
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
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var TasksPhases = angular.module('CreateTasksApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    TasksPhases.controller('CreateTasksController', function ($scope, $http) {
        $("#ps-open").addClass('menu-open');
        $("#ps-active").addClass('active');
        $("#create-tasks").addClass('active');

        $('#todate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#fromdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $scope.resetscope = function(){
            $scope.getProjects();
            $scope.getTasks();
            $scope.tasks = {};
        };

        $scope.getProjects = function(){
            $("#loader").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
            $scope.offset = 0;
            $scope.limit = 20;
            var arr = {
                'offset':$scope.offset,
                'limit':$scope.limit,
                'company_id': $("#company_id").val()
            };
            $http.get('create-projects/'+ JSON.stringify(arr)).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.allProjects = response.data.data;
                    $scope.offset += $scope.limit;
                    $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                    $("#loadmore-btn").show('slow');
                }else{
                    $("#loadmore-btn").hide('slow');
                    $scope.nomore = "There is no data";
                    $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                }
            });
        };

        $scope.getTasks = function(){
            $("#loader-tasks").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
            $scope.offset = 0;
            $scope.limit = 20;
            var arr = {
                'offset':$scope.offset,
                'limit':$scope.limit,
                'company_id': $("#company_id").val()
            };
            $http.get('create-tasks/'+ JSON.stringify(arr)).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.allTasks = response.data.data;
                    $scope.offset += $scope.limit;
                    $("#loader-tasks").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                    $("#loadmore-tasks-btn").show('slow');
                }else{
                    $("#loadmore-tasks-btn").hide('slow');
                    $scope.nomorephases = "There is no data";
                    $("#loader-tasks").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                }
            });
        };

        $scope.loadMorePhases = function(){
            $("#loader-phases").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
            var arr = {
                'offset':$scope.offset,
                'limit':$scope.limit,
                'company_id': $("#company_id").val()
            };
            $http.get('create-phases/'+ JSON.stringify(arr)).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.allPhases = $scope.allPhases.concat(response.data.data);
                    $scope.offset += $scope.limit;
                    $("#loader-phases").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                    $("#loadmore-phases-btn").show('slow');
                }else{
                    $("#loadmore-phases-btn").hide('slow');
                    $scope.nomorephases = "There is no data";
                    $("#loader-phases").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                }
            });
        };

        $scope.loadMore = function(){
            $("#loadmore-btn i").addClass('fa-fw fa-pulse');
            var arr = {
                'offset':$scope.offset,
                'limit':$scope.limit,
                'company_id': $("#company_id").val()
            };
            $http.get('create-projects/'+ JSON.stringify(arr)).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.allPhases = response.data.data;
                    $scope.offset += $scope.limit;
                    $("#loadmore-btn i").addClass('fa-fw fa-pulse');
                    $("#loadmore-btn").show('slow');
                }else{
                    $scope.nomore = "There is no more data";
                    $("#loadmore-btn").hide('slow');
                    $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                }
            });
        };

        $scope.getActivities = function(project_id){
            $scope.tasks.activity_id = 0;
            $http.get('get-project-activities/'+ project_id + '/' + $("#company_id").val()).then(function (response) {
                if (response.data.status == true) {
                    $scope.activities = response.data.data;
                    $scope.phases = {};
                }else{
                    $scope.nomore = "There is no data";
                }
            });
        };

        $scope.getActivityPhases = function(activity_id){
            $scope.tasks.phase_id = 0;
            $http.get('get-activity-phases/'+ activity_id + '/' + $("#company_id").val()).then(function (response) {
                if (response.data.status == true) {
                    $scope.phases = response.data.data;
                }else{
                    $scope.nomore = "There is no data";
                }
            });
        };

        $scope.editTasks = function(id){
            $http.get('create-tasks/'+ id + '/edit').then(function (response) {
                if (response.data.status == true) {
                    $scope.getActivities(response.data.data[0].project_id);
                    $scope.getActivityPhases(response.data.data[0].activity_id);
                    $scope.tasks = response.data.data[0];
                    $scope.tasks.project_id = parseInt(response.data.data[0].project_id);
                    $scope.tasks.activity_id = parseInt(response.data.data[0].activity_id);
                    $scope.tasks.phase_id = parseInt(response.data.data[0].phase_id);
                }else{
                    $scope.nomore = "There is no more data";
                    $("#loadmore-btn").hide('slow');
                }
            });
        };
        
        $scope.deletetasks = function(id){
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('create-tasks/' + id).then(function (response) {
                    if(response.data.status == true){
                        swal("Deleted!", response.data.message, "success");
                        $scope.resetscope();
                    }else{
                        swal("Error!", response.data.message, "error");
                    }
                });
            });
        };

        $scope.saveTasks = function(){
            if(!$scope.tasks.task_name || !$scope.tasks.project_id || !$scope.tasks.activity_id || !$scope.tasks.phase_id){
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            }else{
                $(".btn-success i").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
                $scope.tasks.start_date = $("#todate input").val();
                $scope.tasks.end_date = $("#fromdate input").val();
                $scope.tasks.company_id = $("#company_id").val();
                $scope.appurl = $("#appurl").val();
                var Data = new FormData();
                angular.forEach($scope.tasks, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('create-tasks', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal({
                            title: "Save!",
                            text: res.data.message,
                            type: "success"
                        });
                        $scope.tasks = {};
                        $scope.activities = {};
                        $scope.phases = {};
                        $scope.resetscope();
                        $(".btn-success i").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                    }
                });
            }
        };
    });
</script>
@endsection