@extends('adminlte::auth.passwords.email')

@section('auth_body')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control"
               placeholder="Enter your email" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">
        Send Password Reset Link
    </button>
</form>
@endsection
