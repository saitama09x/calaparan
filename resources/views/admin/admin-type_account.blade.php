@extends('layouts.dashboardLayout')

@section('content')
<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Please select type of account</h3>
  </div>

<div class='card-body'>
<div class='form-group'>
<a href="{{route('admin-create-account', 'teachers')}}" class='btn btn-md btn-success'>Teacher</a>
</div>
<div class='form-group'>
<a href="{{route('admin-create-account', 'students')}}" class='btn btn-md btn-danger'>Student</a>
</div>
</div>

</div>
</div>
</div>
@endsection