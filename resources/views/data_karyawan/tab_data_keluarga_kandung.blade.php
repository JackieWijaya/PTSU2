@if (!$data_keluarga_kandung_status || $data_keluarga_kandung_status->status_isi == '2')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Data Keluarga Kandung</h4>
                <small>(Terdiri dari ayah, ibu, dan saudara. Jika belum memiliki pasangan, isi data keluarga kandung
                    anda sendiri. Jika sudah, tambahkan juga data keluarga kandung pasangan anda)</small>
            </div>
        </div>
        <div class="card-body">

            @if ($data_keluarga_kandung->isEmpty())
                <form action="{{ route('data_keluarga_kandung.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                            <label for="status_keluarga_kandung">Status Keluarga</label>
                            <select name="status_keluarga_kandung" id="status_keluarga_kandung"
                                class="form-control @error('status_keluarga_kandung') is-invalid @enderror">
                                <option value="">-- Pilih Status Keluarga --</option>
                                <option
                                    value="Ayah Kandung"{{ old('status_keluarga_kandung') == 'Ayah Kandung' ? 'selected' : '' }}>
                                    Ayah Kandung</option>
                                <option
                                    value="Ibu Kandung"{{ old('status_keluarga_kandung') == 'Ibu Kandung' ? 'selected' : '' }}>
                                    Ibu Kandung</option>
                                <option
                                    value="Ayah Mertua"{{ old('status_keluarga_kandung') == 'Ayah Mertua' ? 'selected' : '' }}>
                                    Ayah Mertua</option>
                                <option
                                    value="Ibu Mertua"{{ old('status_keluarga_kandung') == 'Ibu Mertua' ? 'selected' : '' }}>
                                    Ibu Mertua</option>
                                @foreach (range(1, 10) as $i)
                                    <option
                                        value="Saudara {{ $i }}"{{ old('status_keluarga_kandung') == "Saudara $i" ? 'selected' : '' }}>
                                        Saudara {{ $i }}</option>
                                @endforeach
                            </select>

                            @error('status_keluarga_kandung')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                            <label for="nama_anggota_keluarga_kandung">Nama Anggota Keluarga</label>
                            <input type="text"
                                class="form-control @error('nama_anggota_keluarga_kandung') is-invalid @enderror"
                                name="nama_anggota_keluarga_kandung" id="nama_anggota_keluarga_kandung"
                                value="{{ old('nama_anggota_keluarga_kandung') }}"
                                placeholder="Enter Nama Anggota Keluarga">

                            @error('nama_anggota_keluarga_kandung')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                            <label for="jenis_kelamin_kandung">Jenis Kelamin</label>
                            <select name="jenis_kelamin_kandung" id="jenis_kelamin_kandung"
                                class="form-control @error('jenis_kelamin_kandung') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option
                                    value="Laki-Laki"{{ old('jenis_kelamin_kandung') == 'Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki
                                </option>
                                <option
                                    value="Perempuan"{{ old('jenis_kelamin_kandung') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>

                            @error('jenis_kelamin_kandung')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-2 col-md-3 col-sm-12">
                            <label for="tempat_lahir_kandung">Tempat Lahir</label>
                            <input type="text"
                                class="form-control @error('tempat_lahir_kandung') is-invalid @enderror"
                                name="tempat_lahir_kandung" id="tempat_lahir_kandung"
                                value="{{ old('tempat_lahir_kandung') }}" placeholder="Enter Tempat Lahir">

                            @error('tempat_lahir_kandung')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-2 col-md-3 col-sm-12">
                            <label for="tanggal_lahir_kandung">Tanggal Lahir</label>
                            <input type="date"
                                class="form-control @error('tanggal_lahir_kandung') is-invalid @enderror"
                                name="tanggal_lahir_kandung"
                                id="tanggal_lahir_kandung"value="{{ old('tanggal_lahir_kandung') }}"
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
                                <option
                                    value="Belum Sekolah"{{ old('pendidikan_kandung') == 'Belum Sekolah' ? 'selected' : '' }}>
                                    Belum Sekolah
                                </option>
                                <option value="SD"{{ old('pendidikan_kandung') == 'SD' ? 'selected' : '' }}>
                                    SD
                                </option>
                                <option value="SMP"{{ old('pendidikan_kandung') == 'SMP' ? 'selected' : '' }}>
                                    SMP
                                </option>
                                <option value="SMA"{{ old('pendidikan_kandung') == 'SMA' ? 'selected' : '' }}>
                                    SMA
                                </option>
                                <option value="D3"{{ old('pendidikan_kandung') == 'D3' ? 'selected' : '' }}>
                                    D3
                                </option>
                                <option value="S1"{{ old('pendidikan_kandung') == 'S1' ? 'selected' : '' }}>
                                    S1
                                </option>
                                <option value="S2"{{ old('pendidikan_kandung') == 'S2' ? 'selected' : '' }}>
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
                                name="pekerjaan_kandung" id="pekerjaan_kandung" value="{{ old('pekerjaan_kandung') }}"
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

                    <div class="form-check ml-1">
                        <input class="form-check-input" type="checkbox" id="checkbox" @disabled($data_keluarga_kandung_status && $data_keluarga_kandung_status->status_isi == '1')>
                        <label class="form-check-label"><small class="text-bold">Dengan melakukan centang anda
                                dengan kesadaran penuh bertanggung jawab atas keaslian data yang
                                disimpan</small></label>
                    </div>
                    <div class="pb-3">
                        <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
                            sudah diisi dengan benar!</p>
                    </div>
                    <div class="pt-3">
                        <button type="submit" class="btn btn-primary" onclick="setRequired(true)"
                            @disabled($data_keluarga_kandung_status && $data_keluarga_kandung_status->status_isi == '1')>Tambah
                            Data Lainnya</button>
                        @if ($data_tampungs->isNotEmpty())
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#next_data_keluarga_kandungModal" onclick="setRequired(false)"
                                @disabled($data_keluarga_kandung_status && $data_keluarga_kandung_status->status_isi == '1')>Next</button>
                        @else
                            <a href="{{ url('data_karyawan?tab=tab_4') }}" class="btn btn-primary"
                                onclick="setRequired(false)" @disabled($data_keluarga_kandung_status && $data_keluarga_kandung_status->status_isi == '1')>Next</a>
                        @endif
                    </div>
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
                                    <button type="button" class="btn btn-outline-light"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-outline-light" id="confirmBtn"
                                        name="status_isi" value="1">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            @else
                @include('data_karyawan.edit_data_keluarga_kandung')
            @endif

            @if ($data_keluarga_kandung->isEmpty())
                <div class="mt-3" id="data-center">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status Keluarga</th>
                                <th>Nama Anggota Keluarga</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Pendidikan</th>
                                <th>Pekerjaan</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data_tampungs->isNotEmpty())
                                @foreach ($data_tampungs as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->status_keluarga_kandung }}</td>
                                        <td>{{ $item->nama_anggota_keluarga_kandung }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->tempat_lahir_kandung }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir_kandung)->format('d F Y') }}
                                        </td>
                                        <td>{{ $item->pendidikan_kandung }}</td>
                                        <td>{{ $item->pekerjaan_kandung }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger btn-hapus" data-toggle="modal"
                                                data-target="#delete_data_keluarga_kandungModal"
                                                data-id="{{ $item->id }}"
                                                data-id-form="formDeleteDataKeluragaKandung"><span
                                                    class="bi bi-trash3"></span></button>
                                            <div class="modal fade" id="delete_data_keluarga_kandungModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="" method="POST"
                                                            id="formDeleteDataKeluragaKandung">
                                                            @method('DELETE')
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="tab" value="tab_3">
                                                                <p>Apakah Anda Yakin Ingin Menghapus Data Ini ?</p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-outline-light"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-outline-light">Ya,
                                                                    Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">Belum Ada Data / Belum Melakukan Input Data</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            @endif

        </div>

    </div>
@else
    <div class="card" id="data-center">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status Keluarga</th>
                        <th>Nama Anggota Keluarga</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data_keluarga_kandung->isNotEmpty())
                        @foreach ($data_keluarga_kandung as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->status_keluarga }}</td>
                                <td>{{ $item->nama_anggota_keluarga }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->tempat_lahir }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}</td>
                                <td>{{ $item->pendidikan }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">Belum Ada Data / Belum Melakukan Input Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var statusKeluargaKandung = document.getElementById('status_keluarga_kandung');
        var jenisKelaminKandung = document.getElementById('jenis_kelamin_kandung');

        statusKeluargaKandung.addEventListener('change', function() {
            var statusKeluarga = this.value;

            if (statusKeluarga === 'Ayah Kandung' || statusKeluarga === 'Ayah Mertua') {
                jenisKelaminKandung.value = 'Laki-Laki';
            } else if (statusKeluarga === 'Ibu Kandung' || statusKeluarga === 'Ibu Mertua') {
                jenisKelaminKandung.value = 'Perempuan';
            } else {
                jenisKelaminKandung.value = ''; // Kosongkan jika status keluarga tidak sesuai
            }
        });
    });
</script>
