@extends('layouts.admin.master')
@section('title', 'Employee Payscale')
@section('content')
<div  ng-app="PayscaleApp" ng-controller="PayscaleController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Add Employee Payscale</h3>
                </div>
                <div class="col">
                    <button class="btn btn-xs btn-primary float-right" style="display:none" onclick="window.print();" id="ShowPrint">Print / Print PDF</button>
                </div>
            </div>
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
                    <input type="text" ng-model="payscale.valid_till" id="valid_till" datepicker class="form-control" placeholder="Valid till">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Status</label>
                    <p class="form-control">
                        <input type="checkbox" ng-model="payscale.status" id="status"> <label for="status">Status of PayScale</label>
                    </p>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn btn-sm btn-success" ng-click="save_payscale()">Save</button>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card d-print-none">
        <div class="card-body">
            <h3 class="card-title">Get All Payscale</h3>
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
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Payscale = angular.module('PayscaleApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    Payscale.directive('datepicker', function () {
        return {
            restrict: 'A',
            require: 'ngModel',
            compile: function () {
                return {
                    pre: function (scope, element, attrs, ngModelCtrl) {
                        var format, dateObj;
                        format = (!attrs.dpFormat) ? 'yyyy-mm-dd' : attrs.dpFormat;
                        if (!attrs.initDate && !attrs.dpFormat) {
                            // If there is no initDate attribute than we will get todays date as the default
                            dateObj = new Date();
//                            scope[attrs.ngModel] = dateObj.getFullYear() + '-' + (dateObj.getMonth() + 1) + '-' + dateObj.getDate();
                        } else if (!attrs.initDate) {
                            // Otherwise set as the init date
                            scope[attrs.ngModel] = attrs.initDate;
                        } else {
                            // I could put some complex logic that changes the order of the date string I
                            // create from the dateObj based on the format, but I'll leave that for now
                            // Or I could switch case and limit the types of formats...
                        }
                        // Initialize the date-picker
                        $(element).datepicker({
                            format: format
                        }).on('changeDate', function (ev) {
                            // To me this looks cleaner than adding $apply(); after everything.
                            scope.$apply(function () {
                                ngModelCtrl.$setViewValue(ev.format(format));
                            });
                        });
                    }
                };
            }
        };
    });


    Payscale.controller('PayscaleController', function ($scope, $http) {
        $scope.payscale = {};
        $scope.app_url = $("#appurl").val();
        $scope.all_companies = function () {
            $http.get($scope.app_url + 'company/getcompanyinfo').then(function (response) {
                if (response.data.length > 0) {
                    $scope.companies = response.data;
                }
            });
        };


        $scope.getoffice = function (company_id) {
            $scope.offices = {};
            $http.get($scope.app_url + 'company/getoffice/'+company_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.offices = response.data;
                }
            });
        };
        
        $scope.getDepartments = function (office_id) {
            $scope.departments = {};
            $http.get($scope.app_url + 'company/get-departments/'+office_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.departments = response.data;
                }
            });
        };

        $scope.getGroups = function (dep_id) {
            $scope.groups = {};
            $http.get($scope.app_url + 'company/get-groups/' + dep_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.groups = response.data;
                }
            });
        };

        $scope.get_payscale = function(){
            $http.get($scope.app_url + 'company/maintain-payscale').then(function (response) {
                if(response.data.length > 0){
                    $scope.payscales = response.data;
                }
            });
        }

        $scope.editPayscale = function(id){
            $http.get($scope.app_url + 'company/maintain-payscale/'+ id + '/edit').then(function (response) {
                $scope.payscale = response.data[0];
                $scope.payscale.company_id = parseInt($scope.payscale.company_id);
                $scope.payscale.office_id = parseInt($scope.payscale.office_id);
                $scope.payscale.department_id = parseInt($scope.payscale.department_id);
                $scope.payscale.group_id = parseInt($scope.payscale.group_id);
                $scope.payscale.status = $scope.payscale.status == 0 ? false : true;
                $("#ShowPrint").show();
            });
        }


        $scope.save_payscale = function () {
            if (!$scope.payscale.department_id || !$scope.payscale.payscale_name || !$scope.payscale.initial_pay) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.payscale, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.app_url + 'company/maintain-payscale', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.get_payscale();
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                    $scope.get_payscale();
                });
            }
        };

        $scope.deletePayScale = function(id){
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
                $http.delete($scope.app_url + 'company/maintain-payscale/'+id).then(function (response) {
                    $scope.get_payscale();
                    swal("Deleted!", response.data, "success");
                });
            });
        };
    });
</script>
@endsection