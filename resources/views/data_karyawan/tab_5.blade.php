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
                        <td colspan="6">Belum Ada Data / User Belum Melakukan Input Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
