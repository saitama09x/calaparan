@extends('layouts.accountLayout')


@section('form-error')

@if(session('login_error'))
<div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      {{session('login_error')}}
    </div>
@endif


@endsection

@section('account-title', 'Admin Login')

@section('form-content')

{!! Form::open(['url' => '/admin', 'method' => 'post']) !!}
<div class="input-group mb-3">
  <input type="text" name="username" class="form-control" placeholder="Username">
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-envelope"></span>
    </div>
  </div>
</div>
<div class="input-group mb-3">
  <input type="password" name="password" class="form-control" placeholder="Password">
  <div class="input-group-append">
    <div class="input-group-text">
      <span class="fas fa-lock"></span>
    </div>
  </div>
</div>
<div class="row">
  <!-- /.col -->
  <div class="col-4">
    <button type="submit" class="btn btn-primary btn-block">Login</button>
  </div>
  <!-- /.col -->
</div>
{!! Form::close() !!}

@endsection