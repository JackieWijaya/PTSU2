@foreach ($data_pendidikan as $item)
    <form action="{{ route('data_pendidikan.update', ['data_pendidikan' => $data_pribadi->id]) }}" method="POST"
        enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="row">
            <input type="hidden" name="id" value="{{ $item->id }}">
            <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="jenjang">Jenjang</label>
                <select name="jenjang" id="jenjang" class="form-control @error('jenjang') is-invalid @enderror">
                    <option value="">-- Pilih Jenjang --</option>
                    <option value="SD"{{ $item->jenjang == 'SD' ? 'selected' : '' }}>
                        SD
                    </option>
                    <option value="SMP"{{ $item->jenjang == 'SMP' ? 'selected' : '' }}>
                        SMP
                    </option>
                    <option value="SMA"{{ $item->jenjang == 'SMA' ? 'selected' : '' }}>
                        SMA
                    </option>
                    <option value="D3"{{ $item->jenjang == 'D3' ? 'selected' : '' }}>
                        D3
                    </option>
                    <option value="S1"{{ $item->jenjang == 'S1' ? 'selected' : '' }}>
                        S1
                    </option>
                    <option value="S2"{{ $item->jenjang == 'S2' ? 'selected' : '' }}>
                        S2
                    </option>
                </select>

                @error('jenjang')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="fakultas">Fakultas</label>
                <small class="text-muted">(Input "-" Jika Jenjang SD/SMP/SMA)</small>
                <input type="text" class="form-control @error('fakultas') is-invalid @enderror" name="fakultas"
                    id="fakultas" value="{{ $item->fakultas }}" placeholder="Enter Fakultas">
                @if (!$errors->has('fakultas'))
                    <p>*Input "-" Jika Jenjang SD/SMP/SMA</p>
                @endif

                @error('fakultas')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="nama_sekolah">Nama Sekolah</label>
                <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror"
                    name="nama_sekolah" id="nama_sekolah" value="{{ $item->nama_sekolah }}"
                    placeholder="Enter Nama Sekolah">

                @error('nama_sekolah')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="jurusan">Jurusan</label>
                <small class="text-muted">(Input "-" Jika Jenjang SD/SMP)</small>
                <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan"
                    id="jurusan" value="{{ $item->jurusan }}" placeholder="Enter Jurusan">
                @if (!$errors->has('jurusan'))
                    <p>*Input "-" Jika Jenjang SD/SMP</p>
                @endif

                @error('jurusan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="tahun_masuk">Tahun Masuk</label>
                <input type="text" class="form-control @error('tahun_masuk') is-invalid @enderror" name="tahun_masuk"
                    id="tahun_masuk" value="{{ $item->tahun_masuk }}" placeholder="Enter Tahun Masuk">

                @error('tahun_masuk')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="tahun_lulus">Tahun Lulus</label>
                <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus"
                    id="tahun_lulus" value="{{ $item->tahun_lulus }}" placeholder="Enter Tahun Lulus">

                @error('tahun_lulus')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
            sudah diisi dengan benar!</p>
        <div class="pt-3">
            <button type="submit" class="btn btn-primary" onclick="setRequired(true)"
                @disabled($data_pendidikan_status && $data_pendidikan_status->status_isi == '1')>Simpan</button>
        </div>
        <hr>

    </form>
@endforeach

<form action="{{ route('data_pendidikan.update', ['data_pendidikan' => $data_pribadi->id]) }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">
    <button type="button" class="btn btn-primary btn-block mt-3" data-toggle="modal"
        data-target="#next_data_pendidikanModal" onclick="setRequired(false)" @disabled($data_pendidikan_status && $data_pendidikan_status->status_isi == '1')>Next</button>
    <div class="modal fade" id="next_data_pendidikanModal">
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
