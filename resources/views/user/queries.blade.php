@extends('layouts.user.master')
@section('title', 'Customer Queries')
@section('content')
<div  ng-app="QueryApp" ng-controller="QueryController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Your Queries</h2>
            <div class="table-responsive">
                <table class="table table-bordered" style="font-size:12px;">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th style="font-size:12px;">Customer Name</th>
                            <th style="font-size:12px;">Customer Email</th>
                            <th style="font-size:12px;">Category Name</th>
                            <th style="font-size:12px;">Whatsapp</th>
                            <th style="font-size:12px;">Phone Number</th>
                            <th style="font-size:12px;">Mobile Number</th>
                            <th style="font-size:12px;">Status</th>
                            <th style="font-size:12px;">Expected Date</th>
                            <th style="font-size:12px;">Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="all_queries();">
                        <tr ng-repeat="query in Queries">
                            <td ng-bind="$index + 1" style="font-size:12px;"></td>
                            <td ng-bind="query.full_name" style="font-size:12px;"></td>
                            <td ng-bind="query.email" style="font-size:12px;"></td>
                            <td ng-bind="query.category_name" style="font-size:12px;"></td>
                            <td ng-bind="query.whatsapp" style="font-size:12px;"></td>
                            <td ng-bind="query.phone_number" style="font-size:12px;"></td>
                            <td ng-bind="query.mobile_number" style="font-size:12px;"></td>
                            <td ng-bind="query.status" style="font-size:12px;"></td>
                            <td ng-bind="query.expected_date" style="font-size:12px;"></td>
                            <td>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" ng-click="get_complete(query.id);" data-target="#myModal<%query.id%>">Detail</button>
                                <!-- The Modal -->
                                <div class="modal" id="myModal<%query.id%>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Query Detail</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Customer Name</label>
                                                                <p class="form-control" ng-bind="query.full_name"></p>
                                                            </div>
                                                            <div class="col">
                                                                <label>Phone Number</label>
                                                                <p class="form-control" ng-bind="query.phone_number"></p>
                                                            </div>
                                                        </div><br/>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Mobile Number</label>
                                                                <p class="form-control" ng-bind="query.mobile_number"></p>
                                                            </div>
                                                            <div class="col">
                                                                <label>Email</label>
                                                                <p class="form-control" ng-bind="query.email"></p>
                                                            </div>
                                                        </div><br/>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Selected Categories</label><br/>
                                                                <p class="form-control">
                                                                    <span ng-bind="categories[0].category_name"></span> <i class="fa fa-long-arrow-right"></i> <span ng-bind="categories[1].category_name"></span> <i class="fa fa-long-arrow-right"></i> <span ng-bind="categories[2].category_name"></span>
                                                                </p>
                                                            </div>
                                                        </div><br/>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Description</label><br/>
                                                                <p class="form-control" ng-bind="SQuery.query_discription" style="line-height: 25px;"></p>
                                                            </div>
                                                        </div><br/>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Expected Date</label><br/>
                                                                <p class="form-control" ng-bind="SQuery.expected_date"></p>
                                                            </div>
                                                            <div class="col">
                                                                <label>Schedule Date</label><br/>
                                                                <div id="datetimepicker1" class="input-group date datepicker">
                                                                    <input type="text" class="form-control" datepicker  ng-model="SQuery.schedule_date" placeholder="Schedule Date">
                                                                    <span class="input-group-addon input-group-append border-left">
                                                                        <span class="mdi mdi-calendar input-group-text"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div><br/>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Installing Date</label><br/>
                                                                <div id="datetimepicker1" class="input-group date datepicker">
                                                                    <input type="text" class="form-control" datepicker  ng-model="SQuery.installing_date" placeholder="Installing Date">
                                                                    <span class="input-group-addon input-group-append border-left">
                                                                        <span class="mdi mdi-calendar input-group-text"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <label>Price</label><br/>
                                                                <input type="text" class="form-control" placeholder="Price" ng-model="SQuery.price"/>
                                                            </div>
                                                        </div><br/>
                                                        <div class="row" ng-if="query.status === 'Pending' || query.status === 'Accept'">
                                                            <div class="col">
                                                                <label>Comment(If query reject)</label><br/>
                                                                <textarea cols="5" rows="5" class="form-control" ng-model="SQuery.reject_comment" placeholder="Write comment if query reject..."></textarea>
                                                            </div>
                                                        </div><br/>
                                                        <p ng-if="query.status === 'Pending'">
                                                            <button type="button" class="btn btn-danger btn-sm" ng-click="query_status('Reject')">Reject</button>
                                                            <button type="button" class="btn btn-success btn-sm" ng-click="query_status('Accept')">Accept</button>
                                                        </p>
                                                        <p ng-if="query.status === 'Accept'">
                                                            <button type="button" class="btn btn-danger btn-sm" ng-click="query_status('Reject')">Reject</button>
                                                        </p>
                                                        <p ng-if="query.status === 'Reject'">
                                                            <button type="button" class="btn btn-success btn-sm" ng-click="query_status('Accept')">Accept</button>
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label>Follow Up's</label>
                                                                <textarea class="form-control" ng-model="followup.follow_up" placeholder="Follow up ..."></textarea><br/>
                                                                <i class="text-danger" ng-show="!followup.follow_up && showError"><small>Please Type Follow Up</small></i>
                                                                <button type="button" class="btn btn-sm btn-success" ng-click="save_followup()">Submit</button>
                                                            </div>
                                                        </div>
                                                        <br/><br/>
                                                        <div class="row">
                                                            <div class="col" style="height: 657px; overflow-y: scroll">
                                                                <p ng-if="save_FollowUp_Status" ng-bind="save_FollowUp_Status"></p>
                                                                <blockquote ng-repeat="f in followups" class="blockquote">
                                                                    <p ng-bind="f.follow_up"></p>
                                                                    <footer ng-bind="f.created_at" class="text text-small text-right blockquote-footer"></footer>
                                                                </blockquote>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}">
</script>
<script>

    var CompanyQueries = angular.module('QueryApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    CompanyQueries.directive('datepicker', function () {
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

    CompanyQueries.controller('QueryController', function ($scope, $http) {
        $scope.all_queries = function () {
            $http.get('all-company-queries').then(function (response) {
                if (response.data.length > 0) {
                    $scope.Queries = response.data;
                }
            });
        };

        $scope.get_complete = function (query_id) {
            $http.get('specific-query/' + query_id).then(function (response) {
                $scope.SQuery = response.data;
                $scope.followup.query_id = $scope.SQuery.id;
                $scope.get_followups($scope.followup.query_id);
                $scope.get_selected_category($scope.SQuery.category_id);
                $scope.schedule_info(response.data.id);
            });
        };

        $scope.get_selected_category = function (category_id) {
            $http.get('get-selected-category/' + category_id).then(function (response) {
                $scope.categories = response.data;
            });
        };

        $scope.schedule_info = function (query_id) {
            $http.get('schedule-query/' + query_id).then(function (response) {
                angular.extend($scope.SQuery, response.data);
            });
        };
        $scope.SQuery = {};
        $scope.query_status = function (status) {

            $scope.SQuery.status = status;
            var Data = new FormData();
            angular.forEach($scope.SQuery, function (v, k) {
                Data.append(k, v);
            });
            $http.post('save-query-status', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                swal({
                    title: "Save!",
                    text: res.data,
                    type: "success"
                });
                $scope.all_queries();
                $("#myModal" + $scope.SQuery.id).modal('hide');
            });
        };
        $scope.followup = {};
        $scope.save_followup = function () {
            if (!$scope.followup.follow_up) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.followup, function (v, k) {
                    Data.append(k, v);
                });
                $http.post('save-query-followup', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    $scope.save_FollowUp_Status = res.data;
                    $scope.get_followups($scope.followup.query_id);
                });
            }
        };

        $scope.get_followups = function (query_id) {
            $http.get('get-query-followup/' + query_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.followups = response.data;
                }
            });
        };
    });
</script>
@endsection