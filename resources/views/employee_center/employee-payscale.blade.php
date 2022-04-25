@extends('layouts.admin.creationTier')
@section('title', 'Employee Payscale')
@section('pagetitle', 'Employee Payscale')
@section('breadcrumb', 'Employee Payscale')
@section('content')
<div  ng-app="PayscaleApp" ng-controller="PayscaleController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Payscale</h3>
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
                    <select ng-model="payscale.company_id" ng-change="getoffice(payscale.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="payscale.office_id" ng-change="getDepartments(payscale.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="payscale.department_id" id="department" ng-change="getGroups(payscale.department_id)" ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!payscale.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Employee Group</label>
                    <select ng-model="payscale.group_id" id="employee-group" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!payscale.group_id && showError"><small>Please Select Employee Group</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="payscale_name">* Payscale Name</label>
                    <input type="text" ng-model="payscale.payscale_name" id="payscale_name" class="form-control" placeholder="Payscale Name">
                    <i class="text-danger" ng-show="!payscale.payscale_name && showError"><small>Please Type Group Name</small></i>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="initial_pay">* Initial Pay</label>
                    <input type="text" ng-model="payscale.initial_pay" id="initial_pay" class="form-control" placeholder="Initial Pay">
                    <i class="text-danger" ng-show="!payscale.initial_pay && showError"><small>Please Type Initial Pay</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="annual_increments">Anual Payscale</label>
                    <input type="text" ng-model="payscale.annual_increments" id="annual_increments" class="form-control" placeholder="Annual Increments">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="endingpay_payscale">Ending Pay of Payscale</label>
                    <input type="text" ng-model="payscale.endingpay_payscale" id="endingpay_payscale" class="form-control" placeholder="Ending Pay of Payscale">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="complete_payscale">Complete payscale</label>
                    <input type="text" ng-model="payscale.complete_payscale" id="complete_payscale" class="form-control" placeholder="Complete payscale">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="number_stage">No. of Stages</label>
                    <input type="text" ng-model="payscale.number_stage" id="complete_payscale" class="form-control" placeholder="No. of Stages">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="implementation_year">Year of Implementation</label>
                    <select ng-model="payscale.implementation_year" id="implementation_year" class="form-control">
                        <option value="">Select Year of Implementation</option>
                        <?php for($i=1960; $i <= 2050; $i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="valid_till">Valid till</label>
                    <div class="form-group">
                        <div class="input-group date" id="valid_till" data-target-input="nearest">
                            <input type="text" placeholder="Worked To" ng-model="payscale.valid_till" class="form-control datetimepicker-input" data-target="#valid_till"/>
                            <div class="input-group-append" data-target="#valid_till" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Status</label>
                    <p class="form-control">
                        <input type="checkbox" ng-model="payscale.status" id="status"> <label for="status">Status of PayScale</label>
                    </p>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/experience-detail')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_payscale()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/pay-emoluments')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Get All Payscale</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Payscale Name</th>
                        <th>Initial Pay</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_payscale();">
                    <tr ng-repeat="p in payscales">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="p.company_name"></td>
                        <td ng-bind="p.office_name"></td>
                        <td ng-bind="p.department_name"></td>
                        <td ng-bind="p.payscale_name"></td>
                        <td ng-bind="p.initial_pay"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getoffice(p.company_id); getDepartments(p.office_id); editPayscale(p.id); getGroups(p.department_id);">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deletePayScale(p.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" value="<?php echo env('APP_URL'); ?>" id="appurl">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/employee-payscale.js')}}"></script>
@endsection