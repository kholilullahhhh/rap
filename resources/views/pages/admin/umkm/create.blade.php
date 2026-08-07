@extends('layouts.app', ['title' => 'Tambah Dokumen'])

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header">
                <h1>Tambah Dokumen</h1>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </div>

                    <div class="breadcrumb-item">
                        <a href="{{ route('umkm.index') }}">
                            Data Dokumen
                        </a>
                    </div>

                    <div class="breadcrumb-item active">
                        Tambah Dokumen
                    </div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">
                                <h4><i class="fas fa-file-upload mr-2"></i>Form Tambah Dokumen</h4>
                            </div>

                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('umkm.store', array_filter(['role' => request('role')])) }}"
                                    method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>
                                                    Folder
                                                    <small class="text-muted">(opsional)</small>
                                                </label>

                                                <select name="folder_id" class="form-control">

                                                    <option value="">
                                                        Tidak Ada Folder (Root)
                                                    </option>

                                                    @foreach ($folders as $folder)
                                                        <option value="{{ $folder->id }}"
                                                            {{ (string) $selectedFolder === (string) $folder->id ? 'selected' : '' }}>

                                                            {{ $folder->name }}

                                                        </option>
                                                    @endforeach

                                                </select>

                                                @if (isset($selectedFolder) && $selectedFolder)
                                                    <small class="text-muted">
                                                        Dokumen akan disimpan di folder yang dipilih.
                                                    </small>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>
                                                    Tanggal Dokumen
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="hidden" name="tanggal_dokumen"
                                                    value="{{ old('tanggal_dokumen', now()->format('Y-m-d')) }}">
                                                
                                                <div class="form-control-plaintext text-primary">
                                                    <i class="fas fa-calendar-alt mr-1"></i>
                                                    {{ \Carbon\Carbon::parse(old('tanggal_dokumen', now()->format('Y-m-d')))->format('d/m/Y') }}
                                                    <small class="text-muted ml-2">(tanggal saat ini)</small>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>
                                                    Upload File
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <div class="custom-file">
                                                    <input type="file" name="file_path" id="file_path" 
                                                        class="custom-file-input" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                                                    <label class="custom-file-label" for="file_path">
                                                        <i class="fas fa-cloud-upload-alt mr-1"></i>
                                                        Pilih File
                                                    </label>
                                                </div>

                                                <small class="text-muted d-block mt-1">
                                                    <i class="fas fa-info-circle mr-1"></i>
                                                    Format: PDF, DOC, DOCX, XLS, XLSX. Maksimal 10MB.
                                                </small>

                                                <div id="autoNamePreview" class="mt-3" style="display:none;">
                                                    <div class="alert alert-info p-2">
                                                        <i class="fas fa-file-alt mr-2"></i>
                                                        <strong>Nama Dokumen Otomatis:</strong>
                                                        <input type="text" id="autoName" class="form-control mt-1" readonly
                                                            placeholder="Nama dokumen akan terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-group text-center mt-4">
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                                <i class="fas fa-save mr-2"></i>
                                                Simpan Dokumen
                                            </button>

                                            <a href="{{ route('umkm.index') }}" class="btn btn-secondary btn-lg px-5 ml-2">
                                                <i class="fas fa-arrow-left mr-2"></i>
                                                Kembali
                                            </a>
                                        </div>
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
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('file_path');
                const preview = document.getElementById('autoNamePreview');
                const autoName = document.getElementById('autoName');
                
                // Custom file input label
                const fileLabel = fileInput.nextElementSibling;

                if (fileInput) {
                    fileInput.addEventListener('change', function() {
                        const file = this.files && this.files[0];
                        if (file) {
                            // Update label
                            if (fileLabel) {
                                fileLabel.innerHTML = '<i class="fas fa-file mr-1"></i> ' + file.name;
                            }
                            
                            // Update auto name
                            autoName.value = file.name.replace(/\.[^.]+$/, '');
                            preview.style.display = 'block';
                        } else {
                            if (fileLabel) {
                                fileLabel.innerHTML = '<i class="fas fa-cloud-upload-alt mr-1"></i> Pilih File';
                            }
                            autoName.value = '';
                            preview.style.display = 'none';
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection