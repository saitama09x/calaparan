@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Add Teacher Information</h3>
  </div>
{!! Form::model($teachers, ['route' => 'teacher_docreate', 'method' => 'post']) !!}
<div class='card-body'>
<div class="form-group">
<?php echo Form::label('fullname', 'FullName'); ?>
<?php echo Form::text('fullname', '', ['class' => 'form-control', 'placeholder' => 'FullName']); ?>
</div>
<div class="form-group">
<?php echo Form::label('sectname', 'Section'); ?>
<?php echo Form::select('sectname', $section_val, null, ['class'=>'form-control']) ?>
</div>
<div class="form-group">
<button class='btn btn-md btn-primary'>Submit</button>
</div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
@endsection