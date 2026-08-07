@extends('layouts.app', ['title' => 'Data Akun'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/pages/admin/akun/index.css') }}">
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <!-- Header -->
            <div class="section-header fade-in-up">
                <div>
                    <h1>
                        <i class="bi bi-people"></i>
                        Data Akun
                    </h1>
                    <p class="header-subtitle">
                        <i class="bi bi-database me-1"></i>
                        Kelola dan atur semua akun pengguna dengan mudah
                    </p>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="card fade-in-up">
                            <div class="card-body">

                                <!-- Form Tambah Akun -->
                                <div class="card-header-custom">
                                    <h4>
                                        <i class="bi bi-person-plus"></i>
                                        Tambah Akun Baru
                                    </h4>
                                    <span class="badge bg-primary text-white" style="padding: 6px 16px; border-radius: 50px; font-size: 12px;">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Lengkapi data dengan benar
                                    </span>
                                </div>

                                <form action="{{ route('akun.store') }}" method="POST">
                                    @csrf

                                    <div class="form-card p-4 mb-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="bi bi-person"></i>
                                                        Nama Lengkap
                                                    </label>
                                                    <input 
                                                        name="name"
                                                        value="{{ old('name') }}"
                                                        required
                                                        placeholder="Masukkan Nama Lengkap"
                                                        type="text"
                                                        class="form-control @error('name') is-invalid @enderror">
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="bi bi-briefcase"></i>
                                                        Jabatan
                                                    </label>
                                                    <input 
                                                        name="jabatan"
                                                        value="{{ old('jabatan') }}"
                                                        required
                                                        placeholder="Masukkan Jabatan (- jika memiliki jabatan khusus)"
                                                        type="text"
                                                        class="form-control @error('jabatan') is-invalid @enderror">
                                                    @error('jabatan')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="bi bi-person-badge"></i>
                                                        Username
                                                    </label>
                                                    <input 
                                                        name="username"
                                                        value="{{ old('username') }}"
                                                        required
                                                        placeholder="Masukkan Username untuk login"
                                                        type="text"
                                                        class="form-control @error('username') is-invalid @enderror">
                                                    @error('username')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="bi bi-shield-lock"></i>
                                                        Role / Hak Akses
                                                    </label>
                                                    <select 
                                                        name="role"
                                                        required
                                                        class="form-control role-select @error('role') is-invalid @enderror">
                                                        <option value="">-- Pilih Role Akun --</option>
                                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option> 
                                                        <option value="kepala_kantor" {{ old('role') == 'kepala_kantor' ? 'selected' : '' }}>Kepala Kantor</option>
                                                        <option value="inteldakim" {{ old('role') == 'inteldakim' ? 'selected' : '' }}>TI & inteldakim</option>
                                                        <option value="verdokjal" {{ old('role') == 'verdokjal' ? 'selected' : '' }}>Kasubsi pelayanan & verdokjal</option>
                                                        <option value="tu" {{ old('role') == 'tu' ? 'selected' : '' }}>Tata Usaha</option>
                                                    </select>
                                                    @error('role')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="bi bi-key"></i>
                                                        Password
                                                    </label>
                                                    <input 
                                                        name="password"
                                                        required
                                                        placeholder="Masukkan Password (min. 6 karakter)"
                                                        type="password"
                                                        class="form-control @error('password') is-invalid @enderror">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="bi bi-key-fill"></i>
                                                        Konfirmasi Password
                                                    </label>
                                                    <input 
                                                        name="password_confirmation"
                                                        required
                                                        placeholder="Masukkan Ulang Password"
                                                        type="password"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror">
                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <button type="submit" class="btn-primary-custom">
                                                    <i class="bi bi-plus-circle"></i>
                                                    Tambah Data Akun
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Divider -->
                                <div class="section-divider">
                                    <span><i class="bi bi-list-ul me-2"></i>Daftar Akun Terdaftar</span>
                                </div>

                                <!-- Stats Summary -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4 col-sm-8">
                                        <div class="stat-card">
                                            <div class="stat-icon primary">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="stat-info">
                                                <h6>Total Akun</h6>
                                                <div class="value">{{ $datas->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-8">
                                        <div class="stat-card">
                                            <div class="stat-icon success">
                                                <i class="bi bi-shield-check"></i>
                                            </div>
                                            <div class="stat-info">
                                                <h6>Admin</h6>
                                                <div class="value">{{ $datas->where('role', 'admin')->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-8">
                                        <div class="stat-card">
                                            <div class="stat-icon info">
                                                <i class="bi bi-clock-history"></i>
                                            </div>
                                            <div class="stat-info">
                                                <h6>Terakhir Update</h6>
                                                <div class="value" style="font-size: 16px;">
                                                    {{ $datas->isNotEmpty() ? $datas->sortByDesc('updated_at')->first()->updated_at->diffForHumans() : '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-temp">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;" class="text-center">#</th>
                                                <th style="min-width: 160px;">Nama</th>
                                                <th style="min-width: 140px;">Username</th>
                                                <th style="min-width: 140px;">Role</th>
                                                <th style="width: 120px;" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($datas as $i => $data)
                                                <tr>
                                                    <td class="text-center">
                                                        <span class="row-number">{{ ++$i }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="user-name">{{ $data->name }}</span>
                                                        <span class="user-meta">
                                                            <i class="bi bi-briefcase"></i>
                                                            {{ $data->jabatan ?? 'Tidak ada jabatan' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span style="font-weight: 500; color: var(--secondary);">
                                                            <i class="bi bi-person-badge me-1"></i>
                                                            {{ $data->username }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($data->role == 'admin')
                                                            <span class="role-badge admin">
                                                                <i class="bi bi-shield-check"></i>
                                                                Admin
                                                            </span>
                                                        @elseif($data->role == 'inteldakim')
                                                            <span class="role-badge user">
                                                                <i class="bi bi-person"></i>
                                                                TI & Inteldakim
                                                            </span>
                                                        @elseif($data->role == 'kepala_kantor')
                                                            <span class="role-badge user">
                                                                <i class="bi bi-person"></i>
                                                                Kepala Kantor
                                                            </span>
                                                        @elseif($data->role == 'verdokjal')
                                                            <span class="role-badge user">
                                                                <i class="bi bi-person"></i>
                                                                Verdokjal
                                                            </span>
                                                        @elseif($data->role == 'tu')
                                                            <span class="role-badge user">
                                                                <i class="bi bi-person"></i>
                                                                Tata Usaha
                                                            </span>
                                                        @else
                                                            <span class="role-badge user">
                                                                <i class="bi bi-person"></i>
                                                                User
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="action-group justify-content-center">
                                                            <a href="{{ route('akun.edit', $data->id) }}" 
                                                               class="action-btn edit" 
                                                               data-tooltip="Edit Akun">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button 
                                                                type="button"
                                                                onclick="deleteData({{ $data->id }}, 'akun')"
                                                                class="action-btn delete"
                                                                data-tooltip="Hapus Akun">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Cek apakah DataTable sudah ada, jika sudah hancurkan dulu
            if ($.fn.DataTable.isDataTable('#table-temp')) {
                $('#table-temp').DataTable().destroy();
            }

            // Initialize DataTable
            var table = $('#table-temp').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    search: '<i class="bi bi-search me-1"></i>Cari',
                    searchPlaceholder: 'Cari nama atau username...',
                    lengthMenu: 'Tampilkan _MENU_',
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ akun',
                    infoEmpty: 'Tidak ada akun',
                    zeroRecords: 'Akun tidak ditemukan',
                },
                dom: '<"top"lf>rt<"bottom"ip>',
                columnDefs: [
                    {
                        targets: [0, 4],
                        orderable: false,
                    }
                ],
                drawCallback: function() {
                    $('[data-tooltip]').each(function() {});
                }
            });

            // Custom search styling
            $('.dataTables_filter input')
                .attr('placeholder', 'Cari nama atau username...')
                .addClass('form-control form-control-sm');

            $('.dataTables_length select').addClass('form-control form-control-sm');

            // Responsive adjustments
            function handleResponsive() {
                if ($(window).width() < 768) {
                    $('.dataTables_filter input').css('min-width', '100%');
                    $('.dataTables_filter').css('margin-left', '0');
                } else {
                    $('.dataTables_filter input').css('min-width', '200px');
                }
            }

            handleResponsive();
            $(window).resize(handleResponsive);

            // Flash messages
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session("success") }}',
                    timer: 2500,
                    showConfirmButton: true,
                    confirmButtonColor: '#4F46E5',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session("error") }}',
                    confirmButtonColor: '#4F46E5',
                    confirmButtonText: 'OK'
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    text: 'Silahkan periksa kembali data yang Anda masukkan',
                    confirmButtonColor: '#4F46E5',
                    confirmButtonText: 'OK'
                });
            @endif
        });

        // Delete function with SweetAlert2
        function deleteData(id, type) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus akun ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#64748B',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-4',
                    confirmButton: 'btn btn-danger px-4 py-2',
                    cancelButton: 'btn btn-secondary px-4 py-2',
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Perform delete via AJAX
                    $.ajax({
                        url: '/' + type + '/' + id,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Akun berhasil dihapus',
                                timer: 1500,
                                showConfirmButton: false,
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus akun',
                                confirmButtonColor: '#4F46E5',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }

        // Add animation on load
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in-up');
            elements.forEach((el, index) => {
                el.style.animationDelay = (index * 0.1) + 's';
            });
        });
    </script>
@endpush
