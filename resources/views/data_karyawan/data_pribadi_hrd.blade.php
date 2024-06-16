@extends('layout.master')

@section('title', 'Data Karyawan')

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
            <h3 class="card-title">Data Pribadi {{ $data_pribadi->nama_lengkap }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('data_karyawan.update', [$data_pribadi->id]) }}" method="POST"
                enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="row">
                    <div class="form-group col-lg-3 col-md-3 col-sm-6">
                        <label for="nik_pribadi">NIK</label>
                        <input type="text" class="form-control @error('nik_pribadi') is-invalid @enderror"
                            name="nik_pribadi" id="nik_pribadi" value="{{ $data_pribadi->nik ?? '-' }}" pattern="[0-9]+"
                            title="Masukkan hanya angka" placeholder="Masukkan NIK" disabled>

                        @error('nik_pribadi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                            name="nama_lengkap" id="nama_lengkap" value="{{ $data_pribadi->nama_lengkap }}"
                            placeholder="Enter Nama Lengkap" disabled>

                        @error('nama_lengkap')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6">
                        <label for="no_hp">No HP</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                id="no_hp" value="{{ $data_pribadi->no_hp }}" pattern="[0-9]+"
                                title="Masukkan hanya angka" placeholder="0812 3456 7890" disabled>
                        </div>

                        @error('no_hp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-control @error('jenis_kelamin') is-invalid @enderror" disabled>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-Laki"{{ $data_pribadi->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki
                            </option>
                            <option value="Perempuan"{{ $data_pribadi->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>

                        @error('jenis_kelamin')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach ($jabatans as $item)
                                <option value="{{ $item->id }}" {{ old('jabatan') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_jabatan }} </option>
                            @endforeach
                        </select>

                        @error('jabatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6">
                        <label for="devisi">Devisi</label>
                        <select name="devisi" id="devisi" class="form-control @error('devisi') is-invalid @enderror">
                            <option value="">-- Pilih Devisi --</option>
                            @foreach ($devisis as $item)
                                <option value="{{ $item->id }}" {{ old('devisi') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_devisi }} </option>
                            @endforeach
                        </select>

                        @error('devisi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6">
                        <label for="golongan">Golongan</label>
                        <input type="text" class="form-control @error('golongan') is-invalid @enderror" name="golongan"
                            id="golongan"value="{{ old('golongan') }}" placeholder="Enter Golongan">

                        @error('golongan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-6">
                        <label for="tanggal_masuk_kerja">Tanggal Masuk Kerja</label>
                        <input type="date" class="form-control @error('tanggal_masuk_kerja') is-invalid @enderror"
                            name="tanggal_masuk_kerja" id="tanggal_masuk_kerja"value="{{ old('tanggal_masuk_kerja') }}"
                            placeholder="Enter Tanggal Masuk Kerja">

                        @error('tanggal_masuk_kerja')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-2" name="status_isi" value="1">Simpan</button>
            </form>
        </div>
    </div>
@endsection
