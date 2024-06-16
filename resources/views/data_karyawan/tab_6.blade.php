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
                        <td colspan="7" align="center">Belum Ada Data / User Belum Melakukan Input Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
