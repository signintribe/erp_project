@extends('layouts.admin.creationTier')
@section('title', 'Experience Details')
@section('pagetitle', 'Experience Details')
@section('breadcrumb', 'Experience Details')
@section('content')
<div ng-controller="ExperienceController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Experience Detail (If any)</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <label for="select_employee">* Select Employee</label>
                    <select class="form-control" id="select_employee" ng-options="user.id as user.first_name for user in Users" ng-model="experience.employee_id">
                        <option value="">Select Employee</option>
                    </select>
                    <i class="text-danger" ng-show="!experience.employee_id && showError"><small>Please Select Employee</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="designation">* Worked as/Designation</label>
                    <input type="text" class="form-control" id="designation" ng-model="experience.designation" placeholder="Worked as/Designation"/>
                    <i class="text-danger" ng-show="!experience.designation && showError"><small>Please Type Worked as/Designation</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="organization">* Name of Organization</label>
                    <input type="text" class="form-control" id="organization" ng-model="experience.organization" placeholder="Name of Organization"/>
                    <i class="text-danger" ng-show="!experience.organization && showError"><small>Please Type Name of Organization</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label class="reference_number">Contact Person</label>
                    <input type="text" class="form-control" id="reference_number" ng-model="experience.reference_number" placeholder="Contact Person in Organization"/>
                    <i class="text-danger" ng-show="!experience.reference_number && showError"><small>Please Type Contact Person</small></i>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="worked_from">Worked from</label>
                    <div class="form-group">
                        <div class="input-group date" id="worked_from" data-target-input="nearest">
                            <input type="text" placeholder="Start Date" ng-model="experience.worked_from" class="form-control datetimepicker-input" data-target="#worked_from"/>
                            <div class="input-group-append" data-target="#worked_from" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="worked_to">Worked to</label>
                    <div class="form-group">
                        <div class="input-group date" id="worked_to" data-target-input="nearest">
                            <input type="text" placeholder="Worked To" ng-model="experience.worked_to" ng-blur="totalPeriod()" class="form-control datetimepicker-input" data-target="#worked_to"/>
                            <div class="input-group-append" data-target="#worked_to" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="present">Present</label>
                    <p class="form-control">
                        <input type="checkbox" ng-click="totalPeriod()" id="prsnt"> <label for="prsnt">Present</label>
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="total_period">Total Period</label>
                    <input type="text" class="form-control" id="total_period" ng-model="experience.total_period" placeholder="Total Period"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="salary">Salary on this position</label>
                    <input type="text" ng-model="experience.salary" id="salary" placeholder="Salary on this position" class="form-control">
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="country">Worked Country</label>
                    <input type="text" ng-model="experience.worked_country" id="country" placeholder="Worked Country" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="remarks_employee">Remarks of Employer</label>
                    <textarea class="form-control" id="remarks_employee" ng-model="experience.remarks_employee" placeholder="Remarks of Employer"></textarea>
                </div>
            </div> <br>
        </div>
    </div><br>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">* Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="experience.phone_number" placeholder="Phone Number"/>
                    <i class="text-danger" ng-show="!experience.phone_number && showError"><small>Please Type Phone Number</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="experience.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="experience.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="experience.email" placeholder="Email"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">* Address Line 1</label>
                        <input type="text" id="address_1" ng-model="experience.address_line_1" class="form-control" placeholder="Postal Address Line 1"/>
                        <i class="text-danger" ng-show="!experience.address_line_1 && showError"><small>Please Type Address Line 1</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Address Line 2</label>
                        <input type="text" id="address_2" ng-model="experience.address_line_2" class="form-control" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Address Line 3</label>
                        <input type="text" id="address_2" ng-model="experience.address_line_3" class="form-control" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="street">Street</label>
                    <input type="text" class="form-control" id="street" ng-model="experience.street" placeholder="Street"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector" ng-model="experience.sector" placeholder="Sector/Mohallah"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="experience.country" placeholder="Country"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="experience.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="experience.city" placeholder="City"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" ng-model="experience.postal_code" class="form-control" placeholder="Postal Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" id="zip_code" ng-model="experience.zip_code" class="form-control" placeholder="Zip Code"/>
                    </div>
                </div>
            </div><br>
            <!-- <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="experience.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="subjects" ng-model="experience.subjects" placeholder="Linkedin"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="experience.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="experience.instagram" placeholder="Instagram"/>
                </div>
            </div><br/> 
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="experience.twitter" placeholder="Twitter"/>
                </div>
            </div>-->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/certification-detail')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_experience()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/organizational-assignment')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Experience Detail</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Employee Name</th>
                        <th>Organization Name</th>
                        <th>Worked As</th>
                        <th>Worked From</th>
                        <th>Worked To</th>
                        <th>Contact Person</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getExperiences()">
                    <tr ng-repeat="exp in experiences">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="exp.employee_name"></td>
                        <td ng-bind="exp.organization"></td>
                        <td ng-bind="exp.designation"></td>
                        <td ng-bind="exp.worked_from"></td>
                        <td ng-bind="exp.worked_to"></td>
                        <td ng-bind="exp.reference_number"></td>
                        <td>
                            <button class="btn btn-xs btn-info" ng-click="editExperience(exp.id)">Edit</button>
                            <button class="btn btn-xs btn-danger" ng-click="deleteExperience(exp.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" id="company_id" value="<?php echo session('company_id') ?>">
<input type="hidden" id="app_url" value="<?php echo env('APP_URL') ?>">
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/experience_detail.js')}}"></script>
@endsection