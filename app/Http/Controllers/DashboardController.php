<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\data_pelamar;
use App\Models\data_pribadi;
use App\Models\phk;
use App\Models\presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jumlah_pelamar = data_pelamar::all()->count();
        $pelamar = data_pelamar::where('status', null)->count();
        $jumlah_karyawan_baru = data_pribadi::where('jabatans_id', null)->count();
        $jumlah_karyawan_aktif = User::where('status_user', 'Aktif')->where('role', 'Karyawan')->count();
        $total_pengajuan_cuti = cuti::all()->count();
        $jumlah_pengajuan_cuti = cuti::where('status', '-')->count();
        $total_pengajuan_phk = phk::all()->count();
        $jumlah_pengajuan_phk = phk::where('status', '0')->count();
        $data_pribadi = data_pribadi::where('users_id', Auth::user()->id)->first();
        $jumlah_karyawan = DB::select("SELECT data_pribadis.jenis_kelamin, COUNT(*) as jumlah_jenis_kelamin
        FROM data_pribadis
        GROUP BY data_pribadis.jenis_kelamin");
    
        if (Auth::user()->role == 'Karyawan') {
            $cek_presensi = presensi::where('nik', $data_pribadi->nik)->whereDate('created_at', now()->toDateString())->count();
            $jumlah_pengajuan_cuti = cuti::where('nik', $data_pribadi->nik)->where('status', 'Diterima')->count();

            return view('dashboard.index')->with('jumlah_pengajuan_cuti', $jumlah_pengajuan_cuti)->with('jumlah_pengajuan_phk', $jumlah_pengajuan_phk)->with('cek_presensi', $cek_presensi);
        } else {
            return view('dashboard.index')->with('jumlah_pelamar', $jumlah_pelamar)->with('pelamar', $pelamar)->with('jumlah_karyawan_baru', $jumlah_karyawan_baru)->with('jumlah_karyawan_aktif', $jumlah_karyawan_aktif)->with('total_pengajuan_cuti', $total_pengajuan_cuti)->with('jumlah_pengajuan_cuti', $jumlah_pengajuan_cuti)->with('total_pengajuan_phk', $total_pengajuan_phk)->with('jumlah_pengajuan_phk', $jumlah_pengajuan_phk)->with('jumlah_karyawan', $jumlah_karyawan);
        }

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
