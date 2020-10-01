@extends('layouts.accountLayout')

@section('form-content')

@error('lrefno')
    <div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      {{$message}}
    </div>
@enderror

@if(session('no_record'))
<div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      {{session('no_record')}}
    </div>
@endif


@if(session('with_record'))
<div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      {{session('with_record')}}
    </div>
@endif

{!! Form::open(['route' => 'student_check', 'method' => 'post']) !!}
<div class="form-group">
<?php echo Form::label('lrefno', 'Learner Referrence No.'); ?>
<?php echo Form::text('lrefno', '', ['class' => 'form-control', 'placeholder' => 'Learner Referrence No.']); ?>
</div>

<div class="row">
  <!-- /.col -->
  <div class="col-4">
    <button type="submit" class="btn btn-primary btn-block">Submit</button>
  </div>
  <!-- /.col -->
</div>
{!! Form::close() !!}

@endsection