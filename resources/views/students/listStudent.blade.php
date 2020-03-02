@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-10'>
<div class="card card-primary">
<div class="card-header"><h3 class="card-title">Student List</h3></div>
<div class="card-body">
<table class='table table-striped table-bordered' id="datatable">
<thead><tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Section</th><th>Grade Yr</th><th>Action</th></tr></thead>
<tbody></tbody></table>
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
<script>
$(document).ready(function(){
	$("#datatable").DataTable({
		"processing": true,
        "serverSide": true,
        "ajax": {
        	url : "http://localhost/calaparan/public/api/data-students",
        	method : 'post'
        }
	});
})
</script>
@endpush