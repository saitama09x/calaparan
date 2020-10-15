@extends('layouts.dashboardLayout')

@section('metas')
<meta name='student-id' data-id='{{$student->id}}' />
<meta name='student-yr' data-yr='{{$enrolls->gradeyr}}' />
<meta name='enroll-id' data-id='{{$enrolls->id}}' />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/summernote/summernote-lite.css') }}">
<link href="{{ asset('assets/datepicker/css/bootstrap-datepicker.min.css') }}" media="all" type="text/css" rel="stylesheet"/>
<style>
#remark_area{
	display: none;
}

.remedial-table thead th:nth-child(1){
	width:5%;
}

.remedial-table thead th:nth-child(2){
	width:12%;
}

.remedial-table thead th:nth-child(3){
	width:10%;
}

.remedial-table thead th:nth-child(4){
	width:16%;
}

.remedial-table thead th:nth-child(5){
	width:20%;
}

</style>
@endpush

@section('content')
<div class='form-group'>
@if(Auth::guard('web')->check())
<a href="{{route('teacher-student-print-record', $enrolls->id)}}" target="_blank" class='btn btn-md btn-primary'>Print Record</a>
@endif 
@if(Auth::guard('admin')->check())
<a href="{{route('admin-student-print-record', $enrolls->id)}}" target="_blank" class='btn btn-md btn-primary'>Print Record</a>
@endif
</div>
<div class='row'>
<div class='col-md-12'>
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

<div class='row'>
<div class='col-md-12'>
<div class="card card-primary">
	<div class="card-header">
<h3 class="card-title">Records</h3>
</div>
<div class="card-body">
<div class='form-group'>
	<a href="#" class='btn btn-md btn-success' data-toggle="modal" data-target="#edit_modal">Edit</a>
</div>
<div class='form-group'>
<div id="dom-load">

</div>
</div>
</div>
</div>
</div>
</div>

<div class='row'>
<div class='col-md-12'>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Remedial</h3>
</div>
<div class="card-body">
<div class='form-group'>
<a href="#" class='btn btn-md btn-success' data-toggle="modal" data-target="#remedial_modal">Edit</a>
</div>
<div id="remedial-load">

</div>
</div>
</div>
</div>
</div>

<div class='row'>
<div class='col-md-12'>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Core Values</h3>
</div>
<div class="card-body">
<div class='form-group'>
<button type='button' class='btn btn-md btn-primary' id="update-values">Update Values</button>
</div>
<div id="coreval-load">
<table>
<thead class='records-label'>
<tr><th rowspan="2" style="width:15%;">Core Values</th><th style="width:40%;" rowspan="2">Behaviour Statement</th><th colspan="4">Quarter</th></tr>
<tr>
<th>
	<div class='d-flex align-items-center justify-content-around'>
		<input type="radio" name="quarter_values" value="1"/><span>1</span>
	</div>
</th>
<th>
	<div class='d-flex align-items-center justify-content-around'>
		<input type="radio" name="quarter_values" value="2"/><span>2</span>
	</div>
</th>
<th>
	<div class='d-flex align-items-center justify-content-around'>
		<input type="radio" name="quarter_values" value="3"/><span>3</span>
	</div>
</th>
<th>
	<div class='d-flex align-items-center justify-content-around'>
		<input type="radio" name="quarter_values" value="4"/><span>4</span>
	</div>
</th></tr>
</thead>

<tbody>

@if(count($core_arr))
@foreach($core_arr as $k => $v)
@php
$rowspan = count($core_arr[$k]['val']);
@endphp
<tr>
<td rowspan={{$rowspan}}>{{$core_arr[$k]['key']}}</td>
@if(isset($core_arr[$k]['val'][0]))
<td><?= $core_arr[$k]['val'][0]['content'] ?></td>
<td>
	@include('partials.students.behavior_select', ['id' => $core_arr[$k]['val'][0]['id'], 'quarter' => 1, "value" => $core_arr[$k]['val'][0]['values']['first']])
</td>
<td>
	@include('partials.students.behavior_select', ['id' => $core_arr[$k]['val'][0]['id'], 'quarter' => 2, "value" =>  $core_arr[$k]['val'][0]['values']['second']])
</td>
<td>
	@include('partials.students.behavior_select', ['id' => $core_arr[$k]['val'][0]['id'], 'quarter' => 3, "value" =>  $core_arr[$k]['val'][0]['values']['third']])
</td>
<td>
	@include('partials.students.behavior_select', ['id' => $core_arr[$k]['val'][0]['id'], 'quarter' => 4, "value" => $core_arr[$k]['val'][0]['values']['fourth']])
</td>
@endif
</tr>
@if(isset($core_arr[$k]['val'][1]))
<tr>
<td><?= $core_arr[$k]['val'][1]['content'] ?></td>
<td>
	@include('partials.students.behavior_select', ['id' => $core_arr[$k]['val'][1]['id'], 'quarter' => 1, "value" => $core_arr[$k]['val'][1]['values']['first']])
</td>
<td>
	@include('partials.students.behavior_select', ['id' => $core_arr[$k]['val'][1]['id'], 'quarter' => 2, "value" => $core_arr[$k]['val'][1]['values']['second']])
</td>
<td>
	@include('partials.students.behavior_select', ['id' => $core_arr[$k]['val'][1]['id'], 'quarter' => 3, "value" => $core_arr[$k]['val'][1]['values']['third']])
</td>
<td>
	@include('partials.students.behavior_select', ['id' => $core_arr[$k]['val'][1]['id'], 'quarter' => 4, "value" => $core_arr[$k]['val'][1]['values']['fourth']])
</td>
</tr>
@endif
@endforeach
@endif
</tbody>

</table>

</div>
</div>
</div>
</div>
</div>

@include('partials.students.edit_records', ['grades' => $grades])

@include('partials.students.edit_remedial', ['remedial' => $remedial, 'enrolls' => $enrolls])

@endsection

@push('scripts')
<script src="{{ asset('assets/summernote/summernote-lite.js') }}"></script>
<script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/custom_api.js?v=0.2') }}"></script>
<script src="{{ asset('assets/js/js-records.js?v=0.2') }}"></script>
@endpush


