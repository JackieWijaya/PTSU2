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
                        <td colspan="7">Belum Ada Data / User Belum Melakukan Input Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
