<table class='table'>
<tbody>
<tr>
<th>Last Name:</th>
<td>{{ $student->lname}}</td>
<th>First Name:</th>
<td>{{$student->fname}}</td>
<th>Name Ext:</th>
<td>{{$student->exname}}</td>
<th>Middle Name:</th>
<td>{{$student->mname}}</td>
<th>Birthday:</th>
<td>{{ $student->bday }}</td>
</tr>
</tbody>
</table>
<table class="table">
<tr>
<th>Gender:</th>
<td>{{ $student->sex }}</td>
<th>Date Created:</th>
<td>{{ $student->datecreated }}</td></tr>
</table>
<div class="header-wrapper">
<label>ELIGIBILITY FOR ELEMENTARY SCHOOL ENROLLMENT</label>
</div>
<div class='wrapper-border'>
<div class='form-group'>
<table class='table'>
<tbody>
<tr>
<td>Credential Presented for Grade 1:</td>
	@if(isset($credential))
		@foreach($credential as $c)
			@php
				$is_check = "";
			@endphp
			@foreach($student->credentials as $d)
				@php
					if($c->id == $d->eligible_id){
						$is_check = "checked";
					}
				@endphp
			@endforeach
			<td><input type='checkbox' name='eligibility[]' value="{{$c->id}}" {{$is_check}}/></td><td>{{$c->crname}}</td>
		@endforeach
	@endif
</tr>
</tbody>
</table>
</div>
<div class='form-group'>
<table class='table'>
<tr>
<td>Name of School</td>
<td>
@php

$sel_school = $student->credentials;
$sel_id = null;
$shname = "";
$sh_id = "";
$district = "";
if($sel_school->count()){
	$sel_id = $sel_school->first()->school->first()->id;
	$shname = $sel_school->first()->school->first()->shname;
	$sh_id = $sel_school->first()->school->first()->shid;
	$district = $sel_school->first()->school->first()->district;
}
@endphp
{{$shname}}
</td>
<td>School Id</td>
<td>{{$sh_id}}</td>
<td>Address of School</td>
<td>{{$district}}</td>
</tr>
</table>

</div>
</div>
<div class="header-wrapper">
<label>Scholastic Record</label>
</div>
<div class='wrapper-border'>
<div class='form-group'>

@if($student->many_enroll->count())
@foreach($student->many_enroll as $enrolls)

<div class='col-card'>

@if($enrolls->records->count())
<table class='table'>
<thead>
<tr>
	<th rowspan="2">Learning Areas</th><th colspan="4">Quarterly Rating</th><th>Final Rating</th>
	<th>Remarks</th>
</tr>
<tr>
<th>1</th><th>1</th><th>1</th><th>1</th>
</tr>
</thead>
@foreach($enrolls->records as $record)
<tr>
<td>
{{$record->subject->subjname}}
</td>
<td>
{{$record->qtr_first}}
</td>
<td>
{{$record->qtr_second}}
</td>
<td>
{{$record->qtr_third}}
</td>
<td>
{{$record->qtr_fourth}}
</td>
<td>
{{$record->final_rate}}
</td>
<td>
@if($enrolls->remarks->count())
@foreach($enrolls->remarks as $rem)
@if($rem->subjcode == $record->subjcode)
{!! $rem->remarks !!}
@endif
@endforeach
@endif
</td>
</tr>
@endforeach
</table>
@endif

</div>

@endforeach
@endif

</div>
</div>
