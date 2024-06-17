@extends('layout.master')

@section('title', 'Manajemen Jabatan')

@section('content')
    <style>
        #data-center td,
        #data-center th {
            text-align: center;
            vertical-align: middle;
        }
    </style>

    @php
        $no = 1;
    @endphp

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <a href="{{ url('manajemen_jabatan/create') }}" class="btn btn-primary">Tambah</a>
            <div class="d-flex align-items-center ml-auto">
                <span class="mr-2">
                    <i class="fas fa-square text-success"></i> Promosi
                </span>
                <span class="mr-2">
                    <i class="fas fa-square text-secondary"></i> Mutasi
                </span>
                <span class="mr-2">
                    <i class="fas fa-square text-danger"></i> Demosi
                </span>
            </div>
        </div>

        <div class="card-body" id="data-center">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Info</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Jabatan Lama</th>
                        <th>Jabatan Baru</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manajemen_jabatans as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <button id="info" class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#infoModal" data-id="{{ $item->id }}" data-nik="{{ $item->nik }}"
                                    data-jenis="{{ $item->jenis }}" data-nama="{{ $item->data_pribadi->nama_lengkap }}"
                                    data-devisilama="{{ $item->devisi_lama }}" data-jabatanlama="{{ $item->jabatan_lama }}"
                                    data-devisibaru="{{ $item->devisi_baru }}" data-jabatanbaru="{{ $item->jabatan_baru }}"
                                    data-catatan="{{ $item->catatan }}"
                                    data-tgl="{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}"><i
                                        class="bi bi-info-circle"></i></button>
                            </td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->data_pribadi->nama_lengkap }}</td>
                            <td>{{ $item->jabatan_lama }}</td>
                            <td>
                                @if ($item->jenis == 'Promosi')
                                    <small class="badge badge-success">{{ $item->jabatan_baru }}</small>
                                @elseif ($item->jenis == 'Demosi')
                                    <small class="badge badge-danger">{{ $item->jabatan_baru }}</small>
                                @else
                                    <small class="badge badge-secondary">{{ $item->jabatan_lama }}</small>
                                @endif
                            </td>
                            <td>{{ $item->catatan }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                            <td>
                                <a href="{{ url('manajemen_jabatan/' . $item->id . '/edit') }}"
                                    class="btn btn-sm btn-warning"><span class="bi bi-pencil-square"></span></a>
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->data_pribadi->nama_lengkap }}" data-toggle="modal"
                                    data-target="#deleteModal"><span class="bi bi-trash3"></span></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('manajemen_jabatan.info_modal')
    @include('manajemen_jabatan.delete_modal')

@endsection
