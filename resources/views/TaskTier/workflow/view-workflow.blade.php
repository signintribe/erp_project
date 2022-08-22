@extends('layouts.admin.taskTier')
@section('title', 'View Workflow')
@section('pagetitle', 'View Workflow')
@section('breadcrumb', 'View Workflow')
@section('content')
<style>
    .unread{
        color: black;
        font-weight: bold;
        background-color: #f4f0f0;
    }
</style>
<div ng-controller="WorkflowController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">View All Workflow</h3>
        </div>
        <div class="card-body" ng-init="getAllWorkFlows()">
            <label for="">Please Select Workflow For Search</label>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <select ng-model="searchfor" ng-change="getWorkFlowNotification(searchfor)" id="" class="form-control">
                        <option value="">Select Search For</option>
                        <option value="Leave">Leave</option>
                        <option value="Purchase_Quotation">Quotation for purchase</option>
                        <option value="Sale_Quotation">Quotation for sale</option>
                        <option value="Requestion">Requestion</option>
                        <option value="Sale_Order">Sale Order</option>
                        <option value="Task">Task</option>
                        <option value="Tender">Tender</option>
                    </select>
                </div>
            </div>
            <table class="table" ng-if="workflows">
                <thead>
                    <tr>
                        <th></th>
                        <th>Search For</th>
                        <th>Forworded Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="wf in workflows" ng-class="{unread: wf.view_status == 0}">
                        <td>
                            <i ng-if="wf.view_status == 0" class="fa fa-circle" style="color: blue; font-size: 11px;"></i>
                            <i ng-if="wf.view_status == 1" class="fa fa-circle" style="color: #ddd; font-size: 11px;"></i>
                        </td>
                        <td>
                            <span ng-if="">Select Search For</span>
                            <span ng-if="wf.searchfor == 'Leave'">Leave</span>
                            <span ng-if="wf.searchfor == 'Purchase_Quotation'">Quotation for purchase</span>
                            <span ng-if="wf.searchfor == 'Sale_Quotation'">Quotation for sale</span>
                            <span ng-if="wf.searchfor == 'Requestion'">Requestion</span>
                            <span ng-if="wf.searchfor == 'Sale_Order'">Sale Order</span>
                            <span ng-if="wf.searchfor == 'Task'">Task</span>
                            <span ng-if="wf.searchfor == 'Tender'">Tender</span>
                        </td>
                        <td ng-bind="wf.forworded_date"></td>
                        <td ng-bind="wf.description"></td>
                        <td>
                            <span ng-if="wf.status == 2">Reject</span>
                            <span ng-if="wf.status == 1">Approved</span>
                            <span ng-if="wf.status == 0">Pending</span>
                        </td>
                        <td>
                            <div class="btn-group" ng-if="wf.status == 0">
                                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#spcWorkFlow" ng-click="getWorkFlow(wf.id, wf.searchfor)">View</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteWorkflow(wf.id, wf.searchfor)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Modal -->
            <div id="spcWorkFlow" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Workflow Detail</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div ng-if="specwf.searchfor == 'Leave'">
                                <h3 class="card-title">
                                    Leave Applied For : <span ng-bind="specwf.leave_type"></span>
                                </h3><br/><br/>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="">Applied By</label>
                                        <p class="form-control" ng-bind="specwf.applied_name"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="">Look After By</label>
                                        <p class="form-control" ng-bind="specwf.lookafter_name"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="">From Date</label>
                                        <p class="form-control" ng-bind="specwf.fromdate"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="">To Date</label>
                                        <p class="form-control" ng-bind="specwf.todate"></p>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="">Total Leave</label>
                                        <p class="form-control" ng-bind="specwf.total_leave"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="">Leave Avail</label>
                                        <p class="form-control" ng-bind="specwf.avail_leave"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="">Leave Balance</label>
                                        <p class="form-control" ng-bind="specwf.available_balance"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="">Attachment</label>
                                        <a href="{{asset('public/leave_proof/<% specwf.attachment_file %>')}}" class="form-control">Proof Attachment</a>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Description</label>
                                        <p class="form-control" ng-bind="specwf.description"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" ng-if="specwf.status == 0" class="btn btn-danger" ng-click="changeStatus(specwf.id, specwf.searchfor, specwf.workflowfor, 2, specwf.avail_leave)">Reject</button>
                            <button type="button" ng-if="specwf.status == 0" class="btn btn-success" ng-click="changeStatus(specwf.id, specwf.searchfor, specwf.workflowfor, 1, 0)">Approve</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="user_id" value="<?php echo Auth::user()->id; ?>">
<input type="hidden" id="baseurl" value="<?php echo env('APP_URL'); ?>">
<input type="hidden" id="company_id" value="<?php echo session('company_id'); ?>">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/workflow/view-workflow.js')}}"></script>
@endsection