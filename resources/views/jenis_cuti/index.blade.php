@extends('layout.master')

@section('title', 'Jenis Cuti')

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
        <div class="card-header">
            <a href="{{ url('jenis_cuti/create') }}" class="btn btn-primary">Tambah Jenis Cuti</a>
        </div>

        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode Jenis Cuti</th>
                        <th>Nama Jenis Cuti</th>
                        <th>Jatah</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenis_cutis as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_jenis_cuti }}</td>
                            <td>{{ $item->jatah }}</td>
                            <td>
                                <a href="{{ url('jenis_cuti/' . $item->id . '/edit') }}" class="btn btn-sm btn-warning"><span
                                        class="bi bi-pencil-square"></span></a>
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_jenis_cuti }}" data-toggle="modal"
                                    data-target="#deleteModal"><span class="bi bi-trash3"></span></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('jenis_cuti.delete_modal')
@endsection
