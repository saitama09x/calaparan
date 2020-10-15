@component('modals.edit_modal', ['modal_id' => $modal_id ])

@slot('modal_title')
	Update Status
@endslot

@slot('modal_body')

{!! Form::open(['route' => ['admin-grade_enroll_status'], 'method' => 'post']) !!}

<?php echo Form::hidden('yr_from', $status_enroll->yr_from) ?>
<?php echo Form::hidden('student_id', $status_enroll->student_id) ?>
<?php echo Form::hidden('teacher_id', $status_enroll->teacher_id) ?>

<div class='w-50 m-auto'>
<div class='form-group'>
<?php echo Form::label('status', 'Status'); ?>
<?php echo Form::select('status', ['ENROLLED' => 'Enrolled', 'REENROLLED' => 'Irregular', 'DROPPEDOUT' => 'Dropped Out', 'TRANSFERREDOUT' => 'Transferred Out', 'UNENROLLED' => 'Un-enrolled'], $status_enroll->enroll_type, ['class'=>'form-control']) ?>
</div>
<div class='form-group'>
<?php echo Form::label('remarks', 'Remarks'); ?>
<?php echo Form::textarea('remarks', $status_enroll->remarks, ['class' => 'form-control']) ?>
</div>
<div class='form-group'>
<button class='btn btn-sm btn-primary'>Update Status</button>
</div>
{!! Form::close() !!}

@endslot


@slot('modal_footer')

@endslot

@endcomponent