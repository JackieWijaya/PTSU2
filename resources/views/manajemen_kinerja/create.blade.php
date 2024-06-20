@extends('layout.master')

@section('title', 'Manajemen Kinerja')

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

    <a href="{{ url('manajemen_kinerja') }}" class="btn btn-primary btn-block mb-2"><i class="fa fa-arrow-left"></i>
        Kembali</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('manajemen_kinerja.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="nik">Nama Karyawan</label>
                        <select id="nik" name="nik"
                            class="form-control select2 @error('nik') is-invalid @enderror" style="width: 100%;">
                            <option value="">-- Pilih Nama Karyawan --</option>
                            @foreach ($data_karyawan as $item)
                                <option value="{{ $item->nik }}" {{ old('nik') == $item->nik ? 'selected' : '' }}>
                                    {{ $item->nik }} - {{ $item->name }} </option>
                            @endforeach
                        </select>

                        @error('nik')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="jenis">Jenis</label>
                        <select id="jenis" name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Reward" {{ old('jenis') == 'Reward' ? 'selected' : '' }}>Reward</option>
                            <option value="Punishment" {{ old('jenis') == 'Punishment' ? 'selected' : '' }}>Punishment
                            </option>
                        </select>

                        @error('jenis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="foto">Foto / File Bukti</label>
                        <small class="text-muted">(Opsional / Tidak Wajib)</small>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                            name="foto" value="{{ old('foto') }}" placeholder="Enter Foto">
                        @if (!$errors->has('foto'))
                            <p>*Ukuran File Maks 2 MB | Format .jpg, .jpeg, .png, atau .pdf</p>
                        @endif

                        @error('foto')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="alasan">Alasan</label>
                        <input type="text" class="form-control @error('alasan') is-invalid @enderror" name="alasan"
                            id="alasan" value="{{ old('alasan') }}" placeholder="Enter Alasan">

                        @error('alasan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="catatan">Catatan</label>
                        <input type="text" class="form-control @error('catatan') is-invalid @enderror" name="catatan"
                            id="catatan" value="{{ old('catatan') }}" placeholder="Enter Catatan">

                        @error('catatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>

            </form>
        </div>
    </div>
@endsection
