<html>
<head>
	<style>
		html, body{
			font-family: arial, serif;
			font-size:0.8em;
		}
		th, td{
			font-size:0.8em;	
		}
		#wrapper{
			width:100%;
		}
		table{
			width:100%;
			border-collapse: collapse;
		}
		.details{
			display: block;
		}

		.title-header{
			background-color:#808080;
		}

		.title-header th{
			padding:5px;
		}
		
		.details th, .details td {
			text-align :left;
			display: inline-grid;
			margin: 0px 4px;
		}
		
		.records-table{
			width:100%;
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
		.row{
			display:flex;
		}
		.col-5{
			width:50%;
		}
		.px{
			padding:0 7px;
		}
		.py-7{
			padding: 7px 0px;
		}
		.mb{
			margin-bottom:20px;
		}
		.text-center{
			text-align:center;
		}
	</style>
</head>
<body>
<div id='wrapper'>
<table>
<thead class="title-header"><tr><th colspan="8"><center>View Student Information</center></th></tr></thead>
<tbody class="details py-7">
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
<tbody class="details py-7">
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
<tbody class="details py-7">
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
<tbody class="details py-7">
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

<table>
<thead class="title-header"><tr><th colspan="8"><center>Scholastic Records</center></th></tr></thead></table>

<div class='row'>
@foreach($enrolls as $e)
<div class='col-5 px'>
<table>
	<tbody class="details  py-7"><tr>
		<th>School</th>
		<td>{{$e->school->shname}}</td>
		<th>School ID</th>
		<td>{{$e->school->shid}}</td>
	</tr></tbody>
</table>
<table>
	<tbody class="details  py-7"><tr>
		<th>District</th>
		<td>{{$e->school->district}}</td>
		<th>Region</th>
		<td>{{$e->school->region}}</td>
	</tr></tbody>
</table>
<table>
	<tbody class="details  py-7"><tr>
		<th>Classified as Grade</th>
		<td>{{$e->gradeyr}}</td>
		<th>Section</th>
		<td>{{$e->teacher->section->sectionname}}</td>
	</tr>
	<tr>
		<th class="py-7">School Year</th>
		<td>{{$e->yr_from . " - " . $e->yr_to}}</td>
	</tr>
</tbody>
</table>
<table class="records-table mb">
	<thead class='records-label'>
		<tr><th rowspan="2">Learning Areas</th><th colspan="4">Quarterly Rating</th><th rowspan="2">Final Rate</th><th rowspan="2">Remarks</th></tr>
		<tr><th>1</th><th>2</th><th>3</th><th>4</th></tr>
	</thead>
	<tbody>
		@if($e->records->count())
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
		@endif
	</tbody>
</table>

@php
$date_from = "";
$date_to = "";
if(isset($remedials[$e->id])){
	$date_from = $remedials[$e->id][0]->date_from;
	$date_to = $remedials[$e->id][0]->date_to;
}
@endphp

<table class='table'>
<thead class='records-label'>
<th>Remedial Classes</th><th>Conducted from: <strong>{{$date_from}}</strong> To <strong>{{$date_to}}</strong></th>
</thead>
</table>

<table class='records-table'>
<thead><tr><th>Learning Areas</th><th>Final Rating</th><th>Remedial Class Mark</th><th>Recomputed Final Grade</th><th>Remarks</th></tr></thead>
<tbody>
	@if(isset($remedials[$e->id]))
		@foreach($remedials[$e->id] as $r)
			<tr>
				<td>{{$r->subject}}</td>
				<td class='text-center'>{{$r->final_rating}}</td>
				<td class='text-center'>{{$r->remedial_mark}}</td>
				<td class='text-center'>{{$r->refinal_rating}}</td>
				<td>
					{!!$r->remarks!!}
				</td>		
			</tr>
		@endforeach
	@else
		<tr><td colspan="5"><strong><center>No remedial class records</center></strong></td></tr>
	@endif
</tbody>
</table>

</div>
@endforeach

</div>


</body>
</html>
