 <div class="row">
     <div class="col-lg-3 col-6">

         <div class="small-box bg-info">
             <div class="inner">
                 <h3>
                     @if (Auth::user()->role == 'Manager')
                         {{ $jumlah_pelamar }}
                     @else
                         {{ $pelamar }}
                     @endif
                 </h3>
                 <p>
                     @if (Auth::user()->role == 'Manager')
                         Data Pelamar
                     @else
                         Pelamar
                     @endif
                 </p>
             </div>
             <div class="icon">
                 <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="icon icon-tabler icons-tabler-outline icon-tabler-file-cv">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                     <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                     <path d="M11 12.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                     <path d="M13 11l1.5 6l1.5 -6" />
                 </svg>
             </div>
             <a href="{{ url('data_pelamar') }}" class="small-box-footer">More info <i
                     class="fas fa-arrow-circle-right"></i></a>
         </div>
     </div>

     <div class="col-lg-3 col-6">

         <div class="small-box bg-success">
             <div class="inner">
                 <h3>
                     @if (Auth::user()->role == 'Manager')
                         {{ $jumlah_karyawan_aktif }}
                     @else
                         {{ $jumlah_karyawan_baru }}
                     @endif
                 </h3>
                 <p>
                     @if (Auth::user()->role == 'Manager')
                         Karyawan Aktif
                     @else
                         Karyawan Baru
                     @endif
                 </p>
             </div>
             <div class="icon">
                 <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                     <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                     <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                     <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                 </svg>
             </div>
             <a href="{{ url('data_karyawan') }}" class="small-box-footer">More info <i
                     class="fas fa-arrow-circle-right"></i></a>
         </div>
     </div>

     <div class="col-lg-3 col-6">

         <div class="small-box bg-warning">
             <div class="inner">
                 <h3>
                     @if (Auth::user()->role == 'Manager')
                         {{ $total_pengajuan_cuti }}
                     @else
                         {{ $jumlah_pengajuan_cuti }}
                     @endif
                 </h3>
                 <p>Pengajuan Cuti</p>
             </div>
             <div class="icon">
                 <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-beach">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M17.553 16.75a7.5 7.5 0 0 0 -10.606 0" />
                     <path d="M18 3.804a6 6 0 0 0 -8.196 2.196l10.392 6a6 6 0 0 0 -2.196 -8.196z" />
                     <path d="M16.732 10c1.658 -2.87 2.225 -5.644 1.268 -6.196c-.957 -.552 -3.075 1.326 -4.732 4.196" />
                     <path d="M15 9l-3 5.196" />
                     <path
                         d="M3 19.25a2.4 2.4 0 0 1 1 -.25a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 1 .25" />
                 </svg>
             </div>
             <a href="{{ url('cuti') }}" class="small-box-footer">More info <i
                     class="fas fa-arrow-circle-right"></i></a>
         </div>
     </div>

     <div class="col-lg-3 col-6">

         <div class="small-box bg-danger">
             <div class="inner">
                 <h3>
                     @if (Auth::user()->role == 'Manager')
                         {{ $total_pengajuan_phk }}
                     @else
                         {{ $jumlah_pengajuan_phk }}
                     @endif
                 </h3>
                 <p>Pengajuan PHK</p>
             </div>
             <div class="icon">
                 <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-x">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                     <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                     <path d="M22 22l-5 -5" />
                     <path d="M17 22l5 -5" />
                 </svg>
             </div>
             <a href="{{ url('phk') }}" class="small-box-footer">More info <i
                     class="fas fa-arrow-circle-right"></i></a>
         </div>
     </div>

     <div class="col-lg-12 col-12">
         @include('dashboard.piechart')
     </div>

 </div>
