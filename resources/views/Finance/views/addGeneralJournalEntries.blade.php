@extends('layouts.admin.taskTier')
@if ($payment_type == 'payment-voucher')
    @section('title', 'Payment Vourcher')
    @section('pagetitle', 'Payment Vourcher')
    @section('breadcrumb', 'Payment Vourcher')
@endif
@if ($payment_type == 'payment-receipts')
    @section('title', 'Payment Vourcher')
    @section('pagetitle', 'Payment Vourcher')
    @section('breadcrumb', 'Payment Vourcher')
@endif
@if ($payment_type == 'journal-genral')
    @section('title', 'Journal Genral')
    @section('pagetitle', 'Journal Genral')
    @section('breadcrumb', 'Journal Genral')
@endif
@section('content')
<style>
    .hover-li:hover{
        cursor: pointer;
        background-color: #ccc;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div ng-controller="CategoryController" ng-init="resetscope()">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <!-- <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Details</h3>
                </div>
                <div class="card-body">
                    <button class="btn btn-info btn-xs" ng-click="(Entries.Data.push({}))"><i class="fa fa-plus"></i> Add Other</button><br/><br/>
                    <div class="row" ng-if="saveMessage">
                        <div class="col">
                            <div class="alert alert-success">
                                <span ng-bind="saveMessage"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="invoice-no">* Invoice Number</label>
                            <input type="text" ng-model="Entries.invoice_number" placeholder="Invoice Number" id="invoice-no" class="form-control">
                            <i class="text-danger" ng-show="!Entries.invoice_number && showError"><small>Please type invoice number</small></i>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getBanks()">
                            <label for="bank">Bank</label>
                            <select ng-model="Entries.bank_id" ng-options="bank.id as bank.bank_name for bank in BaknsDetail" id="bank" class="form-control">
                                <option value="">Select Bank</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="cheque-no">Cheque No</label>
                            <input type="text" ng-model="Entries.cheque_no" placeholder="Cheque Number" id="cheque-no" class="form-control">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="cheque_date">Cheque Date</label>
                            <div class="form-group">
                                <div class="input-group date" id="cheque_date" data-target-input="nearest">
                                    <input type="text" ng-model="Entries.cheque_date" placeholder="Cheque date" class="form-control datetimepicker-input" data-target="#cheque_date"/>
                                    <div class="input-group-append" data-target="#cheque_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="deposit-slip">Deposit slip</label>
                            <input type="file" onchange="angular.element(this).scope().readUrl(this);" id="deposit-slip" class="form-control">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="depostie_date">Depostie date</label>
                            <div class="form-group">
                                <div class="input-group date" id="depostie_date" data-target-input="nearest">
                                    <input type="text" ng-model="Entries.depostie_date" placeholder="Deposit date" class="form-control datetimepicker-input" data-target="#depostie_date"/>
                                    <div class="input-group-append" data-target="#depostie_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="status">Status</label>
                            <p class="form-control">
                                <input type="radio" ng-model="Entries.status" id="cleared" value="cleared"> <label for="cleared">Cleared</label>
                                <input type="radio" ng-model="Entries.status" id="notcleared" value="notcleared"> <label for="notcleared">Not Cleared</label>
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label>* Date</label>
                                <div class="form-group">
                                    <div class="input-group date" id="entry_date" data-target-input="nearest">
                                        <input type="text" placeholder="Date" class="form-control datetimepicker-input" data-target="#entry_date"/>
                                        <div class="input-group-append" data-target="#entry_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <i class="text-danger" ng-show="!Entries.date && showError"><small>Please type date</small></i>
                            </div>
                        </div>
                    </div><br/>
                </div>
            </div> -->
            <!-- <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Project System</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Select Project</h3>
                                </div>
                                <div class="card-body" style="height:400px; overflow-y:scroll">
                                    <div class="form-group clearfix" ng-repeat="proj in allProjects">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary<% proj.id %>" name="project" ng-click="getActivities(proj.id);" ng-model="ps.project_id" ng-value="proj.id">
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
                                            <input type="radio" id="activity<% act.id %>" name="activity" ng-click="getActivityPhases(act.id)" ng-model="ps.activity_id" ng-value="act.id">
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
                                    <div class="form-group clearfix" ng-if="phases" ng-repeat="phs in phases">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="phases<% phs.id %>" name="phase" ng-click="getPhasesTasks(phs.id)" ng-model="ps.phase_id" ng-value="phs.id">
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
                                            <input type="radio" id="tasks<% tsk.id %>" name="task" ng-model="ps.task_id" ng-value="tsk.id">
                                            <label for="tasks<% tsk.id %>" ng-bind="tsk.task_name"></label>
                                        </div>
                                    </div>
                                    <p ng-if="nomoretask" ng-bind="nomoretask"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Genral Entry</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label>* Date</label>
                                <div class="form-group">
                                    <div class="input-group date" id="entry_date" data-target-input="nearest">
                                        <input type="text" placeholder="Date" class="form-control datetimepicker-input" data-target="#entry_date"/>
                                        <div class="input-group-append" data-target="#entry_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <i class="text-danger" ng-show="!Entries.date && showError"><small>Please type date</small></i>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>GL Account</th>
                                    <th> Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <!-- <th>Charge To</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="Entry in Entries.Data">
                                    <td>
                                        <div class="btn-group dropdown" role="group" style="width:100%;" ng-init="(Entry.CategoryName = 'Select Account')">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" id="drop-box"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="filter-button-text" ng-bind="Entry.CategoryName"></span>
                                                <span style="float: right;margin: 10px;" class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="drop-box">
                                                <input type="search" class="form-control input-sm" ng-model="filtername" placeholder="Account Name">
                                                <li class="dropdown-item" ng-click="(Entry.CategoryName = 'Select Account');(Entry.account_Id = '')"> <a role="button">Select Account</a></li>     
                                                <li class="hover-li dropdown-item" style="" ng-repeat="o in Accounts| filter : {CategoryName:filtername}" ng-click="(Entry.CategoryName = o.CategoryName);(Entry.account_Id = o.id)"><a role="button" ng-bind="o.CategoryName + '=>' + o.ParentCategory "></a></li>     
                                            </ul>
                                        </div>
                                    </td>
                                    <td><input type="text" class="form-control" ng-model="Entry.description"/></td>
                                    <td><input type="number" class="form-control" ng-change="totatl()" ng-model="Entry.debit"/></td>
                                    <td><input type="number" class="form-control" ng-change="totatl()" ng-model="Entry.credit"/></td>
                                    <!-- <td><select class="form-control" ng-options="x.id as x.type_name for x in Types" ng-model="Entry.user_type_id"></select></td> -->
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right">Totals</td>
                                    <td class="text-right" ng-bind="TotalDebit"></td>
                                    <td class="text-right" ng-bind="TotalCredit"></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="2">Out Of Balance</td>
                                    <td class="text-right" ng-bind="((TotalDebit) - (TotalCredit))"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5">
                                        <button class="btn btn-success btn-md" ng-click="SaveEntries()" ng-if="(TotalCredit) && (TotalDebit) && !((TotalDebit) - (TotalCredit))"><i class="fa fa-save"></i> Save</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
<!-- /.content-wrapper -->
@endsection
@section('internaljs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.6.2/angular-sanitize.min.js">
</script>
<script src="{{asset('ng_controllers/task_finance/general-entry.js')}}"></script>
@endsection