@extends('layouts.dashboardLayout')

@push('styles')
<link href="{{ asset('assets/datepicker/css/bootstrap-datepicker.min.css') }}" media="all" type="text/css" rel="stylesheet"/>
@endpush

@section('content')
      
@if($errors->any())
    <div class="alert alert-danger" role='alert'>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
      </button>
      {{"Please fill in these fields: " . implode(", ", $errors->all())}}
    </div>
@endif

<div class='row'>
<div class='col-md-12'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Edit Student Information</h3>
  </div>
{!! Form::model($student, ['route' => ['student.updateStudent', $student->id], 'method' => 'put']) !!}
 	<div class="card-body">
    <div class='row'>
        <div class="col-md-5 form-group">
          <?php echo Form::label('lrefno', 'LRN Number'); ?>
          <?php echo Form::text('lrefno', $student->lrefno , ['class' => 'form-control', 'placeholder' => 'LRN Number']); ?>
        </div>
    </div>
    <div class='row'>
        <div class="col-md form-group">
          <?php echo Form::label('fname', 'First Name'); ?>
          <?php echo Form::text('fname', $student->fname , ['class' => 'form-control', 'placeholder' => 'First Name']); ?>
        </div>
        <div class="col-md form-group">
           <?php echo Form::label('mname', 'Middle Name'); ?>
           <?php echo Form::text('mname', $student->mname , ['class' => 'form-control', 'placeholder' => 'Middle Name']); ?>
        </div>
        <div class="col-md form-group">
           <?php echo Form::label('lname', 'Last Name'); ?>
           <?php echo Form::text('lname', $student->lname , ['class' => 'form-control', 'placeholder' => 'Last Name']); ?>
        </div>
        <div class="col-md form-group">
           <?php echo Form::label('exname', 'Extension Name'); ?>
           <?php echo Form::text('exname', $student->exname , ['class' => 'form-control', 'placeholder' => 'Extension Name']); ?>
        </div>
      </div>
      <div class='row'>
        <div class="col-md form-group">
           <?php echo Form::label('bday', 'Birthday'); ?>
           <?php echo Form::text('bday', $student->bday, ['class' => 'form-control datepicker', 'placeholder' => 'Birthday', 'autocomplete' => 'off']); ?>
        </div>
        <div class="col-md form-group">
           <?php echo Form::label('sex', 'Gender'); ?>
           <?php echo Form::select('sex', ['Male' => 'Male', 'Female' => 'Female'], $student->sex, ['class'=>'form-control']) ?>
        </div>
         <div class="col-md form-group">
         
        </div>
        <div class="col-md form-group">
         
        </div>
      </div>
        <div class='row'>
          <div class="col-md form-group">
            <?php echo Form::label('moname', 'Mother\'s Name'); ?>
               <?php echo Form::text('moname', $student->mother, ['class' => 'form-control', 'placeholder' => 'Mother\'s Name']); ?>
          </div>
            <div class="col-md form-group">
            <?php echo Form::label('edu_one', 'Highest Education Attaintment'); ?>
               <?php echo Form::text('edu_one', $student->edu_one, ['class' => 'form-control', 'placeholder' => 'Highest Education Attaintment']); ?>
          </div>
           <div class="col-md form-group">
            <?php echo Form::label('occu_one', 'Occupation'); ?>
               <?php echo Form::text('occu_one', $student->occu_one, ['class' => 'form-control', 'placeholder' => 'Occupation']); ?>
          </div>
           <div class="col-md form-group">
            <?php echo Form::label('cont_one', 'Contact No.'); ?>
               <?php echo Form::text('cont_one', $student->cont_one, ['class' => 'form-control', 'placeholder' => 'Contact No.']); ?>
          </div>
        </div>
        <div class='row'>
          <div class="col-md form-group">
            <?php echo Form::label('faname', 'Father\'s Name'); ?>
               <?php echo Form::text('faname', $student->father, ['class' => 'form-control', 'placeholder' => 'Father\'s Name']); ?>
          </div>
            <div class="col-md form-group">
            <?php echo Form::label('edu_two', 'Highest Education Attaintment'); ?>
               <?php echo Form::text('edu_two', $student->edu_two, ['class' => 'form-control', 'placeholder' => 'Highest Education Attaintment']); ?>
          </div>
           <div class="col-md form-group">
            <?php echo Form::label('occu_two', 'Occupation'); ?>
               <?php echo Form::text('occu_two', $student->occu_two, ['class' => 'form-control', 'placeholder' => 'Occupation']); ?>
          </div>
           <div class="col-md form-group">
            <?php echo Form::label('cont_two', 'Contact No.'); ?>
               <?php echo Form::text('cont_two', $student->cont_two, ['class' => 'form-control', 'placeholder' => 'Contact No.']); ?>
          </div>
        </div>
        <div class='row'>
          <div class="col-md form-group">
            <?php echo Form::label('guardian', 'Guardian'); ?>
               <?php echo Form::text('guardian', $student->guardian, ['class' => 'form-control', 'placeholder' => 'Guardian']); ?>
          </div>
            <div class="col-md form-group">
            <?php echo Form::label('edu_three', 'Highest Education Attaintment'); ?>
               <?php echo Form::text('edu_three', $student->edu_three, ['class' => 'form-control', 'placeholder' => 'Highest Education Attaintment']); ?>
          </div>
           <div class="col-md form-group">
            <?php echo Form::label('occu_three', 'Occupation'); ?>
               <?php echo Form::text('occu_three', $student->occu_three, ['class' => 'form-control', 'placeholder' => 'Occupation']); ?>
          </div>
           <div class="col-md form-group">
            <?php echo Form::label('cont_three', 'Contact No.'); ?>
               <?php echo Form::text('cont_three', $student->cont_three, ['class' => 'form-control', 'placeholder' => 'Contact No.']); ?>
          </div>
        </div>
      <div class="form-group">
      	<button class="btn btn-md btn-primary">Update Student Information</button>
      </div>
    </div>
{!! Form::close() !!}
</div>
</div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$('.datepicker').datepicker({
  format: 'yyyy-mm-dd'
})
</script>
@endpush
