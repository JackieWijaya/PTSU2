<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered text-nowrap">
            <colgroup>
                <col style="width: 16.66%;">
                <col style="width: 16.66%;">
                <col style="width: 16.66%;">
                <col style="width: 16.66%;">
                <col style="width: 16.66%;">
                <col style="width: 16.66%;">
            </colgroup>
            <tbody>
                <tr>
                    <th>NIK</th>
                    <td>
                        @if ($data_pribadi->nik == null)
                            -
                        @else
                            {{ $data_pribadi->nik }}
                        @endif
                    </td>
                    <th>Nama Lengkap</th>
                    <td>{{ $data_pribadi->nama_lengkap }}</td>
                    <th>No HP</th>
                    <td>{{ $data_pribadi->no_hp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data_pribadi->email }}</td>
                    <th>Tempat Lahir</th>
                    <td>{{ $data_pribadi->tempat_lahir }}</td>
                    <th>Tanggal Lahir</th>
                    <td>
                        @if ($data_pribadi->tanggal_lahir == null || $data_pribadi->tanggal_lahir == '-')
                            -
                        @else
                            {{ \Carbon\Carbon::parse($data_pribadi->tanggal_lahir)->format('d F Y') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $data_pribadi->jenis_kelamin }}</td>
                    <th>Golongan Darah</th>
                    <td>{{ $data_pribadi->golongan_darah }}</td>
                    <th>Agama</th>
                    <td>{{ $data_pribadi->agama }}</td>
                </tr>
                <tr>
                    <th>Pendidikan Terakhir</th>
                    <td>{{ $data_pribadi->pendidikan_terakhir }}</td>
                    <th>Status Kawin</th>
                    <td>
                        @if (is_null($data_pribadi->status_kawin) || $data_pribadi->status_kawin === '')
                            -
                        @elseif ($data_pribadi->status_kawin == 'TK')
                            Tidak Kawin
                        @elseif ($data_pribadi->status_kawin == 'K0')
                            Kawin 0 Tanggungan
                        @elseif ($data_pribadi->status_kawin == 'K1')
                            Kawin 1 Tanggungan
                        @elseif ($data_pribadi->status_kawin == 'K2')
                            Kawin 2 Tanggungan
                        @elseif ($data_pribadi->status_kawin == 'K3')
                            Kawin 3 Tanggungan
                        @endif
                    </td>
                    <th>Tanggal Nikah</th>
                    <td>
                        @if (is_null($data_pribadi->tanggal_nikah) || $data_pribadi->tanggal_nikah === '')
                            -
                        @else
                            {{ \Carbon\Carbon::parse($data_pribadi->tanggal_nikah)->format('d F Y') }}
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Buku Nikah</th>
                    <td>
                        @if (is_null($data_pribadi->buku_nikah) || $data_pribadi->buku_nikah === '' || $data_pribadi->buku_nikah === '-')
                            -
                        @else
                            <a href="{{ asset('storage/BukuNikah/' . $data_pribadi->buku_nikah) }}">Lihat</a>
                        @endif
                    </td>
                    <th>KTP</th>
                    <td>
                        @if (is_null($data_pribadi->ktp) || $data_pribadi->ktp === '' || $data_pribadi->ktp === '-')
                            -
                        @else
                            <a href="{{ asset('storage/DataKaryawan/' . $data_pribadi->ktp) }}">Lihat</a>
                        @endif
                    </td>
                    <th>Kartu Keluarga</th>
                    <td>
                        @if (is_null($data_pribadi->kk) || $data_pribadi->kk === '' || $data_pribadi->kk === '-')
                            -
                        @else
                            <a href="{{ asset('storage/DataKaryawan/' . $data_pribadi->kk) }}">Lihat</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>SIM</th>
                    <td>
                        @if (is_null($data_pribadi->sim) || $data_pribadi->sim === '' || $data_pribadi->sim === '-')
                            -
                        @else
                            <a href="{{ asset('storage/DataKaryawan/' . $data_pribadi->sim) }}">Lihat</a>
                        @endif
                    </td>
                    <th>NPWP</th>
                    <td>
                        @if (is_null($data_pribadi->npwp) || $data_pribadi->npwp === '' || $data_pribadi->npwp === '-')
                            -
                        @else
                            <a href="{{ asset('storage/DataKaryawan/' . $data_pribadi->npwp) }}">Lihat</a>
                        @endif
                    </td>
                    <th>Rekening</th>
                    <td>
                        @if (is_null($data_pribadi->rekening) || $data_pribadi->rekening === '' || $data_pribadi->rekening === '-')
                            -
                        @else
                            <a href="{{ asset('storage/DataKaryawan/' . $data_pribadi->rekening) }}">Lihat</a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>BPJS Kesehatan</th>
                    <td>
                        @if (is_null($data_pribadi->bpjs_kesehatan) ||
                                $data_pribadi->bpjs_kesehatan === '' ||
                                $data_pribadi->bpjs_kesehatan === '-')
                            -
                        @else
                            <a href="{{ asset('storage/DataKaryawan/' . $data_pribadi->bpjs_kesehatan) }}">Lihat</a>
                        @endif
                    </td>
                    <th>BPJS Ketenagakerjaan</th>
                    <td>
                        @if (is_null($data_pribadi->bpjs_ketenagakerjaan) ||
                                $data_pribadi->bpjs_ketenagakerjaan === '' ||
                                $data_pribadi->bpjs_ketenagakerjaan === '-')
                            -
                        @else
                            <a
                                href="{{ asset('storage/DataKaryawan/' . $data_pribadi->bpjs_ketenagakerjaan) }}">Lihat</a>
                        @endif
                    </td>
                    <th>Jabatan</th>
                    <td>
                        @if (is_null($data_pribadi->jabatans_id) || $data_pribadi->jabatans_id === '')
                            -
                        @else
                            {{ $data_pribadi->jabatan->nama_jabatan }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Devisi</th>
                    <td>
                        @if (is_null($data_pribadi->devisis_id) || $data_pribadi->devisis_id === '')
                            -
                        @else
                            {{ $data_pribadi->devisi->nama_devisi }}
                        @endif
                    </td>
                    <th>Golongan</th>
                    <td>
                        @if (is_null($data_pribadi->golongan) || $data_pribadi->golongan === '')
                            -
                        @else
                            {{ $data_pribadi->golongan }}
                        @endif
                    </td>
                    <th>Tanggal Masuk Kerja</th>
                    <td>
                        @if (is_null($data_pribadi->tanggal_masuk_kerja) || $data_pribadi->tanggal_masuk_kerja === '')
                            -
                        @else
                            {{ \Carbon\Carbon::parse($data_pribadi->tanggal_masuk_kerja)->format('d F Y') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td colspan="5">{{ $data_pribadi->alamat }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
