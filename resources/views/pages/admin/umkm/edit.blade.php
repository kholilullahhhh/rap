@extends('layouts.app', ['title' => 'Edit Dokumen'])

@section('content')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/pages/admin/umkm/edit.css') }}">
@endpush

<div class="main-content">
    <section class="section">

        <!-- Header -->
        <div class="section-header">
            <h1><i class="bi bi-pencil-square"></i> Edit Dokumen</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door"></i> Dashboard
                    </a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('umkm.index') }}">
                        <i class="bi bi-folder2-open"></i> Data Dokumen
                    </a>
                </div>
                <div class="breadcrumb-item active">
                    <i class="bi bi-pencil-square"></i> Edit Dokumen
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h4><i class="bi bi-file-earmark-text"></i> Form Edit Dokumen</h4>
                            <div>
                                <span class="badge badge-status {{ $data->status ?? 'draft' }}">
                                    <i class="bi bi-info-circle"></i> 
                                    {{ ucfirst($data->status ?? 'Draft') }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body">

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Terjadi kesalahan!</strong>
                                <ul class="mt-2">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{ route('umkm.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">

                                        <!-- Folder -->
                                        <div class="form-group">
                                            <label>
                                                <i class="bi bi-folder2"></i> Folder
                                                <span class="text-muted-small">(Opsional)</span>
                                            </label>
                                            <select
                                                name="folder_id"
                                                class="form-control @error('folder_id') is-invalid @enderror">
                                                <option value="">Tanpa Folder (Root)</option>
                                                @foreach($folders ?? [] as $folder)
                                                <option
                                                    value="{{ $folder->id }}"
                                                    {{ old('folder_id', $data->folder_id) == $folder->id ? 'selected' : '' }}>
                                                    {{ $folder->name }}
                                                    <span class="text-muted">({{ $folder->dokumen_count ?? 0 }} dokumen)</span>
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('folder_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text">
                                                <i class="bi bi-info-circle"></i> Pilih folder untuk mengelompokkan dokumen ini
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <!-- Tanggal Dokumen -->
                                        <div class="form-group">
                                            <label>
                                                Tanggal Dokumen
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="date"
                                                name="tanggal_dokumen"
                                                class="form-control @error('tanggal_dokumen') is-invalid @enderror"
                                                value="{{ old('tanggal_dokumen', $data->tanggal_dokumen ? \Carbon\Carbon::parse($data->tanggal_dokumen)->format('Y-m-d') : '') }}"
                                                required>
                                            @error('tanggal_dokumen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <!-- File -->
                                        <div class="form-group">
                                            <label>
                                                File Dokumen
                                                <span class="text-muted-small">(Kosongkan jika tidak diganti)</span>
                                            </label>

                                            <div class="file-preview" style="width:100%;">
                                                <span class="file-icon"><i class="bi bi-file-earmark-pdf"></i></span>
                                                <div style="flex:1;min-width:0;">
                                                    <div class="file-name" id="currentDocName" style="word-break:break-all;">
                                                        {{ $data->judul }}
                                                    </div>
                                                    <div class="file-size">
                                                        <i class="bi bi-info-circle"></i> Nama dokumen otomatis mengikuti nama file
                                                    </div>
                                                </div>
                                                @if($data->file_path)
                                                <div class="ms-auto">
                                                    <a href="{{ asset('storage/'.$data->file_path) }}" target="_blank" class="btn-file-action view-file">
                                                        <i class="bi bi-eye"></i> Lihat
                                                    </a>
                                                </div>
                                                @endif
                                            </div>

                                            <input
                                                type="file"
                                                name="file_path"
                                                id="file_path"
                                                class="form-control @error('file_path') is-invalid @enderror"
                                                accept=".pdf,.doc,.docx,.xls,.xlsx">
                                            @error('file_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <div id="autoNamePreview" class="mt-2" style="display:none;">
                                                <label style="font-weight:600;font-size:13px;color:var(--dark);">
                                                    Nama Dokumen Baru
                                                    <small class="text-muted">(otomatis dari file baru)</small>
                                                </label>
                                                <input
                                                    type="text"
                                                    id="autoName"
                                                    class="form-control"
                                                    readonly>
                                            </div>

                                            <small class="form-text">
                                                <i class="bi bi-info-circle"></i>
                                                Jika memilih file baru, nama dokumen akan diperbarui mengikuti nama file.
                                                Maksimal 10MB. Format: PDF, DOC, DOCX, XLS, XLSX
                                            </small>
                                        </div>

                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="form-group text-center mt-4">
                                    <button type="submit" class="btn btn-primary-custom">
                                        <i class="bi bi-save"></i> Simpan Perubahan
                                    </button>
                                    <a href="{{ route('umkm.index') }}" class="btn btn-secondary-custom">
                                        <i class="bi bi-arrow-left"></i> Kembali
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>

@push('scripts')
<script>
    // Auto-hide alert after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        }

        // Preview nama dokumen otomatis dari file yang dipilih
        const fileInput = document.getElementById('file_path');
        const preview = document.getElementById('autoNamePreview');
        const autoName = document.getElementById('autoName');

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files && this.files[0];
                if (file) {
                    autoName.value = file.name.replace(/\.[^.]+$/, '');
                    preview.style.display = 'block';
                } else {
                    autoName.value = '';
                    preview.style.display = 'none';
                }
            });
        }
    });
</script>
@endpush
@endsection
