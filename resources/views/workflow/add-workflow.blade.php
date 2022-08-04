@extends('layouts.admin.taskTier')
@section('title', 'Add Workflow')
@section('pagetitle', 'Add Workflow')
@section('breadcrumb', 'Add Workflow')
@section('content')
<style>
    #search-box{
        box-shadow: 2px 7px 16px -2px rgba(0,0,0,0.75);
        -webkit-box-shadow: 2px 7px 16px -2px rgba(0,0,0,0.75);
        -moz-box-shadow: 2px 7px 16px -2px rgba(0,0,0,0.75);
        position: absolute; 
        background-color: #fff; 
        border-radius: 0px 5px 5px 0px; 
        width: 93%; 
        z-index:1000;
        padding: 10px;
        display: none;
    }
</style>
<div ng-controller="WorkflowController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Workflow Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="workflow-for">* Workflow For</label>
                    <select ng-model="workflow.searchfor" id="workflow-for" class="form-control">
                        <option value="">Workflow For</option>
                        <option value="Leave">Leave</option>
                        <option value="Purchase_Quotation">Quotation for purchase</option>
                        <option value="Sale_Quotation">Quotation for sale</option>
                        <option value="Requestion">Requestion</option>
                        <option value="Sale_Order">Sale Order</option>
                        <option value="Task">Task</option>
                        <option value="Tender">Tender</option>
                    </select>
                    <i class="text-danger" ng-show="!workflow.searchfor && showError"><small>Please Select Workflow For</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="search">* Search</label>
                    <input type="text" ng-model="workflow.search" ng-blur="getResult(workflow.search)" placeholder="Search" id="search" class="form-control">
                    <div id="search-box">
                        <div ng-if="getLeave">
                            <p></p>
                        </div>
                        <div ng-if="getPQuotation">
                            <p ng-repeat="PQ in getPQuotation">
                                <span ng-bind="PQ.quotation_number" ng-click="getWorkFlow(PQ.quotation_number)"></span>
                            </p>
                        </div>
                        <div ng-if="getSQuotation">
                            <p ng-repeat="SQ in getSQuotation">
                                <span ng-bind="SQ.quotation_number" ng-click="getWorkFlow(SQ.quotation_number)"></span>
                            </p>
                        </div>
                        <div ng-if="getRequestion">
                            <p ng-repeat="req in getRequestion">
                                <span ng-bind="req.requestion_no" ng-click="getWorkFlow(req.requestion_no)"></span>
                            </p>
                        </div>
                        <div ng-if="getSO">
                            <p ng-repeat="so in getSO">
                                <span ng-bind="so.so_number" ng-click="getWorkFlow(so.so_number)"></span>
                            </p>
                        </div>
                        <div ng-if="getTask"></div>
                        <div ng-if="getTender">
                            <p ng-repeat="tender in getTender">
                                <span ng-bind="tender.tender_no" ng-click="getWorkFlow(tender.tender_no)"></span>
                            </p>
                        </div>
                        <i class="text-danger" ng-show="!workflow.workflowfor && showError"><small>Please Search Workflow For</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getoffice()">
                    <label for="office">* Select Office</label>
                    <select ng-model="workflow.office_id" ng-change="getDepartments(workflow.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                    <i class="text-danger" ng-show="!workflow.office_id && showError"><small>Please Select Office</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="forword-to">* Forword to</label>
                    <select ng-model="workflow.forword_to" ng-change="getRoles(workflow.forword_to)" ng-options="dept.id as dept.department_name for dept in departments" id="forword-to" class="form-control">
                        <option value="">Forword To</option>
                    </select>
                    <i class="text-danger" ng-show="!workflow.forword_to && showError"><small>Please Select Forworded To</small></i>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="assign-to">* Assign To</label>
                    <select ng-model="workflow.assign_to" ng-change="getActions(workflow.assign_to)" id="assign-to" ng-options="rol.id as rol.role_name for rol in allroles" class="form-control" id="role">
                        <option value="">Select Assign To</option>
                    </select>
                    <i class="text-danger" ng-show="!workflow.assign_to && showError"><small>Please Select Assign To</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="forworded_date">Forworded Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="forworded_date" data-target-input="nearest">
                            <input type="text" placeholder="Forword Date" ng-model="workflow.forworded_date" class="form-control datetimepicker-input" data-target="#forworded_date"/>
                            <div class="input-group-append" data-target="#forworded_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="attachment">Attechment</label>
                    <input type="file" onchange="angular.element(this).scope().readUrl(this);" id="attachment" class="form-control">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-if="allactions">
                    <label for="forword-for">Fowrord for</label>
                    <p ng-repeat="act in allactions">
                        <input type="checkbox" ng-click="getCheckList(act.action)" id="<% act.action %>"> <label for="<% act.action %>" ng-bind="act.action"></label>
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <label for="description">Description</label>
                    <textarea ng-model="workflow.description" id="description" cols="30" rows="5" class="form-control" placeholder="Description . . ."></textarea>
                </div>
            </div><br/>
            <div class="row">
                <div class="col">
                    <button class="btn btn-success btn-sm float-right" ng-click="saveWorkflow()"> <i id="loader" class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
    <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/workflow/add-workflow.js')}}"></script>
@endsection