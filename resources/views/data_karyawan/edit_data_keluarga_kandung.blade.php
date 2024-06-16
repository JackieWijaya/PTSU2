@foreach ($data_keluarga_kandung as $item)
    <form action="{{ route('data_keluarga_kandung.update', ['data_keluarga_kandung' => $data_pribadi->id]) }}"
        method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="row">
            <input type="hidden" name="id" value="{{ $item->id }}">
            <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">

            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <label for="status_keluarga_kandung">Status Keluarga</label>
                <select name="status_keluarga_kandung" id="status_keluarga_kandung"
                    class="form-control status_keluarga_inti @error('status_keluarga_kandung') is-invalid @enderror">
                    <option value="">-- Pilih Status Keluarga --</option>
                    <option value="Ayah Kandung"{{ $item->status_keluarga == 'Ayah Kandung' ? 'selected' : '' }}>
                        Ayah Kandung</option>
                    <option value="Ibu Kandung"{{ $item->status_keluarga == 'Ibu Kandung' ? 'selected' : '' }}>
                        Ibu Kandung</option>
                    <option value="Ayah Mertua"{{ $item->status_keluarga == 'Ayah Mertua' ? 'selected' : '' }}>
                        Ayah Mertua</option>
                    <option value="Ibu Mertua"{{ $item->status_keluarga == 'Ibu Mertua' ? 'selected' : '' }}>
                        Ibu Mertua</option>
                    @foreach (range(1, 10) as $i)
                        <option
                            value="Saudara {{ $i }}"{{ $item->status_keluarga == "Saudara $i" ? 'selected' : '' }}>
                            Saudara {{ $i }}</option>
                    @endforeach
                </select>

                @error('status_keluarga_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <label for="nama_anggota_keluarga_kandung">Nama Anggota Keluarga</label>
                <input type="text" class="form-control @error('nama_anggota_keluarga_kandung') is-invalid @enderror"
                    name="nama_anggota_keluarga_kandung" id="nama_anggota_keluarga_kandung"
                    value="{{ $item->nama_anggota_keluarga }}" placeholder="Enter Nama Anggota Keluarga">

                @error('nama_anggota_keluarga_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <label for="jenis_kelamin_kandung">Jenis Kelamin</label>
                <select name="jenis_kelamin_kandung" id="jenis_kelamin_kandung"
                    class="form-control @error('jenis_kelamin_kandung') is-invalid @enderror">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-Laki"{{ $item->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                        Laki-Laki
                    </option>
                    <option value="Perempuan"{{ $item->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>

                @error('jenis_kelamin_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-2 col-md-3 col-sm-12">
                <label for="tempat_lahir_kandung">Tempat Lahir</label>
                <input type="text" class="form-control @error('tempat_lahir_kandung') is-invalid @enderror"
                    name="tempat_lahir_kandung" id="tempat_lahir_kandung" value="{{ $item->tempat_lahir }}"
                    placeholder="Enter Tempat Lahir">

                @error('tempat_lahir_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-2 col-md-3 col-sm-12">
                <label for="tanggal_lahir_kandung">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir_kandung') is-invalid @enderror"
                    name="tanggal_lahir_kandung" id="tanggal_lahir_kandung"value="{{ $item->tanggal_lahir }}"
                    placeholder="Enter Tanggal Lahir">

                @error('tanggal_lahir_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-2 col-md-6 col-sm-12">
                <label for="pendidikan_kandung">Pendidikan</label>
                <select name="pendidikan_kandung" id="pendidikan_kandung"
                    class="form-control @error('pendidikan_kandung') is-invalid @enderror">
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

                @error('pendidikan_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                <label for="pekerjaan_kandung">Pekerjaan</label>
                <small class="text-muted">(Isi - Jika Pendidikan Belum Sekolah)</small>
                <input type="text" class="form-control @error('pekerjaan_kandung') is-invalid @enderror"
                    name="pekerjaan_kandung" id="pekerjaan_kandung" value="{{ $item->pekerjaan }}"
                    placeholder="Enter Pekerjaan">
                @if (!$errors->has('pekerjaan_kandung'))
                    <p>*Jika Masih Sekolah Isi Siswa Untuk SD - SMA | Isi Mahasiswa Untuk D3 - S2
                    </p>
                @endif

                @error('pekerjaan_kandung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
            sudah diisi dengan benar!</p>
        <div class="pt-3">
            <button type="submit" class="btn btn-primary" onclick="setRequired(true)"
                @disabled($data_keluarga_kandung_status && $data_keluarga_kandung_status->status_isi == '1')>Simpan</button>
        </div>
        <hr>

    </form>
@endforeach

<form action="{{ route('data_keluarga_kandung.update', ['data_keluarga_kandung' => $data_pribadi->id]) }}"
    method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    <input type="hidden" name="data_pribadi_id" value="{{ $data_pribadi->id }}">
    <button type="button" class="btn btn-primary btn-block mt-3" data-toggle="modal"
        data-target="#next_data_keluarga_kandungModal" onclick="setRequired(false)"
        @disabled($data_keluarga_kandung_status && $data_keluarga_kandung_status->status_isi == '1')>Next</button>
    <div class="modal fade" id="next_data_keluarga_kandungModal">
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
