@extends('layouts.dashboardLayout')

@section('content')
<div class='row'>
<div class='col-md-8'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Create Account for Teachers</h3>
  </div>

<div class='card-body'>
<table class='table'>
<thead><tr><th>Teachers</th><th>Email</th><th>Active</th><th>Section</th><th>Grade Level</th><th>Action</th></tr></thead>
<tbody>
@if($users->count())
@foreach($users as $u)
<tr>
	<td>{{$u->fullname}}</td>
	@if($u->account->count())
	@php
		$row = $u->account->first();
		$year_label = ["Kinder", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6"];
	@endphp
		@if($row->account_type_label == "Teacher")
			<td>{{ $row->email }}</td>
			<td>{{ $row->is_active}}</td>
			<td>{{ $u->section->sectionname }}</td>
			<td>{{ $year_label[$u->section->gradelevel] }}</td>
			<td><a href="{{route('admin-create-account', ['type' => 'teacher', 'id' => $u->id])}}" class='btn btn-md btn-warning'>Edit</a></td>
		@endif
	@else
	<td colspan="4"><center>No Account Yet</center></td>
	<td><a href="{{route('admin-create-account', ['type' => 'teacher', 'id' => $u->id])}}" class='btn btn-md btn-danger'>Create</a></td>
	@endif
</tr>
@endforeach
@endif
</tbody>
</table>
</div>

</div>
</div>
</div>
@endsection