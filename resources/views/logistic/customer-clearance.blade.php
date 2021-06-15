@extends('layouts.admin.master')
@section('title', 'Add Customer Clearance')
@section('content')
<div  ng-app="CustomerClearanceApp" ng-controller="CustomerClearanceController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Customer Organization Information</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="organization_name">Name of Organization</label>
                    <input type="text" class="form-control" id="organization_name" ng-model="clearance.organization_name" placeholder="Name of Organization"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="ntn_no">NTN</label>
                    <input type="text" class="form-control" id="ntn_no" ng-model="clearance.ntn_no" placeholder="NTN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="incroporation_no">Incroporation/License No.</label>
                    <input type="text" class="form-control" id="incroporation_no" ng-model="clearance.incroporation_no" placeholder="Incroporation/License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Organizational Logo:</label>
                    <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"><br/>
                    <img ng-if="catimage" ng-src="<% catimage %>" class="img img-responsive" style="width: 100%; height: 200px;"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="strn">STRN</label>
                    <input type="text" class="form-control" id="strn" ng-model="clearance.strn" placeholder="STRN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="import_license">Import License No.</label>
                    <input type="text" class="form-control" id="import_license" ng-model="clearance.import_license" placeholder="Import License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="export_license">Export License No.</label>
                    <input type="text" class="form-control" id="export_license" ng-model="clearance.export_license" placeholder="Export License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="chamber_no"><abbr title="Chamber of Commerce License No.">CC License No.</abbr></label>
                    <input type="text" class="form-control" id="chamber_no" ng-model="clearance.chamber_no" placeholder="Chamber of Commerce License No."/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency_dealing">Currency in dealing</label>
                    <input type="text" class="form-control" id="currency_dealing" ng-model="clearance.currency_dealing" placeholder="Currency in dealing"/>
                </div><!-- 
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Nature of Business</label><br/>
                    <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                    <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                    <input type="checkbox" id="manufacturer"/> <label for="manufacturer">Manufacturer</label><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Sub Nature of Business</label><br/>
                    <input type="checkbox" id="exporter"/> <label for="exporter">Exporter</label><br/>
                    <input type="checkbox" id="importer"/> <label for="importer">Importer</label><br/>
                    <input type="checkbox" id="contractor"/> <label for="contractor">Contractor</label><br/>
                    <input type="checkbox" id="retailer"/> <label for="retriler">Retailer</label><br/>
                    <input type="checkbox" id="whole_seller"/> <label for="whole_saller">Whole Seller</label><br/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Type of Business</label><br/>
                    <input type="checkbox" id="private"/> <label for="private">Private limited company</label><br/>
                    <input type="checkbox" id="public"/> <label for="public">Public</label><br/>
                    <input type="checkbox" id="partnership"/> <label for="partnership">Partnership</label><br/>
                    <input type="checkbox" id="sole_proprietor"/> <label for="sole_proprietor">Sole Proprietor</label><br/>
                </div> -->
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Address Detail</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line1">Postal Address Line 1</label>
                    <input type="text" class="form-control" id="address_line1" ng-model="clearance.address_line_1" placeholder="Postal Address Line 1"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="address_line2">Postal Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" ng-model="clearance.address_line_2" placeholder="Postal Address Line 2"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sector">Sector/Mohallah</label>
                    <input type="text" class="form-control" id="sector" ng-model="clearance.sector" placeholder="Sector/Mohallah"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" ng-model="clearance.city" placeholder="City"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" ng-model="clearance.state" placeholder="State/Province"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" ng-model="clearance.country" placeholder="Country"/>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Organizational Contact</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="clearance.phone_number" placeholder="Phone Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="clearance.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="clearance.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="clearance.linkedin" placeholder="Linkedin"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="clearance.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="clearance.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="clearance.email" placeholder="Email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="clearance.website" placeholder="Website"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="clearance.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="clearance.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="clearance.instagram" placeholder="Instagram"/>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Select product categories and attributes</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="saveCustomerClearance()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var CustomerClearance = angular.module('CustomerClearanceApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    CustomerClearance.controller('CustomerClearanceController', function ($scope, $http) {
        $scope.clearance = {};
        $scope.saveCustomerClearance = function(){
            if (!$scope.clearance.organization_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.clearance, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('save-cus-clearance', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.clearance = {};
                });
            }
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.catimage = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.clearance.logo_file = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };
    });
</script>
@endsection