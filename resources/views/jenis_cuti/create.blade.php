@extends('layout.master')

@section('title', 'Jenis Cuti')

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

    <a href="{{ url('jenis_cuti') }}" class="btn btn-primary btn-block mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Jenis Cuti</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis_cuti.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="nama_jenis_cuti">Nama Jenis Cuti</label>
                        <input type="text" class="form-control @error('nama_jenis_cuti') is-invalid @enderror"
                            name="nama_jenis_cuti" id="nama_jenis_cuti" value="{{ old('nama_jenis_cuti') }}"
                            placeholder="Enter Nama Jenis Cuti">

                        @error('nama_jenis_cuti')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="jatah">Jatah</label>
                        <input type="number" class="form-control @error('jatah') is-invalid @enderror" name="jatah"
                            id="jatah" value="{{ old('jatah') }}" placeholder="Enter Jatah">

                        @error('jatah')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>

            </form>
        </div>
    </div>
@endsection
