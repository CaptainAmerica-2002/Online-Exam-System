@extends('adminlte::page')

@section('title', 'Teacher Dashboard')

@section('content_header')
    <h1>Teacher Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $examCount ?? 0 }}</h3>
                <p>My Exams</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <a href="/teacher/exams" class="small-box-footer">
                Manage Exams <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
@stop
