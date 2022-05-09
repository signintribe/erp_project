@extends('layouts.admin.creationTier')
@section('title', 'Company Group')
@section('pagetitle', 'Company Group')
@section('breadcrumb', 'Company Group')
@section('content')
<div ng-controller="GroupController" ng-cloak>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Add Employee Groups</h3>
                        </div>
                        <div class="col">
                            <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" ng-init="getoffice(0)">
                        <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="company" ng-init="all_companies();">Select Company</label>
                            <select ng-model="group.company_id" ng-change="getoffice(group.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                                <option value="">Select Company</option>
                            </select>
                        </div> -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="office">Select Office</label>
                            <select ng-model="group.office_id" ng-change="getDepartments(group.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                                <option value="">Select Office</option>
                            </select><br/>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="department">* Select Department</label>
                            <select ng-model="group.department_id" id="department" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                                <option value="">Select Department</option>
                            </select>
                            <i class="text-danger" ng-show="!group.department_id && showError"><small>Please Select Department</small></i><br/>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="group_name">* Group Name</label>
                            <input type="text" ng-model="group.group_name" id="group_name" class="form-control" placeholder="Group Name">
                            <i class="text-danger" ng-show="!group.group_name && showError"><small>Please Type Group Name</small></i><br/>
                        </div>
                    </div><br><!-- 
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="group_category">* Group Category</label>
                            <select ng-model="group.group_category" id="group_category" class="form-control">
                                <option value="">Group Category</option>
                            </select>
                        </div>
                    </div><br> -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="group_scope">Scope of Group</label>
                            <textarea ng-model="group.scope_group" id="group_scope" cols="30" rows="10" class="form-control" placeholder="Scope of Group"></textarea>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-sm btn-success" ng-click="save_group()"> <i id="loader" class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div><br>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="card d-print-none">
                <div class="card-header">
                    <h3 class="card-title">Get All Shifts</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm table-striped">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Company Name</th>
                                <th>Office Name</th>
                                <th>Department Name</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody ng-init="get_groups();">
                            <tr ng-repeat="g in allgroups">
                                <td ng-bind="$index+1"></td>
                                <td ng-bind="g.company_name"></td>
                                <td ng-bind="g.office_name"></td>
                                <td ng-bind="g.department_name"></td>
                                <td ng-bind="g.group_name"></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-info" ng-click="getoffice(g.company_id); getDepartments(g.office_id); editGroup(g.id)">Edit</button>
                                        <button class="btn btn-xs btn-danger" ng-click="deleteEmployeeGroup(g.id)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_company/employee-group.js')}}"></script>
@endsection