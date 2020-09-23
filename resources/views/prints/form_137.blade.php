<html>
<head>
	<style>
		html, body{
			font-family: arial, serif;
		}
		#wrapper{
			width:80%;
		}
		table{
			width:100%;
		}
		.details{
			display: block;
			margin:5px;
		}

		.title-header{
			background-color:gray;
		}

		.title-header th{
			padding:5px;
		}
		
		.details th, .details td {
			text-align :left;
			display: inline-grid;
    		margin: 0 8px;
		}
		
		.records-table{
			width:70%;
			border: solid 1px #000;
			border-collapse: collapse;
		}

		.records-label th{
			width: 70px;
    		text-align: center;	
		}

		.records-label th{
			border: solid 1px #000;
		}
		.records-table tbody td{
			border: solid 1px #000;
			text-align:center;
		}
	</style>
</head>
<body>
<div id='wrapper'>
<table>
<thead class="title-header"><tr><th colspan="8"><center>View Student Information</center></th></tr></thead>
<tbody class="details">
<tr>
<th>LAST NAME:</th>
<td> {{ $student->lname }} </td>
<th>FIRST NAME:</th>
<td> {{ $student->fname }} </td>
<th>NAME EXT (JR, I, II):</th>
<td> {{ $student->exname }} </td>
<th>MIDDLE NAME:</th>
<td> {{ $student->mname }} </td>
</tr>

</tbody>
</table>

<table>
<tbody class="details">
<tr>
<th>Learner Referrence Number:</th>
<td> {{ $student->lrefno }} </td>
<th>Birthdate(MM/DD/YYYY):</th>
<td> {{ date("m/d/Y", strtotime($student->bday)) }} </td>
</tr>
</tbody>
</table>

<table>
<thead class="title-header"><tr><th colspan="8"><center>ELIGIBILITY FOR ELEMENTARY SCHOOL ENROLLMENT</center></th></tr></thead>
<tbody class="details">
<tr>
<th>Credential Presented for Grade 1:</th>
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
<table>
<tbody class="details">
<tr>
	<th>Name of School</th>
	<td>
	@php
	
	$sel_school = $student->credentials;
	$shname = "";
	$sel_id = "";
	$sh_id = "";
	$district = "";
	if($sel_school->count()){
		$sel_id = $sel_school->first()->school->first()->id;
		$shname =  $sel_school->first()->school->first()->shname;
		$sh_id = $sel_school->first()->school->first()->shid;
		$district = $sel_school->first()->school->first()->district;
	}
	
	echo $shname;

	@endphp
</td>
<th>School Id</th>
<td>{{$sh_id}}</td>
<th>Address of School</th>
<td>{{$district}}</td>
</tr>
</tbody>
</table>

<div class='row'>

@foreach($enrolls as $e)
<table>
	<tbody class="details"><tr>
		<th>School</th>
		<td>{{$e->school->shname}}</td>
		<th>School ID</th>
		<td>{{$e->school->shid}}</td>
	</tr></tbody>
</table>
<table>
	<tbody class="details"><tr>
		<th>District</th>
		<td>{{$e->school->district}}</td>
		<th>Region</th>
		<td>{{$e->school->region}}</td>
	</tr></tbody>
</table>
<table>
	<tbody class="details"><tr>
		<th>Classified as Grade</th>
		<td>{{$e->gradeyr}}</td>
		<th>Section</th>
		<td>{{$e->teacher->section->sectionname}}</td>
		<th>School Year</th>
		<td>{{$e->yr_from . " " . $e->yr_to}}</td>
	</tr></tbody>
</table>
<table class="records-table">
	<thead class='records-label'>
		<tr><th rowspan="2">Learning Areas</th><th colspan="4">Quarterly Rating</th><th rowspan="2">Final Rate</th><th rowspan="2">Remarks</th>
		<tr><th>1</th><th>2</th><th>3</th><th>4</th></tr>
	</thead>
	<tbody>
		@foreach($e->records as $r)
			<tr>
				<td>{{$r->subject->subjname}}</td>
				<td>{{$r->qtr_first}}</td>
				<td>{{$r->qtr_second}}</td>
				<td>{{$r->qtr_third}}</td>
				<td>{{$r->qtr_fourth}}</td>
				<td>{{$r->final_rate}}</td>
				<td>{!! $r->remarks !!}</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endforeach

</div>


</body>
</html>
