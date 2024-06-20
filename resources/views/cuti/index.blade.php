@extends('layout.master')

@section('title', 'Cuti')

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
        @if (Auth::user()->role == 'Karyawan')
            <div class="card-header d-flex align-items-center justify-content-between">
                <a href="{{ url('cuti/create') }}"
                    class="btn btn-primary @if (Auth::user()->status_user == 'Tidak Aktif') disabled @endif">Tambah Pengajuan
                </a>
            </div>
        @endif

        <div class="card-body" id="data-center">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Jenis Cuti</th>
                        <th>Tanggal</th>
                        <th>Jumlah Cuti</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        @if (Auth::user()->role == 'Karyawan')
                            <th>#</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cutis as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nik }} - {{ $item->data_pribadi->nama_lengkap }}</td>
                            <td>{{ $item->jenis_cuti->nama_jenis_cuti }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }} -
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y') }}</td>
                            <td>{{ $item->jumlah_hari }} Hari</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                @if (Auth::user()->role == 'HRD')
                                    @if ($item->status == 'Diterima')
                                        <small class="badge badge-success">Diterima</small>
                                    @elseif ($item->status == 'Ditolak')
                                        <small class="badge badge-danger">Ditolak</small>
                                    @else
                                        <button class="btn btn-sm btn-success btn-diterima" type="button"
                                            data-toggle="modal" data-target="#diterimaModal" data-id="{{ $item->id }}"
                                            data-nik="{{ $item->nik }}"
                                            data-nama="{{ $item->data_pribadi->nama_lengkap }}">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-ditolak" type="button" data-toggle="modal"
                                            data-target="#ditolakModal" data-id="{{ $item->id }}"
                                            data-nik="{{ $item->nik }}"
                                            data-nama="{{ $item->data_pribadi->nama_lengkap }}">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    @endif
                                @else
                                    @if ($item->status == 'Diterima')
                                        <small class="badge badge-success">Diterima</small>
                                    @elseif ($item->status == 'Ditolak')
                                        <small class="badge badge-danger">Ditolak</small>
                                    @else
                                        <small class="badge badge-secondary">Menunggu</small>
                                    @endif
                                @endif
                            </td>
                            @if (Auth::user()->role == 'Karyawan')
                                <td>
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                        data-nik="{{ $item->nik }}" data-nama="{{ $item->data_pribadi->nama_lengkap }}"
                                        data-toggle="modal" data-target="#deleteModal" @disabled($item->status != '-')><span
                                            class="bi bi-trash3"></span></button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('cuti.diterima_modal')
    @include('cuti.ditolak_modal')
    @include('cuti.delete_modal')
@endsection
