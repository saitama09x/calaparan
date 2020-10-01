@extends('layouts.dashboardLayout')

@section('content')
<div class='row'>
<div class='col-md-12'>
	<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Student Lists</h3>
</div>
<div class="card-body">
<table class='table'>
<thead><tr><th>Student Name</th><th>Action</th></tr></thead>

@if($enrolls->count())

@endif
</table>
</div>
</div>
</div>
</div>
@endsection