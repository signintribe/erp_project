@extends('layouts.admin.creationTier')
@section('title', 'Chart of Account')
@section('pagetitle', 'Chart of Account')
@section('breadcrumb', 'Chart of Account')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div ng-controller="CategoryController" ng-init="resetscope()">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
            <div class="card">
                <!-- /.box-header -->
                <div class="card-body">
                    <p ng-if="savemessage" ng-bind="savemessage"></p>
                    <div class="row">
                        <div class="col">
                            <div class="form-group" >
                                <label>Account ID</label>  
                                <input type="number" class="form-control" ng-model="Category.AccountId" placeholder="Account ID"  autofocus/>
                                <i class="text-danger" ng-show="!Category.AccountId && showError"><small>Please type account ID</small></i>
                            </div>
                        </div>
                    <!-- </div>
                    <div class="row"> -->
                        <div class="col">
                            <div class="form-group" id="CategoryName">
                                <label>Account Name</label>  
                                <input class="form-control" ng-model="Category.CategoryName" placeholder="Account Name"/>
                                <i class="text-danger" ng-show="!Category.CategoryName && showError"><small>Please type account name</small></i>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col">
                            <p class="form-control">
                                <input type="checkbox" ng-model="Category.EmpAcc" id="EmpAcc"> <label for="EmpAcc">Account for Employee</label>
                            </p>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Account Description</label>  
                                <textarea rows='5' max='300' class="form-control" placeholder="Add Account Description" ng-model="Category.AccountDescription"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card" id="openingBalance">
                <div class="card-header">
                    <h3 class="card-title">Opening Balance</h3>
                </div>
                <div class="card-body">
                     <div class="row">
                        <div class="col">
                            <input type="number" ng-model="Category.credit" class="form-control" placeholder="Credit Amount">
                        </div>
                        <div class="col">
                            <input type="number" ng-model="Category.debit" class="form-control" placeholder="Debit Amount">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="input-group date" id="account_date" data-target-input="nearest">
                                    <input type="text" placeholder="End Date" ng-model="Category.account_date" class="form-control datetimepicker-input" data-target="#account_date"/>
                                    <div class="input-group-append" data-target="#account_date" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div> -->
            <!-- /.box -->
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7">
           <div class="card" style="height: 520px;">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="card-title">Select Account Type</h3>
                        </div>
                        <div class="col">
                            <a href="#showAccounts" class="btn btn-xs btn-warning float-right">Show All Accounts</a>
                        </div>
                    </div>
                </div>
               <div class="card-body">
                   <div class="row">
                       <div class="col" style="overflow-y: scroll; height: 430px;">
                            <i class="text-danger" ng-show="!Category.ParentcategoryId && showError"><small>Please select account type</small></i>
                            <div ng-repeat="(key, value) in allcats">
                                <strong ng-bind="key"></strong><br/>
                                <ul class="list-unstyled" style="margin-left: 20px;">
                                    <li ng-repeat="cats in value">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio<%cats.id%>" ng-model="Category.ParentcategoryId" ng-click="getChilds(cats)" ng-value="cats.id" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label" style="font-weight: normal" for="customRadio<%cats.id%>" ng-bind="cats.CategoryName"></label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                       </div>
                       <div class="col">
                           <ul class="list-unstyled" style="margin-left: 20px;">
                                <li ng-repeat="child in childaccounts">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="chidlRadio<%child.id%>" ng-model="Category.ParentcategoryId" ng-click="getCategory(child)" ng-value="child.id" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" style="font-weight: normal" for="chidlRadio<%child.id%>" ng-bind="child.CategoryName"></label>
                                    </div>
                                </li>
                            </ul><br/>
                            <p ng-bind="selectedCate.AccountDescription"></p>
                           <div id="Save-button">
                                <button class="btn btn-success btn-sm pull-right" ng-click="save_category()">
                                    <i class="fa fa-save" id="savebtn"></i> <span ng-bind="SaveLabel"></span>
                                </button> 
                            </div>
                       </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" id="showAccounts">All Accounts</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>Account ID</th>
                                    <th>Account Name</th>
                                    <th>Parent Account</th>
                                    <th>Account Created</th>
                                    <th>Type of Account</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="acc in Accounts">
                                    <td ng-bind="$index+1"></td>
                                    <td ng-bind="acc.AccountId"></td>
                                    <td ng-bind="acc.CategoryName"></td>
                                    <td ng-bind="acc.ParentCategory"></td>
                                    <td ng-bind="acc.created_at"></td>
                                    <td>
                                        <span ng-if="acc.emp_acc == 0">Company</span>
                                        <span ng-if="acc.emp_acc == 1" class="text-success">Employee</span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-info btn-xs" ng-click="editAccount(acc)">Edit</button>
                                            <button class="btn btn-danger btn-xs" ng-click="delete_category(acc.id)">Delete</button>
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
</div>
<!-- /.content-wrapper -->
@endsection
@section('internaljs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.6.2/angular-sanitize.min.js">
</script>
<script src="{{asset('ng_controllers/creation_finance/user-chart-account.js')}}"></script>
@endsection
