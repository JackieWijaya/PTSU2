<div class="modal fade" id="infoModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <p><strong>NIK</strong><br><span id="nik"></span></p>
                        <p><strong>Nama Lengkap</strong><br><span id="nama_lengkap"></span></p>
                        <p><strong>Devisi Lama</strong><br><span id="devisi_lama"></span></p>
                        <p><strong>Jabatan Lama</strong><br><span id="jabatan_lama"></span></p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <p><strong>Jenis</strong><br><span id="jenis"></span></p>
                        <p><strong>Tanggal</strong><br><span id="tanggal"></span></p>
                        <p><strong>Devisi Baru</strong><br><span id="devisi_baru"></span></p>
                        <p><strong>Jabatan Baru</strong><br><span id="jabatan_baru"></span></p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <strong>Catatan</strong><br>
                        <span id="catatan" style="display: block; max-width: 100%; overflow: auto;"></span>
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
            let devisi_lama = $(this).attr('data-devisilama');
            let jabatan_lama = $(this).attr('data-jabatanlama');
            let devisi_baru = $(this).attr('data-devisibaru');
            let jabatan_baru = $(this).attr('data-jabatanbaru');
            let catatan = $(this).attr('data-catatan');
            let tanggal = $(this).attr('data-tgl');

            let devisi_baru_text;
            if (devisi_baru === '-' || devisi_baru === '') {
                devisi_baru_text = devisi_lama;
            } else {
                devisi_baru_text = devisi_baru;
            }

            let jabatan_baru_text;
            if (jabatan_baru === '-' || jabatan_baru === '') {
                jabatan_baru_text = jabatan_lama;
            } else {
                jabatan_baru_text = jabatan_baru;
            }

            // Menetapkan nilai ke elemen HTML
            $('#nik').text(nik);
            $('#jenis').text(jenis);
            $('#nama_lengkap').text(nama_lengkap);
            $('#devisi_lama').text(devisi_lama);
            $('#jabatan_lama').text(jabatan_lama);
            $('#devisi_baru').text(devisi_baru_text);
            $('#jabatan_baru').text(jabatan_baru_text);
            $('#catatan').text(catatan);
            $('#tanggal').text(tanggal);
        })
    })
</script>
