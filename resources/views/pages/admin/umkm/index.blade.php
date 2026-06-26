@extends('layouts.app', ['title' => 'Data Dokumen'])

@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/sweetalert2/dist/sweetalert2.min.css') }}">

<style>
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        padding: 0.375rem 0.75rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .badge-draft {
        background: #ffc107;
        color: #212529;
        padding: 5px 10px;
        border-radius: 3px;
    }

    .badge-review {
        background: #17a2b8;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    }

    .badge-approved {
        background: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    }

    .badge-obsolete {
        background: #dc3545;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
    }
</style>
@endpush

<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Data Dokumen</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    Data Dokumen
                </div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header">
                            <h4>Daftar Dokumen</h4>

                            <div class="card-header-action">
                                <a href="{{ route('umkm.create') }}"
                                    class="btn btn-primary btn-icon icon-left">
                                    <i class="fas fa-plus"></i>
                                    Tambah Dokumen
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped" id="table-dokumen">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No Dokumen</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Versi</th>
                                            <th>Status</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($datas as $index => $dokumen)

                                        <tr>

                                            <td>{{ $index + 1 }}</td>

                                            <td>
                                                {{ $dokumen->nomor_dokumen }}
                                            </td>

                                            <td>
                                                {{ $dokumen->judul }}
                                            </td>

                                            <td>
                                                {{ $dokumen->kategori->nama ?? '-' }}
                                            </td>

                                            <td>
                                                {{ date('d-m-Y', strtotime($dokumen->tanggal_dokumen)) }}
                                            </td>

                                            <td>
                                                {{ $dokumen->versi }}
                                            </td>

                                            <td>

                                                @if($dokumen->status == 'draft')
                                                    <span class="badge-draft">Draft</span>

                                                @elseif($dokumen->status == 'review')
                                                    <span class="badge-review">Review</span>

                                                @elseif($dokumen->status == 'approved')
                                                    <span class="badge-approved">Approved</span>

                                                @else
                                                    <span class="badge-obsolete">Obsolete</span>
                                                @endif

                                            </td>

                                            <td>

                                                @if($dokumen->file_path)

                                                <a href="{{ asset('storage/'.$dokumen->file_path) }}"
                                                    target="_blank"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-file"></i>
                                                </a>

                                                @else

                                                -

                                                @endif

                                            </td>

                                            <td>

                                                <div class="action-buttons">

                                                    <a href="{{ route('umkm.edit',$dokumen->id) }}"
                                                        class="btn btn-warning btn-action">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('umkm.hapus',$dokumen->id) }}"
                                                        method="POST"
                                                        class="delete-form">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="button"
                                                            class="btn btn-danger btn-action delete-btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                    </form>

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

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>

<script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>

<script>

$(document).ready(function () {

    $('#table-dokumen').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        pageLength: 10,
        lengthMenu: [10,25,50,100]
    });

    $('.delete-btn').click(function(e){

        e.preventDefault();

        let form = $(this).closest('form');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Dokumen akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

    @if(session('message'))

    Swal.fire({
        icon:'success',
        title:'Sukses',
        text:'{{ session("message") }}'
    });

    @endif

    @if(session('error'))

    Swal.fire({
        icon:'error',
        title:'Gagal',
        text:'{{ session("error") }}'
    });

    @endif

});

</script>

@endpush

@endsection