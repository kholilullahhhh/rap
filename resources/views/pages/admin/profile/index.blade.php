@extends('layouts.app', ['title' => 'Profile'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/pages/admin/profile/index.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <!-- Header -->
            <div class="section-header fade-in-up">
                <div>
                    <h1>
                        <i class="bi bi-person-circle"></i>
                        Profile
                    </h1>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </div>
                    <div class="breadcrumb-item active">
                        <i class="bi bi-person-circle"></i> Profile
                    </div>
                </div>
            </div>

            <div class="section-body">
                <!-- Welcome Section -->
                <div class="fade-in-up">
                    <h2 class="section-title">
                        <i class="bi bi-person-circle"></i>
                        Hi, {{ session('name') }}! 👋
                    </h2>
                    <p class="section-lead">
                        <i class="bi bi-pencil-square me-1"></i>
                        Silahkan ubah profile anda di halaman ini
                    </p>
                </div>

                <div class="row mt-4 justify-content-center">
                    <div class="col-12 col-lg-10">
                        <div class="card fade-in-up">
                            <!-- Card Header -->
                            <div class="card-header">
                                <h4>
                                    <i class="bi bi-person-gear"></i>
                                    Edit Profile
                                </h4>
                                <span class="badge bg-success text-white" style="padding: 6px 16px; border-radius: 50px; font-size: 11px;">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Aktif
                                </span>
                            </div>

                            <!-- Form -->
                            <form method="post" action="{{ route('profile.update') }}" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                <input type="hidden" class="form-control" name="id" value="{{ $data->id }}" required>

                                <div class="card-body">
                                    <!-- Profile Avatar (Display Only) -->
                                    <div class="profile-avatar-wrapper">
                                        <div class="profile-avatar">
                                            <i class="bi bi-person-fill"></i>
                                            <div class="avatar-status"></div>
                                        </div>
                                        <div class="profile-name">{{ $data->name }}</div>
                                        <div class="profile-role">
                                            <i class="bi bi-shield-check me-1"></i>
                                            {{ session('role') ?? 'User' }}
                                        </div>
                                    </div>

                                    <!-- Mini Stats -->
                                    <div class="row g-2 mb-4">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="stat-card-mini">
                                                <div class="stat-icon-mini primary">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                                <div class="stat-info-mini">
                                                    <h6>Nama</h6>
                                                    <div class="value" style="font-size: 13px;">{{ $data->name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="stat-card-mini">
                                                <div class="stat-icon-mini success">
                                                    <i class="bi bi-person-badge"></i>
                                                </div>
                                                <div class="stat-info-mini">
                                                    <h6>Username</h6>
                                                    <div class="value" style="font-size: 13px;">{{ $data->username }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <div class="stat-card-mini">
                                                <div class="stat-icon-mini warning">
                                                    <i class="bi bi-shield-check"></i>
                                                </div>
                                                <div class="stat-info-mini">
                                                    <h6>Role</h6>
                                                    <div class="value" style="font-size: 13px; text-transform: capitalize;">{{ session('role') ?? 'User' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Divider -->
                                    <div class="form-divider">
                                        <span><i class="bi bi-pencil me-1"></i>Ubah Data Diri</span>
                                    </div>

                                    <!-- Form Fields -->
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>
                                                <i class="bi bi-person"></i>
                                                Nama Lengkap
                                            </label>
                                            <input 
                                                type="text" 
                                                class="form-control @error('name') is-invalid @enderror" 
                                                placeholder="Masukkan nama lengkap anda" 
                                                name="name" 
                                                value="{{ $data->name }}" 
                                                required
                                            >
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @else
                                                <div class="invalid-feedback">Silahkan isi nama lengkap anda</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>
                                                <i class="bi bi-person-badge"></i>
                                                Username
                                            </label>
                                            <input 
                                                type="text" 
                                                class="form-control @error('username') is-invalid @enderror" 
                                                placeholder="Masukkan username anda" 
                                                name="username" 
                                                value="{{ $data->username }}" 
                                                required
                                            >
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @else
                                                <div class="invalid-feedback">Silahkan isi username anda</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password Section -->
                                    <div class="form-divider">
                                        <span><i class="bi bi-key me-1"></i>Keamanan</span>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>
                                                <i class="bi bi-key"></i>
                                                Ubah Password
                                            </label>
                                            <input 
                                                type="password" 
                                                class="form-control @error('password') is-invalid @enderror" 
                                                value="" 
                                                name="password" 
                                                placeholder="Masukkan password baru anda (kosongkan jika tidak ada perubahan)"
                                            >
                                            <div class="password-hint">
                                                <i class="bi bi-info-circle"></i>
                                                Biarkan kosong jika tidak ingin mengubah password
                                            </div>
                                            <input type="hidden" class="form-control" value="{{ $data->password }}" name="oldPassword">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Footer -->
                                <div class="card-footer">
                                    <a href="{{ route('dashboard') }}" class="btn-warning-custom">
                                        <i class="bi bi-arrow-left"></i>
                                        Kembali
                                    </a>
                                    <button type="submit" class="btn-primary-custom">
                                        <i class="bi bi-save"></i>
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation on load
            const elements = document.querySelectorAll('.fade-in-up');
            elements.forEach((el, index) => {
                el.style.animationDelay = (index * 0.1) + 's';
            });

            // Form validation
            (function() {
                'use strict';
                const forms = document.querySelectorAll('.needs-validation');
                Array.prototype.slice.call(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            })();
        });
    </script>
    @endpush
@endsection
