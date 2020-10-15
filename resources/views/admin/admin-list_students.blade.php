@extends('layouts.dashboardLayout')

@section('metas')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<div class='row'>
<div class='col-md-12'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Student Lists</h3>
  </div>
<div class="card-body">
<div class='form-group'>
	<div class='row'>
		<div class='col-md-4'>
	@if($selyears->count())
	<label>Select School Year</label>
	<select class='form-control' id="selyear">
		@foreach($selyears as $yr)
			<option value="{{$yr->yr_from}}">{{$yr->yr_from . " - " . (intval($yr->yr_from) + 1)}}</option>
		@endforeach
	</select>
	@endif
		</div>
	</div>
</div>
<table class='table' id="datatable">
<thead><tr><th>Student Name</th><th>Status</th><th>Action</th></tr></thead>
<tbody>
	
</tbody>
</table>
</div>
</div>
</div>
</div>
@endsection

@push('styles')
<link href="{{ asset('assets/bootstrap/css/dataTables.bootstrap4.min.css') }}" />
<link href="{{ asset('assets/datatables/css/jquery.dataTables.min.css') }}" />
<link href="{{ asset('assets/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/custom_api.js') }}"></script>
<script>
$(document).ready(function(){

	var dt = new DataTable();

	dt.section_studentList(function(table){

		$("#selyear").change(function(){
			var val = $(this).val();
			
			$("#datatable").dataTable().fnDestroy();
			
			dt.section_studentList(function(table){

			}, <?= $section ?>, val);

		})

	}, <?= $section ?>, <?= $current_yr ?>)

})
</script>
@endpush