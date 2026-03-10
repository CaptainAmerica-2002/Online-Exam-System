@extends('adminlte::page')

@section('title', 'My Results')

@section('content_header')
    <h1>My Exam Results</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Exam History</h3>
    </div>

    <div class="card-body">

        @if($attempts->isEmpty())
            <div class="alert alert-info">
                No exam attempts found.
            </div>
        @else
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Exam</th>
                    <th>Score</th>
                    <th>Percentage</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>

                @foreach($attempts as $attempt)
                @php
                    $percent = $attempt->percentage ?? 0;
                @endphp

                <tr>
                    <td>{{ $attempt->exam->title ?? 'N/A' }}</td>
                    <td>{{ $attempt->score ?? 0 }}</td>

                    <td>
                        <div class="progress">
                            <div class="progress-bar 
                                @if($percent >= 70)
                                    bg-success
                                @elseif($percent >= 40)
                                    bg-warning
                                @else
                                    bg-danger
                                @endif"
                                role="progressbar"
                                style="width: {{ $percent }}%;">
                                {{ $percent }}%
                            </div>
                        </div>
                    </td>

                    <td>
                        @if($attempt->status == 'pass')
                            <span class="badge bg-success">PASS</span>
                        @else
                            <span class="badge bg-danger">FAIL</span>
                        @endif
                    </td>

                    <td>{{ $attempt->created_at->format('d M Y') }}</td>

                    <td>
                        <a href="/student/results/{{ $attempt->id }}" 
                           class="btn btn-primary btn-sm">
                            View Result
                        </a>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>

        @endif

    </div>
</div>

@stop
