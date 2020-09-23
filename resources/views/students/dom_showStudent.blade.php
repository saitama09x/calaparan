<table class='table'>
<thead><tr><th>Learning Areas</th><th>1</th><th>2</th><th>3</th><th>4</th><th>Final Rating</th><th>Remarks</th></tr></thead>
<tbody>
@if($records->count())

@foreach($records as $e)

<tr>

<td>{{$e->subject->subjname}}</td>
<td>{{$e->qtr_first}}</td>
<td>{{$e->qtr_second}}</td>
<td>{{$e->qtr_third}}</td>
<td>{{$e->qtr_fourth}}</td>
<td>{{$e->final_rate}}</td>
<td>{!! $e->remarks !!}
<a href="javascript:void(0)" class='btn btn-sm btn-info btn-add-remarks' data-subjcode="{{$e->subjcode}}" data-eid="{{$e->enroll_id}}" data-toggle="modal" data-target="#remarks_modal">Edit Remarks</a>
</td>
</tr>

@endforeach
	
@endif
</tbody>
</table>