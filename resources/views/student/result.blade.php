@extends('adminlte::page')

@section('title', 'Exam Result')

@section('content_header')
    <h1>Exam Marksheet</h1>
@stop

@section('content')

<div class="card">
<div class="card-body">

<h4><strong>Exam:</strong> {{ $attempt->exam->title }}</h4>

<hr>

<h5 class="mb-3">Student Details</h5>

<div class="row">

<div class="col-md-6">
<p><strong>Name:</strong> {{ $student->name }}</p>
<p><strong>Roll Number:</strong> {{ $student->rollno }}</p>
<p><strong>Department:</strong> {{ $student->department }}</p>
</div>

<div class="col-md-6">
<p><strong>Subject:</strong> {{ $attempt->exam->subject }}</p>
<p><strong>Exam:</strong> {{ $attempt->exam->title }}</p>
<p><strong>Date:</strong> {{ $attempt->created_at->format('d M Y h:i A') }}</p>
</div>

</div>

<hr>

<h5>Exam Performance</h5>

<table class="table table-bordered">

<tr>
<th width="200">Total Questions</th>
<td>{{ $totalQuestions }}</td>
</tr>

<tr>
<th>Correct Answers</th>
<td>{{ $correctAnswers }}</td>
</tr>

<tr>
<th>Wrong Answers</th>
<td>{{ $wrongAnswers }}</td>
</tr>

<tr>
<th>Score</th>
<td>{{ $attempt->score }}</td>
</tr>

<tr>
<th>Percentage</th>
<td>{{ $attempt->percentage }}%</td>
</tr>

<tr>
<th>Status</th>
<td>
@if($attempt->status == 'pass')
<span class="badge bg-success">PASS</span>
@else
<span class="badge bg-danger">FAIL</span>
@endif
</td>
</tr>

</table>

<div class="mt-4">

<a href="/student/results" class="btn btn-primary mr-2">
<i class="fas fa-arrow-left"></i> Back to Results
</a>

<a href="{{ url('/student/results/'.$attempt->id.'/download') }}" class="btn btn-success">
<i class="fas fa-download"></i> Download Marksheet
</a>

</div>

</div>

@stop

