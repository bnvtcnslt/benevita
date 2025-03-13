@extends('layouts.auth')

@section('content')
    <div class="login-container">
        <h2 class="text-center">Reset Password<br><small>Benevita Consulting</small></h2>

        <!-- Menampilkan Pesan dari session (pesan sukses/gagal) -->
        @if(session()->has('pesan'))
            <div class="alert alert-{{ session('pesan')['type'] }} text-center">
                {{ session('pesan')['message'] }}
            </div>
        @endif

        <!-- Menampilkan Pesan Validasi Manual -->
        @if ($errors->any())
            <div class="alert alert-danger text-center">
                <ul class="list-unstyled mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update', ['token' => $token]) }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <!-- Input Password Baru -->
            <div class="form-group password-container">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="new_password" name="password" placeholder="Password Baru" required>
                    <i class="fas fa-eye eye-icon" id="togglePassword"></i>
                </div>
            </div>

            <!-- Input Konfirmasi Password -->
            <div class="form-group password-container">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    <i class="fas fa-eye eye-icon" id="toggleConfirmPassword"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>

            <div class="text-center mt-3">
                <a href="{{ route('auth.index') }}">Kembali ke Login</a>
            </div>
        </form>
    </div>
@endsection
