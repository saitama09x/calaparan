@extends('layouts.dashboardLayout')

@section('metas')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
<script src="{{ asset('assets/js/custom_api.js') }}"></script>
<script>
$(document).ready(function(){

var dt = new DataTable();

dt.listStudent(function(table){

	$('#datatable tbody').on('click', '.show-detail', function () {
		var tr = $(this).closest('tr');
        var row = table.row( tr );
        var data = row.data();
        var _table = dt.show_details(table);
        var __table = $(_table).clone();
        var tbody = $(__table).find('tbody');
        
        for(var i in data['enrolls']){
        	var enroll = data['enrolls'][i];
        	var tr = $("<tr>");
        	var td = $("<td>");
        	var a = $("<a>");
        	a.addClass('btn btn-md btn-info')
        	a.attr({"href" : enroll['url']})
        	a.text("Records")
        	td.text(enroll['gradeyr'])
        	tr.append(td)
        	td = $("<td>");
        	td.text(enroll['yr_from'])
        	tr.append(td)
        	td = $("<td>");
        	td.text(enroll['yr_to'])
        	tr.append(td)
        	td = $("<td>");
        	td.text(enroll['section'])
        	tr.append(td)
        	td = $("<td>");
        	td.append(a)
        	tr.append(td)
        	tbody.append(tr)
        }

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            row.child( __table ).show();
            tr.addClass('shown');
        }

	});

})

})
</script>
@endpush