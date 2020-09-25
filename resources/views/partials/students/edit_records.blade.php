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
		<label>
			<input type='radio' name="quarter" value="1"/>1st
		</label>
		<label>
			<input type='radio' name="quarter" value="2"/>2nd
		</label>
		<label>
			<input type='radio' name="quarter" value="3"/>3rd
		</label>
		<label>
			<input type='radio' name="quarter" value="4"/>4th
		</label>
		<label>
			<input type='radio' name="quarter" value="5"/>Final
		</label>
	</div>
	<div class='form-group'>
		<table class='table'>
		<thead><tr><th>Learning Areas</th></tr></thead>
			@if(!empty($enrolls))
				@if($enrolls->teacher->count())
					@if($enrolls->teacher->subjects->count())
						@foreach($enrolls->teacher->subjects as $s)
							<tr><td>{{$s->subjects->subjname}}</td>
								<td><input type='number' name='gradeval[]' data-id="{{$s->subjects->subjcode}}" class='form-control'/></td></tr>
						@endforeach
					@endif
				@endif
			@endif
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
