@extends('layouts.admin.creationTier')
@section('title', 'Edit Inventory')
@section('pagetitle', 'Edit Inventory')
@section('breadcrumb', 'Edit Inventory')
@section('content')
<div ng-controller="InventoryController" ng-cloak>
    <div class="card" ng-init="editInventoryInfo({{$id}}); inventory.id={{$id}}">
        <div class="card-header">
            <h3 class="card-title">Product Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="barcode_id">* Barcode Id</label>
                    <input type="text" class="form-control" id="barcode_id" ng-model="inventory.barcode_id" placeholder="Product Barcode Id"/>
                    <i class="text-danger" ng-show="!inventory.barcode_id && showError"><small>Please Type Product Barcode Id</small></i>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
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
        <div class="card-header">
            <h3 class="card-title">Select Categories and Attributes</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <label>Selected Category</label>
            </div>
            <button class="btn btn-success btn-rounded btn-fw btn-sm" ng-click="change_category()">
                <span ng-repeat="c in selectedCategories">
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
        <div class="card-header">
            <h3 class="card-title">Product Pricing</h3>
        </div>
        <div class="card-body">
            <div class="row" ng-init="getCompanyTaxes();">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="delivery_charges">Delivery Charges</label>
                    <input type="number" class="form-control" id="delivery_charges" ng-model="inventory.delivery_charges" placeholder="Delivery Charges"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="cost_price">Cost Price</label>
                    <input type="number" class="form-control" id="cost_price" ng-model="inventory.cost_price" placeholder="Cost Price"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="carriage_charges">Carriage Inward Charges</label>
                    <input type="number" class="form-control" id="carriage_charges" ng-model="inventory.carriage_inward_charges" placeholder="Carriage Inward Charges"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Gross Price</label>
                    <p ng-bind="inventory.delivery_charges + inventory.cost_price + inventory.carriage_inward_charges" class="form-control"></p>
                </div>
            </div><br/>
            <div class="row" id="selectedTaxes">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="4">
                                        These are the taxes that you are selected while saving the product
                                    </th>
                                </tr>
                                <tr>
                                    <th>Authority Name</th>
                                    <th>Tax Nature</th>
                                    <th>Tax Rate</th>
                                    <th>Tax Levid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="st in SeletedTaxes">
                                    <td ng-bind="st.authority_name"></td>
                                    <td ng-bind="st.tax_nature"></td>
                                    <td ng-bind="st.tax_percentage"></td>
                                    <td ng-bind="st.tax_levid"></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <button class="btn btn-xs btn-info" ng-click="changeTaxes()">Change Taxes</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row" style="display: none;" id="changeTaxes">
                <div class="col">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th colspan="4">Here you can change the tax rate with this product</th>
                        </tr>
                        <tr>
                            <th>Authority Name</th>
                            <th>Tax Nature</th>
                            <th>Tax Rate</th>
                            <th>Tax Levid</th>
                            <th>Action</th>
                        </tr>
                        <tr ng-repeat="tx in Taxes">
                            <td ng-bind="tx.authority_name"></td>
                            <td ng-bind="tx.tax_nature"></td>
                            <td ng-bind="tx.tax_percentage"></td>
                            <td ng-bind="tx.tax_levid"></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-xs btn-success btn-addtax" id="addtax<% tx.id %>" ng-click="selectedTax(tx.id, tx.tax_percentage)">Add</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-xs btn-warning" ng-click="cancelTax({{$id}})">Cancel</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="profit-selection">Profit Type</label>
                    <select ng-model="inventory.profit_type" class="form-control">
                        <option value="">Select Profit Type</option>
                        <option value="percent">%age</option>
                        <option value="amount">Amount</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="profit">Profit</label>
                    <input type="number" ng-model="inventory.profit" class="form-control" placeholder="Add profit in % or amount" ng-keyup="addProfit();">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="purchase_price">Purchase Price</label>
                    <input type="text" ng-model="inventory.purchase_price" id="purchase_price" readonly class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="sale-price">Sale Price</label>
                    <input type="number" ng-model="inventory.sale_price" readonly class="form-control">
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Vendor Information</h3>
        </div>
        <div class="card-body">
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
                        <option value="1">Active</option>
                        <option value="0">In Active</option>
                    </select>
                </div>
            </div>
        </div>
    </div><br/>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Stock Availability</h3>
        </div>
        <div class="card-body">
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
        <div class="card-header">
            <h3 class="card-title">Accounts</h3>
        </div>
        <div class="card-body" ng-init="getAccounts()">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Chart of Account Id Cost of Sales</label>
                    <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="inventory.chartof_account_cost">
                        <option value="">Select Chart of Account Id Cost of Sales</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Chart of Account Id Inventory</label>
                    <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="inventory.chartof_account_inventory">
                        <option value="">Select Chart of Account Id Inventory</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label>Chart of Account Id Sales</label>
                    <select class="form-control" ng-options="Account.id as Account.CategoryName for Account in Accounts" ng-model="inventory.chartof_account_sale">
                        <option value="">Select Chart of Account Id Sales</option>
                    </select>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <button type="button" class="btn btn-success btn-sm float-right" ng-click="saveInventory()"> <i class="fa fa-save" id="loader"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="appurl" value="<?php echo env('APP_URL') ?>">
<input type="hidden" value="<?php echo session('company_id'); ?>" id="company_id">
@endsection
@section('internaljs')
<script src="{{ asset('ng_controllers/material_management/edit_inventory.js')}}"></script>
@endsection