@extends('adminlte::page')

@section('title','Exam Results')

@section('content_header')
<h1>Exam Results</h1>
@stop

@section('content')

<table class="table table-bordered">
<tr>
<th>Student</th>
<th>Score</th>
<th>Percentage</th>
<th>Status</th>
</tr>

@foreach($attempts as $attempt)
<tr>

<td>{{ $attempt->student->name }}</td>
<td>{{ $attempt->score }}</td>
<td>{{ $attempt->percentage }}%</td>

<td>
@if($attempt->status == 'pass')
<span class="badge bg-success">PASS</span>
@else
<span class="badge bg-danger">FAIL</span>
@endif
</td>

</tr>
@endforeach

</table>

@stop