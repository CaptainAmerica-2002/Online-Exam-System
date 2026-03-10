@extends('adminlte::page')

@section('title', 'My Exams')

@section('content_header')
<h1>My Exams</h1>
@stop

@section('content')

<div class="card">

<div class="card-body">

<table class="table table-bordered">

    <thead>

        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Questions</th>
            <th>View</th>
        </tr>

    </thead>

    <tbody>

        @foreach($exams as $exam)

        <tr>

            <td>{{ $exam->title }}</td>

            <td>{{ ucfirst($exam->status) }}</td>

            <td>

                @if($exam->status === 'draft')

                    <a href="/teacher/exam/{{ $exam->id }}/add-question" class="btn btn-sm btn-primary">
                    Add Question
                    </a>

                @else

                    <button class="btn btn-sm btn-secondary" disabled>
                    Published
                    </button>

                @endif

            </td>

                <td>

                    <a href="/teacher/exam/{{ $exam->id }}" class="btn btn-sm btn-info">
                    View Paper
                    </a>

                    <a href="/teacher/exam/{{ $exam->id }}/edit" class="btn btn-sm btn-warning">
                    Edit
                    </a>
                    
                    <a href="/teacher/exam/{{ $exam->id }}/results" class="btn btn-success btn-sm">
                    Results
                    </a>

                </td>

        </tr>

        @endforeach

    </tbody>

</table>

</div>

</div>

@stop