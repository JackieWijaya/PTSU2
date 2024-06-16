@if (!$bahasa_asing || $bahasa_asing->status_isi == '2')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Bahasa Asing</h4>
                <small>(Nilai tingkat kemahiran anda dalam berbahasa asing, baik lisan maupun tulisan)</small>
            </div>
        </div>
        <div class="card-body">

            @if ($bahasa_asing == null)
                <form action="{{ route('bahasa_asing.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <input type="hidden" name="id" value="{{ $data_pribadi->id }}">

                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="lisan">Lisan</label>
                            <select name="lisan" id="lisan"
                                class="form-control @error('lisan') is-invalid @enderror">
                                <option value="">-- Pilih Nilai Keahlian --</option>
                                <option value="Cukup"{{ old('lisan') == 'Cukup' ? 'selected' : '' }}>
                                    Cukup
                                </option>
                                <option value="Sedang"{{ old('lisan') == 'Sedang' ? 'selected' : '' }}>
                                    Sedang
                                </option>
                                <option value="Baik"{{ old('lisan') == 'Baik' ? 'selected' : '' }}>
                                    Baik
                                </option>
                            </select>

                            @error('lisan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="tulisan">Tulisan</label>
                            <select name="tulisan" id="tulisan"
                                class="form-control @error('tulisan') is-invalid @enderror">
                                <option value="">-- Pilih Nilai Keahlian --</option>
                                <option value="Cukup"{{ old('tulisan') == 'Cukup' ? 'selected' : '' }}>
                                    Cukup
                                </option>
                                <option value="Sedang"{{ old('tulisan') == 'Sedang' ? 'selected' : '' }}>
                                    Sedang
                                </option>
                                <option value="Baik"{{ old('tulisan') == 'Baik' ? 'selected' : '' }}>
                                    Baik
                                </option>
                            </select>

                            @error('tulisan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-check ml-1">
                        <input class="form-check-input" type="checkbox" id="checkbox" @disabled($bahasa_asing && $bahasa_asing->status_isi == '1')>
                        <label class="form-check-label"><small class="text-bold">Dengan melakukan centang anda
                                dengan kesadaran penuh bertanggung jawab atas keaslian data yang
                                disimpan</small></label>
                    </div>
                    <div class="pb-3">
                        <p class="text-danger">*Semua data yang disimpan tidak dapat diubah, pastikan semua inputan
                            sudah diisi dengan benar!</p>
                    </div>
                    <div class="pt-3">
                        <input type="hidden" name="status_isi" value="1">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#simpan_bahasa_asingModal" onclick="setRequired(true)"
                            @disabled($bahasa_asing && $bahasa_asing->status_isi == '1')>Simpan</button>
                    </div>
                    <div class="modal fade" id="simpan_bahasa_asingModal">
                        <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                                <div class="modal-header">
                                    <h4 class="modal-title">Konfirmasi Simpan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Data akan disimpan dan tidak dapat diubah atau ditambahkan. Apakah anda yakin
                                        ingin
                                        lanjut ?</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-light"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-outline-light">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            @else
                @include('data_karyawan.edit_bahasa_asing')
            @endif

        </div>

    </div>
@else
    <div class="card" id="data-center">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nilai Keahlian Lisan</th>
                        <th>Nilai Keahlian Tulisan</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($bahasa_asing)
                        <tr>
                            <td>{{ $bahasa_asing->lisan }}</td>
                            <td>{{ $bahasa_asing->tulisan }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="2">Belum Ada Data / Belum Melakukan Input Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endif
