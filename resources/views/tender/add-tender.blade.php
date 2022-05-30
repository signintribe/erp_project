@extends('layouts.admin.taskTier')
@section('title', 'Add Tender')
@section('pagetitle', 'Add Tender')
@section('breadcrumb', 'Add Tender')
@section('content')

<form action="add-tender" method="get">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Advertisement Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Tender Type</label>
                    <input type="text" name="tender-type" id="" placeholder='Tender Type' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Advertisement Date</label>
                    <input type="text" name="advertisment-date" id="" placeholder="Advertisment Date" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Submission Date</label>
                    <input type="text" name="submission-date" id="" placeholder="Submission Date" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Opening Date</label>
                    <input type="text" name="opening-date" id="" placeholder="Opening Date" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Opening Time</label>
                    <input type="text" name="opening-time" id="" placeholder="Opening Time" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Documents Required</label>
                    <input type="text" name="document-reuired" id="" placeholder="Document Required" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Upload Tender File</label>
                    <input type="file" name="tender-file" id="" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Tender Opening Venue</label>
                    <input type="text" name="" id="" placeholder="Tender Opening Venue" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Organization/Contact Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Name of Organization</label>
                    <input type="text" name="name-organization" id="" placeholder="Name of Organization" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Phone/Mobile</label>
                    <input type="text" name="mobile" id="" placeholder="Phone/Mobile" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Fax</label>
                    <input type="text" name="fax" id="" placeholder="Fax" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Website</label>
                    <input type="text" name="website" id="" placeholder="Website" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Email</label>
                    <input type="text" name="email" id="" placeholder="Email" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Postal Address Line 1</label>
                    <input type="text" name="postal-address-1" id="" placeholder="Postal Address Line 1" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Postal Address Line 2</label>
                    <input type="text" name="postal-address-2" id="" placeholder="Postal Address Line 2" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Street</label>
                    <input type="text" name="street" id="" placeholder="Street" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Sector/Mohallah</label>
                    <input type="text" name="sector" id="" placeholder="Sector/Mohallah" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">City</label>
                    <input type="text" name="city" id="" placeholder="City" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">State/Province</label>
                    <input type="text" name="State/Province" id="" placeholder="State/Province" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Country</label>
                    <input type="text" name="country" id="" placeholder="Country" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Currency</label>
                    <input type="text" name="currency" id="" placeholder="Currency" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Phone 1</label>
                    <input type="text" name="phone-1" id="" placeholder="Phone 1" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Phone 2</label>
                    <input type="text" name="phone-2" id="" placeholder="Phone 2" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                   <label for="">Facebook</label>
                   <input type="text" name="facebook" id="" placeholder="Facebook" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Linkedin</label>
                    <input type="text" name="linkedin" id="" placeholder="Linkedin" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Whatsapp</label>
                    <input type="text" name="whatsapp" id="" placeholder="Whatsapp" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Twitter</label>
                    <input type="text" name="twitter" id="" placeholder="Twitter" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Instgram</label>
                    <input type="text" name="instgram" id="" placeholder="Instgram" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Contact Person Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Name Of Contact Person</label>
                    <input type="text" name="contact-person" id="" placeholder="Name of Contact Person" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Designation</label>
                    <input type="text" name="designation" id="" placeholder="Designation" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Phone Office</label>
                    <input type="text" name="phone-office" id="" placeholder="Phone Office" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Mobile Number</label>
                    <input type="text" name="mobile-number" id="" placeholder="Mobile Number" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Email</label>
                    <input type="text" name="email" id="" placeholder="Email" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Facebook</label>
                    <input type="text" name="facebook" id="" placeholder="Facebook" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Linkedin</label>
                    <input type="text" name="linkedin" id="" placeholder="Linkedin" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Whatsapp</label>
                    <input type="text" name="whatsapp" id="" placeholder="Whatsapp" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Twitter</label>
                    <input type="text" name="twitter" id="" placeholder="Twitter" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Instgram</label>
                    <input type="text" name="instgram" id="" placeholder="Instgram" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Status Of Tender</label>
                    <input type="text" name="status-tender" id="" placeholder="Status of Tender" class="form-control">
                </div>
            </div><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Item Quantity/Quality/ & Price Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Tender Fee</label>
                    <input type="text" name="tender-fee" id="" placeholder="Tender Fee" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Bid Money</label>
                    <input type="text" name="bid-money" id="" placeholder="Bid Money" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Mode Of Bid Money</label>
                    <select name="" id="" class="form-control">
                        <option value="">Please Select Mode</option>
                        <option value="">BG</option>
                        <option value="">CDR</option>
                        <option value="">PO</option>
                        <option value="">BD</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Issuance Date</label>
                    <input type="text" name="sssuance-date " id="" placeholder="Issuance Date " class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Expiry Date</label>
                    <input type="text" name="expiry-date" id="" placeholder="Expiry Date" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Name Of Item</label>
                    <input type="text" name="item-name" id="" placeholder="Name of Item" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Part Number</label>
                    <input type="text" name="part-number" id="" placeholder="Part Number" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Manufacturer</label>
                    <input type="text" name="manufacturer" id="" placeholder="Manufacturer" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Assember</label>
                    <input type="text" name="assember" id="" placeholder="Assember" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Model No.</label>
                    <input type="text" name="model-no" id="" placeholder="Model No." class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Color</label>
                    <input type="text" name="color" id="" placeholder="Color" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Weight</label>
                    <input type="text" name="weight" id="" placeholder="Weight" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Size</label>
                    <input type="text" name="size" id="" placeholder="Size" class="form-control"> 
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Manufacturing Date</label>
                    <input type="text" name="manuufacturing-date" id="" placeholder="Manufacturing Date" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Warranty/Guaranty</label>
                    <input type="text" name="warranty/guaranty" id="" placeholder="Warranty/Guaranty" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Warranty/Guaranty Claims Form</label>
                    <input type="text" name="warranty/guaranty-claims-form" id="" placeholder="Warranty/Guaranty Claims From" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Standard</label>
                    <input type="text" name="standard" id="" placeholder="Standard" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Mode of Delivery</label>
                    <input type="text" name="mode-delivery" id="" placeholder="Mode of Delivery" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Other Details if any</label>
                    <input type="text" name="other details" id="" placeholder="Other Details if any" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Quality of Item</label>
                    <input type="text" name="quality-item" id="" placeholder="Quality of Item" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Item Price</label>
                    <input type="text" name="" id="" placeholder="Item Price" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Quantity Available</label>
                    <input type="text" name="quality-available" id="" placeholder="Quality Available" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Freight</label>
                    <input type="text" name="freight" id="" placeholder='Freight' class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Custom</label>
                    <input type="text" name="customm" id="" placeholder="Custom" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Income Tax</label>
                    <input type="text" name="income-tax" id="" placeholder="Income Tax" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">G.S.T</label>
                    <input type="text" name="g.s.t" id="" placeholder="G.S.T" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Other Government Duties</label>
                    <input type="text" name="other-govt-duties" id="" placeholder="Other Government Duties" class="form-control">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Total Price</label>
                    <input type="text" name="total-price" id="" placeholder="Total Price" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <label for="">Payment Mode</label>
                    <select name="payment-mode" id="" class="form-control">
                        <option value="">Please Select Payment Mode</option>
                    </select>
                </div>
            </div><br>
        </div>
    </div>
</form>
@endsection