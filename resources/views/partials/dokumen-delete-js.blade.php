<script>
    // ===== DELETE DOKUMEN (shared handler) =====
    // Delegated ke document agar tetap berfungsi setelah DataTables me-render ulang baris,
    // dan terpisah dari init DataTables sehingga tidak mati bila init tersebut gagal.
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();

        var form = $(this).closest('form.delete-form');
        if (!form.length) {
            return;
        }

        var docTitle = $(this).data('title') || 'Dokumen';

        Swal.fire({
            title: 'Hapus Dokumen?',
            html: `
                <div style="text-align:left;padding:6px 0;">
                    <p style="margin-bottom:6px;color:#64748B;font-size:14px;">
                        <i class="bi bi-file-earmark-text" style="color:#4F46E5;"></i>
                        <strong>${docTitle}</strong>
                    </p>
                    <p style="color:#EF4444;font-size:13px;margin:0;">
                        <i class="bi bi-exclamation-triangle"></i> Data akan dihapus permanen!
                    </p>
                </div>
            `,
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
            if (!result.isConfirmed) {
                return;
            }

            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: (response && response.message) || 'Dokumen berhasil dihapus',
                        timer: 1200,
                        showConfirmButton: false,
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    var message = 'Terjadi kesalahan';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: message,
                        confirmButtonColor: '#4F46E5',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
