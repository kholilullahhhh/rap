@extends('layouts.app', ['title' => 'Edit Dokumen'])

@section('content')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<style>
    :root {
        --primary: #4F46E5;
        --primary-light: #EEF2FF;
        --success: #10B981;
        --warning: #F59E0B;
        --danger: #EF4444;
        --secondary: #64748B;
        --dark: #0F172A;
    }
    body { font-family: 'Inter', sans-serif; background: #F1F5F9; }
    .main-content { padding: 15px 25px; }

    /* Header */
    .section-header {
        padding: 0 0 20px 0;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .section-header h1 {
        font-size: 22px;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-header h1 i { color: var(--primary); }
    .section-header-breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
    }
    .section-header-breadcrumb .breadcrumb-item a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
    }
    .section-header-breadcrumb .breadcrumb-item.active {
        color: var(--dark);
        font-weight: 600;
    }

    /* Card */
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        background: white;
        transition: all 0.3s ease;
    }
    .card:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
    .card-header {
        background: white;
        border-bottom: 1px solid #F1F5F9;
        padding: 14px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .card-header h4 {
        font-size: 15px;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-header h4 i { color: var(--primary); }
    .card-body { padding: 20px 24px 24px; }

    /* Form */
    .form-group {
        margin-bottom: 18px;
    }
    .form-group label {
        font-weight: 600;
        font-size: 13px;
        color: var(--dark);
        margin-bottom: 4px;
        display: block;
    }
    .form-group label .text-danger { color: var(--danger); }
    .form-group label .text-muted-small {
        font-weight: 400;
        color: var(--secondary);
        font-size: 11px;
    }
    .form-control {
        border: 2px solid #E2E8F0;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 13px;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
        background: white;
        width: 100%;
    }
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        outline: none;
    }
    .form-control.is-invalid {
        border-color: var(--danger);
    }
    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
    }
    .invalid-feedback {
        display: block;
        font-size: 12px;
        color: var(--danger);
        margin-top: 4px;
    }
    .form-text {
        font-size: 12px;
        color: var(--secondary);
        margin-top: 4px;
    }

    /* Button */
    .btn-primary-custom {
        background: linear-gradient(135deg, #4F46E5, #7C3AED);
        color: white;
        border: none;
        padding: 8px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 12px rgba(79,70,229,0.2);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79,70,229,0.3);
        color: white;
        text-decoration: none;
    }
    .btn-secondary-custom {
        background: #F1F5F9;
        color: var(--dark);
        border: 1px solid #E2E8F0;
        padding: 8px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        text-decoration: none;
    }
    .btn-secondary-custom:hover {
        background: #E2E8F0;
        color: var(--dark);
        text-decoration: none;
    }

    /* Alert */
    .alert {
        border: none;
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 20px;
    }
    .alert-danger {
        background: #FEF2F2;
        color: #991B1B;
        border-left: 4px solid var(--danger);
    }
    .alert-danger ul {
        padding-left: 20px;
        margin: 0;
    }
    .alert-danger ul li {
        font-size: 13px;
    }

    /* File Preview */
    .file-preview {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--primary-light);
        padding: 8px 16px;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .file-preview .file-icon {
        font-size: 20px;
        color: var(--primary);
    }
    .file-preview .file-name {
        font-size: 13px;
        font-weight: 500;
        color: var(--dark);
    }
    .file-preview .file-size {
        font-size: 11px;
        color: var(--secondary);
    }
    .btn-file-action {
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .btn-file-action.view-file {
        background: #DBEAFE;
        color: #1E40AF;
    }
    .btn-file-action.view-file:hover {
        background: #3B82F6;
        color: white;
        text-decoration: none;
    }
    .btn-file-action.download-file {
        background: #D1FAE5;
        color: #065F46;
    }
    .btn-file-action.download-file:hover {
        background: #10B981;
        color: white;
        text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content { padding: 10px 15px; }
        .section-header { flex-direction: column; align-items: flex-start !important; gap: 8px; }
        .section-header h1 { font-size: 19px; }
        .card-body { padding: 16px; }
        .card-header { padding: 12px 16px; }
        .form-group { margin-bottom: 14px; }
        .btn-primary-custom, .btn-secondary-custom {
            width: 100%;
            justify-content: center;
            margin-bottom: 8px;
        }
        .text-center .btn {
            display: block;
            width: 100%;
            margin: 0 0 8px 0 !important;
        }
    }
    @media (max-width: 480px) {
        .section-header-breadcrumb { font-size: 11px; }
        .file-preview { flex-wrap: wrap; }
    }
</style>
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

                                        <!-- Judul Dokumen -->
                                        <div class="form-group">
                                            <label>
                                                Judul Dokumen
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input
                                                type="text"
                                                name="judul"
                                                class="form-control @error('judul') is-invalid @enderror"
                                                value="{{ old('judul', $data->judul) }}"
                                                placeholder="Masukkan judul dokumen..."
                                                required>
                                            @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Kategori -->
                                        <div class="form-group">
                                            <label>
                                                Kategori Dokumen
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select
                                                name="kategori_id"
                                                class="form-control @error('kategori_id') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach($kategori as $item)
                                                <option
                                                    value="{{ $item->id }}"
                                                    {{ old('kategori_id', $data->kategori_id) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_jenis }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

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
                                                <span class="text-muted-small">(Opsional)</span>
                                            </label>

                                            @if($data->file_path)
                                            <div class="file-preview">
                                                <span class="file-icon"><i class="bi bi-file-earmark-pdf"></i></span>
                                                <div>
                                                    <div class="file-name">{{ basename($data->file_path) }}</div>
                                                    <div class="file-size">
                                                        @php
                                                            $filePath = storage_path('app/public/' . $data->file_path);
                                                            $fileSize = file_exists($filePath) ? filesize($filePath) : 0;
                                                            $fileSizeFormatted = $fileSize > 0 ? number_format($fileSize / 1024, 2) . ' KB' : 'Unknown';
                                                        @endphp
                                                        {{ $fileSizeFormatted }}
                                                    </div>
                                                </div>
                                                <div class="ms-auto">
                                                    <a href="{{ asset('storage/'.$data->file_path) }}" target="_blank" class="btn-file-action view-file">
                                                        <i class="bi bi-eye"></i> Lihat
                                                    </a>
                                                    {{-- <a href="{{ route('umkm.download', $data->id) }}" class="btn-file-action download-file">
                                                        <i class="bi bi-download"></i> Download
                                                    </a> --}}
                                                </div>
                                            </div>
                                            @endif

                                            <input
                                                type="file"
                                                name="file_path"
                                                class="form-control @error('file_path') is-invalid @enderror"
                                                accept=".pdf,.doc,.docx,.xls,.xlsx">
                                            @error('file_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text">
                                                <i class="bi bi-info-circle"></i> 
                                                Kosongkan jika tidak ingin mengganti file. 
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
    });
</script>
@endpush
@endsection