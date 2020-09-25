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
<table>
<thead class='records-label'>
		<tr><th rowspan="2">Learning Areas</th><th colspan="4">Quarterly Rating</th><th rowspan="2">Final Rate</th><th rowspan="2">Remarks</th>
		<tr><th>1</th><th>2</th><th>3</th><th>4</th></tr>
	</thead>
<tbody>
@foreach($enrolls as $e)
<tr>
	<td>{{$e->subject->subjname}}</td>
	<td>{{$e->qtr_first}}</td>
	<td>{{$e->qtr_second}}</td>
	<td>{{$e->qtr_third}}</td>
	<td>{{$e->qtr_fourth}}</td>
	<td>{{$e->final_rate}}</td>
	<td>{!!$e->remarks!!}</td>
</tr>
@endforeach
</tbody>
</table>

<table>
<thead class='records-label'><tr><th rowspan="2">Core Values</th><th rowspan="2">Behaviour Statement</th><th colspan="4">Quarter</th></tr>
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
@endif
</tr>
@if(isset($core_arr[$k]['val'][1]))
<tr>
<td><?= $core_arr[$k]['val'][1]['content'] ?></td>
</tr>
@endif
@endforeach
@endif
</tbody>

</table>

</body>
</html>
