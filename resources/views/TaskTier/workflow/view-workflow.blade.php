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
    .table-sm{
        font-size: 14px;
    }
</style>
<div ng-controller="WorkflowController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">View All Workflow</h3>
        </div>
        <div class="card-body" ng-init="getAllWorkFlows('inbox')">
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
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
                <div class="col-lg-3 col-md-3 col-sm-3"></div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <button class="btn btn-sm btn-primary float-right" ng-click="getAllWorkFlows('inbox')"> <i class="fa fa-refresh"></i> </button>
                </div>
            </div><hr/>
            <table class="table table-sm" ng-if="workflows">
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
                                <button class="btn btn-xs btn-danger" ng-click="deleteWorkflow(wf.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table><br/>
            <div class="text-center">
                <button class="btn btn-sm btn-primary" ng-if="workflows.length > 19" ng-click="loadMore('inbox')" id="btn-loadmore"><i class="fa fa-spinner" id="load-more"></i> Load More</button>
                <p ng-if="nomore" ng-bind="nomore"></p>
            </div>
            <!-- Modal -->
            <div id="spcWorkFlow" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" ng-if="specwf.searchfor == 'Purchase_Quotation'">Workflow Detail Quotation For Purchase</h4>
                            <h4 class="modal-title" ng-if="specwf.searchfor == 'Leave'">Workflow Detail Leave</h4>
                            <h4 class="modal-title" ng-if="specwf.searchfor == 'Sale_Quotation'">Workflow Quotation For Sale</h4>
                            <h4 class="modal-title" ng-if="specwf.searchfor == 'Requestion'">Workflow Requestion</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <i class="fa" id="view-loader"></i>
                            </div>
                            <div ng-if="specwf.searchfor == 'Leave'">
                                <h5>Workflow of Leave</h5><hr>
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
                                        <a href="{{asset('public/leave_proof/<% specwf.attachment_file %>')}}" class="btn btn-block btn-primary">Proof Attachment</a>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Description</label>
                                        <p class="form-control" ng-bind="specwf.description"></p>
                                    </div>
                                </div><hr/>
                            </div>
                            <div ng-if="specwf.searchfor == 'Purchase_Quotation'">
                                <h3 class="card-title">
                                    Quotation Number: <span ng-bind="specwf.quotation_number"></span>
                                </h3><br><br/>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="quotation_date">Quotation Date</label>
                                        <p class="form-control" ng-bind="specwf.quotation_date"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="applyfor">Apply for</label>
                                        <p class="form-control" ng-bind="specwf.apply_to"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="till_date">Quotation Till Date</label>
                                        <p class="form-control" ng-bind="specwf.quotation_till"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="delivery_date">Delivery Date</label>
                                        <p class="form-control" ng-bind="specwf.delivery_date"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Check List</label>
                                        <div class="row" id="getchecklist">
                                            <div class="col">
                                                <ul class="list-unstyled" ng-repeat="chklst in getselectedchecklist">
                                                    <li ng-if="chklst.checklist == 'principal_performa'">
                                                        Principal performa invoce with sign & stamp on company letter head
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'agency_agreement'">
                                                        Agency agreement with sign & stamp on company letter head
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'oem_certificate'">
                                                        OEM Certificate
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'atp'">
                                                        ATP
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'compliance_sheet'">
                                                        Compliance Sheet
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'company_profile'">
                                                        Company Profile/Certificate
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'warrenty'">
                                                        Warrenty / Guarantee acceptence as per IT
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'technical_offer'">
                                                        Complete Technical Offer
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'trade_link'">
                                                        Complete Trade Link
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="product_name">Product Name</label>
                                        <p class="form-control" ng-bind="specwf.product_name"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="unit_price">Unit Price</label>
                                        <p class="form-control" ng-bind="specwf.unit_price"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="quantity">Quantity</label>
                                        <p class="form-control" ng-bind="specwf.quantity"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="gross_price">Gross Price</label>
                                        <p class="form-control" ng-bind="specwf.gross_price"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Taxes</label>
                                        <table class="table table-bordered table-sm">
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Tax Name</th>
                                                <th>Tax Percentage</th>
                                            </tr>
                                            <tr ng-repeat="tx in taxes">
                                                <td ng-bind="$index + 1"></td>
                                                <td ng-bind="tx.tax_name"></td>
                                                <td ng-bind="tx.tax_percentage"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Delivery Charges</label>
                                        <table class="table table-bordered table-sm">
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Logistic Type</th>
                                                <th>Charges</th>
                                            </tr>
                                            <tr ng-repeat="chrg in deliverycharges">
                                                <td ng-bind="$index + 1"></td>
                                                <td ng-bind="chrg.logistic_type"></td>
                                                <td ng-bind="chrg.delivery_charges"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="discount_name">Discount Name</label>
                                        <p class="form-control" ng-bind="specwf.discount_name"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="discount_amount">Discount Amount</label>
                                        <p class="form-control" ng-bind="specwf.discount_amount"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="net_amount">Net Amount</label>
                                        <p class="form-control" ng-bind="specwf.net_amount"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="advance_percentage">Advance Percentage</label>
                                        <p class="form-control" ng-bind="specwf.advance_percentage"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="time_advance">Time Advance</label>
                                        <p class="form-control" ng-bind="specwf.time_advance"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="payment_type">Payment Type</label>
                                        <p class="form-control" ng-bind="specwf.payment_type"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="description">Description</label>
                                        <p ng-bind="specwf.description"></p>
                                    </div>
                                </div>
                            </div>
                            <div ng-if="specwf.searchfor == 'Sale_Quotation'">
                                <h3 class="card-title">
                                    Quotation Number: <span ng-bind="specwf.quotation_number"></span>
                                </h3><br><br/>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="quotation_date">Quotation Date</label>
                                        <p class="form-control" ng-bind="specwf.quotation_date"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="applyfor">Apply for</label>
                                        <p class="form-control" ng-bind="specwf.apply_to"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="till_date">Quotation Till Date</label>
                                        <p class="form-control" ng-bind="specwf.quotation_till"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="delivery_date">Delivery Date</label>
                                        <p class="form-control" ng-bind="specwf.delivery_date"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Check List</label>
                                        <div class="row" id="getchecklist">
                                            <div class="col">
                                                <ul class="list-unstyled" ng-repeat="chklst in getselectedchecklist">
                                                    <li ng-if="chklst.checklist == 'principal_performa'">
                                                        Principal performa invoce with sign & stamp on company letter head
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'agency_agreement'">
                                                        Agency agreement with sign & stamp on company letter head
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'oem_certificate'">
                                                        OEM Certificate
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'atp'">
                                                        ATP
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'compliance_sheet'">
                                                        Compliance Sheet
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'company_profile'">
                                                        Company Profile/Certificate
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'warrenty'">
                                                        Warrenty / Guarantee acceptence as per IT
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'technical_offer'">
                                                        Complete Technical Offer
                                                    </li>
                                                    <li ng-if="chklst.checklist == 'trade_link'">
                                                        Complete Trade Link
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="product_name">Product Name</label>
                                        <p class="form-control" ng-bind="specwf.product_name"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="unit_price">Unit Price</label>
                                        <p class="form-control" ng-bind="specwf.unit_price"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="quantity">Quantity</label>
                                        <p class="form-control" ng-bind="specwf.quantity"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="gross_price">Gross Price</label>
                                        <p class="form-control" ng-bind="specwf.gross_price"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Taxes</label>
                                        <table class="table table-bordered table-sm">
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Tax Name</th>
                                                <th>Tax Percentage</th>
                                            </tr>
                                            <tr ng-repeat="tx in taxes">
                                                <td ng-bind="$index + 1"></td>
                                                <td ng-bind="tx.tax_name"></td>
                                                <td ng-bind="tx.tax_percentage"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Delivery Charges</label>
                                        <table class="table table-bordered table-sm">
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Logistic Type</th>
                                                <th>Charges</th>
                                            </tr>
                                            <tr ng-repeat="chrg in deliverycharges">
                                                <td ng-bind="$index + 1"></td>
                                                <td ng-bind="chrg.logistic_type"></td>
                                                <td ng-bind="chrg.delivery_charges"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="discount_name">Discount Name</label>
                                        <p class="form-control" ng-bind="specwf.discount_name"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="discount_amount">Discount Amount</label>
                                        <p class="form-control" ng-bind="specwf.discount_amount"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="net_amount">Net Amount</label>
                                        <p class="form-control" ng-bind="specwf.net_amount"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="advance_percentage">Advance Percentage</label>
                                        <p class="form-control" ng-bind="specwf.advance_percentage"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="time_advance">Time Advance</label>
                                        <p class="form-control" ng-bind="specwf.time_advance"></p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label for="payment_type">Payment Type</label>
                                        <p class="form-control" ng-bind="specwf.payment_type"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="description">Description</label>
                                        <p ng-bind="specwf.description"></p>
                                    </div>
                                </div>
                            </div>
                            <div ng-if="specwf.searchfor == 'Requestion'">
                                <h3 class="card-title">
                                    Requestion Number : <span ng-bind="specwf.workflowfor"></span>
                                </h3><br/><br/>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-md-4">
                                        <label for="requestion_date">Requition Date</label>
                                        <p class="form-control" ng-bind="specwf.requestion_date"></p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-md-4">
                                        <label for="require_date">Require Date</label>
                                        <p class="form-control" ng-bind="specwf.require_date"></p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-md-4">
                                        <label for="require_till">Require Till</label>
                                        <p class="form-control" ng-bind="specwf.require_till"></p>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="co">
                                        <label for="description">Description</label>
                                        <p ng-bind="specwf.description"></p>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-md-4">
                                        <label for="product_name">Product Name</label>
                                        <p class="form-control" ng-bind="specwf.product_name"></p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-md-4">
                                        <label for="resource">Resource Person</label>
                                        <p class="form-control" ng-bind="specwf.product_name"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h5>Forward To</h5>
                                </div>
                            </div><hr>
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th>Office Name</th>
                                    <th>Forward To</th>
                                    <th>Assign To</th>
                                    <th>Action</th>
                                </tr>
                                <tr ng-repeat="fwo in wfforwards">
                                    <td ng-bind="fwo.office_name"></td>
                                    <td ng-bind="fwo.forword_to"></td>
                                    <td ng-bind="fwo.role_name"></td>
                                    <td ng-bind="fwo.action"></td>
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getoffice()">
                                    <label for="office">* Select Office</label>
                                    <select ng-model="workflow.office_id" ng-change="getDepartments(workflow.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                                        <option value="">Select Office</option>
                                    </select>
                                    <i class="text-danger" ng-show="!workflow.office_id && showError"><small>Please Select Office</small></i>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <label for="forword-to">* Forword to (Dept)</label>
                                    <select ng-model="workflow.forword_to" ng-change="getRoles(workflow.forword_to)" ng-options="dept.id as dept.department_name for dept in departments" id="forword-to" class="form-control">
                                        <option value="">Forword To</option>
                                    </select>
                                    <i class="text-danger" ng-show="!workflow.forword_to && showError"><small>Please Select Forworded To</small></i>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <label for="assign-to">* Assign To</label>
                                    <select ng-model="workflow.assign_to" ng-change="getActions(workflow.assign_to)" id="assign-to" ng-options="rol.id as rol.role_name for rol in allroles" class="form-control" id="role">
                                        <option value="">Select Assign To</option>
                                    </select>
                                    <i class="text-danger" ng-show="!workflow.assign_to && showError"><small>Please Select Assign To</small></i>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <label for="forward_for">Fowrord for</label>
                                    <select ng-model="workflow.action_id" id="forward_for" ng-options="act.id as act.action for act in allactions" class="form-control">
                                        <option value="">Select Action</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                            <div class="btn-group" ng-if="specwf.searchfor == 'Leave'">
                                <button type="button" ng-if="specwf.status == 0" class="btn btn-danger btn-sm" ng-click="changeStatus(specwf.id, specwf.searchfor, specwf.workflowfor, 2, specwf.avail_leave)">Reject</button>
                                <button type="button" ng-if="specwf.status == 0" class="btn btn-success btn-sm" ng-click="changeStatus(specwf.id, specwf.searchfor, specwf.workflowfor, 1, 0)">Approve</button>
                            </div>
                            <div class="btn-group" ng-if="specwf.searchfor != 'Leave'">
                                <button type="button" ng-if="specwf.status == 0" class="btn btn-danger btn-sm" ng-click="changeStatus(specwf.id, specwf.searchfor, specwf.workflowfor, 2, 0)">Reject</button>
                                <button type="button" ng-if="specwf.status == 0" class="btn btn-success btn-sm" ng-click="changeStatus(specwf.id, specwf.searchfor, specwf.workflowfor, 1, 0)">Approve</button>
                            </div>
                            <button class="btn btn-primary btn-sm" ng-click="forwardTo(specwf.id)"> <i class="fa fa-send" id="loader"></i> Forward</button>
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