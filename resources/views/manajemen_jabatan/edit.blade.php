@extends('layout.master')

@section('title', 'Manajemen Jabatan')

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

    <a href="{{ url('manajemen_jabatan') }}" class="btn btn-primary btn-block mb-2"><i class="fa fa-arrow-left"></i>
        Kembali</a>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Data</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('manajemen_jabatan.update', ['manajemen_jabatan' => $manajemen_jabatan->id]) }}"
                method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="nik">Nama Karyawan</label>
                        <select id="nik" name="nik"
                            class="form-control select2 @error('nik') is-invalid @enderror" style="width: 100%;">
                            <option value="">-- Pilih Nama Karyawan --</option>
                            @foreach ($data_karyawan as $item)
                                <option value="{{ $item->nik }}"
                                    {{ $item->nik == $manajemen_jabatan->nik ? 'selected' : null }}>
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
                            <option value="Promosi"
                                {{ old('jenis') ?? $manajemen_jabatan->jenis == 'Promosi' ? 'selected' : '' }}>
                                Promosi</option>
                            <option value="Mutasi"
                                {{ old('jenis') ?? $manajemen_jabatan->jenis == 'Mutasi' ? 'selected' : '' }}>Mutasi
                            </option>
                            <option value="Demosi"
                                {{ old('jenis') ?? $manajemen_jabatan->jenis == 'Demosi' ? 'selected' : '' }}>Demosi
                            </option>
                        </select>

                        @error('jenis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="devisi_lama">Devisi Lama</label>
                        <input type="text" class="form-control @error('devisi_lama') is-invalid @enderror"
                            name="devisi_lama" id="devisi_lama" value="{{ $manajemen_jabatan->devisi_lama }}" readonly>

                        @error('devisi_lama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="jabatan_lama">Jabatan Lama</label>
                        <input type="text" class="form-control @error('jabatan_lama') is-invalid @enderror"
                            name="jabatan_lama" id="jabatan_lama" value="{{ $manajemen_jabatan->jabatan_lama }}" readonly>

                        @error('jabatan_lama')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="devisi_baru">Devisi Baru</label>
                        <select id="devisi_baru" name="devisi_baru"
                            class="form-control select2 @error('devisi_baru') is-invalid @enderror" style="width: 100%;">
                            <option value="">-- Pilih Devisi Baru --</option>
                            @foreach ($devisis as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $id_devisi_baru ? 'selected' : null }}>
                                    {{ $item->nama_devisi }} </option>
                            @endforeach
                        </select>

                        @error('devisi_baru')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-sm-6">
                        <label for="jabatan_baru">Jabatan Baru</label>
                        <select id="jabatan_baru" name="jabatan_baru"
                            class="form-control select2 @error('jabatan_baru') is-invalid @enderror" style="width: 100%;">
                            <option value="">-- Pilih Jabatan Baru --</option>
                            @foreach ($jabatans as $item)
                                <option value="{{ $item->id }}"
                                    {{ $item->id == $id_jabatan_baru ? 'selected' : null }}>
                                    {{ $item->nama_jabatan }} </option>
                            @endforeach
                        </select>

                        @error('jabatan_baru')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                        <label for="catatan">Catatan</label>
                        <input type="text" class="form-control @error('catatan') is-invalid @enderror" name="catatan"
                            id="catatan" value="{{ old('catatan') ?? $manajemen_jabatan->catatan }}"
                            placeholder="Enter Catatan">

                        @error('catatan')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>

            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function resetJabatanBaruOptions() {
                $('#jabatan_baru option').prop('disabled', false);
            }

            $('#nik').change(function() {
                var nik = $(this).val();
                if (nik) {
                    $.ajax({
                        url: '{{ route('getDevisiJabatan') }}',
                        type: 'GET',
                        data: {
                            nik: nik
                        },
                        success: function(data) {
                            console.log(data); // Tambahkan console log untuk debugging
                            $('#devisi_lama').val(data.devisi);
                            $('#jabatan_lama').val(data.jabatan);

                            var devisiLamaId = data.devisiId;
                            var jabatanLamaId = data.jabatanId;
                            console.log('Devisi Lama ID:', devisiLamaId);
                            console.log('Jabatan Lama ID:', jabatanLamaId); // Debugging line
                            $('#jabatan_baru option').each(function() {
                                if ($(this).val() == jabatanLamaId) {
                                    $(this).prop('disabled', true);
                                } else {
                                    $(this).prop('disabled', false);
                                }
                            });
                        },
                        error: function() {
                            alert('Gagal mengambil data jabatan');
                        }
                    });
                } else {
                    $('#devisi_lama').val('');
                    $('#jabatan_lama').val('');
                    resetJabatanBaruOptions();
                }
            });

            // Call resetJabatanBaruOptions on page load to ensure the options are visible initially
            resetJabatanBaruOptions();
        });
    </script>

    <script>
        // Function to toggle visibility of fields based on marital status
        function toggleMaritalFields() {
            var jenis = document.getElementById('jenis').value;
            var devisiBaruField = document.getElementById('devisi_baru').closest('.form-group');
            var jabatanBaruField = document.getElementById('jabatan_baru').closest('.form-group');

            // Check if marital status is selected and not "Tidak Kawin"
            if (jenis && jenis !== 'Mutasi') {
                devisiBaruField.style.display = 'block';
                jabatanBaruField.style.display = 'block';
            } else {
                devisiBaruField.style.display = 'none';
                jabatanBaruField.style.display = 'none';
            }
        }

        // Call the function initially to set the fields based on the current value of status_kawin
        toggleMaritalFields();

        // Add event listener to status_kawin field to toggle visibility of other fields
        document.getElementById('jenis').addEventListener('change', function() {
            toggleMaritalFields();
        });

        // Hide fields if marital status is not selected initially
        document.addEventListener('DOMContentLoaded', function() {
            toggleMaritalFields();
        });
    </script>
@endsection
