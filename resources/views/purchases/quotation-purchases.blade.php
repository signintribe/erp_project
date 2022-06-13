@extends('layouts.admin.taskTier')
@section('title', 'Quotation For Purchases')
@section('pagetitle', 'Quotation For Purchases')
@section('breadcrumb', 'Quotation For Purchases')
@section('content')
<div ng-controller="QuotationPurchaseController">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Quotation Deatil</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_no">Quotation Number</label>
                    <input type="text" ng-model="pq.quotation_number" id="quotation_no" placeholder="Quotation Number" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_date">Quotation Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="quotation_date" data-target-input="nearest">
                            <input type="text" placeholder="Quotation Date" ng-model="pq.quotation_date" class="form-control datetimepicker-input" data-target="#quotation_date"/>
                            <div class="input-group-append" data-target="#quotation_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Quotation Status</label><br>
                    <p class="form-control">
                        <input type="checkbox" ng-model="pq.pending" id="pending"> <label for="pending">Pending</label> 
                        <input type="checkbox" ng-model="pq.po_made" id="po_made"> <label for="po_made">PO Made</label>
                    </p>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Apply to</label>
                    <select ng-model="pq.apply_to" id="" class="form-control">
                        <option value="">Select Apply to</option>
                        <option value="Tender">Tender</option>
                        <option value="Requestion">Requestion</option>
                    </select>
                </div>
            </div><br/>
            <div class="row" ng-if="pq.apply_to">
                <div class="col text-center">
                    <label for="applied_entity">Search Your <% pq.apply_to %></label>
                    <div class="input-group">
                        <input type="search" ng-model="pq.applied_entity" class="form-control" placeholder="Search Your <% pq.apply_to %>">
                        <div class="input-group-append">
                            <button type="button" ng-click="getAppliedTo(pq.applied_entity, pq.apply_to);" class="btn btn-md btn-success">
                                <i class="fa fa-search"></i>
                            </button>
                            <a ng-if="pq.apply_to == 'Tender'" href="<?php echo env('APP_URL') ?>tender/tender-information" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                            <a ng-if="pq.apply_to == 'Requestion'" href="<?php echo env('APP_URL') ?>tender/requestion" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li ng-repeat="tender in tenders" style="cursor: pointer" class="list-group-item text-left" ng-click="fillTender(tender)" ng-bind="tender.tender_name"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Vendor Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="vendor">Search Vendor</label>
                    <input type="text" ng-model="pq.vendor" placeholder="Search Vendor" id="vendor" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="quotation_till">Quotation Valid Till</label>
                    <div class="form-group">
                        <div class="input-group date" id="quotation_till" data-target-input="nearest">
                            <input type="text" placeholder="Quotation Valid Till" ng-model="pq.quotation_till" class="form-control datetimepicker-input" data-target="#quotation_till"/>
                            <div class="input-group-append" data-target="#quotation_till" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="delivery_date">Delivery Date</label>
                    <div class="form-group">
                        <div class="input-group date" id="delivery_date" data-target-input="nearest">
                            <input type="text" placeholder="Delivery Date" ng-model="pq.delivery_date" class="form-control datetimepicker-input" data-target="#delivery_date"/>
                            <div class="input-group-append" data-target="#delivery_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <h5 for="card-title">List of Document</h5><hr/>
                    <div class="row">
                        <div class="col">
                        <label for="principal_performa">Principal performa invoce with sign & stamp on company letter head</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="principal_performa">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="agency_agreement">Agency agreement with sign & stamp on company letter head</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="agency_agreement">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="oem_certificate">OEM Certificate</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="oem_certificate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="atp">ATP</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="atp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="compliance_sheet">Compliance Sheet</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="compliance_sheet">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="company_profile">Company Profile/Certificate</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="company_profile">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="warrenty">Warrenty / Guarantee acceptence as per IT</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="warrenty">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="special_instruction">Special Instruction Compliance</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="special_instruction">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="technical_offer">Complete Technical Offer</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="technical_offer">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="trade_link">Complete Trade Link</label>
                        </div>
                        <div class="col">
                            <input type="checkbox"  id="trade_link">
                        </div>
                    </div>
                </div>
            </div><hr/>
            <!-- <div class="row">
                <div class="col-6">
                    <label for="">Delivery Address</label>
                    <input type="text" ng-model="pq.delivery_address" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Shipment Status</label>
                    <select ng-model="pq.shipment_status" id="" class="form-control">
                        <option value="">Pending</option>
                        <option value="">Shipped</option>
                        <option value="">Droped</option>
                        <option value="">Delivered</option>
                    </select>
                </div>
            </div><br> -->
        </div>
    </div>
    <div class="card"  onclick="getAmount();">
        <div class="card-header">
            <h2 class="card-title">Item Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="product_item">Search Product/Item</label>
                    <input type="text" ng-model="pq.product_item" id="product_item" placeholder="Search Product/Item" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="unit_price">Unit Price</label>
                    <input type="text" ng-model="pq.unit_price" id="unit_price" placeholder="Unit Price" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="qty">Quantity</label>
                    <input type="text" ng-model="pq.quantity" placeholder="Quantity" id="qty" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="gross_price">Gross Price</label>
                    <input type="text" ng-model="pq.gross_price" placeholder="Gross Price" id="gross_price" class="form-control">
                </div>
            </div><br>
            <!-- <div class="row">
                <div class="col-6">
                    <label for="">Cahrt Of Account Debit</label>
                    <select ng-model="pq.account_debit" id="" class="form-control">
                        <option value="">Chart of Account Debit</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Chart Of Account Credit</label>
                    <select ng-model="pq.account_credit" id="" class="form-control">
                        <option value="">Chart Of Account Credit</option>
                    </select>
                </div>
            </div><br> -->
            <div class="row">
                <div class="col-10"><h5>Add Taxes</h5></div>
                <div class="col-2">
                    <button class="btn btn-sm btn-primary float-right" onclick="Addrow();">+Add Row</button>
                </div>
            </div><br/>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name Of Taxe</th>
                        <th>Percentage Of taxe</th>
                        <th>Total Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody onclick='totalAmount()'>
                    <tr id='row2'>
                        <td>
                            <input type="text" name="name_taxe" id="name_taxe" placeholder='Name of Taxe' class="form-control">
                        </td>
                        <td>
                            <input type="text" name="percentage_taxe" id="percentage_taxe" placeholder='Percentage Of Taxe' class="form-control">
                        </td>
                        <td>
                            <input type="text" name="total_amount" id="total_amount" placeholder='Total Amount' class="form-control total_amount">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">Total Taxe</th>
                        <td>
                            <input type="text" name="total_taxe" id="total_taxe" placeholder='Total Taxe' class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Delivery Charges</label>
                    <select name="delivery-charges" id="" class="form-control">
                        <option value="">Select Delivery Charges</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Discount Name</label>
                    <input type="text" name="discount_name" id="discount_name" placeholder='Discount Name' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Discount Amount</label>
                    <input type="text" name="discount_amount" id="discount_amount" placeholder='Discount Amount' class="form-control discount_amount">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Net Amount</label>
                    <input type="text" name="net_amount" id="net_amount" placeholder='Net Amount' class="form-control net_amount">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Payment Terms</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Advance Percentage</label>
                    <input type="text" name="advance-percentage" id="" placeholder='Advance Percentage' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Time Of Advance</label>
                    <select name="time-of-advance" id="" class="form-control">
                        <option value="">Select Time of Advance</option>
                        <option value="">PO Time</option>
                        <option value="">Delivery Time</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Payment Type</label>
                    <select name="payment-type" id="" class="form-control">
                        <option value="">Select Payment Type</option>
                        <option value="">Cash</option>
                        <option value="">Credit Card</option>
                        <option value="">Debit Card</option>
                        <option value="">CDR</option>
                        <option value="">Pay Order</option>
                        <option value="">LC</option>
                    </select>
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Special Note Description</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <textarea ng-model="pq.description" id="" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="card">
        <div class="card-header">
            <h2 class="card-title">Add Taxes</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Name Of Taxe</label>
                    <select ng-model="pq.tax" id="" class="form-control">
                        <option value="">Select Name Of Taxe</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Payment Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Payment Method</label>
                    <select ng-model="pq.payment_method" id="" class="form-control">
                        <option value="">COD</option>
                        <option value="">Credit card</option>
                        <option value="">Debit card</option>
                        <option value="">Cash Sales</option>
                        <option value="">Credit Sales</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Percentage of Advance</label>
                    <input type="text" ng-model="pq.percentage" id="" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Shipment Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Delivery Date</label>
                    <input type="text" ng-model="pq.delivery_date" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Ship Via</label>
                    <select ng-model="pq.ship_via" id="" class="form-control">
                        <option value="">By Hand</option>
                        <option value="">By Courier</option>
                        <option value="">By Seaport</option>
                        <option value="">By Airport</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col-6">
                    <label for="">Port of Loading</label>
                    <input type="text" ng-model="pq.port_loading" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Port of Unloading</label>
                    <input type="text" ng-model="pq.port_unloading" id="" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Attachment</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Item Picture</label>
                    <input type="file" id="" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Required For</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <label for="">Project</label>
                    <select ng-model="pq.project" id="" class="form-control">
                        <option value="">Select Project</option>
                    </select>
                </div>
                <div class="col-4">
                <label for="">Activity</label>
                    <sel ect ng-model="pq.activity" id="" class="form-control">
                        <option value="">Select Activity</option>
                    </select>
                </div>
                <div class="col-4">
                <label for="">Phase</label>
                    <select ng-model="pq.phase" id="" class="form-control">
                        <option value="">Select Phase</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <button class="btn-success">Save</button>
                </div>
            </div>
        </div>
    </div> -->
</div>
<script>
    function Addrow() {
        var txt1 =  $('<tr id="col1"></tr>').html('<td><input type="text" name="name_taxe" id="name_taxe" placeholder="Name of Taxe" class="form-control"></td>'
        +'<td><input type="text" name="percentage_taxe" id="percentage_taxe" placeholder="Percentage Of Taxe" class="form-control"></td>'
        +'<td><input type="text" name="total_amount" id="total_amount" placeholder="Total Amount" class="form-control"></td>'
        +'<td><button onclick="Remove();" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></td>');
        $('#row2').after(txt1);
    };
    function Remove(){
        $('#col1').remove();
    }
     function Addrow() {
         var txt1 =  $('<tr id="col1"></tr>').html('<td><input type="text" name="name_taxe" id="name_taxe" placeholder="Name of Taxe" class="form-control"></td>'
                +'<td><input type="text" name="percentage_taxe" id="percentage_taxe" placeholder="Percentage Of Taxe" class="form-control"></td>'
                +'<td><input type="text" name="total_amount" id="total_amounts" placeholder="Total Amount" class="form-control"></td>'
                +'<td><button onclick="Remove();" class="btn-secondary">-</button></td>');
          $('#row2').after(txt1);
   };
    function Remove(){
    $('#col1').remove();
    }
    function getAmount(){
        var unit = $('#unit_price').val();
        var qty = $('#qty').val();
        var totals = (unit*qty);
        $('#gross_price').val(totals);
    }
    function totalAmount() {
        var gross = $('#gross_price').val();
        var gross = parseInt(gross);
        var total = $('#total_amount').val();
        var total = parseInt(total);
        var totaltax = gross + total;
        gross += parseInt(total);
        var totalamount = $('#total_amounts').val();
         gross += parseInt(totalamount);
        var totaltax = gross;
        $('#total_taxe').val(totaltax);
    }
</script>
@endsection

@section('internaljs')
<script src="{{asset('ng_controllers/task_purchase/quotation_purchases.js')}}"></script>
@endsection