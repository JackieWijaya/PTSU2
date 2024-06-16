<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\data_pribadi;
use App\Models\pengaturan_presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekapPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil bulan dan tahun dari request, jika tidak ada gunakan bulan dan tahun saat ini
        $bulan = $request->query('bulan', now()->month);
        $tahun = $request->query('tahun', now()->year);

        // Dapatkan data pengaturan presensi
        $pengaturan_presensi = pengaturan_presensi::where('id', 1)->first();
        $jam_terlambat = Carbon::parse($pengaturan_presensi->jam_masuk)->addMinutes(10)->format('H:i:s');

        // Dapatkan data presensi
        $presensis = Presensi::select(
                'presensis.*',
                'data_pribadis.nama_lengkap',
                // 'jabatans.nama_jabatan',
                'users.foto',
                DB::raw('count(presensis.nik) as jumlah_kehadiran'),
                DB::raw("SUM(CASE WHEN TIME(presensis.created_at) > '$jam_terlambat' THEN 1 ELSE 0 END) as jumlah_terlambat")
            )
            ->join('data_pribadis', 'presensis.nik', '=', 'data_pribadis.nik')
            ->join('users', 'data_pribadis.no_hp', '=', 'users.no_hp')
            // ->join('jabatans', 'data_pribadis.jabatans_id', '=', 'jabatans.id')
            ->whereYear('presensis.created_at', $tahun)
            ->whereMonth('presensis.created_at', $bulan)
            ->groupBy('presensis.nik')
            ->get();
            // dd($presensis);

        // Hitung total waktu terlambat untuk setiap karyawan
        foreach ($presensis as $presensi) {
            $total_jam = 0;
            $total_menit = 0;
            $total_detik = 0;

            $terlambatPresensis = Presensi::where('nik', $presensi->nik)
                ->whereTime('created_at', '>', $jam_terlambat)
                ->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->get();

            foreach ($terlambatPresensis as $item) {
                $created_at = Carbon::parse($item->created_at)->format('H:i:s');
                if ($created_at > $jam_terlambat) {
                    $selisih = $this->selisih($jam_terlambat, $created_at); // panggil fungsi selisih
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

            $presensi->total_waktu_terlambat = sprintf('%02d Jam %02d Menit %02d Detik', $total_jam, $total_menit, $total_detik);
        }

        return view('presensi.rekap', compact('presensis', 'bulan', 'tahun'));
    }

    public function selisih($jam_masuk, $jam_keluar)
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
        return ['jam' => $jam, 'menit' => $sisamenit, 'detik' => $detik];
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
