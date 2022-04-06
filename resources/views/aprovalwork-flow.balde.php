@extends('layouts.admin.taskTier')
@section('title', 'Approval Work Flow')
@section('pagetitle', 'Approval Work Flow')
@section('breadcrumb', 'Approval Work Flow')
@section('content')
<form action="approval-work" method="get">
 <div class="card">
     <div class="card-body">
        <div class='row'>
            <div class="col-6">
            <label>Select Department</label>
            <select name="" class="form-control" id="">
                <option name="" id="">DDl</option>
            </select>
            </div>
            <div class="col-6">
            <label>Select Designation</label>
            <select name="" id="" class="form-control">
                <option value="">DDL</option>
             </select>
            </div>
        </div><br/>
        <div class="row">
            <div class="col-6">
            <label>Approval Type</label>
            <select name="" id="" class="form-control">
                <option value=''>Pending</option>
                <option value="">Declined</option>
                <option value="">Recommended</option>
                <option value="">Approved</option>
            </select>
            </div>
            <div class="col-6">
            <label>Approval For </label>
            <select name="" id=""class="form-control">
                <option value="">DDL</select>
            </select>
            </div>
        </div><br/>
        <div class="row">
            <div class="col">
                <label for="">Remarks</label>
                <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
        </div><br/>
        <div class="row">
            <div class="col">
               <button class="btn btn-success">Save </button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection