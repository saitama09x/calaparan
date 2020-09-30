@extends('layouts.dashboardLayout')

@section('content')
<div class='row'>
	<div class='col-md-9'>
		<div class="card card-primary">
			<div class="card-header">
			<h3 class="card-title">Subject Lists</h3>
		</div>
			<div class="card-body">
				<div class='form-group'>
					<a href="{{route('subject_create')}}" class='btn btn-primary btn-md'>New Subject</a>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>Subject Code<th>Subject</th><th>Top Level</th><th>Grade Level</th><th>Action</th>
						</tr>
					</thead>
					<tbody>
				@if($subject->count())
					@foreach($subject as $s)
						<tr>
							<td>{{$s->subjcode}}</td>
							<td>{{$s->subjname}}</td>
							<td>{{isset($parents[$s->parent_id]) ? $parents[$s->parent_id] : '' }}</td>
							<td>{{$s->gradelevel}}</td>
							<td><a href="#" class='btn btn-warning btn-md'>Edit</a></td>
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