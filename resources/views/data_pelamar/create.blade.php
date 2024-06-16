<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PTSU</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">
    <link rel="shortcut icon" href="{{ asset('storage/Logo/PTSU.ico') }}" type="image/x-icon">
</head>

<body>

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

    <div class="card card-primary m-2">
        <div class="card-header d-flex justify-content-center align-items-center">
            <h3 class="card-title text-center text-lg">Formulir Data Pribadi</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('data_pelamar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-9 col-md-6 col-sm-6">

                        <div class="row">
                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                    placeholder="Enter Nama Lengkap">

                                @error('nama_lengkap')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option
                                        value="Laki-Laki"{{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki
                                    </option>
                                    <option
                                        value="Perempuan"{{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>

                                @error('jenis_kelamin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    name="tanggal_lahir" id="tanggal_lahir"value="{{ old('tanggal_lahir') }}"
                                    placeholder="Enter Tanggal Lahir">

                                @error('tanggal_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                    placeholder="Enter Tempat Lahir">

                                @error('tempat_lahir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="no_hp">No HP</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        name="no_hp" id="no_hp" value="{{ old('no_hp') }}" pattern="[0-9]+"
                                        title="Masukkan hanya angka" placeholder="081234567890">
                                </div>

                                @error('no_hp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}"
                                        placeholder="example@gmail.com">
                                </div>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" id="alamat" value="{{ old('alamat') }}"
                                    placeholder="Enter Alamat">

                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <select name="pendidikan_terakhir" id="pendidikan_terakhir"
                                    class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                                    <option value="">-- Pilih Pendidikan Terakhir --</option>
                                    <option value="SD"{{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>
                                        SD
                                    </option>
                                    <option value="SMP"{{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>
                                        SMP
                                    </option>
                                    <option value="SMA"{{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>
                                        SMA
                                    </option>
                                    <option value="D3"{{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>
                                        D3
                                    </option>
                                    <option value="S1"{{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>
                                        S1
                                    </option>
                                    <option value="S2"{{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>
                                        S2
                                    </option>
                                </select>

                                @error('pendidikan_terakhir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="agama">Agama</label>
                                <select name="agama" id="agama"
                                    class="form-control @error('agama') is-invalid @enderror">
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="Islam"{{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam
                                    </option>
                                    <option value="Kristen"{{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="Katolik"{{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Hindu"{{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                                    </option>
                                    <option value="Buddha"{{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha
                                    </option>
                                    <option value="Konghucu"{{ old('agama') == 'Konghucu' ? 'selected' : '' }}>
                                        Konghucu
                                    </option>
                                </select>

                                @error('agama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="golongan_darah">Golongan Darah</label>
                                <select name="golongan_darah" id="golongan_darah"
                                    class="form-control @error('golongan_darah') is-invalid @enderror">
                                    <option value="">-- Pilih Golongan Darah --</option>
                                    <option value="A"{{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A
                                    </option>
                                    <option value="B"{{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B
                                    </option>
                                    <option value="AB"{{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB
                                    </option>
                                    <option value="O"{{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O
                                    </option>
                                </select>

                                @error('golongan_darah')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="status_kawin">Status Kawin</label>
                                <select name="status_kawin" id="status_kawin"
                                    class="form-control @error('status_kawin') is-invalid @enderror">
                                    <option value="">-- Pilih Status Kawin --</option>
                                    <option value="TK"{{ old('status_kawin') == 'TK' ? 'selected' : '' }}>Tidak
                                        Kawin
                                    </option>
                                    <option value="K0"{{ old('status_kawin') == 'K0' ? 'selected' : '' }}>Kawin 0
                                        Tanggungan
                                    </option>
                                    <option value="K1"{{ old('status_kawin') == 'K1' ? 'selected' : '' }}>Kawin 1
                                        Tanggungan
                                    </option>
                                    <option value="K2"{{ old('status_kawin') == 'K2' ? 'selected' : '' }}>Kawin 2
                                        Tanggungan
                                    </option>
                                    <option value="K3"{{ old('status_kawin') == 'K3' ? 'selected' : '' }}>Kawin 3
                                        Tanggungan
                                    </option>
                                </select>

                                @error('status_kawin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                <label for="tanggal_nikah">Tanggal Nikah</label>
                                <input type="date"
                                    class="form-control @error('tanggal_nikah') is-invalid @enderror"
                                    name="tanggal_nikah" id="tanggal_nikah"value="{{ old('tanggal_nikah') }}"
                                    placeholder="Enter Tanggal nikah">

                                @error('tanggal_nikah')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-lg-9 col-md-12 col-sm-12">
                                <label for="buku_nikah">Buku Nikah</label>
                                <input type="file" class="form-control @error('buku_nikah') is-invalid @enderror"
                                    id="buku_nikah" name="buku_nikah" value="{{ old('buku_nikah') }}"
                                    onchange="PratinjauGambar()" placeholder="Enter Buku Nikah">
                                @if (!$errors->has('buku_nikah'))
                                    {{-- <div class="mb-2"> --}}
                                    <p>*Ukuran File Tidak Boleh Lebih Dari 800 KB | Harus .jpg, .jpeg, atau
                                        .png</p>
                                    {{-- </div> --}}
                                @endif

                                @error('buku_nikah')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                        <img src="" class="pratinjau-gambar img-fluid" alt=""
                            style="max-height: 300px; max-width: 100%;">
                    </div>
                </div>

                <hr>

                <div class="form-check ml-1">
                    <input class="form-check-input" type="checkbox" required>
                    <label class="form-check-label">
                        <small class="text-bold">Dengan melakukan centang anda dengan kesadaran penuh bertanggung jawab
                            atas keaslian data yang dikirim</small>
                    </label>
                </div>

                <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                    data-target="#konfirmasiModal">Kirim</button>

                <div class="modal fade" id="konfirmasiModal">
                    <div class="modal-dialog">
                        <div class="modal-content bg-danger">
                            <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Kirim Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="mb-konfirmasi">
                                <p>Pastikan semua data sudah benar karena tidak dapat diubah setelah dikirim. Lanjutkan?
                                </p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-light"
                                    data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-outline-light">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    {{-- script pratinjaugambar --}}
    <script src="{{ asset('dist/js/pratinjaugambar.js') }}"></script>

    <script>
        // Function to toggle visibility of fields based on marital status
        function toggleMaritalFields() {
            var statusKawin = document.getElementById('status_kawin').value;
            var tanggalNikahField = document.getElementById('tanggal_nikah').closest('.form-group');
            var bukuNikahField = document.getElementById('buku_nikah').closest('.form-group');

            // Check if marital status is selected and not "Tidak Kawin"
            if (statusKawin && statusKawin !== 'TK') {
                tanggalNikahField.style.display = 'block';
                bukuNikahField.style.display = 'block';
                document.getElementById('tanggal_nikah').setAttribute('required', 'required');
                document.getElementById('buku_nikah').setAttribute('required', 'required');
            } else {
                tanggalNikahField.style.display = 'none';
                bukuNikahField.style.display = 'none';
                document.getElementById('tanggal_nikah').removeAttribute('required');
                document.getElementById('buku_nikah').removeAttribute('required');
            }
        }

        // Call the function initially to set the fields based on the current value of status_kawin
        toggleMaritalFields();

        // Add event listener to status_kawin field to toggle visibility of other fields
        document.getElementById('status_kawin').addEventListener('change', function() {
            toggleMaritalFields();
        });

        // Hide fields if marital status is not selected initially
        document.addEventListener('DOMContentLoaded', function() {
            toggleMaritalFields();
        });
    </script>

    @include('sweetalert::alert')

</body>

</html>
