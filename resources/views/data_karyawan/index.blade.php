@extends('layout.master')

@section('title', 'Data Karyawan')

@section('content')
    <style>
        #data-center td,
        #data-center th {
            text-align: center;
            vertical-align: middle;
        }

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

    @php
        $no = 1;
    @endphp

    @if (Auth::user()->role == 'HRD')
        @include('data_karyawan.all_data')
    @else
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills bg-white d-flex" id="tab-menu">
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center" href="#tab_1" data-toggle="tab">Data Pribadi</a>
                    </li>
                    @if ($data_pribadi->status_kawin != 'TK')
                        <li class="nav-item flex-fill custom-tab">
                            <a class="nav-link text-center {{ $data_pribadi->status_isi == '0' || $data_pribadi->status_isi == '2' ? 'disabled' : '' }}"
                                href="#tab_2" data-toggle="tab">Data Keluarga
                                Inti</a>
                        </li>
                    @endif
                    <li class="nav-item flex-fill custom-tab">
                        @php
                            $isDisabled = false;

                            if ($data_pribadi->status_kawin == 'TK') {
                                $isDisabled = $data_pribadi->status_isi == '0' || $data_pribadi->status_isi == '2';
                            } else {
                                $isDisabled =
                                    !$data_keluarga_inti_status ||
                                    $data_keluarga_inti_status->status_isi == '0' ||
                                    $data_keluarga_inti_status->status_isi == '2';
                            }
                        @endphp
                        <a class="nav-link text-center {{ $isDisabled ? 'disabled' : '' }}" href="#tab_3"
                            data-toggle="tab">Data Keluarga Kandung</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center {{ !$data_keluarga_kandung_status || $data_keluarga_kandung_status->status_isi == '0' || $data_keluarga_kandung_status->status_isi == '2' ? 'disabled' : '' }}"
                            href="#tab_4" data-toggle="tab">Data Pendidikan</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center {{ !$data_pendidikan_status || $data_pendidikan_status->status_isi == '0' || $data_pendidikan_status->status_isi == '2' ? 'disabled' : '' }}"
                            href="#tab_5" data-toggle="tab">Sertifikat Pelatihan</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center {{ !$pelatihan_sertifikat_status || $pelatihan_sertifikat_status->status_isi == '0' || $pelatihan_sertifikat_status->status_isi == '2' ? 'disabled' : '' }}"
                            href="#tab_6" data-toggle="tab">Pengalaman Kerja</a>
                    </li>
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center {{ !$pengalaman_kerja_status || $pengalaman_kerja_status->status_isi == '0' || $pengalaman_kerja_status->status_isi == '2' ? 'disabled' : '' }}"
                            href="#tab_7" data-toggle="tab">Bahasa Asing</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="tab-content">
            <div class="tab-pane" id="tab_1">@include('data_karyawan.tab_data_pribadi')</div>
            <div class="tab-pane" id="tab_2">@include('data_karyawan.tab_data_keluarga_inti')</div>
            <div class="tab-pane" id="tab_3">@include('data_karyawan.tab_data_keluarga_kandung')</div>
            <div class="tab-pane" id="tab_4">@include('data_karyawan.tab_data_pendidikan')</div>
            <div class="tab-pane" id="tab_5">@include('data_karyawan.tab_pelatihan_sertifikat')</div>
            <div class="tab-pane" id="tab_6">@include('data_karyawan.tab_pengalaman_kerja')</div>
            <div class="tab-pane" id="tab_7">@include('data_karyawan.tab_bahasa_asing')</div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mendapatkan nilai parameter dari URL
            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, '\\$&');
                var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }

            // Ambil nilai parameter tab dari URL
            var tabParam = getParameterByName('tab');

            // Jika nilai parameter tab ada, pilih tab tersebut
            if (tabParam) {
                // Aktifkan tab yang sesuai dengan nilai parameter
                $('#tab-menu a[href="#' + tabParam + '"]').tab('show');
            } else {
                // Atur default tab
                $('#tab-menu a[href="#tab_1"]').tab('show');
            }

            // Tangani perubahan tab yang ditampilkan
            $('#tab-menu a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var href = $(this).attr('href').substr(1); // Hilangkan karakter '#' dari href
                // Tambahkan parameter tab ke URL
                var newUrl = window.location.href.split('?')[0] + '?tab=' + href;
                history.replaceState(null, null, newUrl);

                // Muat ulang halaman untuk menerapkan perubahan tab
                location.reload();
            });
        });
    </script>

    <script>
        function setRequired(isRequired) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.required = isRequired;
            });
        }

        // generate alamat URL untuk proses hapus data 
        $('.btn-hapus').click(function() {
            let id = $(this).attr('data-id');
            let id_form = $(this).attr('data-id-form');
            $('#' + id_form).attr('action', '/data_tampung/' + id);

            // Add a click event listener for the submit button of the specific form
            $('#' + id_form + ' [type="submit"]').click(function() {
                $('#' + id_form).submit();
            });
        });
    </script>


    @include('sweetalert::alert')
@endsection
