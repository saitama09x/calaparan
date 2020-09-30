@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Add Subject</h3>
  </div>
{!! Form::open(['route' => 'subject_docreate', 'method' => 'post']) !!}
<div class='card-body'>
<div class="form-group">
<?php echo Form::label('subjcode', 'Subject Code'); ?>
<?php echo Form::text('subjcode', '', ['class' => 'form-control', 'placeholder' => 'Subject Code']); ?>
</div>
<div class="form-group">
<?php echo Form::label('subjname', 'Subject Name'); ?>
<?php echo Form::text('subjname', '', ['class' => 'form-control', 'placeholder' => 'Subject Name']); ?>
</div>
<div class="form-group">
<?php echo Form::label('gradelevel', 'Grade Level'); ?>
<?php echo Form::select('gradelevel', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7], null, ['class'=>'form-control']) ?>
</div>
<div class="form-group">
<?php echo Form::label('parent_id', 'Top Level'); ?>
<?php echo Form::select('parent_id', $parents, null, ['class'=>'form-control']) ?>
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