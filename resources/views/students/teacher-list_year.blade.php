@extends('layouts.dashboardLayout')

@section('content')
<div class='row'>
<div class='col-md-12'>
	<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Enrollment Years</h3>
</div>
<div class="card-body">
<h4>Select Years</h4>
@if($history->count())

	@foreach($history as $hist)
		<a href="{{route('lists_student', $hist->yr_from)}}" class='btn btn-md btn-primary'>{{$hist->yr_from}}</a>
	@endforeach

@endif

</div>
</div>
</div>
</div>
@endsection