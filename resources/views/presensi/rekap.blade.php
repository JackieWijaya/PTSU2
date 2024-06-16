@extends('layout.master')

@section('title')
    Rekap Presensi
@endsection

@section('content')
    <style>
        #data-center td,
        #data-center th {
            text-align: center;
            vertical-align: middle;
        }
    </style>

    <div class="card" id="data-center">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <select id="bulan" class="form-control">
                        <option value="">Pilih Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ isset($bulan) && $bulan == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <input type="number" id="tahun" class="form-control" placeholder="Pilih Tahun" min="2000"
                        max="2100" value="{{ $tahun ?? now()->year }}">
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="datatable table table-hover nowrap text-center align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Jabatan</th>
                        <th>Hadir</th>
                        <th>Terlambat</th>
                        <th>Total Waktu Terlambat</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    {{-- @dd($presensis->data_pribadi); --}}
                    @foreach ($presensis as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                @if ($item->foto == null)
                                    <img src="{{ asset('storage/FotoProfil/default.png') }}" class="card-img-center"
                                        alt="User Image" width="40px">
                                @else
                                    <img src="{{ asset('storage/FotoProfil/' . $item->foto) }}" class="card-img-center"
                                        alt="User Image" width="30px">
                                @endif
                            </td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td>
                                {{-- @dd($item->data_pribadi->jabatan) --}}
                                @if ($item->data_pribadi->jabatan == null)
                                    -
                                @else
                                    {{ $item->data_pribadi->jabatan->nama_jabatan }}
                                @endif
                            </td>
                            <td><small class="badge badge-success">{{ $item->jumlah_kehadiran }} Kali</small></td>
                            <td><small class="badge badge-danger">{{ $item->jumlah_terlambat }} Kali</small></td>
                            <td><small class="badge badge-secondary">{{ $item->total_waktu_terlambat }}</small></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('bulan').addEventListener('change', function() {
            var selectedBulan = this.value;
            var selectedTahun = document.getElementById('tahun').value;
            updateUrl(selectedBulan, selectedTahun);
        });

        document.getElementById('tahun').addEventListener('change', function() {
            var selectedTahun = this.value;
            var selectedBulan = document.getElementById('bulan').value;
            updateUrl(selectedBulan, selectedTahun);
        });

        function updateUrl(bulan, tahun) {
            var currentUrl = new URL(window.location.href);
            if (bulan) {
                currentUrl.searchParams.set('bulan', bulan);
            } else {
                currentUrl.searchParams.delete('bulan');
            }
            if (tahun) {
                currentUrl.searchParams.set('tahun', tahun);
            } else {
                currentUrl.searchParams.delete('tahun');
            }
            window.location.href = currentUrl.toString();
        }
    </script>
@endsection
