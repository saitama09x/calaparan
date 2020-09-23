@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Add Teacher Information</h3>
  </div>
{!! Form::open(['route' => 'section_doedit', 'method' => 'post']) !!}
<input type="hidden" value="{{$section->id}}" name="id" />
<div class='card-body'>
<div class="form-group">
<?php echo Form::label('sectionname', 'Section Name'); ?>
<?php echo Form::text('sectionname', $section->sectionname, ['class' => 'form-control', 'placeholder' => 'Section Name']); ?>
</div>
<div class="form-group">
<?php echo Form::label('gradelevel', 'Grade Level'); ?>
<?php echo Form::select('gradelevel', [1, 2, 3, 4, 5, 6, 7], $section->gradelevel, ['class'=>'form-control']) ?>
</div>
<div class="form-group">
<?php echo Form::label('teacher', 'Advisor'); ?>
<?php echo Form::select('teacher', $teachers, !is_null($section->adviser) ? $section->adviser->id : null, ['class'=>'form-control']) ?>
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