<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\data_pribadi;
use App\Models\pengaturan_presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PhpParser\Node\Expr\New_;
use RealRashid\SweetAlert\Facades\Alert;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Auth::user()->role == 'Karyawan'){
            $today = now()->toDateString(); // Mengambil tanggal hari ini dalam format Y-m-d
            $bulanini = date('m') * 1;
            $tahunini = date('Y');
            $no_hp = Auth::user()->no_hp;
            $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();

            // Menghitung jumlah presensi berdasarkan tanggal hari ini
            $cek = Presensi::whereDate('created_at', $today)
                            ->where('nik', $data_pribadi->nik)
                            ->count();
            
            $presensi = Presensi::whereDate('created_at', $today)->where('nik', $data_pribadi->nik)->first();
            if($presensi != null){
                if($presensi->foto_keluar != '-'){
                    $cek1 = 1;
                } else {
                    $cek1 = 0;
                }
            } else {
                $cek1 = 0;
            }

            $presensisblnini = Presensi::where('nik', $data_pribadi->nik)
                        ->whereYear('created_at', $tahunini)
                        ->whereMonth('created_at', $bulanini)
                        ->get();

            $presensis = Presensi::where('nik', $data_pribadi->nik)->get();

            $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            $pengaturan_presensi = pengaturan_presensi::where('id', 1)->first();
            // dd($pengaturan_presensi);

            $jam_terlambat = Carbon::parse($pengaturan_presensi->jam_masuk)->addMinutes(10)->format('H:i:s');
            $terlambat = Presensi::where('nik', $data_pribadi->nik)
            ->whereYear('created_at', $tahunini)
            ->whereMonth('created_at', $bulanini)
            ->whereTime('created_at', '>', $jam_terlambat)
            ->get();

            return view('presensi.index')->with('cek', $cek)->with('cek1', $cek1)->with('presensis', $presensis)->with('presensisblnini', $presensisblnini)->with('namabulan', $namabulan)->with('bulanini', $bulanini)->with('tahunini', $tahunini)->with('pengaturan_presensi', $pengaturan_presensi)->with('terlambat', $terlambat);
        } else {
            $bulanini = date('m') * 1;
            $tahunini = date('Y');
            // Memeriksa apakah ada parameter tanggal
            $tanggal = $request->get('tanggal', Carbon::now()->format('Y-m-d'));

            $presensisblnini = Presensi::select(
                'presensis.*',
                'data_pribadis.nama_lengkap')
                // 'jabatans.nama_jabatan')
                ->join('data_pribadis', 'presensis.nik', '=', 'data_pribadis.nik')
                // ->join('jabatans', 'data_pribadis.jabatans_id', '=', 'jabatans.id')
                ->whereDate('presensis.created_at', $tanggal)
                ->get();

            $pengaturan_presensi = pengaturan_presensi::where('id', 1)->first();
            $jam_terlambat = Carbon::parse($pengaturan_presensi->jam_masuk)->addMinutes(10)->format('H:i:s');
            $terlambat = Presensi::whereYear('created_at', $tahunini)
                ->whereMonth('created_at', $bulanini)
                ->whereTime('created_at', '>', $jam_terlambat)
                ->get();

            return view('presensi.index')->with('presensisblnini', $presensisblnini)->with('pengaturan_presensi', $pengaturan_presensi)->with('terlambat', $terlambat);
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
        $today = now()->toDateString();
        $no_hp = Auth::user()->no_hp;
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $nik = $data_pribadi->nik;
        $tgl_presensi = date("Y-m-d");
        $image = $request->image;
        $pengaturan_presensi = pengaturan_presensi::where('id', 1)->first();
        $lok = explode(",", $pengaturan_presensi->lokasi);
        $latitudekantor = $lok[0];
        $longitudekantor = $lok[1];
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];

        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);
        $folderPath = "public/Presensi/";
        $formatName = $nik."-".$tgl_presensi;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName.".png";
        $file = $folderPath.$fileName;

        $cek = Presensi::whereDate('updated_at', $today)
                        ->where('nik', $nik)
                        ->count();

        if($radius > $pengaturan_presensi->radius){
            echo "error|Maaf Anda Berada Diluar Radius, Jarak Anda " . $radius. " meter dari Kantor|";
        } else {
            if($cek > 0) {
                $today = now()->toDateString();
                $no_hp = Auth::user()->no_hp;
                $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
                $nik = $data_pribadi->nik;
                $presensis = Presensi::whereDate('created_at', $today)->where('nik', $nik)->first();
                $presensis->foto_keluar = $fileName;
                $presensis->lokasi      = $lokasi;
                $update = $presensis->update();
                $presensis->touch();
                if ($update) {
                    echo "success|Terima Kasih, Hati - Hati Di Jalan|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal Absen, Silahkan Hubungi IT|out";
                }
            } else {
                $presensi = New Presensi();
                $presensi->nik        = $nik;
                $presensi->foto_masuk = $fileName;
                // $presensi->foto_keluar = $fileName;
                $presensi->lokasi     = $lokasi;
                
                $simpan = $presensi->save();
                if ($simpan) {
                    echo "success|Terima Kasih, Selamat Bekerja|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal Absen, Silahkan Hubungi IT|in";
                }
            }
        }    
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presensi $presensi)
    {
        //
        return view('presensi.rekap');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presensi $presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presensi $presensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presensi $presensi)
    {
        //
    }
}
