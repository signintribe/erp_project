@extends('layouts.admin.master')
@section('title', 'Sub Menu')
@section('content')
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4">
				<label>Name</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4">
				<label>Father Name</label>
				<input type="text" class="form-control" name="father-name">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4">
				<label>Gender</label>
				<select name="gender" class="form-control">
					<option value="">Select Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
			</div>
		</div><br/>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4">
				<label>City</label><br/>
				<input type="radio" name="city" value="Islamabad"> <label>Islamabad</label><br/>
				<input type="radio" name="city" value="Rawalpindi"> <label>Rawalpindi</label><br/>
				<input type="radio" name="city" value="Lahore"> <label>Lahore</label><br/>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4">
				<label>Course</label><br/>
				<input type="checkbox" name="course" value="Web Development"> <label>Web Development</label><br/>
				<input type="checkbox" name="course" value="Web Designing"> <label>Web Designing</label><br/>
				<input type="checkbox" name="course" value="MS Office"> <label>MS Office</label><br/>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4">
				<label>Address</label>
				<textarea class="form-control" name="address"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<button type="button" class="btn btn-md btn-success">Save</button>
			</div>
		</div>
	</div>
</div>
@endsection