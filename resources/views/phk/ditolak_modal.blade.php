<div class="modal fade" id="ditolakModal">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form action="" method="POST" id="status_ditolakForm">
                @method('PATCH')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="mb-konfirmasi-ditolak"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-light" name="status" value="Ditolak">Ya,
                        Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // generate alamat URL untuk proses hapus data 
    $('.btn-ditolak').click(function() {
        let id = $(this).attr('data-id');
        $('#status_ditolakForm').attr('action', '/status_phk/' + id);

        let nik = $(this).attr('data-nik');
        let nama = $(this).attr('data-nama');
        $('#mb-konfirmasi-ditolak').text("Apakah Anda Yakin Ingin Menolak Pengajuan PHK Karyawan Dengan NIK " +
            nik +
            " " +
            nama + " ?");
    })

    $('#status_ditolakForm [type="submit"]').click(function() {
        $('#status_ditolakForm').submit();
    })
</script>
