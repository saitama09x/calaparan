@extends('layouts.accountLayout')

@section('form-error')

@if(session('no_account'))
<div class="alert alert-success" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      {{session('no_account')}}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      {{"Please check the following fields " . implode(", ", $errors->all())}}
    </div>
@endif

@endsection


@section('form-content')

<div class="form-group">

<h4>Hi, {{$user->fname . " " . $user->mname . " " . $user->lname}}</h4>

</div>

{!! Form::open(['route' => ['student_account_create', $lrn], 'method' => 'put']) !!}
<div class="form-group">
<label>Learner Referrence Number</label>
<p>{{$lrn}}</p>
</div>
<div class="form-group">
<p>You LRN is your default username, please create a password for your account.</p>
</div>
<div class="form-group">
<?php echo Form::label('password', 'Password'); ?>
<?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => 'Create Password']); ?>
</div>

<div class='form-group'>
<?php echo Form::label('confirm', 'Confirm Password'); ?>
<?php echo Form::password('confirm', ['class' => 'form-control', 'placeholder' => 'Retype Password']); ?>
</div>

<div class="row">
  <!-- /.col -->
  <div class="col-4">
    <button type="submit" class="btn btn-primary btn-block">Create</button>
  </div>
  <!-- /.col -->
</div>
{!! Form::close() !!}

@endsection