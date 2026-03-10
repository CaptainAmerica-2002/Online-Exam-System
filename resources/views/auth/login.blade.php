@extends('adminlte::auth.login')

@section('auth_body')
<div class="custom-auth-body">

    {{-- ERROR DISPLAY (THIS WAS MISSING) --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Login --}}
        <div class="input-group mb-3">
           <input type="text"
                name="login"
                value="{{ old('login') }}"
                class="form-control"
                placeholder="Email or Roll Number"
                required autofocus>


            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        {{-- Password --}}
        <div class="input-group mb-3">
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Password"
                   required>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary btn-block">
            Sign In
        </button>

    </form>

</div>
@stop

@section('auth_footer')
<div class="text-center mt-3">

    <p class="mb-1">
        <a href="{{ route('password.request') }}" class="auth-link">
            Forgot Password?
        </a>
    </p>

    <p class="mb-0">
        <a href="{{ route('register') }}" class="auth-link">
            Register
        </a>
    </p>

</div>
@stop
