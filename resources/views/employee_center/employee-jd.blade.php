@extends('layouts.admin.creationTier')
@section('title', 'Job Description')
@section('pagetitle', 'Job Description')
@section('breadcrumb', 'Job Description')
@section('content')
<div ng-controller="JDController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Employee JD's</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="jd_name">Name of JD</label>
                    <input type="text" ng-model="jds.jd_name" id="jd_name" placeholder="Name of Job Description" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">SOP for JD</label>
                    <input type="file" id="" class="form-control" onchange="angular.element(this).scope().readSOPUrl(this);">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="dose_repeat">Dose Repeat</label>
                    <select ng-model="jds.dose_repeat" id="dose_repeat" class="form-control">
                        <option value="">Dose Repeat</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">JD Attachment</label>
                    <input type="file" id="jd-attachment" class="form-control" onchange="angular.element(this).scope().readJDUrl(this);">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="frequency_repeat">Frequency of Repeat</label>
                    <select ng-model="jds.frequency_repeat" id="frequency_repeat" class="form-control">
                        <option value="">Frequency of Repeate</option>
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                    
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">JD Description</h3>
            <div class="card-tools">
                <button type="button" id="more_fields" ng-click="addRow()" class="btn btn-secondary">Add More</button>
            </div>
        </div>
        <div class="card-body">
            <div ng-repeat="row in descriptionList">
                <div class="row">
                    <div class="col-12">
                        <label for="">Description</label>
                        <textarea ng-model="row.description" id="description" class="form-control"></textarea>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-3">
                        <label for="">Pay Allowance</label>
                        <select ng-model="row.payallowance" id="pay-allowance" class="form-control">
                            <option value="">select pay allowance</option>
                            <option value="1000">1000</option>
                            <option value="2000">2000</option>
                            <option value="3000">3000</option>
                            <option value="4000">4000</option>
                        </select>
                    </div>
                </div><br>
            </div>
            <div class="row">
                <div class="col" align="right">
                    <button class="btn btn-success" ng-click="save_jds()"> <i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee JD's</h3>
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
                    <select ng-model="jdss.company_id" ng-change="getoffice(jds.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <!--<div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="jdss.office_id" ng-change="getDepartments(jds.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="jdss.department_id" id="department" ng-change="getGroups(jds.department_id)"  ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!jds.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Employee Group</label>
                    <select ng-model="jdss.group_id" id="employee-group" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!jds.group_id && showError"><small>Please Select Employee Group</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="jd_name">* JD Name</label>
                    <input type="text" ng-model="jdss.jd_name" id="jd_name" class="form-control" placeholder="JD Name">
                    <i class="text-danger" ng-show="!jds.jd_name && showError"><small>Please Type JD Name</small></i>
                </div>
            </div><br>            
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="attachment">Attachment</label>
                    <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);">
                    <img ng-if="jdDoc" ng-src="<% jdDoc %>" class="img-lg rounded" style-="width:100%; height:200px;">
                </div>
                <div class="col">
                    <label for="description">Description</label>
                    <textarea ng-model="jdss.description" id="description" class="form-control" cols="30" rows="10" placeholder="Add Description"></textarea>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/pay-emoluments')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_jds()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/pay-allowance-deduction')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>        
        </div>
    </div><br>-->
    <div class="card d-print-none">
        <div class="card-header">
            <h3 class="card-title">Get All Payscale</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>JD Name</th>
                        <th>Dose Repeat</th>
                        <th>Repeat Frequency</th>
                        <th>Attachment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_jds();">
                    <tr ng-repeat="j in alljds">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="j.jd_name"></td>
                        <td ng-bind="j.dose_repeat"></td>
                        <td ng-bind="j.frequency_repeat"></td>
                        <td><a href="{{asset('public/employeeJD/<% j.attachment %>')}}" target="_blank" ng-bind="j.attachment"></a></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editJD(j.id);">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteJobDescription(j.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- getoffice(j.company_id); getDepartments(j.office_id);  getGroups(j.department_id);  -->
<input type="hidden" id="company_id" value="<?php echo session('company_id') ?>" class="form-control">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/employee-jd.js')}}"></script>
@endsection