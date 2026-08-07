@extends('layouts.app', ['title' => 'Data Jenis Usaha'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/pages/admin/jenisUsaha/index.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <!-- Header -->
            <div class="section-header fade-in-up">
                <div>
                    <h1>
                        <i class="bi bi-briefcase text-primary" style="font-size: 28px;"></i>
                        Data Jenis Usaha
                    </h1>
                    <p class="header-subtitle">
                        <i class="bi bi-database me-1"></i>
                        Kelola dan atur data jenis usaha dengan mudah
                    </p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('jenis_usaha.create') }}" class="btn-primary-custom">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Data
                    </a>
                </div>
            </div>

            <!-- Main Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card fade-in-up">
                        <div class="card-body">
                            <!-- Stats Summary -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-4 col-sm-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3" style="background: #F8FAFC; border-radius: var(--radius-sm);">
                                        <div class="me-3" style="width: 44px; height: 44px; background: var(--primary-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-database text-primary" style="font-size: 20px;"></i>
                                        </div>
                                        <div>
                                            <div style="font-size: 12px; color: var(--secondary); font-weight: 500;">Total Data</div>
                                            <div style="font-size: 22px; font-weight: 700; color: var(--dark);">{{ $datas->count() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3" style="background: #F8FAFC; border-radius: var(--radius-sm);">
                                        <div class="me-3" style="width: 44px; height: 44px; background: #D1FAE5; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-plus-circle text-success" style="font-size: 20px;"></i>
                                        </div>
                                        <div>
                                            <div style="font-size: 12px; color: var(--secondary); font-weight: 500;">Terakhir Ditambahkan</div>
                                            <div style="font-size: 14px; font-weight: 600; color: var(--dark);">
                                                {{ $datas->isNotEmpty() ? $datas->last()->created_at->diffForHumans() : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3" style="background: #F8FAFC; border-radius: var(--radius-sm);">
                                        <div class="me-3" style="width: 44px; height: 44px; background: #FEF3C7; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-clock-history text-warning" style="font-size: 20px;"></i>
                                        </div>
                                        <div>
                                            <div style="font-size: 12px; color: var(--secondary); font-weight: 500;">Terakhir Diupdate</div>
                                            <div style="font-size: 14px; font-weight: 600; color: var(--dark);">
                                                {{ $datas->isNotEmpty() ? $datas->sortByDesc('updated_at')->first()->updated_at->diffForHumans() : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover" id="table-jenis-usaha">
                                    <thead>
                                        <tr>
                                            <th style="width: 60px;" class="text-center">#</th>
                                            <th>Nama Jenis Usaha</th>
                                            <th>Deskripsi</th>
                                            <th style="width: 130px;" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($datas as $i => $data)
                                            <tr>
                                                <td class="text-center">
                                                    <span class="row-number">{{ ++$i }}</span>
                                                </td>
                                                <td>
                                                    <div style="font-weight: 600; color: var(--dark);">
                                                        {{ $data->nama_jenis ?? '-' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="desc-text">
                                                        {!! $data->deskripsi ?? '<span style="color: #94A3B8; font-style: italic;">Tidak ada deskripsi</span>' !!}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="action-group justify-content-center">
                                                        <a href="{{ route('jenis_usaha.edit', $data->id) }}" 
                                                           class="action-btn edit" 
                                                           data-tooltip="Edit Data">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button onclick="deleteData({{ $data->id }}, 'jenis_usaha')" 
                                                                class="action-btn delete" 
                                                                data-tooltip="Hapus Data">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <div class="empty-state">
                                                        <i class="bi bi-inbox"></i>
                                                        <h5>Belum Ada Data</h5>
                                                        <p>Mulai tambahkan data jenis usaha pertama Anda</p>
                                                        <a href="{{ route('jenis_usaha.create') }}" class="btn-primary-custom" style="display: inline-flex; margin-top: 10px;">
                                                            <i class="bi bi-plus-circle"></i>
                                                            Tambah Data
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // Initialize DataTable with enhanced configuration
                var table = $('#table-jenis-usaha').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                        search: '<i class="bi bi-search me-2"></i>Pencarian Data Jenis Usaha',
                        searchPlaceholder: 'Cari nama atau deskripsi...',
                        lengthMenu: 'Tampilkan _MENU_ data per halaman',
                        info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                        infoEmpty: 'Tidak ada data',
                        zeroRecords: 'Data tidak ditemukan',
                    },
                    dom: '<"top"lf>rt<"bottom"ip>',
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50, 100],
                    columnDefs: [
                        {
                            targets: [0, 3],
                            orderable: false,
                        },
                        {
                            targets: 2,
                            render: function(data) {
                                if (data && data.trim() !== '') {
                                    return '<div class="desc-text">' + data + '</div>';
                                }
                                return '<span style="color: #94A3B8; font-style: italic;">Tidak ada deskripsi</span>';
                            }
                        }
                    ],
                    drawCallback: function() {
                        // Re-initialize tooltips after table redraw
                        $('[data-tooltip]').each(function() {
                            // Tooltip handled by CSS
                        });
                    }
                });

                // Add custom search styling
                $('.dataTables_filter input').attr('placeholder', 'Cari nama atau deskripsi...');

                // Add counter badge
                const totalRecords = {{ $datas->count() }};
                if (totalRecords > 0) {
                    $('.dataTables_info').prepend('<span class="badge-custom primary me-2">' + totalRecords + ' Total</span> ');
                }

                // Responsive adjustments
                function handleResponsive() {
                    if ($(window).width() < 768) {
                        $('.dataTables_filter input').css('min-width', '100%');
                    } else {
                        $('.dataTables_filter input').css('min-width', '250px');
                    }
                }

                handleResponsive();
                $(window).resize(handleResponsive);
            });

            // Delete function with confirmation
            function deleteData(id, type) {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus data ini?',
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
                    }
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
                                    text: 'Data berhasil dihapus',
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
                                    text: 'Terjadi kesalahan saat menghapus data',
                                    confirmButtonColor: '#4F46E5',
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

        <!-- SweetAlert2 for better modals -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
@endsection
