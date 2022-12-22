@extends('layouts.admin.reportTier')
@section('title', 'HR Report')
@section('pagetitle', 'HR Report')
@section('breadcrumb', 'HR Report')
@section('content')
<div ng-controller="ReportController">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Criteria</h3>
                </div>
                <div class="card-body">
                    <label for="worked_country">Worked Country</label>
                    <input type="text" ng-model="filter.worked_country" placeholder="Worked Country" id="worked_country" class="form-control"><br>
                    <label for="salary">Salary</label>
                    <div class="row">
                        <div class="col">
                            <input type="number" ng-model="filter.to_salary" placeholder="To Salary" id="salary" class="form-control">
                            <i class="text-danger" ng-show="!filter.to_salary && showError"><small>Please Type Salary</small></i>
                        </div>
                        <div class="col">
                            <input type="number" ng-model="filter.from_salary" placeholder="From Salary" class="form-control">
                            <i class="text-danger" ng-show="!filter.from_salary && showError"><small>Please Type Salary</small></i>
                        </div>
                    </div><hr>
                    <label for="gender">Gender</label>
                    <div class="row">
                        <div class="col">
                            <p class="form-control">
                                <input type="radio" ng-model="filter.gender" value="Male" id="male"> <label for="male">Male</label>
                            </p>
                        </div>
                        <div class="col">
                            <p class="form-control">
                                <input type="radio" ng-model="filter.gender" value="Female" id="female"> <label for="female">Female</label>
                            </p>
                        </div>
                    </div><hr/>
                    <label for="qualification">Qualification</label>
                    <input type="text" ng-model="filter.qualification" id="qualification" placeholder="Qualification" class="form-control"><hr>
                    <label for="country">Living Country</label>
                    <input type="text" ng-model="filter.living_country" id="country" placeholder="Living Country" class="form-control"><br>
                    <button class="btn btn-success btn-md" ng-click="filterEmployee()">Search</button>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-md-6">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-warning">
                            <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Nadia Carmichael</h3>
                            <h5 class="widget-user-desc">Lead Developer</h5>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                Projects <span class="float-right badge bg-primary">31</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                Tasks <span class="float-right badge bg-info">5</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                Completed Projects <span class="float-right badge bg-success">12</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                Followers <span class="float-right badge bg-danger">842</span>
                                </a>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/report_tier/hr-report.js')}}"></script>
@endsection