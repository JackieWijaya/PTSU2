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

    <a href="{{ url('devisi') }}" class="btn btn-primary btn-block mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Devisi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('devisi.update', ['devisi' => $devisi->id]) }}" method="POST"
                enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="nama_devisi">Nama Devisi</label>
                        <input type="text" class="form-control @error('nama_devisi') is-invalid @enderror"
                            name="nama_devisi" id="nama_devisi" value="{{ old('nama_devisi') ?? $devisi->nama_devisi }}"
                            placeholder="Enter Nama Devisi">

                        @error('nama_devisi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>

            </form>
        </div>
    </div>
@endsection
