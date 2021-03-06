<html>
<head>
	<style>
		html, body{
			font-family: arial, serif;
			font-size:15px;
		}
		
		p, th, td{
			font-size:15px;
		}

		#wrapper{
			width:80%;
		}
		table{
			width:100%;
			border-collapse: collapse;
		}

		table td{
			border: solid 1px #000;
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
		
		.text-center{
			text-align:center;
		}

		.records-table{
			width:70%;
			border: solid 1px #000;
			border-collapse: collapse;
		}

		.records-label th{
    		text-align: center;	
    		padding:10px;
		}

		.records-label th{
			border: solid 1px #000;
		}
		.records-table tbody td{
			border: solid 1px #000;
			text-align:center;
		}
		.grade-legend tbody td{
			text-align:center;
		}
		
		.grade-table .learn-col{
			width:45%;
		}

		#values-table thead .statement{
			width:45%;
		}

		.row{
			display:flex;

		}
		.col-4{
			width:40%;
		}

		.col-5{
			width:50%;
		}

		.col-6{
			width:60%;
		}
		.px{
			padding: 0 10px;
		}
		.mb{
			margin-bottom:20px;
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

<div class='row'>
	<div class='col-5 px'>
		<div class='mb'>
<table class='grade-table mb'>
<thead class='records-label'>
		<tr><th class='learn-col' rowspan="2">Learning Areas</th><th colspan="4">Quarterly Rating</th><th rowspan="2">Final Rate</th><th rowspan="2">Remarks</th></tr>
		<tr><th>1</th><th>2</th><th>3</th><th>4</th></tr>
	</thead>
<tbody>
@if(count($grades))
@foreach($grades as $g)

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
<td colspan="7"><strong>{{$g['subject']}}</strong></td>
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
if($remedials->count()){
	$date_from = $remedials->first()->date_from;
	$date_to = $remedials->first()->date_to;
}
@endphp

<table class='table'>
<tbody class='records-label'>
<th>Remedial Classes</th><td>Conducted from: <strong>{{$date_from}}</strong> To <strong>{{$date_to}}</strong></td>
</tbody>
</table>
<table class='table'>
<thead class='records-label'><tr><th>Learning Areas</th><th>Final Rating</th><th>Remedial Class Mark</th><th>Recomputed Final Grade</th><th>Remarks</th></tr></thead>
<tbody>
	@if($remedials->count())
		@foreach($remedials as $r)
			<tr>
				<td>{{$r->subject->subjname}}</td>
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

<table class='grade-legend'>
	<thead>
		<tr>
			<th>Description</th>
			<th>Grading Scale</th>
			<th>Remarks</th>
		</tr>
	</thead>
<tbody>
	<tr><td>OutStanding</td><td>90-100</td><td>Passed</td></tr>
	<tr><td>Very Satisfactory</td><td>90-100</td><td>Passed</td></tr>
	<tr><td>Satisfactory</td><td>90-100</td><td>Passed</td></tr>
	<tr><td>Fairly Satisfactory</td><td>90-100</td><td>Passed</td></tr>
	<tr><td>Did Not Meet Expectation</td><td>90-100</td><td>Failed</td></tr>
</tbody>
</table>
</div>
<div class='col-5 px'>
<table id='values-table'>
<thead class='records-label'><tr><th rowspan="2">Core Values</th><th class='statement' rowspan="2">Behaviour Statement</th><th colspan="4">Quarter</th></tr>
	<tr><th>1</th><th>2</th><th>3</th><th>4</th></tr></thead>

<tbody>

@if(count($core_arr))
@foreach($core_arr as $k => $v)
@php
$rowspan = count($core_arr[$k]['val']);
@endphp
<tr>
<td rowspan={{$rowspan}}>{{$core_arr[$k]['key']}}</td>
@if(isset($core_arr[$k]['val'][0]))
<td><?= $core_arr[$k]['val'][0]['content'] ?></td>
<td class="text-center"><?= $core_arr[$k]['val'][0]['values']['first'] ?></td>
<td class="text-center"><?= $core_arr[$k]['val'][0]['values']['second'] ?></td>
<td class="text-center"><?= $core_arr[$k]['val'][0]['values']['third'] ?></td>
<td class="text-center"><?= $core_arr[$k]['val'][0]['values']['fourth'] ?></td>
@endif
</tr>
@if(isset($core_arr[$k]['val'][1]))
<tr>
<td><?= $core_arr[$k]['val'][1]['content'] ?></td>
<td class="text-center"><?= $core_arr[$k]['val'][1]['values']['first'] ?></td>
<td class="text-center"><?= $core_arr[$k]['val'][1]['values']['second'] ?></td>
<td class="text-center"><?= $core_arr[$k]['val'][1]['values']['third'] ?></td>
<td class="text-center"><?= $core_arr[$k]['val'][1]['values']['fourth'] ?></td>
</tr>
@endif
@endforeach
@endif
</tbody>

</table>
</div>
</div>
<div id="footer">
	<button type='button' onclick="window.print()">Print</button>
</div>
</body>
</html>
