@extends('layouts.dashboardLayout')

@section('content')
<div class='row'>
<div class='col-md-12'>
	<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Student Lists</h3>
</div>
<div class="card-body">
	<h4>Year Enrollment: {{$year_from . " - " . $year_to}}</h4>
<table class='table'>
<thead><tr><th>Student Name</th><th>Date Created</th><th>Action</th></tr></thead>
<tbody>
@if($enrolls->count())
	@foreach($enrolls as $e)
		<tr>
			<td>{{$e->student->lname . ", " . $e->student->fname . " " . $e->student->mname . ", " . $e->student->exname}}</td>
			<td>{{ date("M d, Y", strtotime($e->datecreated)) }}</td>
			<td>
				<a href="{{route('teacher-student-record', $e->id)}}" class="btn btn-primary btn-md">Records</a>
			</td>
		</tr>
	@endforeach
@endif
</tbody>
</table>
</div>
</div>
</div>
</div>
@endsection