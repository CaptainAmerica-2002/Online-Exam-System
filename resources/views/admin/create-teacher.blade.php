@extends('adminlte::page')

@section('title', 'Create Teacher')

@section('content_header')
    <h1>Create Teacher</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title">Teacher Details</h3>
    </div>

    <form method="POST" action="/admin/create-teacher">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label>Teacher Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>


            <div class="form-group">
                <label>Subject</label>
                <select name="subject" class="form-control" required>
                    <option value="">-- Select Subject --</option>
                    <option value="DBMS">DBMS</option>
                    <option value="OS">Operating Systems</option>
                    <option value="CN">Computer Networks</option>
                    <option value="AI">Artificial Intelligence</option>
                    <option value="ML">Machine Learning</option>
                    <option value="SE">Software Engineering</option>
                    <option value="PHP">PHP</option>
                </select>
            </div>


        </div>

        <div class="card-footer text-right">
            <button type="submit" class="btn btn-success">
                Create Teacher
            </button>
        </div>
    </form>
</div>

@stop
