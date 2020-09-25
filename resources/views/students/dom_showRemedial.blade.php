
@php
$date_from = "";
$date_to = "";
if($remedial->count()){
	$date_from = $remedial->first()->date_from;
	$date_to = $remedial->first()->date_to;
}
@endphp

<table class='table'>
<tbody>
<th>Remedial Classes</th><td>Conducted from: <strong>{{$date_from}}</strong> To <strong>{{$date_to}}</strong></td>
</tbody>
</table>
<table class='table'>
<thead><tr><th>Learning Areas</th><th>Final Rating</th><th>Remedial Class Mark</th><th>Recomputed Final Grade</th><th>Remarks</th></tr></thead>
<tbody>
	@if($remedial->count())
		@foreach($remedial as $r)
			<tr>
				<td>{{$r->subject->subjname}}</td>
				<td>{{$r->final_rating}}</td>
				<td>{{$r->remedial_mark}}</td>
				<td>{{$r->refinal_rating}}</td>
				<td>
					{!!$r->remarks!!}
					<a href="javascript:void(0)" class='btn btn-sm btn-info btn-add-remarks' data-subjcode="{{$r->subjcode}}" data-eid="{{$r->enroll_id}}" data-toggle="modal" data-target="#remedial_remarks_modal">Edit Remarks</a></td>		
			</tr>
		@endforeach
	@else
		<tr><td colspan="5"><strong><center>No remedial class records</center></strong></td></tr>
	@endif
</tbody>
</table>