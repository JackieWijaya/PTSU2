@extends('layout.master')

@section('title', 'Pengaturan')

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

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Presensi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('pengaturan_presensi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="lokasi_kantor">Lokasi Kantor</label>
                        <input type="text" class="form-control @error('lokasi_kantor') is-invalid @enderror"
                            name="lokasi_kantor" id="lokasi_kantor" value="{{ $pengaturan_presensi->lokasi }}"
                            placeholder="Enter Lokasi Kantor">

                        @error('lokasi_kantor')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="radius">Radius</label>
                        <small class="text-muted">(Satuan Meter)</small>
                        <input type="number" class="form-control @error('radius') is-invalid @enderror" name="radius"
                            id="radius" value="{{ $pengaturan_presensi->radius }}" placeholder="Enter Radius">

                        @error('radius')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="jam_masuk">Jam Masuk</label>
                        <small class="text-muted">(Jam Datang)</small>
                        <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" name="jam_masuk"
                            id="jam_masuk" value="{{ $pengaturan_presensi->jam_masuk }}" placeholder="Enter Jam Masuk">

                        @error('jam_masuk')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="jam_keluar">Jam Keluar</label>
                        <small class="text-muted">(Jam Pulang)</small>
                        <input type="time" class="form-control @error('jam_keluar') is-invalid @enderror"
                            name="jam_keluar" id="jam_keluar" value="{{ $pengaturan_presensi->jam_keluar }}"
                            placeholder="Enter Jam Keluar">

                        @error('jam_keluar')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" id="btnSimpan" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
