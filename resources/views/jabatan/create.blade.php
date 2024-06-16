@extends('layout.master')

@section('title', 'Jabatan')

@section('content')
    <style>
        :root {
            --errorColor: #f00e0e;
            --validColor: #0add0a;
        }

        .text-danger,
        .form-group p {
            font-size: 0.7rem;
            color: var(--errorColor);
            position: absolute;
        }
    </style>

    <a href="{{ url('jabatan') }}" class="btn btn-primary btn-block mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Jabatan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('jabatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror"
                            name="nama_jabatan" id="nama_jabatan" value="{{ old('nama_jabatan') }}"
                            placeholder="Enter Nama Jabatan">

                        @error('nama_jabatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>

            </form>
        </div>
    </div>
@endsection
