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
	<thead><tr><th>Fullname</th><th>Section</th><th>Grade Yr</th><th>Action</th></tr></thead>
	<tbody>
		@foreach($teachers as $t)
			<tr>
				<td>{{$t->fullname}}</td>
				<td>{{ isset($t->section) ? $t->section->sectionname : ''}}</td>
				<td>{{$t->classgrade}}</td>
				<td><a href="{{route('single_teacher', $t->id)}}" class="btn btn-md btn-warning">View Students</a></td>
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