@can('delete', $dokumen)
    <form action="{{ route('umkm.hapus', $dokumen->id) }}" method="POST"
        class="delete-form" id="delete-form-{{ $dokumen->id }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-action delete delete-btn"
            data-tooltip="Hapus" data-title="{{ $dokumen->judul }}">
            <i class="bi bi-trash3"></i>
        </button>
    </form>
@endcan
