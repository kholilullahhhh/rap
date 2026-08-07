@extends('layouts.app', ['title' => 'Data Dokumen'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/sweetalert2/dist/sweetalert2.min.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

        <link rel="stylesheet" href="{{ asset('css/components/umkm.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">

            <!-- Header -->
            <div class="section-header fade-in-up">
                <div>
                    <h1><i class="bi bi-folder2-open"></i> Data {{ request('role') == 'tu' ? 'Tata Usaha' : '' }}
                        {{ request('role') == 'verdokjal' ? 'Verdokjal' : '' }}
                        {{ request('role') == 'inteldakim' ? 'Inteldakim' : '' }}</h1>
                    <p class="header-subtitle"><i class="bi bi-database me-1"></i> Kelola dan pantau semua dokumen
                        administrasi {{ request('role') == 'tu' ? 'Tata Usaha' : '' }}
                        {{ request('role') == 'verdokjal' ? 'Verdokjal' : '' }}
                        {{ request('role') == 'inteldakim' ? 'Inteldakim' : '' }}</p>
                </div>
                <div class="header-actions">
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i>
                                Dashboard</a></div>
                        <div class="breadcrumb-item active"><i class="bi bi-folder2-open"></i> Data
                            {{ request('role') == 'tu' ? 'Tata Usaha' : '' }}
                            {{ request('role') == 'verdokjal' ? 'Verdokjal' : '' }}
                            {{ request('role') == 'inteldakim' ? 'Inteldakim' : '' }}</div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <div class="card fade-in-up">
                            <div class="card-header">
                                <h4><i class="bi bi-folder2"></i> Folder & Dokumen</h4>


                                {{--ini sementara--}}
                                {{-- <div class="card-header-action d-flex flex-wrap gap-2">
                                    <button type="button" class="btn-folder-create" data-toggle="modal"
                                        data-target="#modalCreateFolder">
                                        <i class="bi bi-folder-plus"></i> Buat Folder
                                    </button>
                                    <a href="{{ request('folder') ? route('umkm.create', ['folder' => request('folder')]) : route('umkm.create') }}"
                                        class="btn-primary-custom">
                                        <i class="bi bi-plus-circle"></i> Tambah Data
                                    </a>
                                </div> --}}


                            </div>

                            <div class="card-body">

                                <!-- Folder Grid -->
                                <div class="folder-grid" id="folderGrid">
                                    @forelse($folders ?? [] as $folder)
                                        <div class="folder-card folder-color-{{ $folder->color ?? 1 }} {{ request('folder') == $folder->id ? 'active' : '' }}"
                                            data-folder-id="{{ $folder->id }}"
                                            onclick="filterByFolder({{ $folder->id }}, '{{ request('role') }}')">

                                            <div class="folder-actions">
                                                @can('update', $folder)
                                                <button class="btn-folder-action edit-folder"
                                                    onclick="event.stopPropagation(); editFolder({{ $folder->id }}, '{{ $folder->name }}', {{ $folder->color ?? 1 }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                @endcan
                                                @can('delete', $folder)
                                                <button class="btn-folder-action delete-folder"
                                                    onclick="event.stopPropagation(); deleteFolder({{ $folder->id }})">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                                @endcan
                                            </div>

                                            <span class="folder-icon">
                                                <i class="bi bi-folder2"></i>
                                            </span>

                                            <div class="folder-name">{{ $folder->name }}</div>
                                            <div class="folder-count">{{ $folder->dokumen_count ?? 0 }} dokumen</div>
                                        </div>
                                    @empty
                                        <div class="folder-empty">
                                            <i class="bi bi-folder2-open"></i>
                                            <h6>Belum Ada Folder</h6>
                                            <p>Buat folder untuk mengelompokkan dokumen Anda</p>

                                            <button type="button" class="btn-folder-create" data-toggle="modal"
                                                data-target="#modalCreateFolder">
                                                <i class="bi bi-folder-plus"></i> Buat Folder Pertama
                                            </button>
                                        </div>
                                    @endforelse
                                </div>

                                <!-- Folder Breadcrumb -->
                                @if (request('folder') && isset($currentFolder))
                                    <div class="folder-breadcrumb">
                                        <span class="breadcrumb-item">
                                            <a href="{{ route('umkm.index', array_filter(['role' => request('role')])) }}"><i
                                                    class="bi bi-folder2-open"></i>
                                                Semua</a>
                                        </span>
                                        <span class="breadcrumb-separator">/</span>
                                        <span class="breadcrumb-item active">
                                            <i class="bi bi-folder2"></i> {{ $currentFolder->name ?? 'Folder' }}
                                        </span>
                                        <span class="breadcrumb-item ms-auto">
                                            <a href="{{ route('umkm.index', array_filter(['role' => request('role')])) }}"
                                            class="btn btn-sm btn-secondary-custom btn-filter-reset">
                                                <i class="bi bi-x"></i> Hapus Filter
                                            </a>
                                        </span>
                                    </div>
                                @endif

                                <!-- Stats -->
                                <div class="row g-3 mb-3">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="stat-card">
                                            <div class="stat-icon primary"><i class="bi bi-files"></i></div>
                                            <div class="stat-info">
                                                <h6>Total</h6>
                                                <div class="value">{{ $datas->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="stat-card">
                                            <div class="stat-icon success"><i class="bi bi-check-circle"></i></div>
                                            <div class="stat-info">
                                                <h6>Approved</h6>
                                                <div class="value">{{ $datas->where('status', 'approved')->count() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="stat-card">
                                            <div class="stat-icon warning"><i class="bi bi-clock-history"></i></div>
                                            <div class="stat-info">
                                                <h6>Review & Draft</h6>
                                                <div class="value">
                                                    {{ $datas->whereIn('status', ['review', 'draft'])->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="stat-card">
                                            <div class="stat-icon info"><i class="bi bi-file-pdf"></i></div>
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
                                                <th class="col-w-30">#</th>
                                                <th class="col-min-150">Judul</th>
                                                <th class="col-min-85">Tanggal</th>
                                                <th class="col-w-45">File</th>
                                                <th class="col-w-130">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($datas as $index => $dokumen)
                                                <tr>
                                                    <td><span class="row-number"></span></td>
                                                    <td>
                                                        <span
                                                            class="doc-title" title="{{ $dokumen->judul }}">{{ Str::limit($dokumen->judul, 40) }}</span>
                                                        <span class="doc-meta">
                                                            <span><i class="bi bi-person"></i>
                                                                {{ $dokumen->user->name ?? 'Unknown' }}</span>
                                                            @if ($dokumen->folder_id)
                                                                <span><i class="bi bi-folder2"></i>
                                                                    {{ $dokumen->folder->name ?? '' }}</span>
                                                            @endif
                                                        </span>
                                                    </td>
                                                            <td><span
                                                                    class="fs-11">{{ date('d-m-Y', strtotime($dokumen->tanggal_dokumen)) }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($dokumen->file_path)
                                                            <a href="{{ route('umkm.view', $dokumen->id) }}"
                                                                target="_blank" class="btn-action view"
                                                                data-tooltip="Lihat File">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        @else
                                                            <span class="text-muted-11">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="action-buttons">
                                                            <a href="{{ route('umkm.edit', $dokumen->id) }}"
                                                                class="btn-action edit" data-tooltip="Edit">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            @if ($dokumen->file_path)
                                                                {{-- <a href="{{ route('umkm.download', $dokumen->id) }}" class="btn-action download" data-tooltip="Download" target="_blank">
                                                        <i class="bi bi-download"></i>
                                                    </a> --}}
                                                            @endif
                                                            <button type="button" class="btn-action move"
                                                                data-tooltip="Pindah Folder"
                                                                onclick="moveDocument({{ $dokumen->id }})">
                                                                <i class="bi bi-arrow-right"></i>
                                                            </button>
                                                            @include('partials.dokumen-delete-form')
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                {{-- <tr>
                                                    <td colspan="6">
                                                        <div class="empty-state">
                                                            <i class="bi bi-inbox"></i>
                                                            <h5>Belum Ada Dokumen</h5>
                                                            <p>Mulai tambahkan dokumen pertama Anda</p>
                                                            <a href="{{ route('umkm.create', array_filter(['folder' => request('folder'), 'role' => request('role')])) }}"
                                                                class="btn-primary-custom"
                                                                style="display:inline-flex;margin-top:8px;">
                                                                <i class="bi bi-plus-circle"></i> Tambah Dokumen
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr> --}}
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

    <!-- Modal Create Folder -->
    <div class="modal fade" id="modalCreateFolder" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-folder-plus text-primary"></i> Buat Folder Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formCreateFolder" action="{{ route('umkm.folder.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Folder</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Masukkan nama folder..." required>
                        </div>
                        <div>
                            <label class="form-label">Warna Folder</label>
                            <div class="color-options flex-gap-6">
                                @for ($i = 1; $i <= 8; $i++)
                                    <label class="color-option"
                                        style="background:var(--fc{{ $i }});{{ $i == 1 ? 'border-color:var(--dark);' : '' }}"
                                        onclick="selectColor(this, {{ $i }})">
                                        <input type="radio" name="color" value="{{ $i }}"
                                            {{ $i == 1 ? 'checked' : '' }}>
                                        </label>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Buat Folder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Folder -->
    <div class="modal fade" id="modalEditFolder" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square text-warning"></i> Edit Folder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditFolder" action="" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Folder</label>
                            <input type="text" name="name" id="editFolderName" class="form-control" required>
                        </div>
                        <div>
                            <label class="form-label">Warna Folder</label>
                            <div class="color-options flex-gap-6">
                                @for ($i = 1; $i <= 8; $i++)
                                    <label class="color-option" style="background:var(--fc{{ $i }});"
                                        onclick="selectColor(this, {{ $i }})">
                                        <input type="radio" name="color" value="{{ $i }}">
                                    </label>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning text-white">Update Folder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Move Document -->
    <div class="modal fade" id="modalMoveDocument" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-arrow-right-circle text-primary"></i> Pindahkan Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formMoveDocument" action="" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body">
                        <p class="text-secondary-13-mb">Pilih folder tujuan untuk
                            dokumen ini:</p>
                        <div class="mb-3">
                            <label class="form-label">Pilih Folder</label>
                            <select name="folder_id" class="form-control" required>
                                <option value="">Pilih Folder...</option>
                                @foreach ($folders ?? [] as $folder)
                                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Pindahkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                var table = $('#table-dokumen').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    autoWidth: false,
                    pageLength: 10,
                    lengthMenu: [10, 25, 50, 100],
                    drawCallback: function(settings) {
                        let api = this.api();
                        let start = api.page.info().start;
                        api.column(0, {
                            page: 'current'
                        }).nodes().each(function(cell, i) {
                            cell.querySelector('.row-number').innerHTML = start + i + 1;
                        });
                    },
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
                    columnDefs: [{
                        targets: [0, 4],
                        orderable: false
                    }]
                });

                $('.dataTables_filter input').attr('placeholder', 'Cari dokumen...').addClass(
                    'form-control form-control-sm');
                $('.dataTables_length select').addClass('form-control form-control-sm');

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

                // Flash messages with Toast
                @if (session('message'))
                    showToast('success', 'Sukses!', '{{ session('message') }}');
                @endif

                @if (session('error'))
                    showToast('error', 'Gagal!', '{{ session('error') }}');
                @endif

                @if (session('folder_success'))
                    showToast('success', 'Berhasil!', '{{ session('folder_success') }}');
                @endif
            });

            // ===== TOAST FUNCTION =====
            function showToast(type, title, message) {
                const icons = {
                    success: 'bi-check-circle-fill',
                    error: 'bi-x-circle-fill',
                    warning: 'bi-exclamation-triangle-fill'
                };

                const toast = `
        <div class="toast ${type}">
            <span class="toast-icon"><i class="bi ${icons[type] || icons.success}"></i></span>
            <div class="toast-body">
                <div class="toast-title">${title}</div>
                <div class="toast-message">${message}</div>
            </div>
            <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
    `;

                let container = document.querySelector('.toast-container');
                if (!container) {
                    container = document.createElement('div');
                    container.className = 'toast-container';
                    document.body.appendChild(container);
                }

                container.insertAdjacentHTML('beforeend', toast);

                setTimeout(() => {
                    const toastEl = container.lastElementChild;
                    if (toastEl) {
                        toastEl.style.opacity = '0';
                        toastEl.style.transform = 'translateX(100%)';
                        setTimeout(() => toastEl.remove(), 400);
                    }
                }, 4000);
            }

            // ===== FOLDER FUNCTIONS =====

            // Filter by folder
            function filterByFolder(folderId, role = null) {

                const url = new URL(window.location.href);

                if (role) {
                    url.searchParams.set('role', role);
                }

                url.searchParams.set('folder', folderId);

                window.location.href = url.toString();
            }

            // Select color
            function selectColor(element, value) {
                document.querySelectorAll('.color-option').forEach(el => {
                    el.classList.remove('active');
                    el.style.borderColor = 'transparent';
                });
                element.classList.add('active');
                element.style.borderColor = 'var(--dark)';
                element.querySelector('input[type="radio"]').checked = true;
            }

            // Edit folder
            function editFolder(id, name, color) {
                $('#modalEditFolder').modal('show');
                $('#formEditFolder').attr('action', "{{ route('umkm.folder.update', '') }}/" + id);
                $('#editFolderName').val(name);

                document.querySelectorAll('#modalEditFolder .color-option').forEach(el => {
                    el.classList.remove('active');
                    el.style.borderColor = 'transparent';
                    let radio = el.querySelector('input[type="radio"]');
                    if (radio.value == color) {
                        el.classList.add('active');
                        el.style.borderColor = 'var(--dark)';
                        radio.checked = true;
                    }
                });
            }

            // Delete folder
            function deleteFolder(id) {
                Swal.fire({
                    title: 'Hapus Folder?',
                    text: 'Dokumen dalam folder ini akan tetap ada dan pindah ke root',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-danger px-4 py-2',
                        cancelButton: 'btn btn-secondary px-4 py-2',
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('umkm.folder.delete', '') }}/" + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message || 'Folder berhasil dihapus',
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
                                    text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                                    confirmButtonColor: '#4F46E5',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            }

            // Move document
            function moveDocument(id) {
                $('#modalMoveDocument').modal('show');
                $('#formMoveDocument').attr('action', "{{ route('umkm.document.move', '') }}/" + id);
            }

            // Animation on load
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.fade-in-up').forEach((el, i) => {
                    el.style.animationDelay = (i * 0.08) + 's';
                });
            });
        </script>

        @include('partials.dokumen-delete-js')
    @endpush
@endsection
