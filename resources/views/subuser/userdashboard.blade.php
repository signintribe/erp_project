@extends('layouts.admin.newmaster')
@section('title', 'Sub User')
@section('pagetitle', 'Sub User')
@section('breadcrumb', 'Sub User')
@section('content')
<?php echo Auth::user(); ?>
@endsection
@section('internaljs')
<script src="{{asset('ng_controllers/subuser/subuserdashboard.js')}}"></script>
@endsection