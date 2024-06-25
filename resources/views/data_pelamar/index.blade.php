@extends('layout.master')

@section('title', 'Data Pelamar')

@section('content')
    <style>
        td,
        th {
            text-align: center;
        }
    </style>

    @php
        $no = 1;
    @endphp

    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Info</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                        <th>Pendidikan</th>
                        <th>Tanggal Lamar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($data_pelamars) --}}
                    @foreach ($data_pelamars as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <button id="info" class="btn btn-sm btn-info" data-toggle="modal" data-target="#infoModal"
                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama_lengkap }}"
                                    data-no="{{ $item->no_hp }}" data-email="{{ $item->email }}"
                                    data-tgllahir="{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}"
                                    data-tmptlahir="{{ $item->tempat_lahir }}" data-jk="{{ $item->jenis_kelamin }}"
                                    data-alamat="{{ $item->alamat }}" data-pendidikan="{{ $item->pendidikan_terakhir }}"
                                    data-agama="{{ $item->agama }}" data-goldar="{{ $item->golongan_darah }}"
                                    data-statuskawin="{{ $item->status_kawin }}"
                                    data-tglnikah="{{ $item->tanggal_nikah ? \Carbon\Carbon::parse($item->tanggal_nikah)->format('d F Y') : '-' }}"
                                    data-bukunikah="{{ $item->buku_nikah }}"
                                    data-tgllamar="{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}"
                                    data-status="{{ $item->status }}"><i class="bi bi-info-circle"></i></button>
                            </td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}</td>
                            <td>{{ $item->pendidikan_terakhir }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">

                                    @if ($item->status == null)
                                        @if (Auth::user()->role == 'Manager')
                                            <small class="badge badge-secondary">Menunggu</small>
                                        @else
                                            <button class="btn btn-sm btn-success mr-1 btn-diterima" type="button"
                                                data-toggle="modal" data-target="#diterimaModal"
                                                data-id="{{ $item->id }}" data-nama="{{ $item->nama_lengkap }}">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-ditolak" type="button"
                                                data-toggle="modal" data-target="#ditolakModal"
                                                data-id="{{ $item->id }}" data-nama="{{ $item->nama_lengkap }}">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        @endif
                                    @else
                                        @if ($item->status == 'Diterima')
                                            <small class="badge badge-success">Diterima</small>
                                        @else
                                            <small class="badge badge-danger">Ditolak</small>
                                        @endif
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('data_pelamar.info_modal')
    @include('data_pelamar.diterima_modal')
    @include('data_pelamar.ditolak_modal')

    <script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload(); // Muat ulang halaman jika dimuat dari cache
            }
        };
    </script>
@endsection
