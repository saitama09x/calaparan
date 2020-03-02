@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Add Teacher Information</h3>
  </div>
{!! Form::model($teachers, ['route' => ['teacher.store']]) !!}
<div class='card-body'>
<div class="form-group">
<?php echo Form::label('fullname', 'FullName'); ?>
<?php echo Form::text('fullname', '', ['class' => 'form-control', 'placeholder' => 'FullName']); ?>
</div>
<div class="form-group">
<?php echo Form::label('sectname', 'Section'); ?>
<?php echo Form::text('sectname', '', ['class' => 'form-control', 'placeholder' => 'Section']); ?>
</div>
<div class="form-group">
<?php echo Form::label('schooolyr', 'School Year'); ?>
<?php echo Form::text('schooolyr', '', ['class' => 'form-control', 'placeholder' => 'School Year']); ?>
</div>
<div class="form-group">
<?php echo Form::label('classgrade', 'Class Grade'); ?>
<?php echo Form::select('classgrade', ['1' => '1', '2' => '2'], null, ['class'=>'form-control']) ?>
</div>
<div class="form-group">
<button>Submit</button>
</div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
@endsection