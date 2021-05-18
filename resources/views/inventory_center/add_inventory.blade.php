@extends('layouts.admin.master')
@section('title', 'Add Inventory')
@section('content')
<div  ng-app="InventoryApp" ng-controller="InventoryController" ng-cloak>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Product Information</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="product_name">Name of Product/Service</label>
                    <input type="text" class="form-control" id="product_name" ng-model="inventory.product_name" placeholder="Name of Product/Service"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="description">Description</label>
                    <textarea id="description" ng-model="inventory.description" class="form-control" cols="5" rows="5" placeholder="Product/Service Description"></textarea>
                </div>
            </div><br/>
            <div class="row">
                <label>Select Category</label>
            </div>
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
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <label>Select Attributes</label><br/>
                    <input type="checkbox"> <label>Brand</label><br/>
                    <input type="checkbox"> <label>Model</label><br/>
                    <input type="checkbox"> <label>Warranty Type</label><br/>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Product Pricing</h3>
            <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="product_price">Product Price</label>
                    <input type="text" class="form-control" id="product_price" ng-model="inventory.product_price" placeholder="Product Price"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="income_tax">Income Tax</label>
                    <input type="text" class="form-control" id="income_tax" ng-model="inventory.income_tax" placeholder="Income Tax"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="withholding_tax">Withholding Tax</label>
                    <input type="text" class="form-control" id="withholding_tax" ng-model="inventory.withholding_tax" placeholder="Withholding Tax"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="sales_tax">Sales Tax</label>
                    <input type="text" class="form-control" id="sales_tax" ng-model="inventory.sales_tax" placeholder="Sales Tax"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="fed">FED</label>
                    <input type="text" class="form-control" id="fed" ng-model="inventory.fed" placeholder="FED"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="import_duty">Import Duty</label>
                    <input type="text" class="form-control" id="import_duty" ng-model="inventory.import_duty" placeholder="Import Duty"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="tax_adjustment">Tax Adjustment</label>
                    <input type="text" class="form-control" id="tax_adjustment" ng-model="inventory.tax_adjustment" placeholder="Tax Adjustment"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="tax_exemption">Tax Exemption</label>
                    <input type="text" class="form-control" id="tax_exemption" ng-model="inventory.tax_exemption" placeholder="Tax Exemption"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="delivery_charges">Delivery Charges</label>
                    <input type="text" class="form-control" id="delivery_charges" ng-model="inventory.delivery_charges" placeholder="Delivery Charges"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="gross_price">Gross Purchase Price</label>
                    <input type="text" class="form-control" id="gross_price" ng-model="inventory.gross_price" placeholder="Gross Purchase Price"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="carriage_charges">Carriage Inward Charges</label>
                    <input type="text" class="form-control" id="carriage_charges" ng-model="inventory.carriage_charges" placeholder="Carriage Inward Charges"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="octri_taxes">Octri and Taxes</label>
                    <input type="text" class="form-control" id="octri_taxes" ng-model="inventory.octri_taxes" placeholder="Octri and Taxes"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="net_price">Net Purchase Price at Godown</label>
                    <input type="text" class="form-control" id="net_price" ng-model="inventory.net_price" placeholder="Net Purchase Price at Godown"/>
                </div>
            </div><br/>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Vendor Information</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="vendor">Select Vendor</label>
                    <select class="form-control" id="vendor" ng-model="inventory.vendor_id">
                        <option value="">Select Vendor</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="stock_class">Stock Class</label>
                    <select class="form-control" id="stock_class" ng-model="inventory.stock_class">
                        <option value="">Stock Class</option>
                        <option value="For Sale">For Sale</option>
                        <option value="For Office">For Office</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="stock_classproduct_status">Product Status</label>
                    <select class="form-control" id="product_status" ng-model="inventory.product_status">
                        <option value="">Product Status</option>
                        <option value="Active">Active</option>
                        <option value="In Active">In Active</option>
                    </select>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Stock Availability</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="stockin_hand">Stock in hand</label>
                    <input type="text" class="form-control" id="stockin_hand" ng-model="inventory.stockin_hand" placeholder="Stock in hand"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="store_name">Store Name</label>
                    <input type="text" class="form-control" id="store_name" ng-model="inventory.store_name" placeholder="Store Name"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="reorder_quantity">Reorder Quantity</label>
                    <input type="text" class="form-control" id="reorder_quantity" ng-model="inventory.reorder_quantity" placeholder="Reorder Quantity"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="stockon_purchase">Stock on Purchase Order</label>
                    <input type="text" class="form-control" id="stockon_purchase" ng-model="inventory.stockon_purchase" placeholder="Stock on Purchase Order"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="stockon_sales">Stock on Sales Order</label>
                    <input type="text" class="form-control" id="stockon_sales" ng-model="inventory.stockon_sales" placeholder="Stock on Sales Order"/>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Accounts</h3>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="chartof_account_cost">Chart of Account Id Cost of Sales</label>
                    <input type="text" class="form-control" id="chartof_account_cost" ng-model="inventory.chartof_account_cost" placeholder="Chart of Account Id Cost of Sales"/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="chartof_account_inventory">Chart of Account Id Inventory</label>
                    <input type="text" class="form-control" id="chartof_account_inventory" ng-model="inventory.chartof_account_inventory" placeholder="Chart of Account Id Inventory"/>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label for="chartof_account_sale">Chart of Account Id Sales</label>
                    <input type="text" class="form-control" id="chartof_account_sale" ng-model="inventory.chartof_account_sale" placeholder="Chart of Account Id Sales"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-success btn-sm float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Inventory = angular.module('InventoryApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Inventory.controller('InventoryController', function ($scope, $http) {
        $scope.get_allcategories = function (category_id) {
            $http.get('get_categories/' + category_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categories = response.data;
                }
            });
        };

        $scope.get_categorywithitsparents = function (parent_id) {
            $scope.categorywithparents = {};
            $("#catone").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categorywithparents = response.data;
                    $("#catone").html('');
                } else {
                    $("#catone").html('');
                }
            });
        };

        $scope.get_categoriesone = function (parent_id) {
            $scope.categoryiesone = {};
            $scope.categoryiestwo = {};
            $("#cattwo").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesone = response.data;
                    $("#cattwo").html('');
                } else {
                    $("#cattwo").html('');
                }
            });
        };

        $scope.get_categoriestwo = function (parent_id) {
            $scope.categoryiestwo = {};
            $("#catthree").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiestwo = response.data;
                    $("#catthree").html('');
                } else {
                    $("#catthree").html('');
                }
            });
        };

        $scope.get_categoriesthree = function (parent_id) {
            $scope.categoryiesthree = {};
            $("#catfour").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesthree = response.data;
                    $("#catfour").html('');
                } else {
                    $("#catfour").html('');
                }
            });
        };

        $scope.get_categoriesfour = function (parent_id) {
            $scope.categoryiesfour = {};
            $("#catfive").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesfour = response.data;
                    $("#catfive").html('');
                } else {
                    $("#catfive").html('');
                }
            });
        };

        $scope.get_categoriesfive = function (parent_id) {
            $scope.categoryiesfive = {};
            $("#catsix").html('<div class="square-path-loader"></div>');
            $http.get('get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesfive = response.data;
                    $("#catsix").html('');
                } else {
                    $("#catsix").html('');
                }
            });
        };

        $scope.get_category = function (category_id) {
            $http.get('get_categories/' + category_id).then(function (response) {
                $scope.category = response.data[0];
            });
        };
    });
</script>
@endsection