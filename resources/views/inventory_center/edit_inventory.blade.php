@extends('layouts.admin.master')
@section('title', 'Edit Inventory')
@section('content')
<div  ng-app="InventoryApp" ng-controller="InventoryController" ng-cloak>
    <div class="card" ng-init="editInventoryInfo({{$id}}); inventory.id={{$id}}">
        <div class="card-body">
            <h3 class="card-title">Product Information</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="product_name">* Name of Product/Service</label>
                    <input type="text" class="form-control" id="product_name" ng-model="inventory.product_name" placeholder="Name of Product/Service"/>
                    <i class="text-danger" ng-show="!inventory.product_name && showError"><small>Please Type Product Name</small></i>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="description">Description</label>
                    <textarea id="description" ng-model="inventory.product_description" class="form-control" cols="5" rows="5" placeholder="Product/Service Description"></textarea>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <label>Selected Category</label>
            </div>
            <button class="btn btn-success btn-rounded btn-fw btn-sm" ng-click="change_category()">
                <span ng-repeat="c in selectedCategories" ng-if="$index != 0">
                        <% selectedCategories[$index] %> <i class="fa fa-arrow-right" ng-if="$index + 1 < selectedCategories.length"></i>
                </span>
            </button><br>
            <div class="row" style="display: none;" id="categories">
                <div class="col">
                    <div align='center' id="catone"></div>
                    <div class="form-group" ng-init="get_categorywithitsparents(1)">
                        <div class="form-check form-check-primary" ng-repeat="cats in categorywithparents">
                            <label class="form-check-label" style="text-transform: capitalize">
                                <input type="radio" class="form-check-input" ng-model="inventory.category_id" ng-value="cats.id" ng-click="get_categoriesone(cats.id)">
                                    <% cats.category_name %>
                                <i class="input-helper"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div align='center' id="cattwo"></div>
                    <div class="form-group">
                        <div class="form-check form-check-warning" ng-repeat="catsone in categoryiesone">
                            <label class="form-check-label" style="text-transform: capitalize">
                                <input type="radio" class="form-check-input" ng-model="inventory.category_id" ng-value="catsone.id" ng-click="get_categoriestwo(catsone.id)">
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
                            <label class="form-check-label" style="text-transform: capitalize">
                                <input type="radio" class="form-check-input" ng-model="inventory.category_id"  ng-value="catstwo.id" ng-click="get_categoriesthree(catstwo.id)">
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
                            <label class="form-check-label" style="text-transform: capitalize">
                                <input type="radio" class="form-check-input" ng-model="inventory.category_id"  ng-value="catsthree.id" ng-click="get_categoriesfour(catsthree.id)">
                                <label for="" ng-bind="catsthree.category_name"></label>
                                <i class="input-helper"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div align='center' id="catfive"></div>
                    <div class="form-group">
                        <div class="form-check form-check-success" ng-repeat="catsfour in categoryiesfour">
                            <label class="form-check-label" style="text-transform: capitalize">
                                <input type="radio" class="form-check-input" ng-model="inventory.category_id"  ng-value="catsfour.id" ng-click="get_categoriesfive(catsfour.id)">
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
                            <label class="form-check-label" style="text-transform: capitalize">
                                <input type="radio" class="form-check-input" ng-model="inventory.category_id"  ng-value="catsfive.id" ng-click="get_categoriessix(catsfive.id)">
                                <%catsfive.category_name%>
                                <i class="input-helper"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div class="row">
                <label>Selected Attributes</label>
            </div><br/>
            <div ng-repeat="Attributes in catattributes">
                <div ng-repeat="(AttrName, catAtt) in Attributes">
                    <label ng-bind="AttrName" style="font-weight: bolder; text-transform: capitalize"></label><hr/>
                    <div ng-repeat="Av in catAtt">
                        <div>
                            <div ng-repeat="proAtt in SelectedAttributes">  
                                <p  data-ng-if="Av.id == proAtt.value_id">
                                    <mark style="color: red;"><% Av.value_name %></mark>
                                </p>                                 
                            </div>                          
                        </div>                       
                    </div>
                </div>
            </div><br/> 
            <div class="row" ng-if="attributes">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <label  style="font-weight: bolder; text-transform: capitalize; color: Green">Select Attributes Again</label>
                </div>
            </div><br/>
            <div id="attrbuts"></div>
            <div class="row" ng-repeat="attr in attributes">
                <div class="col" ng-repeat="(key, value) in attr">
                    <label ng-bind="key" style="font-weight: bolder; text-transform: capitalize"></label><hr/>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2" ng-repeat="atv in value" style="padding-bottom: 20px;">
                            <input type="checkbox" ng-click="getAttr(atv.id)" id="atv<% atv.id %>"> <label for="atv<% atv.id %>" ng-bind="atv.value_name"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Product Pricing</h3>
            <div class="row">
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
                    <input type="text" class="form-control" id="gross_price" ng-model="inventory.gross_pur_price" placeholder="Gross Purchase Price"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="carriage_charges">Carriage Inward Charges</label>
                    <input type="text" class="form-control" id="carriage_charges" ng-model="inventory.carriage_inward_charges" placeholder="Carriage Inward Charges"/>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="octri_taxes">Octri and Taxes</label>
                    <input type="text" class="form-control" id="octri_taxes" ng-model="inventory.octri_taxes" placeholder="Octri and Taxes"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly ng-model="inventory.net_pur_price" placeholder="Net Purchase Price at Godown" aria-label="Recipient's username">
                            <div class="input-group-append">
                            <button class="btn btn-sm btn-success" ng-click="calculate()" type="button">Calculate</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br/>
            <!-- <div class="row">
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <label for="net_price">Net Purchase Price at Godown</label>
                    <input type="text" class="form-control" id="net_price"  readonly ng-model="inventory.net_pur_price" placeholder="Net Purchase Price at Godown"/>
                    <button ng-click="calculate()">Calculate</button>
                </div>
            </div><br/> -->
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Vendor Information</h3>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3" ng-init="getVendors()">
                <label for="organization_name">Name of Vendor</label>
                    <select class="form-control"  ng-options="vendor.id as vendor.organization_name for vendor in vendorinformations" ng-model="inventory.vendor_name">
                        <option value="">Select Vendor Name</option>
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
                    <input type="text" class="form-control" id="stockin_hand" ng-model="inventory.stock_in_hand" placeholder="Stock in hand"/>
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
                    <input type="text" class="form-control" id="stockon_purchase" ng-model="inventory.stock_pur_order" placeholder="Stock on Purchase Order"/>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="stockon_sales">Stock on Sales Order</label>
                    <input type="text" class="form-control" id="stockon_sales" ng-model="inventory.stock_sale_order" placeholder="Stock on Sales Order"/>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-body" ng-init="getAccounts()">
            <h3 class="card-title">Accounts</h3>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label>Chart of Account Id Cost of Sales</label>
                    <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="inventory.chartof_account_cost">
                        <option value="">Select Chart of Account Id Cost of Sales</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label>Chart of Account Id Inventory</label>
                    <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="inventory.chartof_account_inventory">
                        <option value="">Select Chart of Account Id Inventory</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <label>Chart of Account Id Sales</label>
                    <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="inventory.chartof_account_sale">
                        <option value="">Select Chart of Account Id Sales</option>
                    </select>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-success btn-sm float-right" ng-click="saveInventory()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
<script src="{{ asset('public/js/angular.min.js')}}"></script>
<script>
    var Inventory = angular.module('InventoryApp', [], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    Inventory.controller('InventoryController', function ($scope, $http) {
        $scope.appurl = $("#appurl").val();
        $scope.getAccounts = function () {
            var Accounts = $http.get($scope.appurl + 'AllchartofAccount');
            Accounts.then(function (r) {
                $scope.Accounts = r.data;
            });
        };
        $scope.inventory = {};
        $scope.calculate = function(){
            $scope.inventory.net_pur_price = parseInt($scope.inventory.income_tax) + parseInt($scope.inventory.withholding_tax) + 
            parseInt($scope.inventory.sales_tax) + parseInt($scope.inventory.fed) + parseInt($scope.inventory.import_duty) +
            parseInt($scope.inventory.tax_adjustment) + parseInt($scope.inventory.tax_exemption) + parseInt($scope.inventory.delivery_charges) +             
            parseInt($scope.inventory.gross_pur_price) + parseInt($scope.inventory.carriage_inward_charges) + parseInt($scope.inventory.octri_taxes);            
        };
        $scope.change_category = function(){
            $('#categories').show('slow');
        };
        $scope.saveInventory = function(){
            $scope.inventory.attributes = JSON.stringify($scope.attrvals);
            //console.log($scope.inventory);
            if (!$scope.inventory.product_name) {
                $scope.showError = true;
                jQuery("input.required").filter(function () {
                    return !this.value;
                }).addClass("has-error");
            } else {
                var Data = new FormData();
                angular.forEach($scope.inventory, function (v, k) {
                    Data.append(k, v);
                });
                $http.post($scope.appurl + 'save-inventory', Data, {transformRequest: angular.identity, headers: {'Content-Type': undefined}}).then(function (res) {
                    swal({
                        title: "Save!",
                        text: res.data,
                        type: "success"
                    });
                });
            }
        };
        $scope.calculate = function(){
            if(!$scope.inventory.income_tax){
              $scope.inventory.income_tax = 0;
            }
            if(!$scope.inventory.withholding_tax){
                $scope.inventory.withholding_tax = 0;
            }
            if(!$scope.inventory.sales_tax){
                $scope.inventory.sales_tax = 0;
            }
            if(!$scope.inventory.fed){
                $scope.inventory.fed = 0;
            }
            if(!$scope.inventory.import_duty){
                $scope.inventory.import_duty = 0;
            }
            if(!$scope.inventory.tax_adjustment){
                $scope.inventory.tax_adjustment = 0;
            }
            if(!$scope.inventory.tax_exemption){
                $scope.inventory.tax_exemption = 0;
            }
            if(!$scope.inventory.delivery_charges){
                $scope.inventory.delivery_charges = 0;
            }
            if(!$scope.inventory.gross_pur_price){
                $scope.inventory.gross_pur_price = 0;
            }
            if(!$scope.inventory.carriage_inward_charges){
                $scope.inventory.carriage_inward_charges = 0;
            }
            if(!$scope.inventory.octri_taxes){
                $scope.inventory.octri_taxes = 0;
            }
            $scope.inventory.net_pur_price = parseInt($scope.inventory.income_tax) + parseInt($scope.inventory.withholding_tax) + 
            parseInt($scope.inventory.sales_tax) + parseInt($scope.inventory.fed) + parseInt($scope.inventory.import_duty) +
            parseInt($scope.inventory.tax_adjustment) + parseInt($scope.inventory.tax_exemption) + parseInt($scope.inventory.delivery_charges) +             
            parseInt($scope.inventory.gross_pur_price) + parseInt($scope.inventory.carriage_inward_charges) + parseInt($scope.inventory.octri_taxes);            
        };
       
        $scope.getVendors = function () {
            $scope.vendorinformations = {};
            $http.get($scope.appurl + 'vendor/maintain-vendor-information').then(function (response) {
                if (response.data.length > 0) {
                    $scope.vendorinformations = response.data;
                }
            });
        };

        $scope.get_allcategories = function (category_id) {
            $http.get($scope.appurl + 'get_categories/' + category_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categories = response.data;
                }
            });
        };

        $scope.get_categorywithitsparents = function (parent_id) {
            $scope.categorywithparents = {};
            $("#catone").html('<div class="square-path-loader"></div>');
            $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categorywithparents = response.data;
                    $("#catone").html('');
                } else {
                    $("#catone").html('');
                    $scope.getAttributes(parent_id);
                }
            });
        };

        $scope.get_categoriesone = function (parent_id) {
            $scope.categoryiesone = {};
            $scope.categoryiestwo = {};
            $scope.categoryiesthree = {};
            $scope.categoryiesfour = {};
            $scope.categoryiesfive = {};
            $("#cattwo").html('<div class="square-path-loader"></div>');
            $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesone = response.data;
                    $("#cattwo").html('');
                } else {
                    $("#cattwo").html('');
                    $scope.getAttributes(parent_id);
                }
            });
        };

        $scope.get_categoriestwo = function (parent_id) {
            $scope.categoryiestwo = {};
            $scope.categoryiesthree = {};
            $scope.categoryiesfour = {};
            $scope.categoryiesfive = {};
            $("#catthree").html('<div class="square-path-loader"></div>');
            $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiestwo = response.data;
                    $("#catthree").html('');
                } else {
                    $("#catthree").html('');
                    $scope.getAttributes(parent_id);
                }
            });
        };

        $scope.get_categoriesthree = function (parent_id) {
            $scope.categoryiesthree = {};
            $scope.categoryiesfour = {};
            $scope.categoryiesfive = {};
            $("#catfour").html('<div class="square-path-loader"></div>');
            $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesthree = response.data;
                    $("#catfour").html('');
                } else {
                    $("#catfour").html('');
                    $scope.getAttributes(parent_id);
                }
            });
        };

        $scope.get_categoriesfour = function (parent_id) {
            $scope.categoryiesfour = {};
            $scope.categoryiesfive = {};
            $("#catfive").html('<div class="square-path-loader"></div>');
            $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesfour = response.data;
                    $("#catfive").html('');
                } else {
                    $("#catfive").html('');
                    $scope.getAttributes(parent_id);
                }
            });
        };

        $scope.get_categoriesfive = function (parent_id) {
            $scope.categoryiesfive = {};
            $("#catsix").html('<div class="square-path-loader"></div>');
            $http.get($scope.appurl + 'get-categorywithitsparents/' + parent_id).then(function (response) {
                if (response.data.length > 0) {
                    $scope.categoryiesfive = response.data;
                    $("#catsix").html('');
                } else {
                    $("#catsix").html('');
                    $scope.getAttributes(parent_id);
                }
            });
        };

        $scope.getAttributes = function (category_id) {
            $scope.attributes = {};
            $("#attrbuts").html('<div class="square-path-loader"></div>');
            $http.get($scope.appurl + 'get-attr-values/' + category_id).then(function (response) {
                if (response.data.status == true) {
                    $scope.attributes = response.data.data;
                    $("#attrbuts").html('');
                    //console.log($scope.attributes);
                } else {
                    $("#attrbuts").html('');
                }
            });
        };
        $scope.attrvals = [];
        $scope.getAttr = function(attr_id){
            let index = $scope.attrvals.indexOf(attr_id);
            if(index == -1){
                $scope.attrvals.push(attr_id);
            }else{
                $scope.attrvals.splice(index, 1);
            }
        };

        $scope.get_category = function (category_id) {
            $http.get($scope.appurl + 'get_categories/' + category_id).then(function (response) {
                $scope.category = response.data[0];
            });
        };

        $scope.editInventoryInfo = function (id) {
            $http.get($scope.appurl + 'get-inventory-info/'+id).then(function (response) {
                $scope.inventory = response.data;
                $scope.getInventoryStock($scope.inventory.id);
                $scope.getInventoryPricing($scope.inventory.id);
                $scope.getInventoryAccount($scope.inventory.id);
                $scope.getInventoryVendor($scope.inventory.id);
                $scope.getInventoryCategory($scope.inventory.category_id);
                $scope.getInventoryAttributes($scope.inventory.category_id);
                $scope.getSelectedAttributes($scope.inventory.id);
                //console.log($scope.inventory);
            });
        };

        $scope.getInventoryStock = function(id){
            $http.get($scope.appurl + 'get-stock/'+id).then(function (response) {
                angular.extend($scope.inventory, response.data);                
            });
        };

        $scope.getInventoryPricing = function(id){
            $http.get($scope.appurl + 'get-pricing/'+id).then(function (response) {
                angular.extend($scope.inventory, response.data);                
            });
        };

        $scope.getInventoryAccount = function(id){
            $http.get($scope.appurl + 'get-account/' + id).then(function (response) {
                angular.extend($scope.inventory, response.data);  
                $scope.inventory.chartof_account_cost = parseInt(response.data.chartof_account_cost);
                $scope.inventory.chartof_account_inventory = parseInt(response.data.chartof_account_inventory);
                $scope.inventory.chartof_account_sale = parseInt(response.data.chartof_account_sale);              
            });
        };

        $scope.getInventoryVendor = function(id){
            $http.get($scope.appurl + 'get-vendor/' + id).then(function (response) {
                angular.extend($scope.inventory, response.data); 
                $scope.inventory.vendor_name = parseInt(response.data.vendor_name);               
            });
        };

        $scope.getInventoryCategory = function(id){
            $http.get($scope.appurl + 'get-category/' + id).then(function (response) {
                $scope.selectedCategories = response.data;
            });
        };

        $scope.getInventoryAttributes = function(id){
            $scope.catattributes = {};
            $("#attrbuts").html('<div class="square-path-loader"></div>');
            $http.get($scope.appurl + 'get-attribute/' + id).then(function (response) {
                if (response.data.status == true) {
                    $scope.catattributes = response.data.data;
                    $("#attrbuts").html('');
                    //console.log($scope.catattributes);
                } else {
                    $("#attrbuts").html('');
                }
            });
        };

        $scope.getSelectedAttributes = function(id){
            $http.get($scope.appurl + 'get-selected-atts/' + id).then(function (response) {
                $scope.SelectedAttributes = response.data;
            });
        };
    });
</script>
@endsection