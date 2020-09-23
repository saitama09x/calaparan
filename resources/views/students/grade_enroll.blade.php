@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-12'>
@if(session('is_added'))
	@component('alerts.alert', ['alert_type' => 'alert-success'])
		{{$student->fname . ' ' . $student->mname . ' ' . $student->lname}} is added
	@endcomponent
@endif
<div class='form-group'>
<a href="#" class="btn btn-md btn-info">Print Report Card</a>
</div>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">View Student Information</h3>
</div>
<div class="card-body">
<table class='table'>
<tbody>
<tr>
<th>Name:</th>
<td>{{ $student->fname . ' ' . $student->mname . ' ' . $student->lname . ' ' . $student->exname}}</td>
<th>Birthday:</th>
<td>{{ $student->bday }}</td>
</tr>
<tr>
	<th>Gender:</th>
	<td>{{ $student->sex }}</td>
	<th>Date Created:</th>
	<td>{{ $student->datecreated }}</td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>

{!! Form::model($credential, ['route' => ['admin-add_eligibities'], 'method' => 'post']) !!}
<?= Form::hidden('student_id', $student->id) ?>
<div class='row'>
<div class='col-md-12'>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">ELIGIBILITY FOR ELEMENTARY SCHOOL ENROLLMENT</h3>
</div>
<div class='card-body'>
<table class='table'>
<tbody>
<tr>
<td>Credential Presented for Grade 1:</td>
	@if(isset($credential))
		@foreach($credential as $c)
			@php
				$is_check = "";
			@endphp
			@foreach($student->credentials as $d)
				@php
					if($c->id == $d->eligible_id){
						$is_check = "checked";
					}
				@endphp
			@endforeach
			<td><input type='checkbox' name='eligibility[]' value="{{$c->id}}" {{$is_check}}/></td><td>{{$c->crname}}</td>
		@endforeach
	@endif
</tr>
</tbody>
</table>
<table class='table'>
<tr>
	<td>Name of School</td>
	<td>
	@php
	
	$sel_school = $student->credentials;
	$sel_id = null;
	$sh_id = "";
	$district = "";
	if($sel_school->count()){
		$sel_id = $sel_school->first()->school->first()->id;
		$sh_id = $sel_school->first()->school->first()->shid;
		$district = $sel_school->first()->school->first()->district;
	}

	$opt = [];
	foreach($school as $s){
		$opt[$s->id] = $s->shname;
	}
	@endphp
	{!!
		Form::select('school', $opt, $sel_id, ['class' => 'form-control']);
	!!}
</td>
<td>School Id</td>
<td>{{$sh_id}}</td>
<td>Address of School</td>
<td>{{$district}}</td>
</tr>
</table>
<div class='form-group'>
<button class='btn btn-md btn-primary'>Update</button>
</div>
</div>
</div>
</div>
</div>
{!! Form::close() !!}

<div class='row'>
@foreach($gradeyr as $index => $yr)
<div class='col-md-12'>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Enrollment Year {{$yr->classgrade}}</h3>
</div>
<div class="card-body">
{!! Form::model($student, ['route' => ['admin-grade_enroll_add'], 'method' => 'post']) !!}
<?= Form::hidden('gradeyr', $yr->classgrade) ?>
<?= Form::hidden('student_id', $student->id) ?>
<div class='form-group'>
<div class='row'>
<div class='col-md d-flex'>
<label class="mr-2"><strong>Year From:</strong> <input type='text' class='form-control datepicker' value="{{$adviser[$yr->classgrade]['yr_from']}}" name='year_from' /></label>
<label>
<strong>Year To:</strong> <input type='text' class='form-control datepicker' value="{{$adviser[$yr->classgrade]['yr_to']}}" name='year_to' /></label>
</div>
<div class='col-md d-flex align-items-center'>
<a href="{{route('admin-student-record', $adviser[$yr->classgrade]['enroll_id'])}}" class='btn btn-md btn-info'>Records</a>
</div>
</div>
</div>
<table class='table'>
	<thead><tr><th></th><th>Teacher Name</th><th>Section Name</th><th>Total Students</th></tr></thead>
	<tbody>
	@if(isset($adviser[$yr->classgrade]))
		@foreach($adviser[$yr->classgrade]['data'] as $a)
			<tr>
				<td><?= Form::radio('teacher_id', $a->id, $a->is_selected) ?></td>
				<td>{{$a->name}}</td>
				<td>{{$a->section}}</td>
				<td>{{$a->total_student}}</td>
			</tr>
		@endforeach
	@endif
	</tbody>
</table>
<div class='form-group'>
<input type='submit' class='btn btn-md btn-primary' value="update" />
</div>
{!! Form::close() !!}
</div>
</div>
</div>
  	@endforeach
</div>	

@endsection

@push('styles')
<link href="{{ asset('assets/datepicker/css/bootstrap-datepicker.min.css') }}" media="all" type="text/css" rel="stylesheet"/>
@endpush

@push('scripts')
<script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$('.datepicker').datepicker({
	format: 'yyyy-mm-dd'
})
</script>
@endpush
