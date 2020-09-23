@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Add Teacher Information</h3>
  </div>
{!! Form::open(['route' => 'section_docreate', 'method' => 'post']) !!}
<div class='card-body'>
<div class="form-group">
<?php echo Form::label('sectionname', 'Section Name'); ?>
<?php echo Form::text('sectionname', '', ['class' => 'form-control', 'placeholder' => 'Section Name']); ?>
</div>
<div class="form-group">
<?php echo Form::label('gradelevel', 'Grade Level'); ?>
<?php echo Form::select('gradelevel', [1, 2, 3, 4, 5, 6, 7], null, ['class'=>'form-control']) ?>
</div>
<div class="form-group">
<?php echo Form::label('teacher', 'Advisor'); ?>
<?php echo Form::select('teacher', $teachers, null, ['class'=>'form-control']) ?>
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