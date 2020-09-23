@extends('layouts.accountLayout')

@section('form-content')

{!! Form::open(['route' => 'add_register', 'method' => 'post']) !!}
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
<div class="form-group mb-3">
  <label>Email</label>
  <input type="email" class="form-control" placeholder="Email" name="email">
</div>
<div class="form-group mb-3">
  <label>Account Type</label>
  <select class="form-control" name="account_type"><option value="Student">Student</option><option value="Teacher">Teacher</option></select>
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