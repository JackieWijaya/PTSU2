@if (!$data_keluarga_inti_status || $data_keluarga_inti_status->status_isi == '2')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Data Keluarga Inti</h4>
                <small>(Terdiri dari ayah, ibu, dan anak. Isilah sesuai kondisi keluarga anda, termasuk diri
                    anda sendiri
                    baik sebagai suami ataupun istri)</small>
            </div>
        </div>
        <div class="card-body">

            @if (!$data_keluarga_inti_status)
                <form action="{{ route('data_keluarga_inti.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="nik">NIK</label>
                            <small class="text-muted">(Isi 0 Jika Belum Ada)</small>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                id="nik" value="{{ old('nik') }}" placeholder="Enter NIK"
                                @disabled($data_pribadi->status_kawin == 'TK')>

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
                                <option value="Istri"{{ old('status_keluarga_inti') == 'Istri' ? 'selected' : '' }}>
                                    Istri</option>
                                <option value="Suami"{{ old('status_keluarga_inti') == 'Suami' ? 'selected' : '' }}>
                                    Suami</option>
                                @foreach (range(1, 10) as $i)
                                    <option
                                        value="Anak {{ $i }}"{{ old('status_keluarga_inti') == "Anak $i" ? 'selected' : '' }}>
                                        Anak {{ $i }}</option>
                                @endforeach
                            </select>

                            @error('status_keluarga_inti')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="nama_anggota_keluarga_inti">Nama Anggota Keluarga</label>
                            <input type="text"
                                class="form-control @error('nama_anggota_keluarga_inti') is-invalid @enderror"
                                name="nama_anggota_keluarga_inti" id="nama_anggota_keluarga_inti"
                                value="{{ old('nama_anggota_keluarga_inti') }}"
                                placeholder="Enter Nama Anggota Keluarga" @disabled($data_pribadi->status_kawin == 'TK')>

                            @error('nama_anggota_keluarga_inti')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="tempat_lahir_inti">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir_inti') is-invalid @enderror"
                                name="tempat_lahir_inti" id="tempat_lahir_inti" value="{{ old('tempat_lahir_inti') }}"
                                placeholder="Enter Tempat Lahir" @disabled($data_pribadi->status_kawin == 'TK')>

                            @error('tempat_lahir_inti')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                            <label for="tanggal_lahir_inti">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir_inti') is-invalid @enderror"
                                name="tanggal_lahir_inti"
                                id="tanggal_lahir_inti"value="{{ old('tanggal_lahir_inti') }}"
                                placeholder="Enter Tanggal Lahir" @disabled($data_pribadi->status_kawin == 'TK')>

                            @error('tanggal_lahir_inti')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                            <label for="pendidikan_inti">Pendidikan</label>
                            <select name="pendidikan_inti" id="pendidikan_inti"
                                class="form-control @error('pendidikan_inti') is-invalid @enderror"
                                @disabled($data_pribadi->status_kawin == 'TK')>
                                <option value="">-- Pilih Pendidikan --</option>
                                <option
                                    value="Belum Sekolah"{{ old('pendidikan_inti') == 'Belum Sekolah' ? 'selected' : '' }}>
                                    Belum Sekolah
                                </option>
                                <option value="SD"{{ old('pendidikan_inti') == 'SD' ? 'selected' : '' }}>
                                    SD
                                </option>
                                <option value="SMP"{{ old('pendidikan_inti') == 'SMP' ? 'selected' : '' }}>
                                    SMP
                                </option>
                                <option value="SMA"{{ old('pendidikan_inti') == 'SMA' ? 'selected' : '' }}>
                                    SMA
                                </option>
                                <option value="D3"{{ old('pendidikan_inti') == 'D3' ? 'selected' : '' }}>
                                    D3
                                </option>
                                <option value="S1"{{ old('pendidikan_inti') == 'S1' ? 'selected' : '' }}>
                                    S1
                                </option>
                                <option value="S2"{{ old('pendidikan_inti') == 'S2' ? 'selected' : '' }}>
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
                                name="pekerjaan_inti" id="pekerjaan_inti" value="{{ old('pekerjaan_inti') }}"
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
                            <input type="file" class="form-control @error('ktp_pasangan') is-invalid @enderror"
                                id="ktp_pasangan" name="ktp_pasangan" value="{{ old('ktp_pasangan') }}"
                                placeholder="Enter KTP Pasangan" @disabled($data_pribadi->status_kawin == 'TK')>
                            @if (!$errors->has('ktp_pasangan'))
                                <p>*Ukuran File Maks 800 KB | Format .jpg, .jpeg, atau .png</p>
                            @endif

                            @error('ktp_pasangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-check ml-1">
                        <input class="form-check-input" type="checkbox" id="checkbox" @disabled(
                            ($data_keluarga_inti_status && $data_keluarga_inti_status->status_isi == '1') ||
                                $data_pribadi->status_kawin == 'TK')>
                        <label class="form-check-label"><small class="text-bold">Dengan melakukan centang anda
                                dengan
                                kesadaran penuh bertanggung jawab atas keaslian data yang disimpan</small></label>
                    </div>
                    <div class="pb-3">
                        <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
                            sudah diisi dengan benar!</p>
                    </div>
                    <div class="pt-3">
                        <button type="submit" class="btn btn-primary" onclick="setRequired(true)"
                            @disabled(
                                ($data_keluarga_inti_status && $data_keluarga_inti_status->status_isi == '1') ||
                                    $data_pribadi->status_kawin == 'TK')>Tambah
                            Data Lainnya</button>
                        @if ($data_tampungs->isNotEmpty())
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#next_data_keluarga_intiModal" onclick="setRequired(false)"
                                @disabled(
                                    ($data_keluarga_inti_status && $data_keluarga_inti_status->status_isi == '1') ||
                                        $data_pribadi->status_kawin == 'TK')>Next</button>
                        @else
                            <a href="{{ url('data_karyawan?tab=tab_3') }}" class="btn btn-primary"
                                onclick="setRequired(false)" @disabled(
                                    ($data_keluarga_inti_status && $data_keluarga_inti_status->status_isi == '1') ||
                                        $data_pribadi->status_kawin == 'TK')>Next</a>
                        @endif
                    </div>
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
                @include('data_karyawan.edit_data_keluarga_inti')
            @endif

            @if ($data_keluarga_inti->isEmpty())
                <div class="mt-3" id="data-center">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Status</th>
                                <th>Nama</th>
                                <th>KTP Pasangan</th>
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
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->status_keluarga_inti }}</td>
                                        <td>{{ $item->nama_anggota_keluarga_inti }}</td>
                                        <td>
                                            @if ($item->ktp_pasangan == '-')
                                                {{ $item->ktp_pasangan }}
                                            @else
                                                <a
                                                    href="{{ asset('storage/DataKaryawan/' . $item->ktp_pasangan) }}">Lihat</a>
                                            @endif
                                        </td>
                                        <td>{{ $item->tempat_lahir_inti }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir_inti)->format('d F Y') }}
                                        </td>
                                        <td>{{ $item->pendidikan_inti }}</td>
                                        <td>{{ $item->pekerjaan_inti }}</td>

                                        <td>
                                            <button class="btn btn-sm btn-danger btn-hapus" data-toggle="modal"
                                                data-target="#delete_data_keluarga_intiModal"
                                                data-id="{{ $item->id }}"
                                                data-id-form="formDeleteDataKeluragaInti"><span
                                                    class="bi bi-trash3"></span></button>
                                            <div class="modal fade" id="delete_data_keluarga_intiModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="" method="POST"
                                                            id="formDeleteDataKeluragaInti">
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
                                                                <input type="hidden" name="tab" value="tab_2">
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
                                    <td colspan="10">Belum Ada Data / Belum Melakukan Input Data</td>
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
                        <th>NIK</th>
                        <th>Status</th>
                        <th>Nama</th>
                        <th>KTP Pasangan</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data_keluarga_inti->isNotEmpty())
                        @foreach ($data_keluarga_inti as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->status_keluarga }}</td>
                                <td>{{ $item->nama_anggota_keluarga }}</td>
                                <td>
                                    @if ($item->ktp_pasangan == '-')
                                        -
                                    @else
                                        <a href="{{ asset('storage/DataKaryawan/' . $item->ktp_pasangan) }}">Lihat</a>
                                    @endif
                                </td>
                                <td>{{ $item->tempat_lahir }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}</td>
                                <td>{{ $item->pendidikan }}</td>
                                <td>{{ $item->pekerjaan }}</td>
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
    </div>
@endif

<script>
    // Function to toggle visibility of fields based on marital status
    function toggleMaritalFields() {
        var statusKeluargaInti = document.getElementById('status_keluarga_inti').value;
        var ktpPasanganField = document.getElementById('ktp_pasangan').closest('.form-group');

        // Check if marital status is selected and not "Tidak Kawin"
        if (statusKeluargaInti === 'Istri' || statusKeluargaInti === 'Suami') {
            ktpPasanganField.style.display = 'block';
        } else {
            ktpPasanganField.style.display = 'none';
        }
    }

    // Call the function initially to set the fields based on the current value of status_kawin
    toggleMaritalFields();

    // Add event listener to status_kawin field to toggle visibility of other fields
    document.getElementById('status_keluarga_inti').addEventListener('change', function() {
        toggleMaritalFields();
    });

    // Hide fields if marital status is not selected initially
    document.addEventListener('DOMContentLoaded', function() {
        toggleMaritalFields();
    });
</script>
