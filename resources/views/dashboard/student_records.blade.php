@extends('layouts.dashboardLayout')

@section('content')

<div class='row'>
<div class='col-md-12'>
<div class="card card-primary">
	<div class="card-header">
    <h3 class="card-title">Student Name Records</h3>
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
      
<tr>
<td><strong class='mr-2'>Mother:</strong> <span>{{ $student->mother }}</span></td>
<td><strong class='mr-2'>Highest Educational Attainment::</strong><span> {{ $student->edu_one }}</span></td>
<td><strong class='mr-2'>Occupation:</strong> <span>{{ $student->occu_one }}</span></td>
<td><strong class='mr-2'>Contact Number:</strong> <span>{{ $student->cont_one }}</span></td>
</tr>


<tr>
<td><strong class='mr-2'>Father:</strong> <span>{{ $student->father }}</span></td>
<td><strong class='mr-2'>Highest Educational Attainment::</strong><span> {{ $student->edu_two }}</span></td>
<td><strong class='mr-2'>Occupation:</strong> <span>{{ $student->occu_two }}</span></td>
<td><strong class='mr-2'>Contact Number:</strong> <span>{{ $student->cont_two }}</span></td>
</tr>

<tr>
<td><strong class='mr-2'>Guardian:</strong> <span>{{ $student->guardian }}</span></td>
<td><strong class='mr-2'>Highest Educational Attainment::</strong><span> {{ $student->edu_three }}</span></td>
<td><strong class='mr-2'>Occupation:</strong> <span>{{ $student->occu_three }}</span></td>
<td><strong class='mr-2'>Contact Number:</strong> <span>{{ $student->cont_three }}</span></td>
</tr>

    </tbody>
    </table>
  </div>

</div>
</div>
</div>

<div class='row'>
@if(count($enrolls))
  @foreach($enrolls as $e)
  <div class='col-md-6'>
  <div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">School Record</h3>
  </div>
  <div class='card-body'>
    <div class="row">
      <div class='col-md-7'>School: {{$e->shname}}</div>
      <div class='col-md-5'>School ID: {{$e->shid}}</div>
    </div>
    <div class="row">
      <div class='col-md-4'>District: {{$e->district}}</div>
      <div class='col-md-4'>Division: {{$e->division}}</div>
      <div class='col-md-4'>Region: {{$e->region}}</div>
    </div>
    <div class="row">
      <div class='col-md-4'>Classified as Grade: {{$e->gradeyr}}</div>
      <div class='col-md-4'>Section: {{$e->section}}</div>
      <div class='col-md-4'>School Year: {{ date('Y', strtotime($e->yr_from)) . '-' . date('Y', strtotime($e->yr_to))}}</div>
    </div>
    <div class="row">
      <div class='col-md-9'>Name of Adviser/Teacher:{{$e->teacher}}</div>
      <div class='col-md-5'>Signature:__________</div>
    </div>
    <table class='table'>
    <thead>
      <tr>
        <th></th>
        <th colspan="4">Quarterly</th>
        <th rowspan="2">Final Rate</th>
        <th rowspan="2">Remarks</th>
      </tr>
      <tr>
        <th>Learning Areas</th><th>1</th><th>2</th><th>3</th><th>4</th>
      </tr>
      </thead>
    <tbody>
    @if(count($records))
      @foreach($records as $r)
        @if($r->id == $e->id)
          <tr>
            <td>{{$r->subname}}</td>
            <td>{{$r->qtr_first}}</td>
            <td>{{$r->qtr_second}}</td>
            <td>{{$r->qtr_third}}</td>
            <td>{{$r->qtr_fourth}}</td>
            <td>{{$r->final_rate}}</td>
            <td>{!!$r->remarks!!}</td>
          </tr>
        @endif
      @endforeach
    @endif
    </tbody>
    </table>
  </div>
  </div>
  </div>
  @endforeach
@endif
</div>

@endsection