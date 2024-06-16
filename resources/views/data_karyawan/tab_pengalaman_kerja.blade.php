@if (!$pengalaman_kerja_status || $pengalaman_kerja_status->status_isi == '2')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Pengalaman Kerja</h4>
                <small>(Isilah riwayat kerja anda. Jika tidak ada pengalaman kerja sebelumnya, anda dapat
                    melewatkannya)</small>
            </div>
        </div>
        <div class="card-body">

            @if ($pengalaman_kerja->isEmpty())
                <form action="{{ route('pengalaman_kerja.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                                name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                                placeholder="Enter Nama Perusahaan">

                            @error('nama_perusahaan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                name="jabatan" id="jabatan" value="{{ old('jabatan') }}" placeholder="Enter Jabatan">

                            @error('jabatan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="mulai_kerja">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('mulai_kerja') is-invalid @enderror"
                                name="mulai_kerja" id="mulai_kerja"value="{{ old('mulai_kerja') }}"
                                placeholder="Enter Mulai">

                            @error('mulai_kerja')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="akhir_kerja">Tanggal Berakhir</label>
                            <input type="date" class="form-control @error('akhir_kerja') is-invalid @enderror"
                                name="akhir_kerja" id="akhir_kerja"value="{{ old('akhir_kerja') }}"
                                placeholder="Enter Akhir">

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
                                <input type="text" class="form-control @error('gaji') is-invalid @enderror"
                                    name="gaji" id="gaji" value="{{ old('gaji') }}" pattern="[0-9]+"
                                    title="Masukkan hanya angka" placeholder="1234567890">
                            </div>

                            @error('gaji')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="alasan_keluar">Alasan Keluar</label>
                            <input type="text" class="form-control @error('alasan_keluar') is-invalid @enderror"
                                name="alasan_keluar" id="alasan_keluar" value="{{ old('alasan_keluar') }}"
                                placeholder="Enter Alasan Keluar">

                            @error('alasan_keluar')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-check ml-1">
                        <input class="form-check-input" type="checkbox" id="checkbox" @disabled($pengalaman_kerja_status && $pengalaman_kerja_status->status_isi == '1')>
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
                            @disabled($pengalaman_kerja_status && $pengalaman_kerja_status->status_isi == '1')>Tambah
                            Data Lainnya</button>
                        @if ($data_tampungs->isNotEmpty())
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#next_pengalaman_kerjaModal" onclick="setRequired(false)"
                                @disabled($pengalaman_kerja_status && $pengalaman_kerja_status->status_isi == '1')>Next</button>
                        @else
                            <a href="{{ url('data_karyawan?tab=tab_7') }}" class="btn btn-primary"
                                onclick="setRequired(false)" @disabled($pengalaman_kerja_status && $pengalaman_kerja_status->status_isi == '1')>Next</a>
                        @endif
                    </div>
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
                @include('data_karyawan.edit_pengalaman_kerja')
            @endif

            @if ($pengalaman_kerja->isEmpty())
                <div class="mt-3">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center">No</th>
                                <th style="text-align: center">Nama Perusahaan</th>
                                <th style="text-align: center">Jabatan</th>
                                <th style="text-align: center">Tanggal Mulai</th>
                                <th style="text-align: center">Tanggal Berakhir</th>
                                <th style="text-align: center">Gaji</th>
                                <th style="text-align: center">Alasan Keluar</th>
                                <th style="text-align: center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data_tampungs->isNotEmpty())
                                @foreach ($data_tampungs as $item)
                                    <tr>
                                        <td align="center">{{ $no++ }}</td>
                                        <td align="center">{{ $item->nama_perusahaan }}</td>
                                        <td align="center">{{ $item->jabatan }}</td>
                                        <td align="center">
                                            {{ \Carbon\Carbon::parse($item->mulai_kerja)->format('d F Y') }}</td>
                                        <td align="center">
                                            {{ \Carbon\Carbon::parse($item->akhir_kerja)->format('d F Y') }}</td>
                                        <td align="right">Rp. {{ number_format($item->gaji) }}</td>
                                        <td align="center">{{ $item->alasan_keluar }}</td>
                                        <td align="center">
                                            <button class="btn btn-sm btn-danger btn-hapus" data-toggle="modal"
                                                data-target="#delete_pengalaman_kerjaModal"
                                                data-id="{{ $item->id }}"
                                                data-id-form="formDeletePengalamanKerja"><span
                                                    class="bi bi-trash3"></span></button>
                                            <div class="modal fade" id="delete_pengalaman_kerjaModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-danger">
                                                        <form action="" method="POST"
                                                            id="formDeletePengalamanKerja">
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
                                                                <input type="hidden" name="tab" value="tab_6">
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
                                    <td colspan="8" align="center">Belum Ada Data / Belum Melakukan Input Data</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            @endif

        </div>

    </div>
@else
    <div class="card">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center">No</th>
                        <th style="text-align: center">Nama Perusahaan</th>
                        <th style="text-align: center">Jabatan</th>
                        <th style="text-align: center">Tanggal Mulai</th>
                        <th style="text-align: center">Tanggal Berakhir</th>
                        <th style="text-align: center">Gaji</th>
                        <th style="text-align: center">Alasan Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pengalaman_kerja->isNotEmpty())
                        @foreach ($pengalaman_kerja as $item)
                            <tr>
                                <td align="center">{{ $no++ }}</td>
                                <td align="center">{{ $item->nama_perusahaan }}</td>
                                <td align="center">{{ $item->jabatan }}</td>
                                <td align="center">{{ \Carbon\Carbon::parse($item->mulai)->format('d F Y') }}</td>
                                <td align="center">{{ \Carbon\Carbon::parse($item->akhir)->format('d F Y') }}</td>
                                <td align="right">Rp. {{ number_format($item->gaji) }}</td>
                                <td align="center">{{ $item->alasan_keluar }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" align="center">Belum Ada Data / Belum
                                Melakukan Input Data
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endif
