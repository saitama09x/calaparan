@component('modals.edit_modal', ['modal_id' => 'remedial_modal'])

@slot('modal_title')
 	Remdial Records
@endslot

@slot('modal_body')
@php
$date_from = "";
$date_to = "";
if($remedial->count()){
	$date_from = $remedial->first()->date_from;
	$date_to = $remedial->first()->date_to;
}
@endphp
<div class='row form-group justify-content-center'>
	<div class='col-md-2  d-flex'>
		<label class='mr-3'>From</label>
		<input type='text' id="remdate-from" value="{{$date_from}}" class='form-control datepicker'/>
	</div>
	<div class='col-md-2 d-flex'>
		<label class='mr-3'>To</label>
		<input type='text' id="remdate-to" value="{{$date_to}}" class='form-control datepicker'/>
	</div>
</div>
<div class='form-group mt-2'>
		<table class='table remedial-table'>
		<thead><tr><th></th><th>Learning Areas</th><th>Final Rating</th><th>Remedial Class Mark</th><th>Recomputed Final Grade</th></tr></thead>
			@if(!empty($enrolls))
				@if($enrolls->teacher->count())
					@if($enrolls->teacher->subjects->count())
						@foreach($enrolls->teacher->subjects as $s)
							@php
								$is_check = "";
								$final = "";
								$markval = "";
								$recomval = "";
								$remval = "";
								if($remedial->count()){
									foreach($remedial as $r){
										if($r->subjcode == $s->subjects->subjcode){
											$is_check = "checked";
											$final = $r->final_rating;
											$markval = $r->remedial_mark;
											$recomval = $r->refinal_rating;
											$remval = $r->remarks;
										}
									}
								}
							@endphp
							<tr>
								<td><input type='checkbox' class="remedial-check" value="{{$s->subjects->subjcode}}" {{$is_check}}/></td>
								<td>{{$s->subjects->subjname}}</td>
								<td><input type='number' name='finalval[{{$s->subjects->subjcode}}]' class='form-control' value="{{$final}}"/></td>
								<td><input type='text' name='markval[{{$s->subjects->subjcode}}]' class='form-control' value="{{$markval}}"/></td>
								<td><input type='number' name='recomval[{{$s->subjects->subjcode}}]' value="{{$recomval}}" class='form-control'/></td>
							</tr>
						@endforeach
					@endif
				@endif
			@endif
		</table>
	</div>
@endslot

@slot('modal_footer')
<input type='button' class='btn btn-primary btn-md' value='Save Records' id="btn-remedial"/>
@endslot
@endcomponent

@component('modals.edit_modal', ['modal_id' => 'remedial_remarks_modal'])

@slot('modal_title')
 	Add Remarks
@endslot

@slot('modal_body')
<textarea id="remedial-rem" class="remedial-rem" style="width: 100%; height: 200px; font-size: 14px;"></textarea>
@endslot

@slot('modal_footer')
<input type='button' class='btn btn-primary btn-md' value='Update Remarks' id="btn-remarks_remedial"/>
@endslot

@endcomponent