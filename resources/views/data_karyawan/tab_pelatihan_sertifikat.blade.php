@if (!$pelatihan_sertifikat_status || $pelatihan_sertifikat_status->status_isi == '2')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Sertifikat Pelatihan</h4>
                <small>(Silakan unggah sertifikat atau penghargaan yang pernah anda dapatkan. Jika tidak ada, anda dapat
                    melewatkannya)</small>
            </div>
        </div>
        <div class="card-body">

            @if ($pelatihan_sertifikat->isEmpty())
                <form action="{{ route('pelatihan_sertifikat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="nama_lembaga">Nama Lembaga</label>
                            <input type="text" class="form-control @error('nama_lembaga') is-invalid @enderror"
                                name="nama_lembaga" id="nama_lembaga" value="{{ old('nama_lembaga') }}"
                                placeholder="Enter Nama Lembaga">

                            @error('nama_lembaga')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="jenis">Jenis</label>
                            <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                name="jenis" id="jenis" value="{{ old('jenis') }}" placeholder="Enter Jenis">
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
                                name="mulai_pelatihan" id="mulai_pelatihan"value="{{ old('mulai_pelatihan') }}"
                                placeholder="Enter Mulai">

                            @error('mulai_pelatihan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12">
                            <label for="akhir_pelatihan">Tanggal Berakhir</label>
                            <input type="date" class="form-control @error('akhir_pelatihan') is-invalid @enderror"
                                name="akhir_pelatihan" id="akhir_pelatihan"value="{{ old('akhir_pelatihan') }}"
                                placeholder="Enter Akhir">

                            @error('akhir_pelatihan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label for="sertifikat">Sertifikat / File Bukti</label>
                            <input type="file" class="form-control @error('sertifikat') is-invalid @enderror"
                                id="sertifikat" name="sertifikat" value="{{ old('sertifikat') }}"
                                placeholder="Enter Sertifikat">
                            @if (!$errors->has('sertifikat'))
                                <p>*Ukuran File Maks 2 MB | Format .jpg, .jpeg, .png, atau .pdf</p>
                            @endif

                            @error('sertifikat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-check ml-1">
                        <input class="form-check-input" type="checkbox" id="checkbox" @disabled($pelatihan_sertifikat_status && $pelatihan_sertifikat_status->status_isi == '1')>
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
                            @disabled($pelatihan_sertifikat_status && $pelatihan_sertifikat_status->status_isi == '1')>Tambah
                            Data Lainnya</button>
                        @if ($data_tampungs->isNotEmpty())
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#next_pelatihan_sertifikatModal" onclick="setRequired(false)"
                                @disabled($pelatihan_sertifikat_status && $pelatihan_sertifikat_status->status_isi == '1')>Next</button>
                        @else
                            <a href="{{ url('data_karyawan?tab=tab_6') }}" class="btn btn-primary"
                                onclick="setRequired(false)" @disabled($pelatihan_sertifikat_status && $pelatihan_sertifikat_status->status_isi == '1')>Next</a>
                        @endif
                    </div>
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
                @include('data_karyawan.edit_pelatihan_sertifikat')
            @endif

            @if ($pelatihan_sertifikat->isEmpty())
                <div class="mt-3" id="data-center">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lembaga</th>
                                <th>Jenis</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Sertifikat</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data_tampungs->isNotEmpty())
                                @foreach ($data_tampungs as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama_lembaga }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->mulai_pelatihan)->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->akhir_pelatihan)->format('d F Y') }}</td>
                                        <td><a
                                                href="{{ asset('storage/DataKaryawan/' . $item->sertifikat) }}">Lihat</a>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger btn-hapus" data-toggle="modal"
                                                data-target="#delete_pelatihan_sertifikatModal"
                                                data-id="{{ $item->id }}"
                                                data-id-form="formDeletePelatihanSertifikat"><span
                                                    class="bi bi-trash3"></span></button>
                                            <div class="modal fade" id="delete_pelatihan_sertifikatModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="" method="POST"
                                                            id="formDeletePelatihanSertifikat">
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
                                                                <input type="hidden" name="tab" value="tab_5">
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
                                    <td colspan="7">Belum Ada Data / Belum Melakukan Input Data</td>
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
                        <th>Nama Lembaga</th>
                        <th>Jenis</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pelatihan_sertifikat->isNotEmpty())
                        @foreach ($pelatihan_sertifikat as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_lembaga }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->mulai)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->akhir)->format('d F Y') }}</td>
                                <td><a href="{{ asset('storage/DataKaryawan/' . $item->sertifikat) }}">Lihat</a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Belum Ada Data / Belum Melakukan Input Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endif
