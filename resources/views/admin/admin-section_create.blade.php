@extends('layouts.dashboardLayout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      @error('sectionname')
      	<p>Required fill section name</p>
      @enderror

       @error('gradelevel')
      	<p>Required fill Grade level</p>
      @enderror
    </div>
@endif

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
<?php echo Form::select('gradelevel', [0 => 'Kinder', 1 => 'Grade 1', 
						2 => 'Grade 2', 3 => 'Grade 3', 4 => 'Grade 4', 
						5 => 'Grade 5', 6 => 'Grade 6'], 
						null, ['class'=>'form-control']) ?>
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