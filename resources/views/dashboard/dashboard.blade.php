@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Quick Example</h3>
  </div>
{!! Form::model($student, ['route' => ['student.addStudent']]) !!}
 	<div class="card-body">
      <div class="form-group">
        <?php echo Form::label('fname', 'First Name'); ?>
        <?php echo Form::text('fname', '', ['class' => 'form-control', 'placeholder' => 'First Name']); ?>
      </div>
      <div class="form-group">
         <?php echo Form::label('lname', 'Middle Name'); ?>
         <?php echo Form::text('lname', '', ['class' => 'form-control', 'placeholder' => 'Middle Name']); ?>
      </div>
      <div class="form-group">
         <?php echo Form::label('lname', 'Last Name'); ?>
         <?php echo Form::text('lname', '', ['class' => 'form-control', 'placeholder' => 'Last Name']); ?>
      </div>
      <div class="form-group">
         <?php echo Form::label('exname', 'Extension Name'); ?>
         <?php echo Form::text('exname', '', ['class' => 'form-control', 'placeholder' => 'Extension Name']); ?>
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