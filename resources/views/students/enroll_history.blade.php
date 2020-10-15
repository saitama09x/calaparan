@extends('layouts.dashboardLayout')

@section('content')


<div class='row'>
<div class='col-md-12'>
<a href="{{route('admin-student-enroll', $student->id)}}" class="btn btn-info btn-sm mb-3">Go Back</a>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">View Student Information</h3>
</div>
<div class="card-body">
<table class='table'>
<tbody>
<tr>
<td><strong class='mr-2'>Last Name:</strong> <span>{{$student->lname}}</span></td>
<td><strong class='mr-2' class='mr-2'>First Name:</strong> <span>{{$student->fname}}</span></td>
<td><strong class='mr-2'>Middle Name:</strong> <span>{{$student->mname}}</span></td>
<td><strong class='mr-2'>LRN:</strong> <span>{{$student->lrefno}}</span></td>
</tr>

<tr>
<td><strong class='mr-2'>Birthday:</strong> <span>{{ $student->bday }}</span></td>
<td><strong class='mr-2'>Gender:</strong><span> {{ $student->sex }}</span></td>
<td colspan="2"><strong class='mr-2'>Date Created:</strong> <span>{{ $student->datecreated }}</span></td>
</tr>
</tbody>
</table>
</div>
</div>

<h3>Previous Records of Kinder</h3>

@if($enrolls->count())

@foreach($enrolls as $e)
<div class="card card-primary">
<div class="card-body">
<table class='table'>
<thead><tr><th style="width:20%;">Enrollment Year</th><th style="width:30%;">Teacher</th><th>Section</th><th style="width:20%;">Status</th><th>Action</th></tr></thead>
<tbody>
@php
$section = "";
$teacher = $e->teacher;
$teachername = "";
	if($teacher->exists()){
		$teachername = $teacher->fullname;
		$section = $teacher->section;
		if($section->exists()){
			$section = $section->sectionname;
		}else{
			$section = "";
		}
	}else{

	}

@endphp
<tr><td>{{$e->yr_from . ' - ' . $e->yr_to}}</td><td>{{$teachername}}</td><td>{{$section}}</td><td>{{$e->enroll_type}}</td><td><a href="{{route('admin-student-record', $e->id)}}" class='btn btn-info btn-sm'>Records</a></td></tr>
</tbody>
</table>
</div>
</div>
@endforeach
@endif

</div>
</div>

@endsection
