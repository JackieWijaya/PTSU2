<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form action="" method="POST" id="formDelete">
                @method('DELETE')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus T</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mb-konfirmasi"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-light">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // generate alamat URL untuk proses hapus data 
    $('.btn-hapus').click(function() {
        let id = $(this).attr('data-id');
        $('#formDelete').attr('action', '/manajemen_jabatan/' + id);

        let nama = $(this).attr('data-nama');
        $('#mb-konfirmasi').text("Apakah Anda Yakin Ingin Menghapus Data Jabatan Dengan Kode " + id + " " +
            nama + " ?");
    })

    $('#formDelete [type="submit"]').click(function() {
        $('#formDelete').submit();
    })
</script>
