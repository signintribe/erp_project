@extends('layouts.admin.creationTier')
@section('title', 'Your Bank Detail')
@section('pagetitle', 'Your Budget Detail')
@section('breadcrumb', 'Your Budget Detail')
@section('content')
<div ng-controller="BankController" ng-cloak>
   <div class="card">
       <div class="card-header">
           <div class="row">
               <div class="col">
                    <h3 class="card-title">Enter Your Budget Detail</h3>
               </div>
               <div class="col">
                   <div class="btn-group float-right">
                       <!-- <button class="btn btn-xs btn-info">Search</button> -->
                       <a href="#Budgets" class="btn btn-xs btn-secondary" ng-if="budgetDetail">View Accounts</a>
                   </div>
               </div>
           </div>
       </div>
       <div class="card-body">
            <div class="table-responsive" ng-init="getAccounts()">
                <table class="table table-sm" style="font-size: 14px;" ng-if="Accounts">
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>Jul</th>
                            <th>Aug</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dec</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="acc in Accounts">
                            <td ng-bind="acc.CategoryName"></td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="jul<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="aug<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="sep<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="oct<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="nov<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="dec<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="jan<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="feb<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="mar<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="apr<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="may<% acc.id %>">
                            </td>
                            <td>
                                <input type="number" name="" placeholder="Budget Amount" class="form-control" id="jun<% acc.id %>">
                            </td>
                            <td>
                                <button class="btn btn-md btn-success" ng-click="addBudget(acc.id);">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p align="center" ng-if="!Accounts">There is no more account</p>
            </div>
       </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title" id="Budgets">All Budgets</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive" ng-init="getBudgetDetail()">
                <table class="table table-sm table-bordered" ng-if="budgetDetail">
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>Jul</th>
                            <th>Aug</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dec</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="b in budgetDetail">
                            <td ng-bind="b.CategoryName"></td>
                            <td ng-bind="b.july"></td>
                            <td ng-bind="b.august"></td>
                            <td ng-bind="b.september"></td>
                            <td ng-bind="b.october"></td>
                            <td ng-bind="b.november"></td>
                            <td ng-bind="b.december"></td>
                            <td ng-bind="b.january"></td>
                            <td ng-bind="b.february"></td>
                            <td ng-bind="b.march"></td>
                            <td ng-bind="b.april"></td>
                            <td ng-bind="b.may"></td>
                            <td ng-bind="b.june"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-danger" ng-click="deleteBudget(b.id)">Delete</button>
                                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#editBudget" ng-click="editBudget(b)">Edit</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p align="center" ng-bind="nobudget" ng-if="nobudget"></p>
                <!-- Modal -->
                <div id="editBudget" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Budget for <span ng-bind="budget.CategoryName"></span></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="jul">Jul</label>
                                <input type="number" class="form-control" id="jul" ng-model="budget.july"><br/>
                            </div>
                            <div class="col">
                                <label for="aug">Aug</label>
                                <input type="number" class="form-control" id="aug" ng-model="budget.august"><br/>
                            </div>
                            <div class="col">
                                <label for="sep">September</label>
                                <input type="number" class="form-control" id="sep" ng-model="budget.september"><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="oct">October</label>
                                <input type="number" class="form-control" id="oct" ng-model="budget.october"><br/>
                            </div>
                            <div class="col">
                                <label for="nov">November</label>
                                <input type="number" class="form-control" id="nov" ng-model="budget.november"><br/>
                            </div>
                            <div class="col">
                                <label for="dec">December</label>
                                <input type="number" class="form-control" id="dec" ng-model="budget.december"><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="nov">January</label>
                                <input type="number" class="form-control" id="jan" ng-model="budget.january"><br/>
                            </div>
                            <div class="col">
                                <label for="feb">February</label>
                                <input type="number" class="form-control" id="feb" ng-model="budget.february"><br/>
                            </div>
                            <div class="col">
                                <label for="mar">March</label>
                                <input type="number" class="form-control" id="mar" ng-model="budget.march"><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="apr">April</label>
                                <input type="number" class="form-control" id="apr" ng-model="budget.april"><br/>
                            </div>
                            <div class="col">
                                <label for="may">May</label>
                                <input type="number" class="form-control" id="may" ng-model="budget.may"><br/>
                            </div>
                            <div class="col">
                                <label for="jun">June</label>
                                <input type="number" class="form-control" id="jun" ng-model="budget.june"><br/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updateBudget()">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="appurl" value="<?php echo env('APP_URL'); ?>">
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_finance/budget.js')}}"></script>
@endsection