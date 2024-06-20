@extends('layout.master')

@section('title', 'Manajemen Kinerja')

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
        @if (Auth::user()->role == 'HRD')
            <div class="card-header d-flex align-items-center justify-content-between">
                <a href="{{ url('manajemen_kinerja/create') }}" class="btn btn-primary">Tambah</a>
            </div>
        @endif

        <div class="card-body" id="data-center">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Info</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Jenis</th>
                        <th>Foto / File Bukti</th>
                        <th>Alasan</th>
                        <th>Tanggal</th>
                        @if (Auth::user()->role == 'HRD')
                            <th>#</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($manajemen_kinerjas as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <button id="info" class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#infoModal" data-id="{{ $item->id }}" data-nik="{{ $item->nik }}"
                                    data-jenis="{{ $item->jenis }}" data-nama="{{ $item->data_pribadi->nama_lengkap }}"
                                    data-foto="{{ $item->foto }}" data-alasan="{{ $item->alasan }}"
                                    data-catatan="{{ $item->catatan }}"
                                    data-tgl="{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}"><i
                                        class="bi bi-info-circle"></i></button>
                            </td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->data_pribadi->nama_lengkap }}</td>
                            <td>
                                @if ($item->jenis == 'Reward')
                                    <small class="badge badge-success">{{ $item->jenis }}</small>
                                @else
                                    <small class="badge badge-danger">{{ $item->jenis }}</small>
                                @endif
                            </td>
                            <td>
                                @if ($item->foto == null || $item->foto == '')
                                    -
                                @else
                                    <a href="{{ asset('storage/FotoRewardPunishment/' . $item->foto) }}">Lihat</a>
                                @endif
                            </td>
                            <td>{{ $item->alasan }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                            @if (Auth::user()->role == 'HRD')
                                <td>
                                    <a href="{{ url('manajemen_kinerja/' . $item->id . '/edit') }}"
                                        class="btn btn-sm btn-warning"><span class="bi bi-pencil-square"></span></a>
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                        data-nik="{{ $item->nik }}" data-nama="{{ $item->data_pribadi->nama_lengkap }}"
                                        data-toggle="modal" data-target="#deleteModal"><span
                                            class="bi bi-trash3"></span></button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('manajemen_kinerja.info_modal')
    @include('manajemen_kinerja.delete_modal')
@endsection
