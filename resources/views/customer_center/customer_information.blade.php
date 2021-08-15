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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="customer_type">* Type of Customer</label>
                    <select class="form-control" ng-model="customer.customer_type" id="customer_type">
                        <option value="">Type of Customer</option>
                        <option value="Individual">Individual</option>
                        <option value="Organization">Organization</option>
                    </select>
                    <i class="text-danger" ng-show="!customer.customer_type && showError"><small>Please Select Customer Type</small></i>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_name">* Customer Name</label>
                    <input type="text" class="form-control" id="customer_name" ng-model="customer.customer_name" placeholder="Cusomer Name"/>
                    <i class="text-danger" ng-show="!customer.customer_name && showError"><small>Please Enter Customer Name</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="ntn_no">NTN</label>
                    <input type="text" class="form-control" id="ntn_no" ng-model="customer.ntn_no" placeholder="NTN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="incroporation_no">Incroporation/License No.</label>
                    <input type="text" class="form-control" id="incroporation_no" ng-model="customer.incroporation_no" placeholder="Incroporation/License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="customer_logo">Logo</label>
                    <input type="file" class="form-control" id="customer_logo" onchange="angular.element(this).scope().readUrl(this);"/>
                    <img ng-if="cuslogo" ng-src="<% cuslogo %>" class="img img-thumbnail" style-="width:100%; height:200px;">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="strn">STRN</label>
                    <input type="text" class="form-control" id="strn" ng-model="customer.strn" placeholder="STRN"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="import_license">Import License No.</label>
                    <input type="text" class="form-control" id="import_license" ng-model="customer.import_license" placeholder="Import License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="export_license">Export License No.</label>
                    <input type="text" class="form-control" id="export_license" ng-model="customer.export_license" placeholder="Export License No."/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="chamber_no">Chamber of Commerce License No.</label>
                    <input type="text" class="form-control" id="chamber_no" ng-model="customer.chamber_no" placeholder="Chamber of Commerce License No."/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="currency_dealing">Currency in dealing</label>
                    <input type="text" class="form-control" id="currency_dealing" ng-model="customer.currency_dealing" placeholder="Currency in dealing"/>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-left" ng-click="save_customerInformation()">Save</button>
                </div>
            </div>
        </div>
    </div><br/>
    <!-- <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-sm btn-success float-right" ng-click="save_customerInformation()">Save</button>
                </div>
            </div>
        </div>
    </div><br> -->
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
                        <th>NTN</th>
                        <th>Incroporation/License No</th>
                        <th>Customer Logo</th>
                        <th>STRN</th>
                        <th>Import License No.</th>
                        <th>Export License No.</th>
                        <th>Chamber of Commerce License No.</th>
                        <th>Currency in dealing</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody ng-init="getCustomerInformation()">
                    <tr ng-repeat="customer in customerinformations">
                        <td ng-bind="$index+1"></td>
                        <td ng-bind="customer.customer_type"></td>
                        <td ng-bind="customer.customer_name"></td>
                        <td ng-bind="customer.ntn_no "></td>
                        <td ng-bind="customer.incroporation_no"></td>
                        <td>
                            <img ng-src="{{asset('public/customer_logo/<% customer.customer_logo %>')}}" alt="">
                        </td>
                        <td ng-bind="customer.strn"></td>
                        <td ng-bind="customer.import_license"></td>
                        <td ng-bind="customer.export_license"></td>
                        <td ng-bind="customer.chamber_no"></td>
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
            if (!$scope.customer.customer_type || !$scope.customer.customer_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
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
            $http.get('maintain-customer-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.customerinformations = response.data;
                }
            });
        };
        
        $scope.editCustomerInformation = function (id) {
            $http.get('maintain-customer-information/'+id+'/edit').then(function (response) {
                $scope.customer = response.data;
                $scope.cuslogo = $scope.appurl + "public/customer_logo/" + $scope.customer.customer_logo;
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