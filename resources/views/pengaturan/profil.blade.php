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
            <h3 class="card-title">Profil</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profil.update', ['profil' => $users->id]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    name="nama_lengkap" id="nama_lengkap" value="{{ $users->name }}"
                                    placeholder="Enter Nama Lengkap">

                                @error('nama_lengkap')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label for="no_hp">No HP</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        name="no_hp" id="no_hp" value="{{ $users->no_hp }}" pattern="[0-9]+"
                                        title="Masukkan hanya angka" placeholder="0812 3456 7890">
                                </div>

                                @error('no_hp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" autocomplete="new-password">

                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" id="password_confirmation" autocomplete="new-password">

                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label for="buku_nikah">Foto</label>
                                <input type="file" class="form-control @error('buku_nikah') is-invalid @enderror"
                                    id="buku_nikah" name="buku_nikah" value="{{ $users->foto }}"
                                    onchange="PratinjauGambar()" placeholder="Enter Foto">
                                @if (!$errors->has('buku_nikah'))
                                    {{-- <div class="mb-2"> --}}
                                    <p>*Ukuran File Tidak Boleh Lebih Dari 800 KB | Harus .jpg, .jpeg, atau
                                        .png</p>
                                    {{-- </div> --}}
                                @endif

                                @error('buku_nikah')
                                    <div class="text-danger mb-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center justify-content-center">
                        <img src="" class="pratinjau-gambar img-fluid" alt=""
                            style="max-height: 250px; max-width: 100%;">
                    </div>
                </div>


                <button type="submit" id="btnSimpan" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>

    {{-- script pratinjaugambar --}}
    <script src="{{ asset('dist/js/pratinjaugambar.js') }}"></script>
@endsection
