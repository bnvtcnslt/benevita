@extends('layouts.auth')

@section('content')
    <div class="login-container">
        <!-- H2 Login (Disembunyikan di Awal) -->
        <h2 id="loginTitle" class="text-center" style="display: none;">Login<br><small>Benevita Consulting</small></h2>

        <!-- Menampilkan Pesan dari Session (Disembunyikan di Awal) -->
        @if(session()->has('pesan'))
            <div id="loginMessage" class="alert alert-{{ session('pesan')['type'] }} text-center" style="display: none;">
                {{ session('pesan')['message'] }}
            </div>
        @endif

        <!-- Section Konfirmasi Admin -->
        <div id="adminConfirmation" class="text-center mb-4">
            <strong>Apakah Anda seorang Admin?</strong>
            <p class="mt-2 text-danger">Hanya Admin yang dapat mengakses halaman ini!</p>
            <div class="mt-3 d-flex justify-content-center gap-3">
                <button id="btnYesAdmin" class="btn btn-primary mr-2">Ya, saya adalah Admin</button>
                <button id="btnNotAdmin" class="btn btn-secondary">Bukan</button>
            </div>
        </div>

        <!-- Form Login (Disembunyikan di Awal) -->
        <form id="loginForm" action="{{ route('auth.verify') }}" method="POST" class="mt-4" style="display: none;">
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

    <!-- MODAL GAGAL LOGIN -->
    <div class="modal fade" id="failedLoginModal" tabindex="-1" aria-labelledby="failedLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger">
                <!-- Header -->
                <div class="modal-header bg-danger text-white text-center d-flex flex-column">
                    <h5 class="modal-title font-weight-bold" id="failedLoginModalLabel"><i class="fas fa-exclamation-triangle fa-3x mb-2"></i> Gagal Login</h5>
                </div>

                <!-- Body -->
                <div class="modal-body text-center">
                    <p class="mb-0">Batas percobaan login telah tercapai.</p>
                    <p>Silakan lakukan konfirmasi ulang untuk melanjutkan.</p>
                </div>

                <!-- Footer -->
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-primary px-4" id="retryAdminConfirm">
                        <i class="fas fa-undo-alt"></i> Konfirmasi Ulang
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
