@extends('layouts.dashboardLayout')

@section('content')
<div class='row'>
	<div class='col-md-9'>
		<div class="card card-primary">
			<div class="card-header">
			<h3 class="card-title">Grade Section Lists</h3>
		</div>
			<div class="card-body">
				<div class='form-group'>
					<a href="{{route('section_create')}}" class='btn btn-primary btn-md'>New Section</a>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>Section Name</th><th>Adviser</th><th>Grade Level</th><th>Total Students</th><th>Action</th>
						</tr>
					</thead>
					<tbody>
				@if($sections->count())
					@foreach($sections as $s)
						<tr>
							<td>{{$s->sectionname}}</td>
							<td>{{isset($s->adviser) ? $s->adviser->fullname : '' }}</td>
							<td>{{isset($s->adviser) ? $s->adviser->classgrade: '' }}</td>
							<td>{{isset($s->adviser) ? $s->adviser->enrolls->count() : '' }}</td>
							<td><a href="{{route('section_edit', $s->id)}}" class='btn btn-warning btn-md'>Edit</a></td>
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