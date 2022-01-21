@extends('layouts.admin.creationTier')
@section('title', 'Customer Information')
@section('pagetitle', 'Customer Information')
@section('breadcrumb', 'Customer Information')
@section('content')
<div  ng-app="CustomerApp" ng-controller="CustomerController" ng-cloak>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Customer Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <img ng-if="cuslogo" ng-src="<% cuslogo %>" class="img img-thumbnail" style-="width:100%; height:200px;">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_type">* Type of Customer</label>
                    <select class="form-control" ng-model="customer.customer_type" id="customer_type">
                        <option value="">Type of Customer</option>
                        <option value="Individual">Individual</option>
                        <option value="Organization">Organization</option>
                    </select>
                    <i class="text-danger" ng-show="!customer.customer_type && showError"><small>Please Select Customer Type</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_name">* Customer Name</label>
                    <input type="text" class="form-control" id="customer_name" ng-model="customer.customer_name" placeholder="Cusomer Name"/>
                    <i class="text-danger" ng-show="!customer.customer_name && showError"><small>Please Enter Customer Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_logo">Logo</label>
                    <input type="file" class="form-control" id="customer_logo" onchange="angular.element(this).scope().readUrl(this);"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency_dealing">Currency in dealing</label>
                    <input type="text" class="form-control" id="currency_dealing" ng-model="customer.currency_dealing" placeholder="Currency in dealing"/>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Address Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_1">* Postal Address Line 1</label>
                        <input type="text" id="address_1" class="form-control" ng-model="customer.address_line_1" placeholder="Postal Address Line 1"/>
                        <i class="text-danger" ng-show="!customer.address_line_1 && showError"><small>Please Type Address Line</small></i>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_2">Postal Address Line 2</label>
                        <input type="text" id="address_2" class="form-control" ng-model="customer.address_line_2" placeholder="Postal Address Line 2"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="address_3">Postal Address Line 3</label>
                        <input type="text" id="address_3" class="form-control" ng-model="customer.address_line_3" placeholder="Postal Address Line 3"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" id="street" class="form-control" ng-model="customer.street" placeholder="Street"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="sector">Sector/Mohallah</label>
                        <input type="text" id="sector" class="form-control" ng-model="customer.sector" placeholder="Sector/Mohallah"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" class="form-control" ng-model="customer.country" placeholder="Country"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="state">State / Province</label>
                        <input type="text" id="state" class="form-control" ng-model="customer.state" placeholder="State / Province"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" class="form-control" ng-model="customer.city" placeholder="City"/>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="zip_code">Zipp Code</label>
                        <input type="text" id="zip_code" class="form-control" ng-model="customer.zip_code" placeholder="Zip Code"/>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" id="postal_code" class="form-control" ng-model="customer.postal_code" placeholder="Postal Code"/>
                    </div>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Contact Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="phone_number">* Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" ng-model="customer.phone_number" placeholder="Phone Number"/>
                    <i class="text-danger" ng-show="!customer.phone_number && showError"><small>Please Enter Phone no</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" ng-model="customer.mobile_number" placeholder="Mobile Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" ng-model="customer.facebook" placeholder="Facebook"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="linkedin">Linkedin</label>
                    <input type="text" class="form-control" id="linkedin" ng-model="customer.linkedin" placeholder="Linkedin"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsapp" ng-model="customer.whatsapp" placeholder="Whatsapp"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" ng-model="customer.twitter" placeholder="Twitter"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" ng-model="customer.email" placeholder="Email"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" ng-model="customer.website" placeholder="Website"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" ng-model="customer.pinterest" placeholder="Pinterest"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="fax_number">Fax Number</label>
                    <input type="text" class="form-control" id="fax_number" ng-model="customer.fax_number" placeholder="Fax Number"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" ng-model="customer.instagram" placeholder="Instagram"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-left" ng-click="save_customerInformation()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Customer Information</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr#</th>
                        <th>Customer Type</th>
                        <th>Customer Name</th>
                        <th>Currency in dealing</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getCustomerInformation()">
                    <tr ng-repeat="customer in customerinformations">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="customer.customer_type"></td>
                        <td ng-bind="customer.customer_name"></td>
                        <td ng-bind="customer.currency_dealing"></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-xs btn-info" ng-click="editCustomerInformation(customer.id)">Edit</button>
                                <button class="btn btn-xs btn-danger" ng-click="deleteCustomerInformation(customer.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> 
    <input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
    <input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Customer = angular.module('CustomerApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });


    Customer.controller('CustomerController', function ($scope, $http) {
        $("#sales").addClass('menu-open');
        $("#sales a[href='#']").addClass('active');
        $("#customer-info").addClass('active');
        $scope.customer = {};
        $scope.appurl = $("#appurl").val();
        $scope.save_customerInformation = function(){
            if (!$scope.customer.customer_type || !$scope.customer.customer_name || !$scope.customer.address_line_1 || !$scope.customer.phone_number) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                $scope.customer.company_id = $("#company_id").val();
                $("#loader").removeClass('fa-save').addClass('fa-spinner fa-sw fa-pulse');
                var Data = new FormData();
                angular.forEach($scope.customer, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('maintain-customer-information', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.customer = {};
                    $scope.cuslogo = "";
                   $scope.getCustomerInformation();
                   $("#loader").removeClass('fa-spinner fa-sw fa-pulse').addClass('fa-save');
                });
            }
        };

        $scope.readUrl = function (element) {
            var reader = new FileReader();//rightbennerimage
            reader.onload = function (event) {
                $scope.cuslogo = event.target.result;
                $scope.$apply(function ($scope) {
                    $scope.customer.cust_logo = element.files[0];
                });
            };
            reader.readAsDataURL(element.files[0]);
        };


        $scope.getCustomerInformation = function () {
            $scope.customerinformations = {};
            $http.get('maintain-customer-information/' + $("#company_id").val()).then(function (response) {
                if (response.data.length > 0) {
                    $scope.customerinformations = response.data;
                }
            });
        };
        
        $scope.editCustomerInformation = function (id) {
            $http.get('maintain-customer-information/'+id+'/edit').then(function (response) {
                $scope.customer = response.data;
                if($scope.customer.customer_logo){
                    $scope.cuslogo = $scope.appurl + "public/customer_logo/" + $scope.customer.customer_logo;
                }
                $scope.editAddress($scope.customer.address_id);
                $scope.editContact($scope.customer.contact_id);
                $scope.editSocial($scope.customer.social_id);
            });
        };

        $scope.editAddress = function (address_id) {
            $http.get($scope.appurl + 'sourcing/get-log-address/' + address_id).then(function (response) {
                angular.extend($scope.customer, response.data[0]);
                //console.log($scope.inventory);
            });
        };

        $scope.editContact = function (contact_id) {
            $http.get($scope.appurl + 'sourcing/get-log-contact/' + contact_id).then(function (response) {
                angular.extend($scope.customer, response.data[0]);
                //console.log($scope.inventory);
            });
        };

        $scope.editSocial = function (social_id) {
            $http.get($scope.appurl + 'sourcing/get-log-social/' + social_id).then(function (response) {
                angular.extend($scope.customer, response.data[0]);
                //console.log($scope.inventory);
            });
        };
        $scope.deleteCustomerInformation = function (id) {
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $http.delete('maintain-customer-information/' + id).then(function (response) {
                    $scope.getCustomerInformation();
                    swal("Deleted!", response.data, "success");
                });
            });
        };

    });
</script>
@endsection