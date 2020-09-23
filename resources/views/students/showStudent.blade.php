@extends('layouts.dashboardLayout')

@section('metas')
<meta name='student-id' data-id='{{$student->id}}' />
<meta name='student-yr' data-yr='{{$enrolls->gradeyr}}' />
<meta name='enroll-id' data-id='{{$enrolls->id}}' />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/summernote/summernote-lite.css') }}">
<link href="{{ asset('assets/datepicker/css/bootstrap-datepicker.min.css') }}" media="all" type="text/css" rel="stylesheet"/>
<style>
#remark_area{
	display: none;
}

.remedial-table thead th:nth-child(1){
	width:5%;
}

.remedial-table thead th:nth-child(2){
	width:12%;
}

.remedial-table thead th:nth-child(3){
	width:10%;
}

.remedial-table thead th:nth-child(4){
	width:16%;
}

.remedial-table thead th:nth-child(5){
	width:20%;
}

</style>
@endpush

@section('content')

<div class='row'>
<div class='col-md-9'>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">View Student Information</h3>
</div>
<div class="card-body">
<table class='table'>
<tbody>
<tr>
<th>Name:</th>
<td>{{ $student->fname . ' ' . $student->mname . ' ' . $student->lname . ' ' . $student->exname}}</td>
<th>Birthday:</th>
<td>{{ $student->bday }}</td>
</tr>
<tr>
	<th>Gender:</th>
	<td>{{ $student->sex }}</td>
	<th>Date Created:</th>
	<td>{{ $student->datecreated }}</td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>

<div class='row'>
<div class='col-md-9'>
<div class="card card-primary">
	<div class="card-header">
<h3 class="card-title">Records</h3>
</div>
<div class="card-body">
<div class='form-group'>
	<a href="#" class='btn btn-md btn-success' data-toggle="modal" data-target="#edit_modal">Edit</a>
</div>
<div class='form-group'>
<div id="dom-load">

</div>
</div>
</div>
</div>
</div>
</div>

<div class='row'>
<div class='col-md-9'>
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Remedial</h3>
</div>
<div class="card-body">
<div class='form-group'>
<a href="#" class='btn btn-md btn-success' data-toggle="modal" data-target="#remedial_modal">Edit</a>
</div>
<div id="remedial-load">

</div>
</div>
</div>
</div>
</div>

@component('modals.edit_modal')

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


@component('modals.remarks_modal')

@slot('remark_title')
 	Student Name
@endslot

@slot('remark_body')
<textarea id="remark_area" class="remark_area" style="width: 100%; height: 200px; font-size: 14px;"></textarea>
@endslot

@slot('remark_footer')
<input type='button' class='btn btn-primary btn-md' value='Update Remarks' id="btn-remarks"/>
@endslot

@endcomponent

@component('modals.remedial_modal')

@slot('modal_title')
 	Remdial Records
@endslot

@slot('modal_body')
<div class='row form-group justify-content-center'>
	<div class='col-md-2  d-flex'>
		<label class='mr-3'>From</label>
		<input type='text' id="remdate-from" value="{{$remedial->first()->date_from}}" class='form-control datepicker'/>
	</div>
	<div class='col-md-2 d-flex'>
		<label class='mr-3'>To</label>
		<input type='text' id="remdate-to" value="{{$remedial->first()->date_to}}" class='form-control datepicker'/>
	</div>
</div>
<div class='form-group mt-2'>
		<table class='table remedial-table'>
		<thead><tr><th></th><th>Learning Areas</th><th>Final Rating</th><th>Remedial Class Mark</th><th>Recomputed Final Grade</th><th>Remarks</th></tr></thead>
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
								<td><textarea class='remedial-rem' name="remval[{{$s->subjects->subjcode}}]">{!!$remval!!}</textarea></td>
							</tr>
						@endforeach
					@endif
				@endif
			@endif
		</table>
	</div>
@endslot

@slot('modal_footer')
<input type='button' class='btn btn-primary btn-md' value='Update Remarks' id="btn-remedial"/>
@endslot
@endcomponent

@endsection

@push('scripts')
<script src="{{ asset('assets/summernote/summernote-lite.js') }}"></script>
<script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/custom_api.js') }}"></script>
<script>
	$(document).ready(function(){
		var api = new API();
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd'
		})

		var load_records = function(){
			var enroll_id = $("meta[name='enroll-id']").data('id')
			api.student_load(enroll_id, function(res){
				$("#dom-load").html(res)
			});
		}

		var load_remedial = function(){
			var enroll_id = $("meta[name='enroll-id']").data('id')
			api.remedial_load(enroll_id, function(res){
				$("#remedial-load").html(res)
			});
		}
		
		load_records();
		load_remedial();

		var edit_modal = $("#edit_modal");
		var remarks_modal = $("#remarks_modal");
		var remedial_modal = $("#remedial_modal");

		$('#remark_area').summernote({
			placeholder : 'Please write your remarks',
			height: 200,
			focus: true,
			toolbar: [
	          ['style', ['style']],
	          ['font', ['bold', 'underline', 'clear']],
	          ['color', ['color']],
	       	]
		})

		$('.remedial-rem').summernote({
			placeholder : 'Please write your remarks',
			height: 70,
			focus: true,
			toolbar: [
	          ['style', ['style']],
	       	]
		})

		$("#studentrecord").on('submit', function(e){
			e.preventDefault();
			var gradeval = $("[name^='gradeval']");
			var quarter = $("[name^='quarter']");
			var sid = $("meta[name='student-id']").data('id')
			var gradeyr = $("meta[name='student-yr']").data('yr')

			var form = new FormData();
			form.append('sid', sid)
			form.append('grade_yr', gradeyr);

			quarter.each(function(index, val){
				if($(this).is(":checked")){
					form.append('quarter', $(this).val());
				}
			})

			gradeval.each(function(index, val){
				form.append('gradeval['+index+']', JSON.stringify(
					{ 
					code : $(val).data('id'), 
					value : $(val).val()
					}
				))
			})

			api.insert_record(form, function(res){
				if(res){
					edit_modal.modal('hide')
					load_records()
				}
			})

		})

		$("#btn-update").click(function(){
			$("#studentrecord").trigger('submit');
		})

		$("#btn-remedial").click(function(){

			var checkrem = $(".remedial-check");
			var enroll_id = $("meta[name='enroll-id']").data('id')
			var remdate_from = $("#remdate-from").val();
			var remdate_to = $("#remdate-to").val();

			var sub_arr = [];
			checkrem.each(function(index, item){
				var val = $(this).val();
				if($(this).is(":checked")){
					sub_arr.push(val);
				}
			})
			
			var form = new FormData();

			form.append('enroll_id', enroll_id);
			form.append('remdate_from', remdate_from);
			form.append('remdate_to', remdate_to);
			form.append('subjects', JSON.stringify(sub_arr));

			sub_arr.map(function(val){

				var final =  $("input[name='finalval[" + val + "]'").val()

				form.append("finalval[" + val + "]", final);

				var mark = $("input[name='markval[" + val + "]'").val();

				form.append("markval[" + val + "]", mark);

				var remcom = $("input[name='recomval[" + val + "]'").val();

				form.append("recomval[" + val + "]", remcom);

				var rem = $("textarea[name='remval[" +val+"]'").summernote('code');

				form.append("remval[" + val + "]", rem);

			})

			api.insert_remedial(form, function(res){
				if(res){
					remedial_modal.modal('hide');
					load_remedial();
				}
			})

		})

		var subj = ''
		var enroll_id = ''

		$("#dom-load").on("click", '.btn-add-remarks', function(){
			subj = $(this).data('subjcode');
			enroll_id = $(this).data('eid');
		})

		$("#btn-remarks").click(function(){
			var val = $('#remark_area').summernote('code');
			var form = new FormData();
			form.append('subjcode', subj);
			form.append('enroll_id', enroll_id);
			form.append('value', val);

			api.add_remarks(form, function(res){
				if(res){
					remarks_modal.modal('hide')
					load_records()
				}
			})
		})

	})
</script>
@endpush


