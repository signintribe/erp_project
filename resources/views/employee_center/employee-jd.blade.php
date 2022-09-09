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
                <div class="col-3">
                    <label for="">Name of task</label>
                    <input type="text" ng-model="jd.task_name" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">SOP for task</label>
                    <input type="text" ng-model="jd.task_sop" id="" class="form-control">
                </div>
                <div class="col-3">
                    <label for="">Dose Repeat</label>
                    <p class="form-control">
                        <input type="radio" ng-model="jd.dose_repeat" value="yes" id="yes">  Yes
                        <input type="radio" ng-model="jd.dose_repeat" value="no" id="no">  No
                    </p>
                </div>
                <div class="col-3">
                    <label for="">JD Attachment</label>
                    <input type="file" ng-model="jd.attachment" id="jd-attachment" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-4">
                    <label for="">Frequency of Repeat</label><br>
                    <input type="radio" ng-model="jd.frequency_repeat" value="daily" id="daily">  Daily <br>
                    <input type="radio" ng-model="jd.frequency_repeat" value="weekly" id="weekly">  Weekly <br>
                    <input type="radio" ng-model="jd.frequency_repeat" value="monthly" id="monthly">  Monthly
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10"></div>
                <div class="col-2">
                    <button type="button" id="more_fields" onclick="add_fields();" class="btn btn-secondary">Add More</button>
                </div>
            </div>
            <div id="fileds">
                <div class="row">
                    <div class="col-12">
                        <label for="">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-3">
                        <label for="">Pay Allowance</label>
                        <select name="pay-allowance" id="pay-allowance" class="form-control">
                            <option value="">select pay allowance</option>
                            <option value=""></option>
                        </select>
                    </div>
                </div><br>
            </div>
            <div class="row">
                <div class="col" align="right">
                    <button class="btn-success">Save</button>
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
                    <select ng-model="jds.company_id" ng-change="getoffice(jds.company_id)" ng-options="c.id as c.company_name for c in companies" id="company" class="form-control">
                        <option value="">Select Company</option>
                    </select>
                </div> -->
                <!--<div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="office">Select Office</label>
                    <select ng-model="jds.office_id" ng-change="getDepartments(jds.office_id)" ng-options="office.id as office.office_name for office in offices" id="office" class="form-control">
                        <option value="">Select Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Department</label>
                    <select ng-model="jds.department_id" id="department" ng-change="getGroups(jds.department_id)"  ng-options="dept.id as dept.department_name for dept in departments" class="form-control">
                        <option value="">Select Department</option>
                    </select>
                    <i class="text-danger" ng-show="!jds.department_id && showError"><small>Please Select Department</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="department">* Select Employee Group</label>
                    <select ng-model="jds.group_id" id="employee-group" ng-options="group.id as group.group_name for group in groups" class="form-control">
                        <option value="">Select Employee Group</option>
                    </select>
                    <i class="text-danger" ng-show="!jds.group_id && showError"><small>Please Select Employee Group</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="jd_name">* JD Name</label>
                    <input type="text" ng-model="jds.jd_name" id="jd_name" class="form-control" placeholder="JD Name">
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
                    <textarea ng-model="jds.description" id="description" class="form-control" cols="30" rows="10" placeholder="Add Description"></textarea>
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
                        <th>Company Name</th>
                        <th>Office Name</th>
                        <th>Department Name</th>
                        <th>Group Name</th>
                        <th>JD Name</th>
                        <th>Attachment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="get_jds();">
                    <tr ng-repeat="j in alljds">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="j.company_name"></td>
                        <td ng-bind="j.office_name"></td>
                        <td ng-bind="j.department_name"></td>
                        <td ng-bind="j.group_name"></td>
                        <td ng-bind="j.jd_name"></td>
                        <td><a href="{{asset('public/employeeJD/<% j.attachment %>')}}" target="_blank" ng-bind="j.attachment"></a></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="getoffice(j.company_id); getDepartments(j.office_id);  getGroups(j.department_id); editJD(j.id);">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteJobDescription(j.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function add_fields() {
    var objTo = document.getElementById('fileds')
    var divtest = document.createElement("div");
    divtest.innerHTML = '<div class="row"><div class="col-12"><label for="">Description</label>'+
        '<textarea name="description" id="description" class="form-control"></textarea>'+
    '</div></div><br><div class="row"><div class="col-3"><label for="">Pay Allowance</label>'+
    '<select name="pay-allowance" id="pay-allowance" class="form-control"><option value="">select pay allowance</option></select></div></div><br>';

    objTo.appendChild(divtest)
}
</script>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/employee-jd.js')}}"></script>
@endsection