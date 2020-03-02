@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Add Subject</h3>
  </div>
{!! Form::model($teachers, ['route' => ['subject.store']]) !!}
<div class='card-body'>
<div class="form-group">
<?php echo Form::label('subject_name', 'Subject Name'); ?>
<?php echo Form::text('subject_name', '', ['class' => 'form-control', 'placeholder' => 'Subject Name']); ?>
</div>
<div class="form-group">
<?php echo Form::label('teacher_id', 'Teacher'); ?>
<?php echo Form::select('teacher_id', $teacher_list, null, ['class'=>'form-control']) ?>
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