@php
    $no = 1;
@endphp

<div class="card" id="data-center">
    @if (Auth::user()->role == 'HRD')
        <div class="card-header">
            <a href="{{ url('data_karyawan/create') }}" class="btn btn-primary">Tambah Data Karyawan</a>
        </div>
    @endif
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_karyawan as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            @if ($item->foto == null)
                                <img src="{{ asset('storage/FotoProfil/default.png') }}" class="card-img-center"
                                    alt="User Image" width="50px">
                            @else
                                <img src="{{ asset('storage/FotoProfil/' . $item->foto) }}" class="card-img-center"
                                    alt="User Image" width="40px">
                            @endif
                        </td>
                        <td>
                            @if ($item->nik == null)
                                -
                            @else
                                {{ $item->nik }}
                            @endif
                        </td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>
                            @if ($item->jabatans_id == null)
                                @if (Auth::user()->role == 'HRD')
                                    <a href="#" data-id="{{ $item->id }}"
                                        class="btn btn-sm btn-primary input-btn">Input</a>
                                @else
                                    -
                                @endif
                            @else
                                {{ $item->jabatan->nama_jabatan }}
                            @endif
                        </td>
                        <td>
                            @if ($item->status_user == 'Aktif')
                                <small class="badge badge-success">{{ $item->status_user }}</small>
                            @else
                                <small class="badge badge-danger">{{ $item->status_user }}</small>
                            @endif
                        </td>
                        <td>
                            <a href="#" data-id="{{ $item->id }}"
                                class="btn btn-sm btn-info detail-info-btn">Detail Info</a>
                            @if (Auth::user()->role == 'HRD')
                                <a href="" data-id="{{ $item->id }}" data-nama="{{ $item->nama_lengkap }}"
                                    data-nik="{{ $item->nik }}" data-toggle="modal"
                                    data-target="#editModal"class="btn btn-sm btn-warning btn-edit"><span
                                        class="bi bi-pencil-square"></span></a>
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_lengkap }}" data-nik="{{ $item->nik }}"
                                    data-toggle="modal" data-target="#deleteModal"><span
                                        class="bi bi-trash3"></span></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content bg-warning">
            <form action="" method="POST" id="formEdit">
                @method('PATCH')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Akses Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mb-konfirmasi-edit"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-dark" name="status_isi" value="2">Ya,
                        Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form action="" method="POST" id="formDelete">
                @method('DELETE')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mb-konfirmasi-hapus"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-light">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var detailButtons = document.querySelectorAll('.detail-info-btn');
        detailButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var url = "{{ url('data_karyawan/show') }}" + '?id=' + id;
                window.location.href = url;
            });
        });

        var inputButtons = document.querySelectorAll('.input-btn');
        inputButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var url = "{{ url('data_karyawan') }}" + '/' + id + '/edit';
                window.location.href = url;
            });
        });
    });
</script>

<script>
    $('.btn-edit').click(function() {
        let id = $(this).attr('data-id');
        $('#formEdit').attr('action', '/data_karyawan/' + id);

        let nik = $(this).attr('data-nik');
        let nama = $(this).attr('data-nama');

        if (nik !== '') {
            $('#mb-konfirmasi-edit').text(
                "Apakah Anda Yakin Ingin Membuka Akses Edit Data Karyawan Dengan NIK " +
                nik +
                " Atas Nama " +
                nama + " ?");
        } else {
            $('#mb-konfirmasi-edit').text(
                "Apakah Anda Yakin Ingin Membuka Akses Edit Data Karyawan Dengan NIK - Atas Nama " +
                nama + " ?");
        }
    })

    $('#formEdit [type="submit"]').click(function() {
        $('#formEdit').submit();
    })

    // generate alamat URL untuk proses hapus data 
    $('.btn-hapus').click(function() {
        let id = $(this).attr('data-id');
        $('#formDelete').attr('action', '/data_karyawan/' + id);

        let nik = $(this).attr('data-nik');
        let nama = $(this).attr('data-nama');

        if (nik !== '') {
            $('#mb-konfirmasi-hapus').text("Apakah Anda Yakin Ingin Menghapus Data Karyawan Dengan NIK " + nik +
                " Atas Nama " +
                nama + " ?");
        } else {
            $('#mb-konfirmasi-hapus').text(
                "Apakah Anda Yakin Ingin Membuka Akses Edit Data Karyawan Dengan NIK - Atas Nama " +
                nama + " ?");
        }
    })

    $('#formDelete [type="submit"]').click(function() {
        $('#formDelete').submit();
    })
</script>
