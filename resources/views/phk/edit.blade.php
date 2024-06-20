@extends('layout.master')

@section('title', 'PHK')

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

    <a href="{{ url('phk') }}" class="btn btn-primary btn-block mb-2"><i class="fa fa-arrow-left"></i>
        Kembali</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit @if (Auth::user()->role == 'HRD')
                    PHK
                @else
                    Pengajuan
                @endif
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('phk.update', ['phk' => $phk->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="row">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="nik">Nama Karyawan</label>
                        <select id="nik" name="nik"
                            class="form-control select2 @error('nik') is-invalid @enderror" style="width: 100%;"
                            @disabled(Auth::user()->role != 'HRD')>
                            <option value="">-- Pilih Nama Karyawan --</option>
                            @foreach ($data_karyawan as $item)
                                <option value="{{ $item->nik }}" {{ $item->nik == $phk->nik ? 'selected' : null }}>
                                    {{ $item->nik }} - {{ $item->data_pribadi->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>

                        @error('nik')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="alasan">Alasan</label>
                        <input type="text" class="form-control @error('alasan') is-invalid @enderror" name="alasan"
                            id="alasan" value="{{ old('alasan') ?? $phk->alasan }}" placeholder="Enter Alasan">

                        @error('alasan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="catatan">Catatan</label>
                        <input type="text" class="form-control @error('catatan') is-invalid @enderror" name="catatan"
                            id="catatan" value="{{ old('catatan') ?? $phk->catatan }}" placeholder="Enter Catatan">

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
