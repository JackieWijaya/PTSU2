 <div class="row">
     <div class="col-lg-6 col-12">

         <div class="small-box bg-info">
             <div class="inner">
                 @if (Auth::user()->data_pribadi->nik == null)
                     <h3>Belum Input Data</h3>
                     <h4>Silahkan Lengkapi Data Terlebih Dulu</h4>
                 @else
                     <h3>{{ Auth::user()->data_pribadi->nik }}</h3>
                     <h4>{{ Auth::user()->name }} - @if (Auth::user()->data_pribadi->jabatan == null)
                             -
                         @else
                             {{ Auth::user()->data_pribadi->jabatan->nama_jabatan }}
                         @endif
                     </h4>
                 @endif
             </div>
             <div class="icon">
                 <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="icon icon-tabler icons-tabler-outline icon-tabler-id">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                     <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                     <path d="M15 8l2 0" />
                     <path d="M15 12l2 0" />
                     <path d="M7 16l10 0" />
                 </svg>
             </div>
             <a href="{{ url('data_karyawan') }}" class="small-box-footer">More info <i
                     class="fas fa-arrow-circle-right"></i></a>
         </div>
     </div>

     <div class="col-lg-3 col-6">

         <div class="small-box bg-success">
             <div class="inner">
                 <h3>Presensi</h3>
                 <h4>
                     @if ($cek_presensi == 0)
                         Belum Absen
                     @else
                         Hadir
                     @endif
                 </h4>
             </div>
             <div class="icon">
                 <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                     <path d="M16 3v4" />
                     <path d="M8 3v4" />
                     <path d="M4 11h16" />
                     <path d="M15 19l2 2l4 -4" />
                 </svg>
             </div>
             <a href="{{ url('presensi') }}" class="small-box-footer">More info <i
                     class="fas fa-arrow-circle-right"></i></a>
         </div>
     </div>

     <div class="col-lg-3 col-6">

         <div class="small-box bg-warning">
             <div class="inner">
                 <h3>{{ $jumlah_pengajuan_cuti }}</h3>
                 <h4>Pengajuan Cuti</h4>
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

 </div>
