@extends('layouts.app', ['title' => 'Profile'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <style>
            :root {
                --primary: #4F46E5;
                --primary-light: #EEF2FF;
                --primary-dark: #4338CA;
                --success: #10B981;
                --warning: #F59E0B;
                --danger: #EF4444;
                --secondary: #64748B;
                --dark: #0F172A;
                --light: #F8FAFC;
                --shadow-sm: 0 1px 3px rgba(0,0,0,0.06);
                --shadow-md: 0 4px 20px rgba(0,0,0,0.08);
                --shadow-lg: 0 10px 40px rgba(0,0,0,0.12);
                --radius-lg: 20px;
                --radius-md: 16px;
                --radius-sm: 12px;
            }

            body {
                font-family: 'Inter', sans-serif;
                background: #F1F5F9;
            }

            .main-content {
                padding: 20px 30px;
            }

            /* Header Section */
            .section-header {
                padding: 0 0 30px 0;
                border-bottom: none;
                margin-bottom: 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 15px;
            }

            .section-header h1 {
                font-size: 28px;
                font-weight: 800;
                color: var(--dark);
                letter-spacing: -0.5px;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .section-header h1 i {
                color: var(--primary);
                font-size: 28px;
            }

            .section-header-breadcrumb {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
            }

            .section-header-breadcrumb .breadcrumb-item {
                color: var(--secondary);
            }

            .section-header-breadcrumb .breadcrumb-item a {
                color: var(--primary);
                text-decoration: none;
                font-weight: 500;
                transition: color 0.3s ease;
            }

            .section-header-breadcrumb .breadcrumb-item a:hover {
                color: var(--primary-dark);
            }

            .section-header-breadcrumb .breadcrumb-item.active {
                color: var(--dark);
                font-weight: 600;
            }

            /* Section Title */
            .section-title {
                font-size: 24px;
                font-weight: 700;
                color: var(--dark);
                margin-bottom: 4px;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .section-title i {
                color: var(--primary);
            }

            .section-lead {
                font-size: 14px;
                color: var(--secondary);
                margin-bottom: 25px;
            }

            /* Card */
            .card {
                border: none;
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-sm);
                overflow: hidden;
                transition: all 0.3s ease;
                background: white;
            }

            .card:hover {
                box-shadow: var(--shadow-lg);
            }

            .card-header {
                background: white;
                border-bottom: 1px solid #F1F5F9;
                padding: 20px 28px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 15px;
            }

            .card-header h4 {
                font-size: 18px;
                font-weight: 700;
                color: var(--dark);
                margin: 0;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .card-header h4 i {
                color: var(--primary);
            }

            .card-body {
                padding: 28px;
            }

            .card-footer {
                background: #FAFBFC;
                border-top: 1px solid #F1F5F9;
                padding: 16px 28px;
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                flex-wrap: wrap;
            }

            /* Form Styling */
            .form-group {
                margin-bottom: 1.25rem;
            }

            .form-group label {
                font-weight: 600;
                font-size: 13px;
                color: var(--dark);
                margin-bottom: 6px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .form-group label i {
                color: var(--primary);
                font-size: 14px;
            }

            .form-group .form-control {
                border: 2px solid #E2E8F0;
                border-radius: var(--radius-sm);
                padding: 10px 14px;
                font-size: 14px;
                font-family: 'Inter', sans-serif;
                transition: all 0.3s ease;
                height: 44px;
            }

            .form-group .form-control:focus {
                border-color: var(--primary);
                box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            }

            .form-group .form-control.is-invalid {
                border-color: var(--danger);
            }

            .form-group .form-control.is-invalid:focus {
                box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
            }

            .form-group .invalid-feedback {
                font-size: 12px;
                color: var(--danger);
                margin-top: 4px;
            }

            /* Buttons */
            .btn-primary-custom {
                background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
                color: white;
                border: none;
                padding: 10px 28px;
                border-radius: 50px;
                font-weight: 600;
                font-size: 14px;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25);
                display: inline-flex;
                align-items: center;
                gap: 8px;
                text-decoration: none;
                cursor: pointer;
            }

            .btn-primary-custom:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(79, 70, 229, 0.35);
                color: white;
                text-decoration: none;
            }

            .btn-primary-custom i {
                font-size: 18px;
            }

            .btn-warning-custom {
                background: #FEF3C7;
                color: #92400E;
                border: none;
                padding: 10px 28px;
                border-radius: 50px;
                font-weight: 600;
                font-size: 14px;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                text-decoration: none;
                cursor: pointer;
            }

            .btn-warning-custom:hover {
                background: #F59E0B;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
                text-decoration: none;
            }

            .btn-warning-custom i {
                font-size: 18px;
            }

            /* Profile Avatar */
            .profile-avatar-wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 30px 20px;
            }

            .profile-avatar {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 56px;
                color: white;
                box-shadow: 0 8px 30px rgba(79, 70, 229, 0.3);
                transition: all 0.3s ease;
                position: relative;
            }

            .profile-avatar:hover {
                transform: scale(1.05);
                box-shadow: 0 12px 40px rgba(79, 70, 229, 0.4);
            }

            .profile-avatar .avatar-status {
                position: absolute;
                bottom: 4px;
                right: 4px;
                width: 16px;
                height: 16px;
                background: var(--success);
                border-radius: 50%;
                border: 3px solid white;
            }

            .profile-name {
                margin-top: 16px;
                font-size: 20px;
                font-weight: 700;
                color: var(--dark);
            }

            .profile-role {
                font-size: 14px;
                color: var(--secondary);
                font-weight: 500;
                text-transform: capitalize;
            }

            /* Stats Cards */
            .stat-card-mini {
                background: #F8FAFC;
                border-radius: var(--radius-sm);
                padding: 12px 16px;
                display: flex;
                align-items: center;
                gap: 12px;
                border: 1px solid #F1F5F9;
                transition: all 0.3s ease;
            }

            .stat-card-mini:hover {
                background: white;
                border-color: var(--primary);
                box-shadow: var(--shadow-sm);
                transform: translateY(-2px);
            }

            .stat-icon-mini {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                flex-shrink: 0;
            }

            .stat-icon-mini.primary {
                background: var(--primary-light);
                color: var(--primary);
            }

            .stat-icon-mini.success {
                background: #D1FAE5;
                color: var(--success);
            }

            .stat-icon-mini.warning {
                background: #FEF3C7;
                color: var(--warning);
            }

            .stat-info-mini h6 {
                font-size: 11px;
                font-weight: 500;
                color: var(--secondary);
                margin: 0 0 1px 0;
                text-transform: uppercase;
                letter-spacing: 0.4px;
            }

            .stat-info-mini .value {
                font-size: 16px;
                font-weight: 700;
                color: var(--dark);
                line-height: 1.2;
            }

            /* Animation */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .fade-in-up {
                animation: fadeInUp 0.6s ease forwards;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .main-content {
                    padding: 15px;
                }

                .section-header {
                    flex-direction: column;
                    align-items: flex-start !important;
                }

                .section-header h1 {
                    font-size: 22px;
                }

                .card-body {
                    padding: 20px;
                }

                .card-header {
                    padding: 16px 20px;
                }

                .card-footer {
                    padding: 14px 20px;
                    flex-direction: column;
                }

                .card-footer .btn {
                    width: 100%;
                    justify-content: center;
                }

                .profile-avatar {
                    width: 100px;
                    height: 100px;
                    font-size: 44px;
                }

                .profile-name {
                    font-size: 18px;
                }
            }

            @media (max-width: 480px) {
                .section-header-breadcrumb {
                    font-size: 12px;
                }

                .section-title {
                    font-size: 20px;
                }

                .stat-card-mini {
                    padding: 10px 14px;
                }

                .stat-info-mini .value {
                    font-size: 14px;
                }
            }

            /* Form divider */
            .form-divider {
                display: flex;
                align-items: center;
                text-align: center;
                margin: 20px 0 24px;
            }

            .form-divider::before,
            .form-divider::after {
                content: '';
                flex: 1;
                border-bottom: 2px solid #F1F5F9;
            }

            .form-divider::before {
                margin-right: 16px;
            }

            .form-divider::after {
                margin-left: 16px;
            }

            .form-divider span {
                font-size: 12px;
                font-weight: 600;
                color: var(--secondary);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                background: white;
                padding: 0 12px;
            }

            /* Password hint */
            .password-hint {
                font-size: 12px;
                color: var(--secondary);
                margin-top: 4px;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .password-hint i {
                font-size: 12px;
            }
        </style>
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