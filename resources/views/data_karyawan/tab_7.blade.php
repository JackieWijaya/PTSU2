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
                @if (isset($bahasa_asing) && $bahasa_asing)
                    <tr>
                        <td>{{ $bahasa_asing->lisan }}</td>
                        <td>{{ $bahasa_asing->tulisan }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="2">Belum Ada Data / User Belum Melakukan Input Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
