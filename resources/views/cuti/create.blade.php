@extends('layout.master')

@section('title', 'Cuti')

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

    <a href="{{ url('cuti') }}" class="btn btn-primary btn-block mb-2"><i class="fa fa-arrow-left"></i> Kembali</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Pengajuan</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('cuti.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="nik">Nama Karyawan</label>
                        <select id="nik" name="nik"
                            class="form-control select2 @error('nik') is-invalid @enderror" style="width: 100%;"
                            @disabled(Auth::user()->role != 'HRD')>
                            <option value="">-- Pilih Nama Karyawan --</option>
                            @foreach ($data_karyawan as $item)
                                <option
                                    value="@if (Auth::user()->role == 'HRD') {{ $item->nik }} @else {{ Auth::user()->data_pribadi->nik }} @endif"
                                    @if (Auth::user()->role == 'HRD') {{ old('nik') == $item->nik ? 'selected' : '' }} @else {{ $item->nik == Auth::user()->data_pribadi->nik ? 'selected' : null }} @endif>
                                    {{ $item->nik }} - {{ $item->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('nik')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="jenis_cuti">Jenis Cuti</label>
                        <select name="jenis_cuti" id="jenis_cuti"
                            class="form-control @error('jenis_cuti') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Cuti --</option>
                            @foreach ($jenis_cutis as $item)
                                <option value="{{ $item->id }}" {{ old('jenis_cuti') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_jenis_cuti }} </option>
                            @endforeach
                        </select>

                        @error('jenis_cuti')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                            name="tanggal_mulai" id="tanggal_mulai"value="{{ old('tanggal_mulai') }}"
                            placeholder="Enter Tanggal Mulai" onchange="calculateDays()">

                        @error('tanggal_mulai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                            name="tanggal_selesai" id="tanggal_selesai"value="{{ old('tanggal_selesai') }}"
                            placeholder="Enter Tanggal Selesai" onchange="calculateDays()">

                        @error('tanggal_selesai')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                        <label for="jumlah_hari">Jumlah Hari</label>
                        <input type="text" class="form-control @error('jumlah_hari') is-invalid @enderror"
                            name="jumlah_hari" id="jumlah_hari" value="{{ old('jumlah_hari') }}" readonly>

                        @error('jumlah_hari')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-sm-3">
                        <label for="sisa_cuti">Sisa Cuti</label>
                        <input type="text" class="form-control @error('sisa_cuti') is-invalid @enderror" name="sisa_cuti"
                            id="sisa_cuti" value="{{ old('sisa_cuti') }}" readonly>

                        @error('sisa_cuti')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                            name="keterangan" id="keterangan" value="{{ old('keterangan') }}"
                            placeholder="Enter Keterangan">

                        @error('keterangan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        function calculateDays() {
            const startDate = document.getElementById('tanggal_mulai').value;
            const endDate = document.getElementById('tanggal_selesai').value;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const timeDiff = end - start;
                const daysDiff = timeDiff / (1000 * 3600 * 24) + 1;

                if (daysDiff >= 0) {
                    document.getElementById('jumlah_hari').value = daysDiff;
                } else {
                    document.getElementById('jumlah_hari').value = '';
                }
            } else {
                document.getElementById('jumlah_hari').value = '';
            }
        }

        $("#jenis_cuti").change(function(e) {
            var jenis_cuti = $(this).val();
            $.ajax({
                url: '/cuti/getsisacuti',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    jenis_cuti: jenis_cuti,
                },
                cache: false,
                success: function(respond) {
                    $("#sisa_cuti").val(respond);
                }
            })
        })
    </script>
@endsection
