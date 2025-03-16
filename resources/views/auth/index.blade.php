@extends('layouts.auth')

@section('content')
    <div class="login-container">
        <!-- H2 Login (Disembunyikan di Awal) -->
        <h2 id="loginTitle" class="text-center">Login<br><small>Benevita Consulting</small></h2>

        <!-- Menampilkan Pesan dari Session (Disembunyikan di Awal) -->
        @if(session()->has('pesan'))
            <div id="loginMessage" class="alert alert-{{ session('pesan')['type'] }} text-center">
                {{ session('pesan')['message'] }}
            </div>
        @endif

        <!-- Form Login (Disembunyikan di Awal) -->
        <form id="loginForm" action="{{ route('auth.verify') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group password-container">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <i class="fas fa-eye eye-icon" id="togglePassword"></i>
            </div>

            <!-- Remember Me Checkbox with Flexbox -->
            <div class="form-check d-flex align-items-center mb-3">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block" id="loginButton">Login</button>
            <div class="text-center mt-3 d-flex justify-content-between">
                <a href="{{ route('password.request') }}" id="forgotPassword">Lupa Password?</a>
                <a href="{{ route('home') }}" id="backToHome">Back to home</a>
            </div>
        </form>

    </div>

@endsection
