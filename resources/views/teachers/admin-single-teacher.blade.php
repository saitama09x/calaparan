@extends('layouts.dashboardLayout')

@section('content')
<div class='row'>
<div class='col-md'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Teacher</h3>
  </div>
<div class='card-body'>
<div class='form-group'>
<p><h4><strong>Fullname:</strong> {{$teacher->fullname}}</h4> </p>
</div>
<div class='form-group'>
<p><h4><strong>Section:</strong> {{$teacher->section->sectionname}}</h4></p>
</div>
<table class='table'>
<thead><tr><th>Student</th><th>Action</th></tr></thead>
<tbody>
	@foreach($teacher->enrolls as $t)
		<tr>
			<td>{{$t->student->fname . " " . $t->student->lname}}</td>
			<td><a href="{{route('admin-student-record', $t->id)}}">Records</a></td>
		</tr>
	@endforeach
</tbody>
</div>
</div>
</div>
</div>


@endsection