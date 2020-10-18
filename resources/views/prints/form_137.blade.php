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
			flex-wrap:wrap;
		}
		.col-5{
			width:45%;
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
		
		.text-left{
			text-align:left !important;	
		}

		#footer{
			padding: 20px;
		    background-color: gray;
		    text-align: center;
		    margin-top: 20px;
		}

		#footer button{
			padding: 10px 20px;
		    background-color: #4040f7;
		    border: unset;
		    color: white;
		}

		@media print{
			#footer{
				display:none;
			}
		}
	</style>
</head>
<body>
<div id='wrapper'>
	<center><img src="{{asset('assets/img/header-print.jpg')}}" width="50%"/></center>
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
	@php
		if($e->records->count()){
			$grades_arr = [];
			foreach($e->records as $r){
				if($r->subject->parent_id == 0){
					$grades_arr[$r->subject->subjcode] = [
						'children' => [],
						'subject' => $r->subject->subjname,
						'subcode' => $r->subject->subjcode,
						'enroll_id' => $r->enroll_id,
						'first' => ($r->qtr_first != 0) ? $r->qtr_first : "",
						'second' => ($r->qtr_second != 0) ? $r->qtr_second : "",
						'third' => ($r->qtr_third != 0) ? $r->qtr_third : "",
						'fourth' => ($r->qtr_fourth != 0) ? $r->qtr_fourth : "",
						'final' => ($r->final_rate != 0) ? $r->final_rate : "",
						'remarks' => $r->remarks
					];
				
				}
				else{

					$parent = App\Models\Subjects::where('id', $r->subject->parent_id)->get();

					if($parent->count()){
						$grades_arr[$parent->first()->subjcode]['children'][] = [
							'subject' => $r->subject->subjname,
							'subcode' => $r->subject->subjcode,
							'enroll_id' => $r->enroll_id,
							'first' => ($r->qtr_first != 0) ? $r->qtr_first : "",
							'second' => ($r->qtr_second != 0) ? $r->qtr_second : "",
							'third' => ($r->qtr_third != 0) ? $r->qtr_third : "",
							'fourth' => ($r->qtr_fourth != 0) ? $r->qtr_fourth : "",
							'final' => ($r->final_rate != 0) ? $r->final_rate : "",
							'remarks' => $r->remarks
						];
					}
				}
			}	
		}
	@endphp

		@if(count($grades_arr))
			@foreach($grades_arr as $g)
				@if(!count($g['children']))
					<tr>
					<td>{{$g['subject']}}</td>
					<td>{{$g['first']}}</td>
					<td>{{$g['second']}}</td>
					<td>{{$g['third']}}</td>
					<td>{{$g['fourth']}}</td>
					<td>{{$g['final']}}</td>
					<td>{!! $g['remarks'] !!}
					</td>
					</tr>
				@else
					<tr>
					<td><strong>{{$g['subject']}}</strong></td>
					<td colspan="6"></td>
					</tr>
					@foreach($g['children'] as $c)
						<tr class='child-item'>
						<td>{{$c['subject']}}</td>
						<td>{{$c['first']}}</td>
						<td>{{$c['second']}}</td>
						<td>{{$c['third']}}</td>
						<td>{{$c['fourth']}}</td>
						<td>{{$c['final']}}</td>
						<td>{!! $c['remarks'] !!}</td>
						</tr>
					@endforeach
				@endif
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

@if(($levels->count() - $enrolls->count()) > 0)

@foreach(range(0, ($levels->count() - $enrolls->count())) as $r)

<div class='col-5 px'>
<table>
	<tbody class="details  py-7"><tr>
		<th>School</th>
		<td></td>
		<th>School ID</th>
		<td></td>
	</tr></tbody>
</table>
<table>
	<tbody class="details  py-7"><tr>
		<th>District</th>
		<td></td>
		<th>Region</th>
		<td></td>
	</tr></tbody>
</table>
<table>
	<tbody class="details  py-7"><tr>
		<th>Classified as Grade</th>
		<td></td>
		<th>Section</th>
		<td></td>
	</tr>
	<tr>
		<th class="py-7">School Year</th>
		<td></td>
	</tr>
</tbody>
</table>
<table class="records-table mb">
	<thead class='records-label'>
		<tr><th rowspan="2">Learning Areas</th><th colspan="4">Quarterly Rating</th><th rowspan="2">Final Rate</th><th rowspan="2">Remarks</th></tr>
		<tr><th>1</th><th>2</th><th>3</th><th>4</th></tr>
	</thead>
	<tbody>
		@if(count($subject_arr))
			@foreach($subject_arr as $s)
				@if(!count($s['children']))
					<tr>
						<td>{{$s['subject']}}</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				@else
					<tr>
						<td><strong>{{$s['subject']}}</strong></td>
						<td colspan="6"></td>
					</tr>
					@foreach($s['children'] as $c)
						<tr>
						<td>{{$c['subject']}}</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					@endforeach
				@endif
			@endforeach
		@endif
	</tbody>
</table>
</div>

@endforeach

@endif
</div>

<div id="footer">
	<button type='button' onclick="window.print()">Print</button>
</div>
</body>
</html>
