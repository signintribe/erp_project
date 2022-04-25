@extends('layouts.admin.creationTier')
@section('title', 'Categories')
@section('pagetitle', 'Categories')
@section('breadcrumb', 'Categories')
@section('content')
<link rel="stylesheet" href="{{ asset('public/dashboard/vendors/icheck/skins/all.css')}}">
<div ng-controller="CategoryController" ng-cloak>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Category</h4>
            </div>
            <div class="card-body" ng-init="get_allcategories(0)">
                <p class="card-description" ng-if="save_message" ng-bind="save_message"></p>
                <label>* Category Name:</label>
                <input type="text" class="form-control" placeholder="Category Name" ng-model="category.category_name"/>
                <i class="text-danger" ng-show="!category.category_name && showError"><small>Please Type Category Name</small></i><br/>
                <label>Parent Category:</label>
                <select class="form-control" ng-options="cat.id as cat.category_name for cat in categories" ng-model="category.parent_id">
                    <option value="">Select Parent Category</option>
                </select><br/>
                <!-- <div class="form-group row">
                    <div class="col">
                        <label>Measurement:</label>
                        <input type="text" class="form-control" placeholder="Measurement" ng-model="category.measurement"/>
                        <small class="text text-muted">Add category measurement if add 3rd level category</small>
                    </div>
                </div> -->
                <label>Category Description:</label>
                <textarea class="form-control" placeholder="Category Description" ng-model="category.category_description" rows="3" cols="3"></textarea><br/>
                <label>Category Image:</label>
                <input type="file" class="form-control" onchange="angular.element(this).scope().readUrl(this);"><br/>
                <img ng-if="catimage" ng-src="<% catimage %>" class="img img-responsive" style="width: 100%; height: 150px;"/><br/><br/>
                <button type="submit" class="btn btn-success btn-sm" ng-click="save_category()"> <i id="loader" class="fa fa-save"></i> Submit</button>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Categories</h2>
            </div>
            <div class="card-body">
                <p class="card-description" ng-if="delete_status" ng-bind="delete_status"></p>
                <div class="row">
                    <div class="col">
                        <div align='center' id="catone"></div>
                        <div class="form-group" ng-init="get_categorywithitsparents(1)">
                            <div class="form-check form-check-primary" ng-repeat="cats in categorywithparents">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="catone" ng-click="get_categoriesone(cats.id)">
                                    <%cats.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-xs" ng-click="get_category(cats.id)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="delete_category(cats.id)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="cattwo"></div>
                        <div class="form-group">
                            <div class="form-check form-check-warning" ng-repeat="catsone in categoryiesone">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="cattwo" ng-click="get_categoriestwo(catsone.id)">
                                    <%catsone.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-xs" ng-click="get_category(catsone.id)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="delete_category(catsone.id)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="catthree"></div>
                        <div class="form-group">
                            <div class="form-check form-check-success" ng-repeat="catstwo in categoryiestwo">
                                <label class="form-check-label">
                                    <input type="radio" name="catthree" class="form-check-input"  ng-click="get_categoriesthree(catstwo.id)">
                                    <%catstwo.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-xs" ng-click="get_category(catstwo.id)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="delete_category(catstwo.id)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="catfour"></div>
                        <div class="form-group">
                            <div class="form-check form-check-success" ng-repeat="catsthree in categoryiesthree">
                                <label class="form-check-label">
                                    <input type="radio" name="catfour" class="form-check-input"  ng-click="get_categoriesfour(catsthree.id)">
                                    <%catsthree.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-xs" ng-click="get_category(catsthree.id)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="delete_category(catsthree.id)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="catfive"></div>
                        <div class="form-group">
                            <div class="form-check form-check-success" ng-repeat="catsfour in categoryiesfour">
                                <label class="form-check-label">
                                    <input type="radio" name="catfive" class="form-check-input"  ng-click="get_categoriesfive(catsfour.id)">
                                    <%catsfour.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-xs" ng-click="get_category(catsfour.id)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="delete_category(catsfour.id)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div align='center' id="catsix"></div>
                        <div class="form-group">
                            <div class="form-check form-check-success" ng-repeat="catsfive in categoryiesfive">
                                <label class="form-check-label">
                                    <input type="radio" name="catsix" class="form-check-input"  ng-click="get_categoriessix(catsfive.id)">
                                    <%catsfive.category_name%>
                                    <i class="input-helper"></i>
                                </label>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-xs" ng-click="get_category(catsfive.id)">Edit</button>
                                    <button class="btn btn-danger btn-xs" ng-click="delete_category(catsfive.id)">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/material_management/categories.js')}}"></script>
@endsection