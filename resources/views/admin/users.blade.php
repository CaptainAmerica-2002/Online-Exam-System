@extends('adminlte::page')

@section('title', 'System Users')

@section('content_header')
    <h1>System Users</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email / Roll No</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email ?? $user->roll_no }}</td>
                    <td>
                        <span class="badge badge-info">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@stop
