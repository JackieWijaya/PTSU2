@foreach ($pengalaman_kerja as $item)
    <form action="{{ route('pengalaman_kerja.update', ['pengalaman_kerja' => $data_pribadi->id]) }}" method="POST"
        enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="row">
            <input type="hidden" name="id" value="{{ $item->id }}">
            <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="nama_perusahaan">Nama Perusahaan</label>
                <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                    name="nama_perusahaan" id="nama_perusahaan" value="{{ $item->nama_perusahaan }}"
                    placeholder="Enter Nama Perusahaan">

                @error('nama_perusahaan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                    id="jabatan" value="{{ $item->jabatan }}" placeholder="Enter Jabatan">

                @error('jabatan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="mulai_kerja">Tanggal Mulai</label>
                <input type="date" class="form-control @error('mulai_kerja') is-invalid @enderror" name="mulai_kerja"
                    id="mulai_kerja"value="{{ $item->mulai }}" placeholder="Enter Mulai">

                @error('mulai_kerja')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="akhir_kerja">Tanggal Berakhir</label>
                <input type="date" class="form-control @error('akhir_kerja') is-invalid @enderror" name="akhir_kerja"
                    id="akhir_kerja"value="{{ $item->akhir }}" placeholder="Enter Akhir">

                @error('akhir_kerja')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="gaji">Gaji</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i>Rp.</i></span>
                    </div>
                    <input type="text" class="form-control @error('gaji') is-invalid @enderror" name="gaji"
                        id="gaji" value="{{ $item->gaji }}" pattern="[0-9]+" title="Masukkan hanya angka"
                        placeholder="1234567890">
                </div>

                @error('gaji')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="alasan_keluar">Alasan Keluar</label>
                <input type="text" class="form-control @error('alasan_keluar') is-invalid @enderror"
                    name="alasan_keluar" id="alasan_keluar" value="{{ $item->alasan_keluar }}"
                    placeholder="Enter Alasan Keluar">

                @error('alasan_keluar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
            sudah diisi dengan benar!</p>
        <div class="pt-3">
            <button type="submit" class="btn btn-primary" onclick="setRequired(true)"
                @disabled($pengalaman_kerja_status && $pengalaman_kerja_status->status_isi == '1')>Simpan</button>
        </div>
        <hr>

    </form>
@endforeach

<form action="{{ route('pengalaman_kerja.update', ['pengalaman_kerja' => $data_pribadi->id]) }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">
    <button type="button" class="btn btn-primary btn-block mt-3" data-toggle="modal"
        data-target="#next_pengalaman_kerjaModal" onclick="setRequired(false)"
        @disabled($pengalaman_kerja_status && $pengalaman_kerja_status->status_isi == '1')>Next</button>
    <div class="modal fade" id="next_pengalaman_kerjaModal">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Next Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Form ini akan terkunci dan tidak dapat diubah lagi. Lanjutkan?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-light" id="confirmBtn" name="status_isi"
                        value="1">Ya</button>
                </div>
            </div>
        </div>
    </div>

</form>
