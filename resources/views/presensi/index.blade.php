@extends('layout.master')

@section('title', 'Presensi')

@section('content')
    <style>
        .custom-tab {
            width: 50%;
        }

        .fc-button {
            background-color: #007bff !important;
            /* Warna primary */
            border: none !important;
            color: white !important;
            padding: 5px 10px !important;
            margin: 2px !important;
            border-radius: 3px !important;
        }

        .fc-button:hover {
            background-color: #0056b3 !important;
            /* Warna primary saat hover */
        }

        .fc-daygrid-day-number,
        .fc-day {
            color: black !important;
            /* Ubah warna angka tanggal menjadi hitam */
        }
    </style>

    @php
        function selisih($jam_masuk, $jam_keluar)
        {
            [$h, $m, $s] = explode(':', $jam_masuk);
            $dtAwal = mktime($h, $m, $s, '1', '1', '1');
            [$h, $m, $s] = explode(':', $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = floor($totalmenit / 60);
            $sisamenit = $totalmenit % 60;
            $detik = $dtSelisih % 60;
            return ['jam' => $jam, 'menit' => round($sisamenit), 'detik' => $detik];
        }

        $no = 1;
    @endphp
    @if (Auth::user()->role == 'Karyawan')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Presensi</h3>
            </div>
            <div class="card-body">
                <div id="dateTimeContainer" class="d-flex flex-column align-items-center">
                    <p id="fullDate" class="mb-0 fs-5"></p>
                    <p id="time" class="mb-0 fs-5"></p>
                </div>
                <div class="font-size-16 font-weight-normal text-dark my-3 text-center">
                    <p>Presensi dibuka pada pukul {{ $pengaturan_presensi->jam_masuk }} &
                        {{ $pengaturan_presensi->jam_keluar }}
                        <br>
                        Presensi (Check In & Check Out) hanya bisa dilakukan 1x sehari
                        <br>
                        <small class="text-muted">(Lewat 10 menit dari jam {{ $pengaturan_presensi->jam_masuk }} dinyatakan
                            terlambat)</small>
                    </p>
                </div>
                <div class="row">
                    @php
                        $now = now()->setTimezone('Asia/Jakarta')->format('H:i:s'); // Ambil waktu saat ini dalam format H:i:s WIB
                    @endphp
                    <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                        <button id="checkIn" class="btn btn-primary w-100" data-toggle="modal" data-target="#checkModal"
                            @if ($now <= $pengaturan_presensi->jam_masuk) disabled @elseif ($cek > 0) disabled @endif>Check
                            In</button>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                        <button id="checkOut" class="btn btn-primary w-100" data-toggle="modal" data-target="#checkModal"
                            @if ($now <= $pengaturan_presensi->jam_keluar) disabled @elseif ($cek1 > 0) disabled @endif>Check
                            Out</button>
                    </div>
                </div>
                @include('presensi.modal')
            </div>
        </div>

        <ul class="nav nav-pills ml-auto mb-3 bg-white d-flex">
            <li class="nav-item flex-fill custom-tab">
                <a class="nav-link active text-center" href="#tab_1" data-toggle="tab">Riwayat Presensi</a>
            </li>
            <li class="nav-item flex-fill custom-tab">
                <a class="nav-link text-center" href="#tab_2" data-toggle="tab">Bulan Ini</a>
            </li>
        </ul>

        @php
            $total_jam = 0;
            $total_menit = 0;
            $total_detik = 0;
            $jam_terlambat = Carbon\Carbon::parse($pengaturan_presensi->jam_masuk)
                ->addMinutes(10)
                ->format('H:i:s');

            foreach ($terlambat as $item) {
                $created_at = Carbon\Carbon::parse($item->created_at)->format('H:i:s');
                if ($created_at > $jam_terlambat) {
                    $selisih = selisih($jam_terlambat, $created_at);
                    $total_jam += $selisih['jam'];
                    $total_menit += $selisih['menit'];
                    $total_detik += $selisih['detik'];
                }
            }

            // Konversi total waktu terlambat ke format jam, menit, dan detik
            $total_menit += floor($total_detik / 60);
            $total_detik = $total_detik % 60;
            $total_jam += floor($total_menit / 60);
            $total_menit = $total_menit % 60;
        @endphp

        <div class="tab-content">
            <div class="card tab-pane" id="tab_2">
                <div class="card-body">
                    <div class="float-right d-none d-sm-block">
                        <p class="text-bold">Hadir : <small class="badge badge-success">{{ $presensisblnini->count() }}
                                Kali</small> Terlambat : <small class="badge badge-danger">{{ $terlambat->count() }}
                                Kali</small> Total Waktu Terlambat :
                            <small class="badge badge-secondary"> {{ $total_jam }} Jam {{ $total_menit }} Menit
                                {{ $total_detik }} Detik</small>
                        </p>
                    </div>
                    <h3 class="card-title">Riwayat Presensi {{ $namabulan[$bulanini] }} {{ $tahunini }}</h3><br>
                    {{-- <h3 class="card-title">Riwayat Presensi</h3><br> --}}
                    <div class="table-responsive">
                        <table id="example2" class="datatable table table-hover nowrap text-center align-middle">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Foto</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($presensisblnini as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s') }}</td>
                                        <td>
                                            @if ($item->created_at == $item->updated_at)
                                                <small class="badge badge-danger">Belum Absen</small>
                                            @else
                                                {{ \Carbon\Carbon::parse($item->updated_at)->format('H:i:s') }}
                                            @endif
                                        </td>
                                        <td><img src="{{ asset('storage/Presensi/' . $item->foto_masuk) }}"
                                                class="card-img-center" alt="Foto Absen" width="50px"></td>
                                        <td>
                                            @php
                                                $jam_masuk = \Carbon\Carbon::parse($item->created_at)->format('H:i:s');
                                                $jam_masuk_plus_10 = \Carbon\Carbon::parse(
                                                    $pengaturan_presensi->jam_masuk,
                                                )
                                                    ->addMinutes(10)
                                                    ->format('H:i:s');
                                            @endphp
                                            {{-- @dd($jam_masuk_plus_10); --}}
                                            @if ($jam_masuk <= $jam_masuk_plus_10)
                                                <small class="badge badge-success">Hadir</small>
                                            @else
                                                @php
                                                    $waktuterlambat = selisih($jam_masuk_plus_10, $jam_masuk);
                                                @endphp
                                                <small class="badge badge-danger">Terlambat {{ $waktuterlambat['jam'] }}
                                                    Jam
                                                    {{ $waktuterlambat['menit'] }} Menit {{ $waktuterlambat['detik'] }}
                                                    Detik</small>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card tab-pane active" id="tab_1">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <!-- Your script -->
        <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" />

        <script>
            // Function to update date and time
            function updateDateTime() {
                var dateTimeContainer = document.getElementById('dateTimeContainer');
                var fullDateElement = document.getElementById('fullDate');
                var timeElement = document.getElementById('time');
                var daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

                var now = new Date();

                // Format the date
                var dateString = daysOfWeek[now.getDay()] + ', ' +
                    now.getDate() + ' ' +
                    new Intl.DateTimeFormat('id-ID', {
                        month: 'long'
                    }).format(now) + ' ' +
                    now.getFullYear();

                // Format the time to WIB
                var options = {
                    timeZone: 'Asia/Jakarta',
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric'
                };
                var timeString = now.toLocaleTimeString('id-ID', options).replace(/\./g, ':') + ' WIB';

                // Update the content
                fullDateElement.textContent = dateString;
                timeElement.textContent = timeString;

                // Update every second
                setTimeout(updateDateTime, 1000);
            }

            // Call the function to start updating date and time
            updateDateTime();
        </script>

        <script>
            $(document).ready(function() {
                var presensis = @json($presensis);
                var pengaturan_presensi = @json($pengaturan_presensi);

                // Fungsi untuk menambahkan 10 menit ke jam_masuk
                function tambahMenit(jam, menit) {
                    var parts = jam.split(':');
                    var date = new Date(1970, 0, 1, parts[0], parts[1], parts[2]);
                    date.setMinutes(date.getMinutes() + menit);
                    return date.toTimeString().split(' ')[0];
                }

                var jam_masuk_plus_10 = tambahMenit(pengaturan_presensi.jam_masuk, 10);

                function selisih(jam_masuk, jam_keluar) {
                    var jamMasukParts = jam_masuk.split(':');
                    var jamKeluarParts = jam_keluar.split(':');

                    var dtAwal = new Date(1970, 0, 1, jamMasukParts[0], jamMasukParts[1], jamMasukParts[2]);
                    var dtAkhir = new Date(1970, 0, 1, jamKeluarParts[0], jamKeluarParts[1], jamKeluarParts[2]);

                    var dtSelisih = (dtAkhir - dtAwal) / 1000; // Convert milliseconds to seconds
                    var jam = Math.floor(dtSelisih / 3600); // Hitung jam
                    var sisajam = dtSelisih % 3600; // Sisa detik setelah dihitung jam
                    var menit = Math.floor(sisajam / 60); // Hitung menit
                    var detik = Math.floor(sisajam % 60); // Hitung detik

                    return {
                        jam: jam,
                        menit: menit,
                        detik: detik
                    };
                }

                var events = presensis.map(function(presensi) {
                    var created_at = new Date(presensi.created_at);
                    var created_at_time = created_at.toTimeString().split(' ')[0];

                    // Logging untuk melihat nilai waktu
                    console.log("Created At Time: " + created_at_time);
                    console.log("Jam Masuk Plus 10 Time: " + jam_masuk_plus_10);

                    var backgroundColor;
                    var waktuTerlambat;
                    var title = '<small class="badge badge-success text-center d-block">Hadir</small>';

                    if (created_at_time > jam_masuk_plus_10) {
                        waktuTerlambat = selisih(jam_masuk_plus_10, created_at_time);
                        backgroundColor = '#dc3545'; // Warna merah untuk terlambat
                        title =
                            '<small class="badge badge-danger text-center d-block">Hadir Terlambat</small><small class="badge badge-danger text-center d-block">' +
                            waktuTerlambat.jam + ' Jam ' + waktuTerlambat.menit + ' Menit ' + waktuTerlambat
                            .detik + ' Detik</small>';
                        console.log("Terlambat: " + waktuTerlambat.jam + " Jam " + waktuTerlambat.menit +
                            " Menit " + waktuTerlambat.detik + " Detik");
                    } else {
                        backgroundColor = '#28a745'; // Warna hijau untuk hadir
                    }

                    return {
                        title: title,
                        start: presensi.created_at.split('T')[0], // Mengambil tanggal dari timestamp
                        backgroundColor: backgroundColor, // Warna berdasarkan kehadiran
                        borderColor: backgroundColor // Gunakan warna yang sama untuk border
                    };
                });

                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: ''
                    },
                    buttonText: {
                        today: 'Today' // Mengubah teks tombol "today" menjadi "Today"
                    },
                    events: events,
                    eventContent: function(arg) {
                        // Use innerHTML to render custom HTML
                        return {
                            html: arg.event.title
                        };
                    }
                });

                calendar.render();
            });
        </script>

        <script>
            // Mendengarkan klik pada tab Bulan Ini
            document.querySelector('a[href="#tab_1"]').addEventListener('click', function(event) {
                event.preventDefault(); // Menghentikan perilaku default dari link

                // Menampilkan card Riwayat Presensi dan menyembunyikan card Bulan Ini
                document.getElementById('tab_1').classList.remove('active');
                document.getElementById('tab_2').classList.add('active');
            });
        </script>
    @else
        <div class="card">
            <div class="card-header">
                <input type="date" class="form-control" id="tanggal"
                    value="{{ request('tanggal', \Carbon\Carbon::now()->format('Y-m-d')) }}">
            </div>
            <div class="card-body">
                <table id="example2" class="datatable table table-hover nowrap text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Foto</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensisblnini as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>
                                    @if ($item->data_pribadi->jabatan == null)
                                        -
                                    @else
                                        {{ $item->data_pribadi->jabatan->nama_jabatan }}
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s') }}</td>
                                <td>
                                    @if ($item->created_at == $item->updated_at)
                                        <small class="badge badge-danger">Belum Absen</small>
                                    @else
                                        {{ \Carbon\Carbon::parse($item->updated_at)->format('H:i:s') }}
                                    @endif
                                </td>
                                <td><img src="{{ asset('storage/Presensi/' . $item->foto_masuk) }}" class="card-img-center"
                                        alt="Foto Absen" width="50px"></td>
                                <td>
                                    @php
                                        $jam_masuk = \Carbon\Carbon::parse($item->created_at)->format('H:i:s');
                                        $jam_masuk_plus_10 = \Carbon\Carbon::parse($pengaturan_presensi->jam_masuk)
                                            ->addMinutes(10)
                                            ->format('H:i:s');
                                    @endphp
                                    {{-- @dd($jam_masuk_plus_10); --}}
                                    @if ($jam_masuk <= $jam_masuk_plus_10)
                                        <small class="badge badge-success">Hadir</small>
                                    @else
                                        @php
                                            $waktuterlambat = selisih($jam_masuk_plus_10, $jam_masuk);
                                        @endphp
                                        <small class="badge badge-danger">Terlambat {{ $waktuterlambat['jam'] }}
                                            Jam
                                            {{ $waktuterlambat['menit'] }} Menit {{ $waktuterlambat['detik'] }}
                                            Detik</small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <script>
        document.getElementById('tanggal').addEventListener('change', function() {
            var selectedDate = this.value;
            var currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('tanggal', selectedDate);
            window.location.href = currentUrl.toString();
        });
    </script>
@endsection
