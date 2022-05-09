@extends('layouts.admin.creationTier')
@section('title', 'Family/Spouse Emergency Contact Person Details')
@section('pagetitle', 'Family/Spouse Person Details')
@section('breadcrumb', 'Family/Spouse Person Details')
@section('content')
<div ng-controller="SpouseController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Family/Spouse Person Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getEmployees();">
                    <div class="form-group">
                        <label for="employee_name">* Select Employee Name</label>
                        <select id="employee_name"  ng-options="user.id as user.first_name for user in Users" ng-model="user.employee_id" class="form-control">
                            <option value="">Select Employee</option>
                        </select>
                        <i class="text-danger" ng-show="!user.employee_name && showError"><small>Please Select Employee</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="first_name">* First Name</label>
                        <input type="text" id="first_name" ng-model="user.spouse_first_name" class="form-control" placeholder="First Name"/>
                        <i class="text-danger" ng-show="!user.spouse_first_name && showError"><small>Please Type First Name</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" ng-model="user.spouse_middle_name" class="form-control" placeholder="Middle Name"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" ng-model="user.spouse_last_name" class="form-control" placeholder="Last Name"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="relation">* Relation with employee</label>
                            <input type="text" id="relation" ng-model="user.relation" class="form-control" placeholder="Relation with employee"/>
                            <i class="text-danger" ng-show="!user.relation && showError"><small>Please Type Relation with employee</small></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <input type="text" id="gender" ng-model="user.gender" class="form-control" placeholder="Gender"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="text" id="dob" ng-model="user.dob" datepicker class="form-control" placeholder="Date of Birth"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="domicile">Domicile</label>
                        <input type="text" id="domicile" ng-model="user.domicile" class="form-control" placeholder="Domicile"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="marital_status">Marital Status</label>
                        <select class="form-control" ng-model="user.marital_status">
                            <option value="">Select Marital Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="patronage">Dependant/Independentat</label>
                        <select id="patronage" ng-model="user.patronage" class="form-control">
                            <option value="">Select Dependant/Independentat</option>
                            <option value="Dependant">Dependant</option>
                            <option value="Independant">Independant</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Contact Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" ng-model="user.phone_number" class="form-control" placeholder="Phone Number"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="mobile_number">* Mobile Number</label>
                        <input type="text" id="mobile_number" ng-model="user.mobile_number" class="form-control" placeholder="Mobile Number"/>
                        <i class="text-danger" ng-show="!user.mobile_number && showError"><small>Please Type Mobile Number</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="fax_number">Fax Number</label>
                        <input type="text" id="fax_number" ng-model="user.fax_number" class="form-control" placeholder="Fax Number"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" ng-model="user.email" class="form-control" placeholder="Email"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">* Address Line 1</label>
                        <input type="text" id="address_1" ng-model="user.address_line_1" class="form-control" placeholder="Postal Address Line 1"/>
                        <i class="text-danger" ng-show="!user.address_line_1 && showError"><small>Please Type Address Line 1</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Address Line 2</label>
                        <input type="text" id="address_2" ng-model="user.address_line_2" class="form-control" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Address Line 3</label>
                        <input type="text" id="address_2" ng-model="user.address_line_3" class="form-control" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" id="street" ng-model="user.street" class="form-control" placeholder="Street"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" id="sector" ng-model="user.sector" class="form-control" placeholder="Sector/Mohallah"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" ng-model="user.city" class="form-control" placeholder="City"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="state">State/Province</label>
                        <input type="text" id="state" ng-model="user.state" class="form-control" placeholder="State/Province"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" ng-model="user.country" class="form-control" placeholder="Country"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" ng-model="user.postal_code" class="form-control" placeholder="Postal Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" id="zip_code" ng-model="user.zip_code" class="form-control" placeholder="Zip Code"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" align="right">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('hr/employees-addresses')}}" data-toggle="tooltip" data-placement="left" title="Previous" class="btn btn-sm btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-success" ng-click="save_spouse()" data-toggle="tooltip" data-placement="bottom" title="Save">
                            <i class="fa fa-save" id="loader"></i> Save
                        </button>
                        <a href="{{url('hr/education-detail')}}" type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <!--  <div class="card">
        <div class="card-body">
            <h3 class="card-title">Social Media</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" id="facebook" ng-model="user.facebook" class="form-control" placeholder="Facebook"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="linkedin">Linkedin</label>
                        <input type="text" id="linkedin" ng-model="user.linkedin" class="form-control" placeholder="Linkedin"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="text" id="whatsapp" ng-model="user.whatsapp" class="form-control" placeholder="Whatsapp"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="text" id="twitter" ng-model="user.twitter" class="form-control" placeholder="Twitter"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="instgram">Instgram</label>
                        <input type="text" id="instgram" ng-model="user.instgram" class="form-control" placeholder="Instgram"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="text" id="whatsapp" ng-model="user.whatsapp" class="form-control" placeholder="Whatsapp"/>
                    </div>
                </div>
            </div><br/> 
        </div>
    </div> -->
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Spouse Detail</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Employee Name</th>
                            <th>Spouse Name</th>
                            <th>Spouse Relation</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getSpouseDetail();">
                        <tr ng-repeat='spouse in spousedetails'>
                            <td ng-bind="$index + 1"></td>
                            <td ng-bind="spouse.employee_name"></td>
                            <td ng-bind="spouse.spouse_first_name"></td>
                            <td ng-bind="spouse.relation"></td>
                            <td ng-bind="spouse.mobile_number"></td>
                            <td ng-bind="spouse.email"></td>
                            <td>
                                <button class="btn btn-xs btn-info" ng-click="eidtSpouse(spouse.id);">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteSpouse(spouse.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_hr/spouse_detail.js.js')}}"></script>
@endsection