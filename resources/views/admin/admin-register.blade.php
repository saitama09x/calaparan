@extends('layouts.accountLayout')

@section('account-title', 'Admin Registration')

@section('form-content')

{!! Form::open(['route' => 'admin_doregister', 'method' => 'post']) !!}
<div class="form-group mb-3">
  <label>First Name</label>
  <input type="text" class="form-control" placeholder="First Name" name="fname">
</div>
<div class="form-group mb-3">
  <label>Middle Name</label>
  <input type="text" class="form-control" placeholder="Middle Name" name="mname">
</div>
<div class="form-group mb-3">
  <label>Last Name</label>
  <input type="text" class="form-control" placeholder="Last Name" name="lname">
</div>
<div class="form-group mb-3">
  <label>Username</label>
  <input type="text" class="form-control" placeholder="Username" name="username">
</div>
<div class="form-group mb-3">
  <label>Password</label>
  <input type="password" class="form-control" placeholder="Password" name="password">
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