@extends('layouts.dashboardLayout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      {{"Please check the following fields " . implode(", ", $errors->all())}}
    </div>
@endif

@if(session('success'))
	@component('alerts.alert', ['alert_type' => 'alert-success'])
		{{session('success')}}
	@endcomponent
@endif
<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Account Registration for Teacher</h3>
  </div>

<div class='card-body'>
@php
	$year_label = ["Kinder", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6"];
@endphp
<div class='form-group'>
<h5>Full Name: {{$user->fullname}}</h5>
<h5>Grade Level: {{$year_label[$user->section->gradelevel]}}</h5>
<h5>Section: {{$user->section->sectionname}}</h5>
</div>
<div class='form-group'>
<label>Create an account</label>
</div>
{!! Form::open(['route' => ['admin-docreate-account', 'teacher', $user->id], 'method' => 'put']) !!}

<div class='form-group'>
<?php echo Form::label('email', 'Email'); ?>
<?php echo Form::email('email', ($guess->count()) ? $guess->first()->email : '', ['class' => 'form-control', 'placeholder' => 'Enter Email']); ?>
</div>

<div class='form-group'>
<?php echo Form::label('password', 'Password'); ?>
<?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password']); ?>
</div>

<div class='form-group'>
<?php echo Form::label('confirm', 'Confirm Password'); ?>
<?php echo Form::password('confirm', ['class' => 'form-control', 'placeholder' => 'Retype Password']); ?>
</div>

<div class='form-group'>
<button class='btn btn-md btn-primary'>Submit</button>
</div>
{!! Form::close() !!}


</div>
</div>
</div>
</div>
@endsection