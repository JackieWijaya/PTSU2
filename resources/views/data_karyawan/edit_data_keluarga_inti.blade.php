@foreach ($data_keluarga_inti as $item)
    <form action="{{ route('data_keluarga_inti.update', ['data_keluarga_inti' => $data_pribadi->id]) }}" method="POST"
        enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="row">
            <input type="hidden" name="id" value="{{ $item->id }}">
            <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="nik">NIK</label>
                {{-- <small class="text-muted">(Isi 0 Jika Belum Ada)</small> --}}
                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                    id="nik" value="{{ $item->nik }}" placeholder="Enter NIK" @disabled($data_pribadi->status_kawin == 'TK')>

                @error('nik')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="status_keluarga_inti">Status Keluarga</label>
                <select name="status_keluarga_inti" id="status_keluarga_inti"
                    class="form-control @error('status_keluarga_inti') is-invalid @enderror"
                    @disabled($data_pribadi->status_kawin == 'TK')>
                    <option value="">-- Pilih Status Keluarga --</option>
                    <option value="Istri"{{ $item->status_keluarga == 'Istri' ? 'selected' : '' }}>
                        Istri</option>
                    <option value="Suami"{{ $item->status_keluarga == 'Suami' ? 'selected' : '' }}>
                        Suami</option>
                    @foreach (range(1, 10) as $i)
                        <option
                            value="Anak {{ $i }}"{{ $item->status_keluarga == "Anak $i" ? 'selected' : '' }}>
                            Anak {{ $i }}</option>
                    @endforeach
                </select>

                @error('status_keluarga_inti')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="nama_anggota_keluarga_inti">Nama Anggota Keluarga</label>
                <input type="text" class="form-control @error('nama_anggota_keluarga_inti') is-invalid @enderror"
                    name="nama_anggota_keluarga_inti" id="nama_anggota_keluarga_inti"
                    value="{{ $item->nama_anggota_keluarga }}" placeholder="Enter Nama Anggota Keluarga"
                    @disabled($data_pribadi->status_kawin == 'TK')>

                @error('nama_anggota_keluarga_inti')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <label for="tempat_lahir_inti">Tempat Lahir</label>
                <input type="text" class="form-control @error('tempat_lahir_inti') is-invalid @enderror"
                    name="tempat_lahir_inti" id="tempat_lahir_inti" value="{{ $item->tempat_lahir }}"
                    placeholder="Enter Tempat Lahir" @disabled($data_pribadi->status_kawin == 'TK')>

                @error('tempat_lahir_inti')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <label for="tanggal_lahir_inti">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir_inti') is-invalid @enderror"
                    name="tanggal_lahir_inti" id="tanggal_lahir_inti"value="{{ $item->tanggal_lahir }}"
                    placeholder="Enter Tanggal Lahir" @disabled($data_pribadi->status_kawin == 'TK')>

                @error('tanggal_lahir_inti')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <label for="pendidikan_inti">Pendidikan</label>
                <select name="pendidikan_inti" id="pendidikan_inti"
                    class="form-control @error('pendidikan_inti') is-invalid @enderror" @disabled($data_pribadi->status_kawin == 'TK')>
                    <option value="">-- Pilih Pendidikan --</option>
                    <option value="Belum Sekolah"{{ $item->pendidikan == 'Belum Sekolah' ? 'selected' : '' }}>
                        Belum Sekolah
                    </option>
                    <option value="SD"{{ $item->pendidikan == 'SD' ? 'selected' : '' }}>
                        SD
                    </option>
                    <option value="SMP"{{ $item->pendidikan == 'SMP' ? 'selected' : '' }}>
                        SMP
                    </option>
                    <option value="SMA"{{ $item->pendidikan == 'SMA' ? 'selected' : '' }}>
                        SMA
                    </option>
                    <option value="D3"{{ $item->pendidikan == 'D3' ? 'selected' : '' }}>
                        D3
                    </option>
                    <option value="S1"{{ $item->pendidikan == 'S1' ? 'selected' : '' }}>
                        S1
                    </option>
                    <option value="S2"{{ $item->pendidikan == 'S2' ? 'selected' : '' }}>
                        S2
                    </option>
                </select>

                @error('pendidikan_inti')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-12 col-sm-12">
                <label for="pekerjaan_inti">Pekerjaan</label>
                <small class="text-muted">(Isi - Jika Pendidikan Belum Sekolah)</small>
                <input type="text" class="form-control @error('pekerjaan_inti') is-invalid @enderror"
                    name="pekerjaan_inti" id="pekerjaan_inti" value="{{ $item->pekerjaan }}"
                    placeholder="Enter Pekerjaan" @disabled($data_pribadi->status_kawin == 'TK')>
                @if (!$errors->has('pekerjaan_inti'))
                    <p>*Jika Masih Sekolah Isi Siswa Untuk SD - SMA | Isi Mahasiswa Untuk D3 - S2
                    </p>
                @endif

                @error('pekerjaan_inti')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                <label for="ktp_pasangan">KTP Pasangan</label>
                <input type="file" class="form-control @error('ktp_pasangan') is-invalid @enderror" id="ktp_pasangan"
                    name="ktp_pasangan" value="{{ $item->ktp_pasangan }}" placeholder="Enter KTP Pasangan"
                    @disabled($data_pribadi->status_kawin == 'TK')>
                @if (!$errors->has('ktp_pasangan'))
                    <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                @endif

                @error('ktp_pasangan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
            sudah diisi dengan benar!</p>
        <div class="pt-3">
            <button type="submit" class="btn btn-primary" onclick="setRequired(true)"
                @disabled($data_keluarga_inti_status && $data_keluarga_inti_status->status_isi == '1')>Simpan</button>
        </div>
        <hr>

    </form>
@endforeach

<form action="{{ route('data_keluarga_inti.update', ['data_keluarga_inti' => $data_pribadi->id]) }}" method="POST"
    enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">
    <button type="button" class="btn btn-primary btn-block mt-3" data-toggle="modal"
        data-target="#next_data_keluarga_intiModal" onclick="setRequired(false)"
        @disabled($data_keluarga_inti_status && $data_keluarga_inti_status->status_isi == '1')>Next</button>
    <div class="modal fade" id="next_data_keluarga_intiModal">
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
