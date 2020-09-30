@component('modals.edit_modal', ['modal_id' => 'edit_modal'])

@slot('modal_title')
	Edit Student
@endslot

@slot('modal_body')
	<form method='POST' id="studentrecord">
	<div class='form-group'>
		Select Quarter
	</div>
	<div class='form-group'>
		<label class='mr-2'>
			<input type='radio' name="quarter" value="1" checked/>1st
		</label>
		<label class='mr-2'>
			<input type='radio' name="quarter" value="2"/>2nd
		</label>
		<label class='mr-2'>
			<input type='radio' name="quarter" value="3"/>3rd
		</label>
		<label class='mr-2'>
			<input type='radio' name="quarter" value="4"/>4th
		</label>
		<label class='mr-2'>
			<input type='radio' name="quarter" value="5"/>Final
		</label>
	</div>
	<div class='form-group'>
		<table class='table'>
			<tbody>
			@if(!empty($enrolls))
				@if($enrolls->records->count())
					@foreach($enrolls->records as $s)
						<tr><td>{{$s->subject->subjname}}</td>
							<td><input type='number' name='gradeval[]' data-id="{{$s->subject->subjcode}}" value="{{$s->qtr_first}}" class='form-control'/></td></tr>
					@endforeach
				@endif
			@endif
			</tbody>
		</table>
	</div>
	</form>
@endslot

@slot('modal_footer')
	<input type='button' class='btn btn-primary btn-md' value='Update' id="btn-update"/>
@endslot

@endcomponent


@component('modals.edit_modal', ['modal_id' => 'remarks_modal'])

@slot('modal_title')
 	Student Name
@endslot

@slot('modal_body')
<textarea id="remark_area" class="remark_area" style="width: 100%; height: 200px; font-size: 14px;"></textarea>
@endslot

@slot('modal_footer')
<input type='button' class='btn btn-primary btn-md' value='Update Remarks' id="btn-remarks"/>
@endslot

@endcomponent
