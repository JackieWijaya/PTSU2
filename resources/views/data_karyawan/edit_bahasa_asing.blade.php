<form action="{{ route('bahasa_asing.update', ['bahasa_asing' => $data_pribadi->id]) }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <div class="row">
        <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">

        <div class="form-group col-lg-6 col-md-6 col-sm-12">
            <label for="lisan">Lisan</label>
            <select name="lisan" id="lisan" class="form-control @error('lisan') is-invalid @enderror">
                <option value="">-- Pilih Nilai Keahlian --</option>
                <option value="Cukup"{{ $bahasa_asing->lisan == 'Cukup' ? 'selected' : '' }}>
                    Cukup
                </option>
                <option value="Sedang"{{ $bahasa_asing->lisan == 'Sedang' ? 'selected' : '' }}>
                    Sedang
                </option>
                <option value="Baik"{{ $bahasa_asing->lisan == 'Baik' ? 'selected' : '' }}>
                    Baik
                </option>
            </select>

            @error('lisan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group col-lg-6 col-md-6 col-sm-12">
            <label for="tulisan">Tulisan</label>
            <select name="tulisan" id="tulisan" class="form-control @error('tulisan') is-invalid @enderror">
                <option value="">-- Pilih Nilai Keahlian --</option>
                <option value="Cukup"{{ $bahasa_asing->tulisan == 'Cukup' ? 'selected' : '' }}>
                    Cukup
                </option>
                <option value="Sedang"{{ $bahasa_asing->tulisan == 'Sedang' ? 'selected' : '' }}>
                    Sedang
                </option>
                <option value="Baik"{{ $bahasa_asing->tulisan == 'Baik' ? 'selected' : '' }}>
                    Baik
                </option>
            </select>

            @error('tulisan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
        sudah diisi dengan benar!</p>
    <div class="pt-3">
        <button type="submit" class="btn btn-primary" onclick="setRequired(true)"
            @disabled($bahasa_asing && $bahasa_asing->status_isi == '1')>Simpan</button>
    </div>
    <hr>

</form>


<form action="{{ route('bahasa_asing.update', ['bahasa_asing' => $data_pribadi->id]) }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">
    <button type="button" class="btn btn-primary btn-block mt-3" data-toggle="modal"
        data-target="#next_bahasa_asingModal" onclick="setRequired(false)" @disabled($bahasa_asing && $bahasa_asing->status_isi == '1')>Next</button>
    <div class="modal fade" id="next_bahasa_asingModal">
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
