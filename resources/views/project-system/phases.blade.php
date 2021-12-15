@extends('layouts.admin.creationTier')
@section('title', 'Create Projects')
@section('pagetitle', 'Create Projects')
@section('breadcrumb', 'Create Projects')
@section('content')
<div ng-app="CreateProjectsApp" ng-controller="CreateProjectsController">
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
                    <button class="btn bt-md btn-success" ng-click="saveProject()"><i class="fa fa-save"></i> Save</button>
                </div> 
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Project Detail</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <i class="text-danger" ng-show="!activity.project_id && showError"><small>Please select project</small></i><br/>
                            <div class="form-group clearfix" ng-repeat="proj in allprojects">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary<% proj.id %>" name="project" ng-click="getActivities(proj.id);" ng-model="activity.project_id" ng-value="proj.id">
                                    <label for="radioPrimary<% proj.id %>" ng-bind="proj.project_name"></label>
                                </div>
                            </div>
                            <div class="text-center">
                                <i id="loader"></i>
                                <span ng-bind="nomore" ng-if="nomore"></span><br/>
                                <button class="btn btn-sm btn-primary" ng-if="allprojects.length > 19" ng-click="loadMore()" id="loadmore-btn"> <i class='fa fa-spinner'></i> Load More</button>
                            </div>
                        </div>
                        <div class="col"></div>
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

    var CreateProjects = angular.module('CreateProjectsApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    CreateProjects.controller('CreateProjectsController', function ($scope, $http) {
        $("#ps-open").addClass('menu-open');
        $("#ps-active").addClass('active');
        $("#create-project").addClass('active');

        $('#todate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#fromdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $scope.resetscope = function(){
            $scope.getProjects();
            $scope.phase = {};
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
                    $scope.allprojects = response.data.data;
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

        $scope.loadMore = function(){
            $("#loadmore-btn i").addClass('fa-fw fa-pulse');
            var arr = {
                'offset':$scope.offset,
                'limit':$scope.limit,
                'company_id': $("#company_id").val()
            };
            $http.get('create-projects/'+ JSON.stringify(arr)).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.allprojects = response.data.data;
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
            $http.get('get-project-activities/'+ project_id).then(function (response) {
                if (response.data.status == true) {
                    $scope.activities = response.data.data;
                }else{
                    $scope.nomore = "There is no data";
                }
            });
        };

        $scope.eidtProject = function(id){
            $http.get('create-projects/'+ id + '/edit').then(function (response) {
                if (response.data.status == true) {
                    $scope.project = response.data.data;
                }else{
                    $scope.nomore = "There is no more data";
                    $("#loadmore-btn").hide('slow');
                }
            });
        };
        
        $scope.deleteProject = function(id){
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
                $http.delete('create-projects/' + id).then(function (response) {
                    if(response.data.status == true){
                        swal("Deleted!", response.data.message, "success");
                        $scope.resetscope();
                    }else{
                        swal("Error!", response.data.message, "error");
                    }
                });
            });
        };

        $scope.saveProject = function(){
            if(!$scope.project.project_name){
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            }else{
                $(".btn-success i").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
                $scope.project.start_date = $("#todate input").val();
                $scope.project.end_date = $("#fromdate input").val();
                $scope.project.company_id = $("#company_id").val();
                $scope.appurl = $("#appurl").val();
                var Data = new FormData();
                angular.forEach($scope.project, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('create-projects', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal({
                            title: "Save!",
                            text: res.data.message,
                            type: "success"
                        });
                        $scope.project = {};
                        $scope.resetscope();
                        $(".btn-success i").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                    }
                });
            }
        };
    });
</script>
@endsection