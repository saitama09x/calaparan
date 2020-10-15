@component('modals.edit_modal', ['modal_id' => $modal_id ])

@slot('modal_title')
	Re-enroll Student
@endslot

@slot('modal_body')

{!! Form::open(['route' => ['admin-grade_enroll_add', 'REENROLLED'], 'method' => 'put']) !!}

<?= Form::hidden('gradeyr', $gradelevel) ?>
<?= Form::hidden('student_id', $student_id) ?>

<div class='form-group'>
	<div class='row'>
		<div class='col-md-4'>
		<label>Year From:</label>
		<input type='text' class='form-control datepicker' value="" name='year_from' autocomplete='off'/>
		</div>
		<div class='col-md-4'>
		<label>Year To:</label>
		<input type='text' class='form-control datepicker' value="" name='year_to' autocomplete='off'/>
		</div>
	</div>
</div>

<table class='table'>
	<thead><tr><th></th><th>Teacher Name</th><th>Section Name</th><th>Total Students</th></tr></thead>
	<tbody>
	@if(isset($adviser))
		@foreach($adviser['data'] as $a)
			<tr>
				<td><?= Form::radio('teacher_id', $a->id, $a->is_selected) ?></td>
				<td>{{$a->name}}</td>
				<td>{{$a->section}}</td>
				<td>{{$a->total_student}}</td>
			</tr>
		@endforeach
	@endif
	</tbody>
</table>

<button class='btn btn-primary btn-md'>Submit</button>

{!! Form::close() !!}

@endslot


@slot('modal_footer')

@endslot

@endcomponent