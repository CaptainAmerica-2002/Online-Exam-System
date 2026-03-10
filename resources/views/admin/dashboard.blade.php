@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Admin Dashboard</h1>
@stop

@section('content')

<div class="row">

    <!-- Students -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalStudents ?? 0 }}</h3>
                <p>Total Students</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>

    <!-- Teachers -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalTeachers ?? 0 }}</h3>
                <p>Total Teachers</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>
    </div>

    <!-- Exams -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalExams ?? 0 }}</h3>
                <p>Total Exams</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>
    </div>

    <!-- Pending Approval -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $pendingExams ?? 0 }}</h3>
                <p>Pending Approvals</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

</div>

<!-- Chart Section -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Pass vs Fail Analytics
            </div>
            <div class="card-body">
                <canvas id="resultChart"></canvas>
            </div>
        </div>
    </div>
</div>

@stop


@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const passCount = @json($passCount);
    const failCount = @json($failCount);

    const ctx = document.getElementById('resultChart');

    if (ctx) {
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pass', 'Fail'],
                datasets: [{
                    data: [passCount, failCount],
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            }
        });
    }

});
</script>
@endsection
