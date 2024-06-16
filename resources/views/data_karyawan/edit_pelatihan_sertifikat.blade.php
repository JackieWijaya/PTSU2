@foreach ($pelatihan_sertifikat as $item)
    <form action="{{ route('pelatihan_sertifikat.update', ['pelatihan_sertifikat' => $data_pribadi->id]) }}"
        method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="row">
            <input type="hidden" name="id" value="{{ $item->id }}">
            <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="nama_lembaga">Nama Lembaga</label>
                <input type="text" class="form-control @error('nama_lembaga') is-invalid @enderror"
                    name="nama_lembaga" id="nama_lembaga" value="{{ $item->nama_lembaga }}"
                    placeholder="Enter Nama Lembaga">

                @error('nama_lembaga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="jenis">Jenis</label>
                <input type="text" class="form-control @error('jenis') is-invalid @enderror" name="jenis"
                    id="jenis" value="{{ $item->jenis }}" placeholder="Enter Jenis">
                @if (!$errors->has('jenis'))
                    <p>*Pelatihan/Lomba/Seminar/Dll</p>
                @endif

                @error('jenis')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="mulai_pelatihan">Tanggal Mulai</label>
                <input type="date" class="form-control @error('mulai_pelatihan') is-invalid @enderror"
                    name="mulai_pelatihan" id="mulai_pelatihan"value="{{ $item->mulai }}" placeholder="Enter Mulai">

                @error('mulai_pelatihan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="akhir_pelatihan">Tanggal Berakhir</label>
                <input type="date" class="form-control @error('akhir_pelatihan') is-invalid @enderror"
                    name="akhir_pelatihan" id="akhir_pelatihan"value="{{ $item->akhir }}" placeholder="Enter Akhir">

                @error('akhir_pelatihan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                <label for="sertifikat">Sertifikat / File Bukti</label>
                <input type="file" class="form-control @error('sertifikat') is-invalid @enderror" id="sertifikat"
                    name="sertifikat" value="{{ old('sertifikat') }}" placeholder="Enter Sertifikat">
                @if (!$errors->has('sertifikat'))
                    <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, .png, atau .pdf</p>
                @endif

                @error('sertifikat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
            sudah diisi dengan benar!</p>
        <div class="pt-3">
            <button type="submit" class="btn btn-primary" onclick="setRequired(true)"
                @disabled($pelatihan_sertifikat_status && $pelatihan_sertifikat_status->status_isi == '1')>Simpan</button>
        </div>
        <hr>

    </form>
@endforeach

<form action="{{ route('pelatihan_sertifikat.update', ['pelatihan_sertifikat' => $data_pribadi->id]) }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">
    <button type="button" class="btn btn-primary btn-block mt-3" data-toggle="modal"
        data-target="#next_pelatihan_sertifikatModal" onclick="setRequired(false)"
        @disabled($pelatihan_sertifikat_status && $pelatihan_sertifikat_status->status_isi == '1')>Next</button>
    <div class="modal fade" id="next_pelatihan_sertifikatModal">
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
