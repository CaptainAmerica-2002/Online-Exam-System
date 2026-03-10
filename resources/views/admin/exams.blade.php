@extends('adminlte::page')

@section('title', 'Approve Exams')

@section('content_header')
    <h1>Approve Exams</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Exam</th>
                        <th>Teacher</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exams as $exam)
                        <tr>
                            <td>{{ $exam->title }}</td>
                            <td>{{ $exam->teacher->name }}</td>
                            <td>{{ ucfirst($exam->status) }}</td>
                            <td>
                                @if($exam->status === 'draft')
                                    <a href="/admin/exam/{{ $exam->id }}/approve"
                                       class="btn btn-success btn-sm">
                                        Approve
                                    </a>
                                @else
                                    <span class="badge badge-success">Approved</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@stop
