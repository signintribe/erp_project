@extends('layouts.admin.taskTier')
@section('title', 'Assigned Tasks')
@section('pagetitle', 'Assigned Tasks')
@section('breadcrumb', 'Assigned Tasks')
@section('content')
<div ng-app="AssignTaskApp" ng-controller="AssignTaskController">
    <div class="card" ng-init="resetscope()">
        <div class="card-header">
            <h3 class="card-title">View Project, Activity, Phase and Task</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Assigned To</th>
                            <th>Supervisor Name</th>
                            <th>Reported To</th>
                            <th>Task Name</th>
                            <th>Phase Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="tasks in allTasks">
                            <td ng-bind="$index+1"></td>
                            <td ng-bind="tasks.assign_emp_name"></td>
                            <td ng-bind="tasks.supervisor_name"></td>
                            <td ng-bind="tasks.reported_emp_name"></td>
                            <td ng-bind="tasks.task_name"></td>
                            <td ng-bind="tasks.phase_name"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#editTask" ng-click="editTask(tasks)">Edit</button>
                                    <button class="btn btn-xs btn-danger" ng-click="deleteTask(tasks.id);">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <i id="loader"></i><br/>
                    <p ng-if="nomore" ng-bind="nomore"></p>
                    <button class="btn btn-md btn-primary" id="loadmore-btn" ng-if="allTasks.length>19" ng-click="loadMore()">Load More</button>
                </div>
                <div class="modal fade" id="editTask">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Extra Large Modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card" ng-init="resetscope()">
                                    <div class="card-header">
                                        <h3 class="card-title">Add Project, Activity, Phase and Task</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <label for="office_id">* Select Office</label>
                                                <select ng-model="task.office_id" ng-change="getDepartments(task.office_id)" ng-options="office.id as office.office_name for office in offices" id="office_id" class="form-control">
                                                    <option value="">Select Office</option>
                                                </select>
                                                <i class="text-danger" ng-show="!task.office_id && showError"><small>Please Select Office</small></i><br/>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <label for="department_id">* Select Department</label>
                                                <select ng-model="task.department_id" id="department_id" ng-change="getGroups(task.department_id)" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                                                    <option value="">Select Department</option>
                                                </select>
                                                <i class="text-danger" ng-show="!task.department_id && showError"><small>Please Select Department</small></i><br/>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <label for="group_id">* Select Employee Group</label>
                                                <select ng-model="task.group_id" id="group_id" ng-options="group.id as group.group_name for group in groups" class="form-control">
                                                    <option value="">Select Employee Group</option>
                                                </select>
                                                <i class="text-danger" ng-show="!task.group_id && showError"><small>Please Select Employee Group</small></i><br/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <label for="assign_employee_id">* Assign to Employee Name</label>
                                                <select class="form-control" ng-options="user.id as user.first_name for user in Users" ng-model="task.assign_employee_id">
                                                    <option value="">Select Employee</option>
                                                </select>
                                                <i class="text-danger" ng-show="!task.assign_employee_id && showError"><small>Please Select Employee</small></i><br/>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <label for="supervise_employee_id">Supervis by</label>
                                                <select class="form-control" ng-options="user.id as user.first_name for user in Users" ng-model="task.supervise_employee_id">
                                                    <option value="">Select Employee</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <label for="reported_employee_id">Reported To</label>
                                                <select class="form-control" ng-options="user.id as user.first_name for user in Users" ng-model="task.reported_employee_id">
                                                    <option value="">Select Employee</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
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
                                        <p ng-click="selectNewTask()" style="cursor: pointer">
                                            <span ng-bind="task.project_name"></span> &nbsp; <i class="fa fa-chevron-circle-right"></i> &nbsp; 
                                            <span ng-bind="task.activity_name"></span> &nbsp; <i class="fa fa-chevron-circle-right"></i> &nbsp; 
                                            <span ng-bind="task.phase_name"></span> &nbsp; <i class="fa fa-chevron-circle-right"></i> &nbsp; 
                                            <span ng-bind="task.task_name"></span> &nbsp; &nbsp; &nbsp;
                                            <span>Edit</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row" style="display:none" id="newTask">
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
                                                <div class="form-group clearfix" ng-repeat="phs in phases">
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
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button class="btn btn-md btn-success float-right" id="save-btn" ng-click="assignTask()"><i id="save-loader" class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo env("APP_URL"); ?>" id="app_url">
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var AssignTask = angular.module('AssignTaskApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    AssignTask.controller('AssignTaskController', function ($scope, $http) {
        $("#ps").addClass('menu-open');
        $("#ps-active").addClass('active');
        $("#assigned-tasks").addClass('active');
        $('#assignmentdate').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $scope.resetscope = function(){
            $scope.task = {};
            $scope.getassignedtasks();
            $scope.getalloffice();
            $scope.getEmployees();
            $scope.getProjects();
        };

        $scope.getalloffice = function () {
            $scope.alloffice = {};
            $http.get($("#app_url").val() + 'company/office-settings').then(function (response) {
                if (response.data.length > 0) {
                    $scope.offices = response.data;
                }
            });
        };

        $scope.getEmployees = function () {
            $http.get($("#app_url").val() + 'hr/getEmployees').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Users = response.data;
                }
            });
        };

        $scope.selectNewTask = function(){
            $("#newTask").slideToggle('slow');
        };

        $scope.editTask = function(task){
            $scope.task = task;
            $scope.task.group_id = parseInt(task.group_id);
            $scope.task.department_id = parseInt(task.department_id);
            $scope.task.office_id = parseInt(task.office_id);
            $scope.task.assign_employee_id = parseInt(task.assign_employee_id);
            $scope.task.reported_employee_id = parseInt(task.reported_employee_id);
            $scope.task.supervise_employee_id = parseInt(task.supervise_employee_id);
            $scope.getDeptAndOffice($scope.task.group_id);
            $scope.getActivities(task.project_id);
            $scope.getActivityPhases(task.activity_id);
            $scope.getPhasesTasks(task.phase_id);
        };

        $scope.getActivities = function(project_id){
            //$scope.task.activity_id = 0;
            $http.get('get-project-activities/'+ project_id + '/' + $("#company_id").val()).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.activities = response.data.data;
                    /* $scope.phases = {};
                    $scope.tasks = {}; */
                    $scope.nomoreactivity = "";
                }else{
                    $scope.nomoreactivity = "There is no activities";
                }
            });
        };

        $scope.getActivityPhases = function(activity_id){
            //$scope.task.phase_id = 0;
            $http.get('get-activity-phases/'+ activity_id + '/' + $("#company_id").val()).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.phases = response.data.data;
                    $scope.tasks = {};
                    $scope.nomorephase = "";
                }else{
                    $scope.nomorephase = "There is no phases";
                }
            });
        };

        $scope.getPhasesTasks = function(phase_id){
            //$scope.task.task_id = 0;
            $http.get('get-phases-tasks/'+ phase_id + '/' + $("#company_id").val()).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.tasks = response.data.data;
                    $scope.nomoretask ="";
                }else{
                    $scope.nomoretask = "There is no tasks";
                }
            });
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
                    $scope.nomoreproject = "There is no projects";
                    $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                }
            });
        };

        $scope.getDepartments = function (office_id) {
            $scope.departments = {};
            $http.get($("#app_url").val() + 'company/get-departments/'+office_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.departments = response.data;
                }
            });
        };

        $scope.getGroups = function (dep_id) {
            $scope.groups = {};
            $http.get($("#app_url").val() + 'company/get-groups/' + dep_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.groups = response.data;
                }
            });
        };

        $scope.getDeptAndOffice = function (group_id) {
            $scope.groups = {};
            $http.get($("#app_url").val() + 'project-system/get-department-office/' + group_id).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.getDepartments(response.data.data[0].office_id);
                    $scope.getGroups(response.data.data[0].department_id);
                    $scope.task.office_id = response.data.data[0].office_id;
                    $scope.task.department_id = response.data.data[0].department_id;
                }
            });
        };

        $scope.getassignedtasks = function(){
            $("#loader").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
            $scope.offset = 0;
            $scope.limit = 20;
            var arr = {
                'offset':$scope.offset,
                'limit':$scope.limit,
                'company_id': $("#company_id").val()
            };
            $http.get('assign-task/'+ JSON.stringify(arr)).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.allTasks = response.data.data;
                    $scope.offset += $scope.limit;
                    $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                    $("#loadmore-btn").show('slow');
                }else{
                    $("#loadmore-btn").hide('slow');
                    $scope.nomore = "There is no projects";
                    $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                }
            });
        };
        
        $scope.loadMore = function(){
            $("#loader").addClass('fa fa-spinner fa-fw fa-3x fa-pulse');
            var arr = {
                'offset':$scope.offset,
                'limit':$scope.limit,
                'company_id': $("#company_id").val()
            };
            $http.get('assign-task/'+ JSON.stringify(arr)).then(function (response) {
                if (response.data.data.length > 0) {
                    $scope.allTasks = $scope.allTasks.concat(response.data.data);
                    $scope.offset += $scope.limit;
                    $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                    $("#loadmore-btn").show('slow');
                }else{
                    $("#loadmore-btn").hide('slow');
                    $scope.nomore = "There is no projects";
                    $("#loader").removeClass("fa fa-spinner fa-fw fa-3x fa-pulse");
                }
            });
        };

        $scope.deleteTask = function(task_id){
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
                $http.delete('assign-task/' + task_id).then(function (response) {
                    if(response.data.status == true){
                        swal("Deleted!", response.data.message, "success");
                        $scope.resetscope();
                    }else{
                        swal("Error!", response.data.message, "error");
                    }
                });
            });
        };

        $scope.assignTask = function(){
            if(!$scope.task.office_id || !$scope.task.department_id || !$scope.task.department_id || !$scope.task.assign_employee_id || !$scope.task.group_id || !$scope.task.project_id){
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            }else{
                $(".btn-success i").removeClass('fa-save').addClass('fa-spinner fa-fw fa-pulse');
                $scope.task.assignment_date = $("#assignmentdate input").val();
                $scope.task.company_id = $("#company_id").val();
                $scope.appurl = $("#appurl").val();
                var Data = new FormData();
                angular.forEach($scope.task, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('assign-task', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    if(res.data.status == true){
                        swal({
                            title: "Save!",
                            text: res.data.message,
                            type: "success"
                        });
                        $scope.task = {};
                        $scope.activities = {};
                        $scope.phases = {};
                        $scope.tasks = {};
                        $scope.resetscope();
                        $(".btn-success i").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                    }
                });
            }
        };
    });
</script>
@endsection