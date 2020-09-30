<table class='table'>
<thead><tr><th>Learning Areas</th><th>1</th><th>2</th><th>3</th><th>4</th><th>Final Rating</th><th>Remarks</th></tr></thead>
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
<a href="javascript:void(0)" class='btn btn-sm btn-info btn-add-remarks' data-subjcode="{{$g['subcode']}}" data-eid="{{$g['enroll_id']}}" data-toggle="modal" data-target="#remarks_modal">Edit Remarks</a>
</td>
</tr>

@else

<tr>
<td>{{$g['subject']}}</td>
<td>{{$g['first']}}</td>
<td>{{$g['second']}}</td>
<td>{{$g['third']}}</td>
<td>{{$g['fourth']}}</td>
<td>{{$g['final']}}</td>
<td>{!! $g['remarks'] !!}
<a href="javascript:void(0)" class='btn btn-sm btn-info btn-add-remarks' data-subjcode="{{$g['subcode']}}" data-eid="{{$g['enroll_id']}}" data-toggle="modal" data-target="#remarks_modal">Edit Remarks</a>
</td>
</tr>

@foreach($g['children'] as $c)

<tr class='child-item'>
<td>{{$c['subject']}}</td>
<td>{{$c['first']}}</td>
<td>{{$c['second']}}</td>
<td>{{$c['third']}}</td>
<td>{{$c['fourth']}}</td>
<td>{{$c['final']}}</td>
<td>{!! $c['remarks'] !!}
<a href="javascript:void(0)" class='btn btn-sm btn-info btn-add-remarks' data-subjcode="{{$c['subcode']}}" data-eid="{{$c['enroll_id']}}" data-toggle="modal" data-target="#remarks_modal">Edit Remarks</a></td>
</tr>

@endforeach

@endif

@endforeach
@endif
</tbody>
</table>