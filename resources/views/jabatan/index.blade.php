@extends('layout.master')

@section('title', 'Jabatan')

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
            <a href="{{ url('jabatan/create') }}" class="btn btn-primary">Tambah Jabatan</a>
        </div>

        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode Jabatan</th>
                        <th>Nama Jabatan</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jabatans as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_jabatan }}</td>
                            <td>
                                <a href="{{ url('jabatan/' . $item->id . '/edit') }}" class="btn btn-sm btn-warning"><span
                                        class="bi bi-pencil-square"></span></a>
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_jabatan }}" data-toggle="modal"
                                    data-target="#deleteModal"><span class="bi bi-trash3"></span></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('jabatan.delete_modal')
@endsection
