@extends('layouts.app', ['title' => 'Data Dokumen'])

@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/sweetalert2/dist/sweetalert2.min.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="{{ asset('css/pages/admin/umkm/user.css') }}">
@endpush

<div class="main-content">
    <section class="section">

        <!-- Header -->
        <div class="section-header fade-in-up">
            <div>
                <h1>
                    <i class="bi bi-file-earmark-text"></i>
                    Data Dokumen
                </h1>
                <p class="header-subtitle">
                    <i class="bi bi-database me-1"></i>
                    Kelola dan pantau semua dokumen administrasi
                </p>
            </div>
            <div class="header-actions">
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </div>
                    <div class="breadcrumb-item active">
                        <i class="bi bi-file-earmark-text"></i> Data Dokumen
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">

                    <div class="card fade-in-up">

                        <div class="card-header">
                            <h4>
                                <i class="bi bi-list-ul"></i>
                                Daftar Dokumen
                            </h4>
                            <div class="card-header-action">
                                <a href="{{ route('umkm.create') }}" class="btn-primary-custom">
                                    <i class="bi bi-plus-circle"></i>
                                    Tambah Data
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <!-- Stats Summary -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-3 col-sm-6">
                                    <div class="stat-card">
                                        <div class="stat-icon primary">
                                            <i class="bi bi-files"></i>
                                        </div>
                                        <div class="stat-info">
                                            <h6>Total</h6>
                                            <div class="value">{{ $datas->count() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="stat-card">
                                        <div class="stat-icon success">
                                            <i class="bi bi-check-circle"></i>
                                        </div>
                                        <div class="stat-info">
                                            <h6>Approved</h6>
                                            <div class="value">{{ $datas->where('status', 'approved')->count() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="stat-card">
                                        <div class="stat-icon warning">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                        <div class="stat-info">
                                            <h6>Review & Draft</h6>
                                            <div class="value">{{ $datas->whereIn('status', ['review', 'draft'])->count() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="stat-card">
                                        <div class="stat-icon info">
                                            <i class="bi bi-file-pdf"></i>
                                        </div>
                                        <div class="stat-info">
                                            <h6>Dengan File</h6>
                                            <div class="value">{{ $datas->whereNotNull('file_path')->count() }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">

                                <table class="table table-striped" id="table-dokumen">

                                    <thead>
                                        <tr>
                                            <th style="width: 40px;">#</th>
                                            <th style="min-width: 100px;">No Dokumen</th>
                                            <th style="min-width: 150px;">Judul</th>
                                            <th style="min-width: 85px;">Tanggal</th>
                                            <th style="width: 65px;">Versi</th>
                                            <th style="width: 85px;">Status</th>
                                            <th style="width: 45px;">File</th>
                                            <th style="width: 95px;">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($datas as $index => $dokumen)
                                        <tr>
                                            <td>
                                                <span class="row-number">{{ $index + 1 }}</span>
                                            </td>
                                            <td>
                                                <span style="font-weight: 600; color: var(--dark); font-size: 12px;">
                                                    {{ $dokumen->nomor_dokumen }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="doc-title" title="{{ $dokumen->judul }}">{{ Str::limit($dokumen->judul, 40) }}</span>
                                                <span class="doc-meta">
                                                    <span>
                                                        <i class="bi bi-person"></i>
                                                        {{ $dokumen->user->name ?? 'Unknown' }}
                                                    </span>
                                                </span>
                                            </td>
                                            <td>
                                                <span style="font-size: 12px;">
                                                    {{ date('d-m-Y', strtotime($dokumen->tanggal_dokumen)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="version-badge">
                                                    <i class="bi bi-tag"></i>
                                                    v{{ $dokumen->versi }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($dokumen->status == 'draft')
                                                    <span class="badge-status draft">
                                                        <i class="bi bi-pencil"></i> Draft
                                                    </span>
                                                @elseif($dokumen->status == 'review')
                                                    <span class="badge-status review">
                                                        <i class="bi bi-eye"></i> Review
                                                    </span>
                                                @elseif($dokumen->status == 'approved')
                                                    <span class="badge-status approved">
                                                        <i class="bi bi-check-circle-fill"></i> Approved
                                                    </span>
                                                @else
                                                    <span class="badge-status obsolete">
                                                        <i class="bi bi-x-circle"></i> Obsolete
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($dokumen->file_path)
                                                    <a href="{{ asset('storage/'.$dokumen->file_path) }}"
                                                       target="_blank"
                                                       class="btn-action view"
                                                       data-tooltip="Lihat File">
                                                        <i class="bi bi-file-earmark-pdf"></i>
                                                    </a>
                                                @else
                                                    <span style="color: #CBD5E1; font-size: 12px;">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('umkm.edit', $dokumen->id) }}"
                                                       class="btn-action edit"
                                                       data-tooltip="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    @include('partials.dokumen-delete-form')
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8">
                                                <div class="empty-state">
                                                    <i class="bi bi-inbox"></i>
                                                    <h5>Belum Ada Dokumen</h5>
                                                    <p>Mulai tambahkan dokumen pertama Anda</p>
                                                    <a href="{{ route('umkm.create') }}" class="btn-primary-custom" style="display: inline-flex; margin-top: 8px;">
                                                        <i class="bi bi-plus-circle"></i>
                                                        Tambah Dokumen
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

        </div>

    </section>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

<script>
$(document).ready(function() {

    // Initialize DataTable
    var table = $('#table-dokumen').DataTable({
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
            searchPlaceholder: 'Cari dokumen...',
            lengthMenu: 'Tampilkan _MENU_',
            info: 'Menampilkan _START_-_END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data',
            zeroRecords: 'Data tidak ditemukan',
        },
        dom: '<"top"lf>rt<"bottom"ip>',
        columnDefs: [
            {
                targets: [0, 5, 6, 7, 8],
                orderable: false,
            },
            {
                targets: 6,
                render: function(data, type, row) {
                    if (data === 'draft') {
                        return '<span class="badge-status draft"><i class="bi bi-pencil"></i> Draft</span>';
                    } else if (data === 'review') {
                        return '<span class="badge-status review"><i class="bi bi-eye"></i> Review</span>';
                    } else if (data === 'approved') {
                        return '<span class="badge-status approved"><i class="bi bi-check-circle-fill"></i> Approved</span>';
                    } else {
                        return '<span class="badge-status obsolete"><i class="bi bi-x-circle"></i> Obsolete</span>';
                    }
                }
            }
        ],
        drawCallback: function() {
            $('[data-tooltip]').each(function() {});
        }
    });

    // Custom search styling
    $('.dataTables_filter input')
        .attr('placeholder', 'Cari dokumen...')
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
    @if(session('message'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session("message") }}',
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

});

// Add animation on load
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.fade-in-up');
    elements.forEach((el, index) => {
        el.style.animationDelay = (index * 0.08) + 's';
    });
});
</script>

@include('partials.dokumen-delete-js')
@endpush
@endsection
