@extends('layouts.admin.taskTier')
@section('title', 'General Journal Entry')
@section('pagetitle', 'General Journal Entry')
@section('breadcrumb', 'General Journal Entry')
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
            <div class="card">
                <div class="card-body">
                    <!--  <button class="btn btn-info btn-xs" ng-click="(Entries.Data.push({}))"><i class="fa fa-plus"></i> Add Other</button><br/><br/> -->
                    <div class="row" ng-if="saveMessage">
                        <div class="col">
                            <div class="alert alert-success">
                                <span ng-bind="saveMessage"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="form-group">
                                    <div class="input-group date" id="entry_date" data-target-input="nearest">
                                        <input type="text" placeholder="Date" class="form-control datetimepicker-input" data-target="#entry_date"/>
                                        <div class="input-group-append" data-target="#entry_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br/>
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
                                    <td class="text-right" colspan="5"><button class="btn btn-success btn-md" ng-click="SaveEntries()" ng-if="(TotalCredit) && (TotalDebit) && !((TotalDebit) - (TotalCredit))"><i class="fa fa-save"></i> Save</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
@endsection
@section('internaljs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.6.2/angular-sanitize.min.js">
</script>
<script src="{{asset('ng_controllers/task_finance/general-entry.js')}}"></script>
@endsection