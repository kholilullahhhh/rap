@extends('layouts.auth', ['title' => 'Login'])
@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/auth/login.css') }}">
@endpush

<!-- ============================================================
    LOGIN CONTAINER
    ============================================================ -->
<div class="login-container">
    <!-- Pattern Overlay -->
    <div class="pattern-overlay"></div>


    <!-- Login Card -->
    <div class="login-card" >
        <div class="card-header">
            <h4>Selamat Datang</h4>
            <div class="header-sub">
                <i class="fas fa-lock"></i> Silakan login untuk melanjutkan
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login_action') }}" class="needs-validation" novalidate>
                @csrf
                <!-- Username -->
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-user label-icon"></i> Username
                    </label>
                    <input id="email" type="text" class="form-control" name="username" placeholder="Masukkan username Anda" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                        Silakan isi username Anda
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-key label-icon"></i> Password
                    </label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Masukkan password Anda" tabindex="2" required>
                    <div class="invalid-feedback">
                        Silakan isi password Anda
                    </div>
                </div>

                <!-- Role Selection -->
                <div class="form-group">
                    <label for="role">
                        <i class="fas fa-user-tag label-icon"></i> Login Sebagai
                    </label>
                    <select class="form-control selectric" name="role" id="role" tabindex="3">
                        <option value="">— Pilih Role —</option>
                        <option value="admin">Admin</option>
                        <option value="kepala_kantor">Kepala Kantor</option>
                        <option value="inteldakim">TI & Inteldakim</option>
                        <option value="tu">Tata Usaha</option>
                        <option value="verdokjal">Pelayanan & Verdokjal</option>
                    </select>
                </div>

                <!-- Login Button -->
                <div class="form-group" style="margin-bottom: 0;">
                    <button type="submit" class="btn btn-login" tabindex="4">
                        <span>Login</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="divider">atau</div>

            <!-- Register Link -->
            <div class="login-footer">
                {{-- <a href="{{ route('register') }}">
                    <i class="fas fa-chevron-left"></i> Belum Punya Akun? Regist
                </a> --}}
                <span class="footer-divider">|</span>
                <a href="/">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
    SCRIPTS
    ============================================================ -->
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

@push('scripts')
<script>
    // ============================================================
    // FORM VALIDATION
    // ============================================================
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    // ============================================================
    // SWEETALERT NOTIFICATIONS
    // ============================================================
    // Success Login
    @if (session('message') == 'sukses login')
        swal({
            title: "Berhasil",
            text: "Anda berhasil login!",
            icon: "success",
            button: "OK",
            timer: 3000,
        });
    @endif

    // Failed Login
    @if (session('message') == 'gagal login')
        swal({
            title: "Gagal Login",
            text: "Periksa kembali username dan password Anda!",
            icon: "error",
            button: "Coba Lagi",
            dangerMode: true,
        });
    @endif

    // Need Login
    @if (session('message') == 'need login')
        swal({
            title: "Akses Ditolak",
            text: "Anda harus login terlebih dahulu!",
            icon: "warning",
            button: "OK",
        });
    @endif

    // Success Logout
    @if (session('message') == 'sukses logout')
        swal({
            title: "Berhasil Logout",
            text: "Anda telah berhasil logout!",
            icon: "success",
            button: "OK",
            timer: 3000,
        });
    @endif
</script>
@endpush
@endsection
