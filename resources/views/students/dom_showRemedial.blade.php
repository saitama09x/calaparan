<table class='table'>
<tbody>
<th>Remedial Classes</th><td>Conducted from: <strong>{{$remedial->first()->date_from}}</strong> To <strong>{{$remedial->first()->date_to}}</strong></td>
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
				<td>{!!$r->remarks!!}</td>		
			</tr>
		@endforeach
	@endif
</tbody>
</table>