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
	</style>
</head>
<body>

<div class='row'>
	<div class='col-5 px'>
		<div class='mb'>
<table class='grade-table'>
<thead class='records-label'>
		<tr><th class='learn-col' rowspan="2">Learning Areas</th><th colspan="4">Quarterly Rating</th><th rowspan="2">Final Rate</th><th rowspan="2">Remarks</th></tr>
		<tr><th>1</th><th>2</th><th>3</th><th>4</th></tr>
	</thead>
<tbody>
@foreach($enrolls as $e)
<tr>
	<td>{{$e->subject->subjname}}</td>
	<td class='text-center'>{{$e->qtr_first}}</td>
	<td class='text-center'>{{$e->qtr_second}}</td>
	<td class='text-center'>{{$e->qtr_third}}</td>
	<td class='text-center'>{{$e->qtr_fourth}}</td>
	<td class='text-center'>{{$e->final_rate}}</td>
	<td class='text-center'>{!!$e->remarks!!}</td>
</tr>
@endforeach
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

</body>
</html>
