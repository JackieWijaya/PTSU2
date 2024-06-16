@if (!$data_pendidikan_status || $data_pendidikan_status->status_isi == '2')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Data Pendidikan</h4>
                <small>(Isilah riwayat pendidikan anda mulai dari SD hingga pendidikan terakhir yang telah anda
                    selesaikan)</small>
            </div>
        </div>
        <div class="card-body">

            @if ($data_pendidikan->isEmpty())
                <form action="{{ route('data_pendidikan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="jenjang">Jenjang</label>
                            <select name="jenjang" id="jenjang"
                                class="form-control @error('jenjang') is-invalid @enderror">
                                <option value="">-- Pilih Jenjang --</option>
                                <option value="SD"{{ old('jenjang') == 'SD' ? 'selected' : '' }}>
                                    SD
                                </option>
                                <option value="SMP"{{ old('jenjang') == 'SMP' ? 'selected' : '' }}>
                                    SMP
                                </option>
                                <option value="SMA"{{ old('jenjang') == 'SMA' ? 'selected' : '' }}>
                                    SMA
                                </option>
                                <option value="D3"{{ old('jenjang') == 'D3' ? 'selected' : '' }}>
                                    D3
                                </option>
                                <option value="S1"{{ old('jenjang') == 'S1' ? 'selected' : '' }}>
                                    S1
                                </option>
                                <option value="S2"{{ old('jenjang') == 'S2' ? 'selected' : '' }}>
                                    S2
                                </option>
                            </select>

                            @error('jenjang')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="fakultas">Fakultas</label>
                            {{-- <small class="text-muted">(Input "-" Jika Jenjang SD/SMP/SMA)</small> --}}
                            <input type="text" class="form-control @error('fakultas') is-invalid @enderror"
                                name="fakultas" id="fakultas" value="{{ old('fakultas') }}"
                                placeholder="Enter Fakultas">
                            {{-- @if (!$errors->has('fakultas'))
                                            <p>*Input "-" Jika Jenjang SD/SMP/SMA</p>
                                        @endif --}}

                            @error('fakultas')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror"
                                name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah') }}"
                                placeholder="Enter Nama Sekolah">

                            @error('nama_sekolah')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="jurusan">Jurusan</label>
                            {{-- <small class="text-muted">(Input "-" Jika Jenjang SD/SMP)</small> --}}
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                name="jurusan" id="jurusan" value="{{ old('jurusan') }}" placeholder="Enter Jurusan">
                            {{-- @if (!$errors->has('jurusan'))
                                            <p>*Input "-" Jika Jenjang SD/SMP</p>
                                        @endif --}}

                            @error('jurusan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="tahun_masuk">Tahun Masuk</label>
                            <input type="text" class="form-control @error('tahun_masuk') is-invalid @enderror"
                                name="tahun_masuk" id="tahun_masuk" value="{{ old('tahun_masuk') }}"
                                placeholder="Enter Tahun Masuk">

                            @error('tahun_masuk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror"
                                name="tahun_lulus" id="tahun_lulus" value="{{ old('tahun_lulus') }}"
                                placeholder="Enter Tahun Lulus">

                            @error('tahun_lulus')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-check ml-1">
                        <input class="form-check-input" type="checkbox" id="checkbox" @disabled($data_pendidikan_status && $data_pendidikan_status->status_isi == '1')>
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
                            @disabled($data_pendidikan_status && $data_pendidikan_status->status_isi == '1')>Tambah
                            Data Lainnya</button>
                        @if ($data_tampungs->isNotEmpty())
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#next_data_pendidikanModal" onclick="setRequired(false)"
                                @disabled($data_pendidikan_status && $data_pendidikan_status->status_isi == '1')>Next</button>
                        @else
                            <a href="{{ url('data_karyawan?tab=tab_5') }}" class="btn btn-primary"
                                onclick="setRequired(false)" @disabled($data_pendidikan_status && $data_pendidikan_status->status_isi == '1')>Next</a>
                        @endif
                    </div>
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
                @include('data_karyawan.edit_data_pendidikan')
            @endif

            @if ($data_pendidikan->isEmpty())
                <div class="mt-3" id="data-center">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenjang</th>
                                <th>Fakultas</th>
                                <th>Nama Sekolah</th>
                                <th>Jurusan</th>
                                <th>Tahun Masuk</th>
                                <th>Tahun Lulus</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data_tampungs->isNotEmpty())
                                @foreach ($data_tampungs as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->jenjang }}</td>
                                        <td>{{ $item->fakultas }}</td>
                                        <td>{{ $item->nama_sekolah }}</td>
                                        <td>{{ $item->jurusan }}</td>
                                        <td>{{ $item->tahun_masuk }}</td>
                                        <td>{{ $item->tahun_lulus }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger btn-hapus" data-toggle="modal"
                                                data-target="#delete_data_pendidikanModal"
                                                data-id="{{ $item->id }}"
                                                data-id-form="formDeleteDataPendidikan"><span
                                                    class="bi bi-trash3"></span></button>
                                            <div class="modal fade" id="delete_data_pendidikanModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="" method="POST"
                                                            id="formDeleteDataPendidikan">
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
                                                                <input type="hidden" name="tab" value="tab_4">
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
                                    <td colspan="8">Belum Ada Data / Belum Melakukan Input Data</td>
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
                        <th>Jenjang</th>
                        <th>Fakultas</th>
                        <th>Nama Sekolah</th>
                        <th>Jurusan</th>
                        <th>Tahun Masuk</th>
                        <th>Tahun Lulus</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data_pendidikan->isNotEmpty())
                        @foreach ($data_pendidikan as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->jenjang }}</td>
                                <td>{{ $item->fakultas }}</td>
                                <td>{{ $item->nama_sekolah }}</td>
                                <td>{{ $item->jurusan }}</td>
                                <td>{{ $item->tahun_masuk }}</td>
                                <td>{{ $item->tahun_lulus }}</td>
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
        var jenjangSelect = document.getElementById('jenjang');
        var fakultasInput = document.getElementById('fakultas');
        var jurusanInput = document.getElementById('jurusan');
        var form = jenjangSelect.closest('form');

        jenjangSelect.addEventListener('change', function() {
            var jenjang = this.value;

            if (jenjang === 'SD' || jenjang === 'SMP' || jenjang === 'SMA') {
                fakultasInput.value = '-';
                fakultasInput.disabled = true;
            } else {
                fakultasInput.value = '';
                fakultasInput.disabled = false;
            }

            if (jenjang === 'SD' || jenjang === 'SMP') {
                jurusanInput.value = '-';
                jurusanInput.disabled = true;
            } else {
                jurusanInput.value = '';
                jurusanInput.disabled = false;
            }
        });

        form.addEventListener('submit', function() {
            // Enable inputs before submitting the form
            fakultasInput.disabled = false;
            jurusanInput.disabled = false;
        });
    });
</script>
