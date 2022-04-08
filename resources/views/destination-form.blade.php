@extends('layouts.admin.creationTier')
@section('title', 'Destination Form')
@section('pagetitle', 'Destination Form')
@section('breadcrumb', 'Destination Form')
@section('content')

<form action="destination" method="get">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class='col-6'>
                    <label>Destination Name</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class='col-6'>
                    <label>Short Name</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-6">
                    <label>Breif Description</label>
                    <input type="text" name="" id="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Employee Group</label>
                    <select name="" id="" class="form-control">
                        <option value="">DDL</option>
                    </select>
                </div>
            </div><br>
            <div class="row">
                <div class="col-6">
                    <label for="">Active</label>
                    <input type="checkbox" name="" id="">
                </div>
                <div class="col-6">
                    <button class="btn-success">Attachment</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection