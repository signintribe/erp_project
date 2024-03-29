@extends('layouts.admin.creationTier')
@section('title', 'Educational Detail')
@section('pagetitle', 'Educational Detail')
@section('breadcrumb', 'Educational Detail')
@section('content')
<div ng-controller="EducationController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Educational Detail</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <label for="select_employee">Select Employee</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="education.employee_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!education.employee_id && showError"><small>Please Select Employee</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="qualification_name">Qualification Name</label>
                    <input type="text" class="form-control" id="qualification_name" ng-model="education.qualification_name" placeholder="Qualification Name"/>
                    <i class="text-danger" ng-show="!education.qualification_name && showError"><small>Please Type Qualification</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="passing_year">Passing Year</label>
                    <select class="form-control" id="passing_year" ng-model="education.passing_year">
                        <option value="">Passing Year</option>
                        <?php for($i = 1990; $i<=2050; $i++){ ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                    <i class="text-danger" ng-show="!education.passing_year && showError"><small>Please Select Passing Year</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="subject">Specialization/Subjects</label>
                    <input type="text" class="form-control" id="subject" ng-model="education.subject" placeholder="Specialization/Subjects"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="institute">Institute / Board</label>
                    <input type="text" class="form-control" id="institute" ng-model="education.institute" placeholder="Institute/Board"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_marks">Total Marks</label>
                    <input type="number" class="form-control" id="total_marks" ng-model="education.total_marks" placeholder="Total Marks"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="obtain_marks">Obtain Marks</label>
                    <input type="number" class="form-control" id="obtain_marks" ng-model="education.obtain_marks" placeholder="Obtain Marks">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="grade">Grade</label>
                    <input type="text" class="form-control" id="grade" ng-model="education.grade" placeholder="Grade"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="division">Division</label>
                    <input type="text" class="form-control" id="division" ng-model="education.division" placeholder="Division"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="distinction">Distinction</label>
                    <input type="text" class="form-control" id="distinction" ng-model="education.distinction" placeholder="Distinction"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/spouse-detail')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_education()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/certification-detail')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Education</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Qualification</th>
                        <th>Passing Year</th>
                        <th>Specilization</th>
                        <th>Institute/Board</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getEducation()">
                    <tr ng-repeat="e in Educations">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="e.employee_name"></td>
                        <td ng-bind="e.qualification_name"></td>
                        <td ng-bind="e.passing_year"></td>
                        <td ng-bind="e.subject"></td>
                        <td ng-bind="e.institute"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editEducation(e.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteEducation(e.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/education_detail.js.js')}}"></script>
@endsection