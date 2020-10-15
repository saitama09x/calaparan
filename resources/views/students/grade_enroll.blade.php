@extends('layouts.dashboardLayout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
      @endforeach
    </div>
@endif


<div class='row'>
<div class='col-md-12'>
@if(session('is_added'))
	@component('alerts.alert', ['alert_type' => 'alert-success'])
		{{$student->fname . ' ' . $student->mname . ' ' . $student->lname}} is added
	@endcomponent
@endif
@if(session('is_updated'))
	@component('alerts.alert', ['alert_type' => 'alert-success'])
		Successfully Updated Infomation
	@endcomponent
@endif
@if(session('is_updated_status'))
	@if(session('is_updated_status')==true)
		@component('alerts.alert', ['alert_type' => 'alert-success'])
			Successfully Updated Status
		@endcomponent
	@else
		@component('alerts.alert', ['alert_type' => 'alert-danger'])
			Incorrect Data
		@endcomponent
	@endif
@endif
@if(session('enroll_success'))
	@component('alerts.alert', ['alert_type' => 'alert-success'])
		{{session('enroll_success')}}
	@endcomponent
@endif
@if(session('enroll_error'))
	@component('alerts.alert', ['alert_type' => 'alert-danger'])
		{{session('enroll_error')}}
	@endcomponent
@endif
<div class='form-group'>
<a href="{{route('admin-print-enroll', $student->id)}}" target="_blank" class="btn btn-md btn-info">Print School Records</a>
</div>
<div class="card card-primary">
<div class="card-header">
<div class='row justify-content-between align-items-center'>
<h3 class="card-title">View Student Information</h3>
<button type='button' class='btn btn-sm btn-warning'  data-toggle="modal" data-target="#update-status-modal" >Update Current Status</button>
</div>
</div>
<div class="card-body">
<div class='row justify-content-between'>
<div class='form-group'>
<a href="{{route('student.editStudent', $student->id)}}" class='btn btn-md btn-success'>Edit Student Information</a>
</div>
<div class='p-2'>
<span class='mr-2'>Current Status:</span>
@if($status_enroll->count())
	@if($status_enroll->first()->enroll_type == "ENROLLED")
		<strong class='text-success'>Enrolled</strong>
	@elseif($status_enroll->first()->enroll_type == "REENROLLED")		
		<strong class='text-warning'>Re-Enrolled</strong>
	@elseif($status_enroll->first()->enroll_type == "DROPPEDOUT")		
		<strong class='text-danger'>Dropped Out</strong>
	@elseif($status_enroll->first()->enroll_type == "TRANSFERREDOUT")		
		<strong class='text-danger'>Transferred Out</strong>
	@elseif($status_enroll->first()->enroll_type == "UNENROLLED")		
		<strong class='text-danger'>Un-Enrolled</strong>
	@endif
	<a href="#card-panel-{{$status_enroll->first()->gradeyr}}" style="font-size:20px;"><i class="fas fa-arrow-circle-down"></i></a>
@endif
</div>
</div>
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

<tr>
<td><strong class='mr-2'>Mother:</strong> <span>{{ $student->mother }}</span></td>
<td><strong class='mr-2'>Highest Educational Attainment::</strong><span> {{ $student->edu_one }}</span></td>
<td><strong class='mr-2'>Occupation:</strong> <span>{{ $student->occu_one }}</span></td>
<td><strong class='mr-2'>Contact Number:</strong> <span>{{ $student->cont_one }}</span></td>
</tr>


<tr>
<td><strong class='mr-2'>Father:</strong> <span>{{ $student->father }}</span></td>
<td><strong class='mr-2'>Highest Educational Attainment::</strong><span> {{ $student->edu_two }}</span></td>
<td><strong class='mr-2'>Occupation:</strong> <span>{{ $student->occu_two }}</span></td>
<td><strong class='mr-2'>Contact Number:</strong> <span>{{ $student->cont_two }}</span></td>
</tr>

<tr>
<td><strong class='mr-2'>Guardian:</strong> <span>{{ $student->guardian }}</span></td>
<td><strong class='mr-2'>Highest Educational Attainment::</strong><span> {{ $student->edu_three }}</span></td>
<td><strong class='mr-2'>Occupation:</strong> <span>{{ $student->occu_three }}</span></td>
<td><strong class='mr-2'>Contact Number:</strong> <span>{{ $student->cont_three }}</span></td>
</tr>

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

{!! Form::model($others_eligible, ['route' => ['admin-add_other_eligibities'], 'method' => 'post']) !!}
<?= Form::hidden('student_id', $student->id) ?>
<div class='row'>
<div class='col-md-12'>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Other Credential Presented</h3>
</div>
<div class="card-body">
	<div class='row'>
		<div class='col-md'>
			<?php 
				$pept = "";
				$date_exam = "";
				$others = "";
				$test_center = "";
				$remarks = "";

				if($others_eligible->count()){
					$row = $others_eligible->first();
					$pept = $row->pept;
					$date_exam = $row->date_exam;
					$others = $row->others;
					$test_center = $row->test_center;
					$remarks = $row->remarks;
				}
			?>
			<?php echo Form::label('pept', 'Pept Passer Rating'); ?>
			<?php echo Form::text('pept', $pept, ['class' => 'form-control', 'placeholder' => 'Rating']); ?>
		</div>
		<div class='col-md'>
			<?php echo Form::label('date_exam', 'Date Exam'); ?>
			<?php echo Form::text('date_exam', $date_exam, ['class' => 'form-control', 'placeholder' => 'Date Exam']); ?>
		</div>
		<div class='col-md'>
			<?php echo Form::label('others', 'Others (Pls. specify)'); ?>
			<?php echo Form::text('others', $others, ['class' => 'form-control', 'placeholder' => 'Others']); ?>
		</div>
	</div>
	<div class='row'>
		<div class='col-md'>
			<?php echo Form::label('test_center', 'Name and Address of testing Center'); ?>
			<?php echo Form::text('test_center', $test_center, ['class' => 'form-control', 'placeholder' => 'testing Center']); ?>
		</div>
		<div class='col-md'>
			<?php echo Form::label('remarks', 'Remarks'); ?>
			<?php echo Form::text('remarks', $remarks, ['class' => 'form-control', 'placeholder' => 'Remarks']); ?>
		</div>
	</div>

	<button class='btn btn-md btn-primary mt-2'>Update</button>
</div>

</div>
</div>
</div>

{!! Form::close() !!}

<div class='row'>
@foreach($gradeyr as $index => $yr)
@php
	$year_label = ["Kinder", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6"];
@endphp
<div class='col-md-12'>
<div class="card card-primary" id="card-panel-{{$yr->gradelevel}}">
<div class="card-header">
<div class='row justify-content-between align-items-center'>
<div>
<h3 class="card-title">Enrollment Year  - <strong>{{$year_label[$yr->gradelevel]}}</strong></h3>
</div>
<div>
<a href="{{route('admin-student-record', $adviser[$yr->gradelevel]['enroll_id'])}}" class='btn btn-md btn-success'>See Records</a>
<a href="#"  data-toggle="modal" data-target="#re-enroll_modal-{{$yr->gradelevel}}" class='btn btn-md btn-danger'>Re-enroll</a>
</div>
</div>
</div>
<div class="card-body">
{!! Form::model($student, ['route' => ['admin-grade_enroll_add', $adviser[$yr->gradelevel]['route']], 'method' => 'put']) !!}
<?= Form::hidden('gradeyr', $yr->gradelevel) ?>
<?= Form::hidden('student_id', $student->id) ?>
<div class='form-group'>
<div class='row'>
<div class='col-md-5 d-flex'>
<label class="mr-2"><strong>Year From:</strong> <input type='text' class='form-control datepicker' value="{{$adviser[$yr->gradelevel]['yr_from']}}" name='year_from' autocomplete='off'/></label>
<label>
<strong>Year To:</strong> <input type='text' class='form-control datepicker' value="{{$adviser[$yr->gradelevel]['yr_to']}}" name='year_to' autocomplete='off'/></label>
</div>
<div>
<label class="mr-4"><strong>Status:</strong>
@if($adviser[$yr->gradelevel]['type'] == "ENROLLED")
<p class='text-success mb-0'>Enrolled</p>
@elseif($adviser[$yr->gradelevel]['type'] == "DROPPEDOUT")
<p class='text-danger mb-0'>Dropped Out</p>
@elseif($adviser[$yr->gradelevel]['type'] == "TRANSFERREDOUT")
<p class='text-danger mb-0'>Transferred Out</p>
@elseif($adviser[$yr->gradelevel]['type'] == "UNENROLLED")
<p class='text-danger mb-0'>Un-Enrolled</p>
@elseif($adviser[$yr->gradelevel]['type'] == "REENROLLED")
<p class='text-warning mb-0'>Re-Enrolled</p>
<a href="{{route('admin-student-enroll_history', ['id' => $student->id, 'level' => $yr->gradelevel])}}" class='btn btn-sm btn-primary'>Check Last Year</a>
@endif
</label>
</div>
</div>
<table class='table'>
	<thead><tr><th></th><th>Teacher Name</th><th>Section Name</th><th>Total Students</th></tr></thead>
	<tbody>
	@if(isset($adviser[$yr->gradelevel]))
		@foreach($adviser[$yr->gradelevel]['data'] as $a)
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
@if($adviser[$yr->gradelevel]['type'] == "")
<input type='submit' class='btn btn-md btn-primary' value="Enroll" />
@else
<input type='submit' class='btn btn-md btn-primary' value="Update" />
@endif
</div>
{!! Form::close() !!}
</div>
</div>
</div>

@include('partials.students.re-enroll', ['adviser' => $adviser[$yr->gradelevel], 'modal_id' => 're-enroll_modal-' . $yr->gradelevel, 'gradelevel' => $yr->gradelevel, 'student_id' => $student->id])

@endforeach
</div>	

@include('partials.students.update_status', ['modal_id' => 'update-status-modal', 'status_enroll' => $status_enroll->first()])

@endsection

@push('styles')
<link href="{{ asset('assets/datepicker/css/bootstrap-datepicker.min.css') }}" media="all" type="text/css" rel="stylesheet"/>
@endpush

@push('scripts')
<script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$('.datepicker').datepicker({
	format: 'yyyy',
	viewMode: "years", 
    minViewMode: "years"
})

$('#date_exam').datepicker({
	format: 'yyyy-mm-dd',
})
</script>
@endpush
