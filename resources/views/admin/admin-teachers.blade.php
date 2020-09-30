@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-9'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">List Teachers</h3>
  </div>
<div class='card-body'>
<div class='form-group'>
<a href="{{route('teacher_create')}}" class='btn btn-md btn-primary'>New Teacher</a>
</div>
<div class='form-group'>
<table class='table'>
	<thead><tr><th>Fullname</th><th>Section</th><th>Year Level</th><th>Action</th></tr></thead>
	<tbody>
		@php
			$year_label = ["Kinder", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6"];
		@endphp
		@foreach($teachers as $t)
			<tr>
				<td>{{$t->fullname}}</td>
				<td>{{ isset($t->section) ? $t->section->sectionname : ''}}</td>
				<td>{{$year_label[$t->section->gradelevel]}}</td>
				<td><a href="{{route('single_teacher', $t->id)}}" class="btn btn-md btn-warning">View Students</a>
					<a href="{{route('teachers.edit', $t->id)}}" class="btn btn-md btn-danger">Edit</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

@endsection