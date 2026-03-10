@extends('adminlte::page')

@section('title', 'Available Exams')

@section('content_header')
    <h1>Available Exams ({{ auth()->user()->department }})</h1>
@stop

@section('content')

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row">
@forelse($exams as $exam)
    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $exam->title }}</h3>
            </div>
            <div class="card-body">
                <p><b>Subject:</b> {{ $exam->subject }}</p>
                <p><b>Department:</b> {{ $exam->department }}</p>
                <p><b>Duration:</b> {{ $exam->duration }} mins</p>
            </div>
            <div class="card-footer text-center">
                <a href="/student/exam/{{ $exam->id }}" class="btn btn-success">
                    Start Exam
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-info">
            No exams available for your department.
        </div>
    </div>
@endforelse
</div>

@stop
