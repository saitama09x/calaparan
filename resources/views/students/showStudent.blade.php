@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">View Student Information</h3>
</div>
<div class="card-body">
<table class='table'>
<tbody>
<tr><td>Name:</td><td>{{ $student->fname . ' ' . $student->mname . ' ' . $student->exname}}</td></tr>
<tr><td>Birthday:</td><td>{{ $student->bday }}</td></tr>
<tr><td>Gender:</td><td>{{ $student->sex }}</td></tr>
<tr><td>Date Created:</td><td>{{ $student->datecreated }}</td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
<h3 class="card-title">Records</h3>
</div>
<div class="card-body">
<div class='form-group'>
	<a href="#" class='btn btn-md btn-success' data-toggle="modal" data-target="#edit_modal">Edit</a>
</div>
<div class='form-group'>
<table class='table'>
	<thead><tr><th>Learning Areas</th><th>1</th><th>2</th><th>3</th><th>4</th></tr></thead>
@if(!empty($enrolls))
	@if($enrolls->section->count())
		@if($enrolls->section->subjects->count())
			@foreach($enrolls->section->subjects as $s)
				<tr><td>{{$s->subject_name}}</td></tr>
			@endforeach
		@endif
	@endif
@endif
</table>
</div>
</div>
</div>
</div>
</div>
@component('modals.edit_modal')

@slot('modal_title')
	Edit Student
@endslot

@slot('modal_body')
	<table class='table'>
	<thead><tr><th>Learning Areas</th></tr></thead>
		@if(!empty($enrolls))
			@if($enrolls->section->count())
				@if($enrolls->section->subjects->count())
					@foreach($enrolls->section->subjects as $s)
						<tr><td>{{$s->subject_name}}</td></tr>
					@endforeach
				@endif
			@endif
		@endif
	</table>
@endslot

@slot('modal_footer')
	Modal Body
@endslot

@endcomponent
@endsection


