@extends('adminlte::page')

@section('title', 'Student Dashboard')

@section('content_header')
    <h1>Student Dashboard</h1>
@stop

@section('content')
<div class="row">

    {{-- Available Exams --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $availableExams ?? 0 }}</h3>
                <p>Available Exams</p>
            </div>
            <div class="icon">
                <i class="fas fa-pen"></i>
            </div>
            <a href="/student/exams" class="small-box-footer">
                View Exams <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    {{-- My Results --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>&nbsp;</h3> {{-- empty heading to match height --}}
                <p>My Results</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <a href="/student/results" class="small-box-footer">
                View Results <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>
@stop
