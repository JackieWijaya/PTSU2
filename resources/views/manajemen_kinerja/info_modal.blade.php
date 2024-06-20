<div class="modal fade" id="infoModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Info</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <p><strong>NIK</strong><br><span id="nik"></span></p>
                        <p><strong>Nama Karyawan</strong><br><span id="nama_lengkap"></span></p>
                        <p><strong>Alasan</strong>
                            <span id="alasan" style="display: block; max-width: 100%; overflow: auto;"></span>
                        </p>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Jenis</strong><br><span id="jenis"></span></p>
                        <p><strong>Tanggal</strong><br><span id="tanggal"></span></p>
                        <p><strong>Foto / File Bukti</strong><br><span id="foto"></span></p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p><strong>Catatan</strong>
                            <span id="catatan" style="display: block; max-width: 100%; overflow: auto;"></span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#info', function() {
            let nik = $(this).attr('data-nik');
            let jenis = $(this).attr('data-jenis');
            let nama_lengkap = $(this).attr('data-nama');
            let foto = $(this).attr('data-foto');
            let alasan = $(this).attr('data-alasan');
            let catatan = $(this).attr('data-catatan');
            let tanggal = $(this).attr('data-tgl');

            let jenis_text;
            let jenis_badge_class;
            switch (jenis) {
                case 'Reward':
                    jenis_text = 'Reward';
                    jenis_badge_class = 'badge badge-success';
                    break;
                case 'Punishment':
                    jenis_text = 'Punishment';
                    jenis_badge_class = 'badge badge-danger';
                    break;
            }

            let foto_text;
            if (foto === null || foto === '') {
                foto_text = '-';
            } else {
                // Jika buku nikah bukan "-"
                foto_text =
                    `<a href="/storage/FotoRewardPunishment/${foto}">Lihat</a>`;
            }

            // Menetapkan nilai ke elemen HTML
            $('#nik').text(nik);
            $('#jenis').removeClass().addClass(jenis_badge_class).text(jenis_text);
            $('#nama_lengkap').text(nama_lengkap);
            $('#foto').html(foto_text);
            $('#alasan').text(alasan);
            $('#catatan').text(catatan);
            $('#tanggal').text(tanggal);
        })
    })
</script>
