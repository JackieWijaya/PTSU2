<div class="modal fade" id="diterimaModal">
    <div class="modal-dialog">
        <div class="modal-content bg-success">
            <form action="" method="POST" id="status_diterimaForm">
                @method('PATCH')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="mb-konfirmasi-diterima"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-light" name="status" value="Diterima">Ya,
                        Terima</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // generate alamat URL untuk proses hapus data 
    $('.btn-diterima').click(function() {
        let id = $(this).attr('data-id');
        $('#status_diterimaForm').attr('action', '/data_pelamar/' + id);

        let nama = $(this).attr('data-nama');
        $('#mb-konfirmasi-diterima').text("Apakah Anda Yakin Ingin Menerima Pelamar Dengan ID " + id + " " +
            nama + " ?");
    })

    $('#status_diterimaForm [type="submit"]').click(function() {
        $('#status_diterimaForm').submit();
    })
</script>
