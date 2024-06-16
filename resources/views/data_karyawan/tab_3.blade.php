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
                        <td colspan="8">Belum Ada Data / User Belum Melakukan Input Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
