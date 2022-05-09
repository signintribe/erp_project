@extends('layouts.admin.creationTier')
@section('title', 'Certification/Training Details')
@section('pagetitle', 'Certification/Training Details')
@section('breadcrumb', 'Certification/Training Details')
@section('content')
<div ng-controller="CertificationController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Certification/Training Detail (If any)</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <label for="select_employee">* Select Employee</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="education.employee_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!education.employee_id && showError"><small>Please Select Employee</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="certification_name">*Certification Name</label>
                    <input type="text" class="form-control" id="certification_name" ng-model="education.certification_name" placeholder="Certification Name"/>
                    <i class="text-danger" ng-show="!education.certification_name && showError"><small>Please Type Certification Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="start_date">Start Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="start_date" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="education.start_date" class="form-control datetimepicker-input" data-target="#start_date"/>
                            <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="end_date">End Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="end_date" data-target-input="nearest">
                            <input type="text" placeholder="End Date" ng-model="education.end_date" class="form-control datetimepicker-input" data-target="#end_date"/>
                            <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_type">Training Type</label>
                    <input type="text" class="form-control" id="training_type" ng-model="education.training_type" placeholder="Training Type"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_institute">Training Institute</label>
                    <input type="text" class="form-control" id="training_institute" ng-model="education.training_institute" placeholder="Training Institute"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_venue">Training Venue</label>
                    <input type="text" class="form-control" id="training_venue" ng-model="education.training_venue" placeholder="Training Venue"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_referred_by">Training Referred by</label>
                    <input type="text" class="form-control" id="training_referred_by" ng-model="education.training_referred_by" placeholder="Training Referred by"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="subjects">Subjects</label>
                    <input type="text" class="form-control" id="subjects" ng-model="education.subjects" placeholder="Subjects"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="training_purpose">Purpose of Training</label>
                    <input type="text" class="form-control" id="training_purpose" ng-model="education.training_purpose" placeholder="Purpose of Training"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/education-detail')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_certification()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/experience-detail')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Certification</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Certification Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Training Venue</th>
                        <th>Subject</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getCertification()">
                    <tr ng-repeat=" cert in allcert">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="cert.employee_name"></td>
                        <td ng-bind="cert.certification_name"></td>
                        <td ng-bind="cert.start_date"></td>
                        <td ng-bind="cert.end_date"></td>
                        <td ng-bind="cert.training_venue"></td>
                        <td ng-bind="cert.subjects"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editCertification(cert.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteCertification(cert.id);">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/certification_detail.js')}}"></script>
@endsection