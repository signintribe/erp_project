@extends('layouts.admin.taskTier')
@section('title', 'Recieve Inventory Form')
@section('pagetitle', 'Recieve Inventory')
@section('breadcrumb', 'Recieve Inventory')
@section('content')

<form action="recieve-inventory" method="get">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">PO Detail</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Inventory Receipt No</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Recieving Date</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-6">
                    <label for="">Apply to Pending Approved PO/Tender</label>
                   <select name="" id="" class="form-control">
                       <option value="">Select Apply to Pending Approved PO/Tender</option>
                   </select>
                </div>
            </div><br/>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Vendor Detials</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Vendor</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Vendor Address</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-6">
                    <label for="">Delivery Address</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Shipment Status</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br/>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Item Detials</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Product/Item</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Quantity Ordered</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br/>
            <div class="row">
                <div class="col-6">
                    <label for="">Reccieve Quantity</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Unit Price</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-6">
                    <label for="">Pending Items</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Gross Total</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-6">
                    <label for="">Chart of Account Debit</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Cahrt of Account Credit</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-12">
                    <label for="">Description</label>
                    <textarea name="" id=""  class="form-control"></textarea>
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Add Texes</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Name of Taxe</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Name of Taxe</option>
                    </select>               
                 </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Payment Detail</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Payment Method</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Shipment Detail</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Delivery Date</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Ship via</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Port of Loading</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-6">
                    <label for="">Port of Unloading</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">FOB Terms</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Packing Detials</h2>
        </div>
        <div class="card-body"></div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Attacment</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Attacment</label>
                    <input type="file" name="" id="" class="form-control">
                </div>
            </div><br/>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Required For</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="">Project</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Project</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Activity</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Activity</option>
                    </select>
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Reciever Information</h2>
        </div>
        <div class="card-body">
         <div class="row">
                <div class="col-6">
                    <label for="">Recieved By</label>
                    <select name="" id="" class="form-control">
                        <option value="">Name of Employee</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Designation</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select Designation</option>
                    </select>
                </div>
        </div><br>
            <div class='row'>
                <div class="col-6">
                    <label for="">Godown</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Room Detial</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br>
            <div class="row">
                    <div class="col float-end">
                        <button class="btn-success">Save</button>
                    </div>
            </div><br>
        </div>
    </div>
</form>
@endsection