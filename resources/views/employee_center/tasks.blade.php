@extends('layouts.admin.creationTier')
@section('title', 'Employee Tast Details')
@section('pagetitle', 'Employee Tast Details')
@section('breadcrumb', 'Employee Tast Details')
@section('content')
<div ng-controller="TasksController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tasks Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <div class="form-group">
                        <label for="select_employee">* Select Employee</label>
                        <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="task.employee_id">
                            <option value="">Select Employee</option>
                        </select>
                        <i class="text-danger" ng-show="!task.employee_id && showError"><small>Please Select Employee</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="task_name">Name of Task</label>
                    <input type="text" class="form-control" id="task_name" ng-model="task.task_name" placeholder="Name of Task"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="task_date">Task Assignment Date</label>
                    <input type="text" class="form-control" id="task_date" ng-model="task.task_date" placeholder="Task Assignment Date"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="expected_date">Expected Task Completion Date</label>
                    <input type="text" class="form-control" id="expected_date" ng-model="task.expected_date" placeholder="Expected Task Completion Date"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="completion_status">Status of Completion</label>
                    <select class="form-control" id="completion_status" ng-model="task.completion_status">
                        <option value="">Status of Completion</option>
                        <option value="InProgess">In Progress</option>
                        <option value="complete">Complete</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>
                <div class='col-lg-3 col-md-3 col-sm-3'>
                    <div class="form-group">
                        <label for="cat-img">Attachment</label>
                        <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);" >
                    </div>
                </div> 
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="completion_date">Task Completion Date</label>
                    <input type="text" class="form-control" id="completion_date" ng-model="task.completion_date" placeholder="Task Completion Date"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="delay_task">Delay period in completion of task</label>
                    <input type="text" class="form-control" id="delay_task" ng-model="task.delay_task" placeholder="Delay period in completion of task"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="save_days">Days saved in completion of task</label>
                    <input type="text" class="form-control" id="save_days" ng-model="task.save_days" placeholder="Days saved in completion of task"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="efficiency">Status of Efficiency</label>
                    <input type="text" class="form-control" id="efficiency" ng-model="task.efficiency" placeholder="Status of Efficiency"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="negligency">Status of Negligency</label>
                    <input type="text" class="form-control" id="negligency" ng-model="task.negligency" placeholder="Status of Negligency"/>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="team">Team Assigned for completion of task</label>
                    <select class="form-control" id="team" ng-model="task.team">
                        <option value="">Team Assigned for completion of task</option>
                    </select>
                </div> -->
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Task Assigned By</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mast_company">Master Company</label>
                    <input type="text" class="form-control" id="master_company" ng-model="task.master_company" placeholder="Master Company"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="child_comapny">Branch/Child Company</label>
                    <input type="text" class="form-control" id="child_comapny" ng-model="task.child_company" placeholder="Branch/Child Company"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department_name">Name of Department</label>
                    <input type="text" class="form-control" id="department_name" ng-model="task.department_name" placeholder="Name of Department"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="supervisor">Name of Supervisor/Senior</label>
                    <input type="text" class="form-control" id="supervisor" ng-model="task.supervisor" placeholder="Name of Supervisor/Senior"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="supervisor_designation">Designation of Supervisor/Senior</label>
                    <input type="text" class="form-control" id="supervisor_designation" ng-model="task.supervisor_designation" placeholder="Designation of Supervisor/Senior"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng_click="save_task()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tasks Detail</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Task Name</th>
                        <th>Task Assignment Date</th>
                        <th>Expected Task Completion Date</th>
                        <th>Status of Completion</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getTaskDetails()">
                    <tr ng-repeat="task in taskdetails">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="task.employee_name"></td>
                        <td ng-bind="task.task_name"></td>
                        <td ng-bind="task.task_date"></td>
                        <td ng-bind="task.expected_date"></td>
                        <td ng-bind="task.completion_status"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editTaskDetail(task.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteTaskDetail(task.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/tasks.js')}}"></script>
@endsection