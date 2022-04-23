@extends('layouts.admin.creationTier')
@section('title', 'Approval Authrity List')
@section('pagetitle', 'Approval Authrity List')
@section('breadcrumb', 'Approval Authrity List')
@section('content')

<div ng-app='AuthorityApp' ng-controller='AuthorityController'>
<form action="approval-authrity-list" method="get">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label>Select Department</label>
                    <select name="" id="" class='form-control'>
                        <option value="">DDl</option>
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
                        <option value="">Declined</option>
                        <option value="">Recommended</option>
                        <option value="">Approved</option>
                    </select>
                </div>
            </div><br/>
            <div class="row">
            <div class="col-2">
                    <button class="btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/creation_authorities/approval-authority-list.js')}}"></script>
@endsection