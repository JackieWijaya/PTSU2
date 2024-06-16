<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PTSU</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    {{-- css select2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?v=3.2.0') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">

    {{-- ion icon --}}
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>

    {{-- ajax & sweetalert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/main.css') }}">

    <link rel="shortcut icon" href="{{ asset('storage/Logo/PTSU.ico') }}" type="image/x-icon">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <div class="navbar-nav ml-auto">
                <h4 class="text-center title">@yield('title')</h4>
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="https://sumatraunggul.co.id/" class="brand-link">
                <img src="{{ asset('storage/Logo/PTSU.png') }}" alt="PTSU Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PT Sumatra Unggul</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center ">
                    <div class="image">
                        @if (Auth::user()->foto == null)
                            <img src="{{ asset('storage/FotoProfil/default.png') }}" class="user-image"
                                alt="User Image">
                        @else
                            <img src="{{ asset('storage/FotoProfil/' . Auth::user()->foto) }}" class="user-image"
                                alt="User Image">
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{ url('profil') }}" class="d-block">{{ Auth::user()->name }}<br>
                            @if (Auth::user()->role == 'Karyawan')
                                @if (Auth::user()->data_pribadi->jabatan == null)
                                    -
                                @else
                                    {{ Auth::user()->data_pribadi->jabatan->nama_jabatan }}
                                @endif
                            @else
                                HRD
                            @endif
                        </a>
                    </div>
                </div>

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2" id="nav-bar">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        @if (Auth::user()->role == 'HRD')
                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>
                                        Master Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('devisi') }}"
                                            class="nav-link {{ Request::is('devisi*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Devisi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('jabatan') }}"
                                            class="nav-link {{ Request::is('jabatan*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Jabatan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('data_pelamar') }}"
                                    class="nav-link {{ Request::is('data_pelamar*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-file-contract"></i>
                                    <p>
                                        Data Pelamar
                                    </p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ url('data_karyawan') }}"
                                class="nav-link {{ Request::is('data_karyawan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Data Karyawan
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('presensi') }}"
                                class="nav-link {{ Request::is('presensi*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>
                                    Presensi
                                </p>
                            </a>
                        </li>

                        @if (Auth::user()->role == 'HRD')
                            <li class="nav-item">
                                <a href="{{ url('rekap_presensi') }}"
                                    class="nav-link {{ Request::is('rekap_presensi*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-layer-group"></i>
                                    <p>
                                        Rekap Presensi
                                    </p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p>
                                    Pengaturan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (Auth::user()->role == 'HRD')
                                    <li class="nav-item">
                                        <a href="{{ url('pengaturan_presensi') }}"
                                            class="nav-link {{ Request::is('pengaturan_presensi*') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Presensi</p>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ url('profil') }}"
                                        class="nav-link {{ Request::is('profil*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profil</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" class="nav-link">
                                @csrf
                                <a href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <p>
                                        <i class="btn btn-outline-danger btn-block">{{ __('Log Out') }}</i>
                                    </p>
                                </a>
                            </form>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>

        <div class="content-wrapper pt-2">

            <section class="content">
                @yield('content')
            </section>

        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">

            </div>
            <strong>Copyright &copy; 2024 <a href="https://sumatraunggul.co.id/">PTSU</a>.</strong>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('/plugins/fullcalendar/main.js') }}"></script>

    <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>

    <script>
        $(function($) {
            let url = window.location.href;
            $('nav ul li a').each(function() {
                if (this.href === url) {
                    $(this).closest('a.nav-link').addClass('active');
                }
            });
        });
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>

    <script>
        $(function() {
            // Inisialisasi DataTable pada semua elemen dengan kelas .datatable
            $("table[id^='example1']").each(function() {
                $(this).DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo($(this).closest('.dataTables_wrapper').find(
                    '.col-md-6:eq(0)'));
            });

            // Inisialisasi DataTable pada semua elemen dengan kelas .datatable-simple
            $("table[id^='example2']").each(function() {
                $(this).DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        });
    </script>

    @include('sweetalert::alert')

</body>

</html>
