@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-6'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Add Records</h3>
  </div>
{!! Form::model($records, ['route' => ['subject.store']]) !!}
<div class='card-body'>
<div class='form-group'>
<div class='row'>
	<label class='col-md-2'>Name: </label>
	<p class='col-md-2'>{{$student->fname}}</p>
</div>
</div>

<table class='table'>
<thead><tr><th>Subject</th><th>Rating</th></tr></thead>
<tbody>
	@foreach($subject as $s)
		<tr><td>{{$s->subject_name}}</td><td></td></tr>
	@endforeach
</tbody>
</table>

</div>
{!! Form::close() !!}
</div>
</div>
</div>
@endsection