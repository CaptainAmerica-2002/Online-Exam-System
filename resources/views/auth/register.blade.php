@extends('adminlte::auth.auth-page', ['authType' => 'register'])

@section('auth_header', 'Create a new account')

@section('auth_body')
<form method="POST" action="{{ route('register') }}">
    @csrf

    {{-- Name --}}
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               placeholder="Full Name" value="{{ old('name') }}" required autofocus>

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>

        @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    {{-- Email --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               placeholder="Email" value="{{ old('email') }}" required>

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>

        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    {{-- Department --}}
    <div class="form-group">
        <label>Department</label>
        <select name="department" class="form-control" required>
            <option value="">Select Department</option>
            <option value="MCA">MCA</option>
            <option value="BCA">BCA</option>
            <option value="ECE">ECE</option>
            <option value="CSE">CSE</option>
        </select>
    </div>


    {{-- Password --}}
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
               placeholder="Password" required>

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>

        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="input-group mb-3">
        <input type="password" name="password_confirmation" class="form-control"
               placeholder="Confirm Password" required>

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn btn-primary btn-block">
        Register
    </button>
</form>
@stop


@section('auth_footer')
<div class="text-center mt-3">
    <a href="{{ route('login') }}" class="auth-link">
        Already have an account? Login
    </a>
</div>
@stop
