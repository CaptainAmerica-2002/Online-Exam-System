@extends('adminlte::page')

@section('title','Edit Exam')

@section('content_header')
<h1>Edit Questions</h1>
@stop

@section('content')

@foreach($exam->questions as $q)

<div class="card mb-3">

<div class="card-body">

<form method="POST" action="/teacher/question/update/{{ $q->id }}">

@csrf

<label>Question</label>
<input type="text" name="question" value="{{ $q->question }}" class="form-control mb-2">

<label>Option A</label>
<input type="text" name="option_a" value="{{ $q->option_a }}" class="form-control mb-2">

<label>Option B</label>
<input type="text" name="option_b" value="{{ $q->option_b }}" class="form-control mb-2">

<label>Option C</label>
<input type="text" name="option_c" value="{{ $q->option_c }}" class="form-control mb-2">

<label>Option D</label>
<input type="text" name="option_d" value="{{ $q->option_d }}" class="form-control mb-2">

<label>Correct Option</label>
<select name="correct_option" class="form-control mb-3">

<option value="a" {{ $q->correct_option=='a'?'selected':'' }}>A</option>
<option value="b" {{ $q->correct_option=='b'?'selected':'' }}>B</option>
<option value="c" {{ $q->correct_option=='c'?'selected':'' }}>C</option>
<option value="d" {{ $q->correct_option=='d'?'selected':'' }}>D</option>

</select>

<button class="btn btn-primary">Update Question</button>

</form>

</div>

</div>

@endforeach

@stop