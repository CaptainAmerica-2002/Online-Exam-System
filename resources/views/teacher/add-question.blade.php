@extends('adminlte::page')

@section('title', 'Add Question')

@section('content_header')
    <h1>Add Question</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <form method="POST" action="/teacher/exam/add-question">
            @csrf
            <input type="hidden" name="exam_id" value="{{ $exam->id }}">

            <div class="form-group">
                <label>Question</label>
                <input type="text" name="question" class="form-control" required>
            </div>

            @foreach(['a','b','c','d'] as $opt)
            <div class="form-group">
                <label>Option {{ strtoupper($opt) }}</label>
                <input type="text" name="option_{{ $opt }}" class="form-control" required>
            </div>
            @endforeach

            <div class="form-group">
                <label>Correct Option</label>
                <select name="correct_option" class="form-control" required>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
            </div>

            <button class="btn btn-success">
                Add Question
            </button>
        </form>

    </div>
</div>
@stop
