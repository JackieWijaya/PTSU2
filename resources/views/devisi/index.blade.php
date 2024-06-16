@extends('layout.master')

@section('title', 'Devisi')

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
            <a href="{{ url('devisi/create') }}" class="btn btn-primary">Tambah Devisi</a>
        </div>

        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kode Devisi</th>
                        <th>Nama Devisi</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devisis as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_devisi }}</td>
                            <td>
                                <a href="{{ url('devisi/' . $item->id . '/edit') }}" class="btn btn-sm btn-warning"><span
                                        class="bi bi-pencil-square"></span></a>
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_devisi }}" data-toggle="modal"
                                    data-target="#deleteModal"><span class="bi bi-trash3"></span></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('devisi.delete_modal')
@endsection
