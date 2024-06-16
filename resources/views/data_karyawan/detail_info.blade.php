@extends('layout.master')

@section('title', 'Data Karyawan')

@section('content')
    <style>
        #data-center td,
        #data-center th {
            text-align: center;
            vertical-align: middle;
        }
    </style>

    @php
        $no = 1;
    @endphp

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills bg-white d-flex m-0" id="tab-menu">
                <li class="nav-item flex-fill custom-tab">
                    <a class="nav-link text-center" href="#tab_1" data-toggle="tab">Data Pribadi</a>
                </li>
                @if (isset($data_pribadi) && $data_pribadi->status_kawin != 'TK')
                    <li class="nav-item flex-fill custom-tab">
                        <a class="nav-link text-center" href="#tab_2" data-toggle="tab">Data Keluarga Inti</a>
                    </li>
                @endif
                <li class="nav-item flex-fill custom-tab">
                    <a class="nav-link text-center" href="#tab_3" data-toggle="tab">Data Keluarga Kandung</a>
                </li>
                <li class="nav-item flex-fill custom-tab">
                    <a class="nav-link text-center" href="#tab_4" data-toggle="tab">Data Pendidikan</a>
                </li>
                <li class="nav-item flex-fill custom-tab">
                    <a class="nav-link text-center" href="#tab_5" data-toggle="tab">Sertifikat Pelatihan</a>
                </li>
                <li class="nav-item flex-fill custom-tab">
                    <a class="nav-link text-center" href="#tab_6" data-toggle="tab">Pengalaman Kerja</a>
                </li>
                <li class="nav-item flex-fill custom-tab">
                    <a class="nav-link text-center" href="#tab_7" data-toggle="tab">Bahasa Asing</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content" id="tab-content">
        <div class="tab-pane" id="tab_1">@include('data_karyawan.tab_1')</div>
        <div class="tab-pane" id="tab_2">@include('data_karyawan.tab_2')</div>
        <div class="tab-pane" id="tab_3">@include('data_karyawan.tab_3')</div>
        <div class="tab-pane" id="tab_4">@include('data_karyawan.tab_4')</div>
        <div class="tab-pane" id="tab_5">@include('data_karyawan.tab_5')</div>
        <div class="tab-pane" id="tab_6">@include('data_karyawan.tab_6')</div>
        <div class="tab-pane" id="tab_7">@include('data_karyawan.tab_7') </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function getParameterByName(name, url) {
                if (!url) url = window.location.href;
                name = name.replace(/[\[\]]/g, '\\$&');
                var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\+/g, ' '));
            }

            var tabParam = getParameterByName('tab');
            var idParam = getParameterByName('id');

            if (tabParam) {
                $('#tab-menu a[href="#' + tabParam + '"]').tab('show');
            } else {
                $('#tab-menu a[href="#tab_1"]').tab('show');
            }

            $('#tab-menu a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var href = $(this).attr('href').substr(1);
                var newUrl = window.location.href.split('?')[0] + '?id=' + idParam + '&tab=' + href;
                location.href = newUrl; // Use location.href to refresh the page
            });
        });
    </script>
@endsection
