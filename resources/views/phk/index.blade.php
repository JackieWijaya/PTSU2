@extends('layout.master')

@section('title', 'PHK')

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
            <a href="{{ url('phk/create') }}" class="btn btn-primary @if ($user->status_user == 'Tidak Aktif') disabled @endif">Tambah
                @if (Auth::user()->role == 'HRD')
                    PHK
                @else
                    Pengajuan
                @endif
            </a>
        </div>

        <div class="card-body" id="data-center">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Alasan</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($phks as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->data_pribadi->nama_lengkap }}</td>
                            <td>{{ $item->alasan }}</td>
                            <td>{{ $item->catatan }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                            <td>
                                @if (Auth::user()->role == 'HRD')
                                    @if ($item->status == '1')
                                        -
                                    @else
                                        @if ($item->status == 'Diterima')
                                            <small class="badge badge-success">Diterima</small>
                                        @elseif ($item->status == 'Ditolak')
                                            <small class="badge badge-danger">Ditolak</small>
                                        @else
                                            <button class="btn btn-sm btn-success btn-diterima" type="button"
                                                data-toggle="modal" data-target="#diterimaModal"
                                                data-id="{{ $item->id }}" data-nik="{{ $item->nik }}"
                                                data-nama="{{ $item->data_pribadi->nama_lengkap }}">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger btn-ditolak" type="button"
                                                data-toggle="modal" data-target="#ditolakModal"
                                                data-id="{{ $item->id }}" data-nik="{{ $item->nik }}"
                                                data-nama="{{ $item->data_pribadi->nama_lengkap }}">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        @endif
                                    @endif
                                @else
                                    @if ($item->status == '1')
                                        -
                                    @else
                                        @if ($item->status == 'Diterima')
                                            <small class="badge badge-success">Diterima</small>
                                        @elseif ($item->status == 'Ditolak')
                                            <small class="badge badge-danger">Ditolak</small>
                                        @else
                                            <small class="badge badge-secondary">Menunggu</small>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->role == 'HRD')
                                    @if ($item->status == '1')
                                        <a href="{{ url('phk/' . $item->id . '/edit') }}"
                                            class="btn btn-sm btn-warning"><span class="bi bi-pencil-square"></span></a>
                                        <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                            data-nik="{{ $item->nik }}"
                                            data-nama="{{ $item->data_pribadi->nama_lengkap }}" data-toggle="modal"
                                            data-target="#deleteModal"><span class="bi bi-trash3"></span></button>
                                    @else
                                        -
                                    @endif
                                @else
                                    <a href="{{ url('phk/' . $item->id . '/edit') }}"
                                        class="btn btn-sm btn-warning @if ($item->status != 0) disabled @endif"
                                        @disabled($item->status != 0)><span class="bi bi-pencil-square"></span></a>
                                    <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                        data-nik="{{ $item->nik }}" data-nama="{{ $item->data_pribadi->nama_lengkap }}"
                                        data-toggle="modal" data-target="#deleteModal" @disabled($item->status != 0)><span
                                            class="bi bi-trash3"></span></button>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('phk.diterima_modal')
    @include('phk.ditolak_modal')
    @include('phk.delete_modal')
@endsection
