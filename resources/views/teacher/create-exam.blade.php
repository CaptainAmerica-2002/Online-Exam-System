@extends('adminlte::page')

@section('title', 'Create Exam')

@section('content_header')
    <h1>Create Exam</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="/teacher/create-exam">
    @csrf

    <div class="form-group">
        <label>Exam Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Subject</label>
        <input type="text" class="form-control" value="{{ auth()->user()->subject }}" readonly>
    </div>

    <div class="form-group">
        <label>Department</label>
        <select name="department" class="form-control" required>
            <option value="">Select Department</option>
            <option value="MCA">MCA</option>
            <option value="BCA">BCA</option>
            <option value="ECE">ECE</option>
            <option value="CSE">CSE</option>
        </select>
    </div>

    <div class="form-group">
        <label>Duration (minutes)</label>
        <input type="number" name="duration" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Start Time</label>
        <input type="datetime-local" name="start_time" class="form-control">
    </div>

    <div class="form-group">
        <label>End Time</label>
        <input type="datetime-local" name="end_time" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">
        Create Exam
    </button>
</form>

@stop
