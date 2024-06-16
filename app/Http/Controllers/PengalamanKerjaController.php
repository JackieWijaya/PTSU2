<?php

namespace App\Http\Controllers;

use App\Models\pengalaman_kerja;
use App\Models\data_pribadi;
use App\Models\data_tampung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PengalamanKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $pengalaman_kerja_status = pengalaman_kerja::where('data_pribadis_id', $data_pribadi->id)->first();
        $pengalaman_kerja = pengalaman_kerja::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($pengalaman_kerja);
        return view('data_karyawan.pengalaman_kerja')->with('data_pribadi', $data_pribadi)->with('pengalaman_kerja_status', $pengalaman_kerja_status)->with('pengalaman_kerja', $pengalaman_kerja);
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
        $status_isi = $request->input('status_isi');
        if($status_isi == '1'){
            $data_tampung = data_tampung::all();
            foreach ($data_tampung as $data) {
                // Buat entri baru di data_keluarga_inti
                $pengalaman_kerja = new pengalaman_kerja();
                $pengalaman_kerja->data_pribadis_id = $request->id;
                $pengalaman_kerja->nama_perusahaan  = $data->nama_perusahaan;
                $pengalaman_kerja->jabatan          = $data->jabatan;
                $pengalaman_kerja->mulai            = $data->mulai_kerja;
                $pengalaman_kerja->akhir            = $data->akhir_kerja;
                $pengalaman_kerja->gaji             = $data->gaji;
                $pengalaman_kerja->alasan_keluar    = $data->alasan_keluar;
                $pengalaman_kerja->status_isi       = $status_isi;
                $pengalaman_kerja->save();
            }
            // Hapus data_tampung
            data_tampung::truncate();
            
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_7');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'nama_perusahaan' => 'required',
                'jabatan'         => 'required',
                'mulai_kerja'     => 'required',
                'akhir_kerja'     => 'required',
                'gaji'            => 'required',
                'alasan_keluar'   => 'required'
            ],
            [
                'nama_perusahaan.required' => 'Nama Perusahaan Harus Diisi',
                'jabatan.required'         => 'Jabatan Harus Diisi',
                'mulai_kerja.required'     => 'Tanggal Mulai Harus Diisi',
                'akhir_kerja.required'     => 'Tanggal Akhir Harus Diisi',
                'gaji.required'            => 'Gaji Harus Diisi',
                'alasan_keluar.required'   => 'Alasan Keluar Harus Diisi'
            ]);

            $data_tampung = new data_tampung();
            $data_tampung->nama_perusahaan  = $validateData['nama_perusahaan'];
            $data_tampung->jabatan          = $validateData['jabatan'];
            $data_tampung->mulai_kerja      = $validateData['mulai_kerja'];
            $data_tampung->akhir_kerja      = $validateData['akhir_kerja'];
            $data_tampung->gaji             = $validateData['gaji'];
            $data_tampung->alasan_keluar    = $validateData['alasan_keluar'];
            $data_tampung->save();

            return redirect('data_karyawan?tab=tab_6');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(pengalaman_kerja $pengalaman_kerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengalaman_kerja $pengalaman_kerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $status_isi = $request->input('status_isi');
        if($status_isi == '1'){
            $pengalaman_kerja = pengalaman_kerja::where('data_pribadis_id', $request->data_pribadi_id)->get();
            
            // Update status_isi for each entry
            foreach ($pengalaman_kerja as $item) {
                $item->status_isi = $status_isi;
                $item->save();  // Save each entry individually
            }
            
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_7');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'nama_perusahaan' => 'required',
                'jabatan'         => 'required',
                'mulai_kerja'     => 'required',
                'akhir_kerja'     => 'required',
                'gaji'            => 'required',
                'alasan_keluar'   => 'required'
            ],
            [
                'nama_perusahaan.required' => 'Nama Perusahaan Harus Diisi',
                'jabatan.required'         => 'Jabatan Harus Diisi',
                'mulai_kerja.required'     => 'Tanggal Mulai Harus Diisi',
                'akhir_kerja.required'     => 'Tanggal Akhir Harus Diisi',
                'gaji.required'            => 'Gaji Harus Diisi',
                'alasan_keluar.required'   => 'Alasan Keluar Harus Diisi'
            ]);

            $pengalaman_kerja = pengalaman_kerja::where('id', $request->id)->first();
            $pengalaman_kerja->nama_perusahaan  = $validateData['nama_perusahaan'];
            $pengalaman_kerja->jabatan          = $validateData['jabatan'];
            $pengalaman_kerja->mulai            = $validateData['mulai_kerja'];
            $pengalaman_kerja->akhir            = $validateData['akhir_kerja'];
            $pengalaman_kerja->gaji             = $validateData['gaji'];
            $pengalaman_kerja->alasan_keluar    = $validateData['alasan_keluar'];
            $pengalaman_kerja->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_6');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengalaman_kerja $pengalaman_kerja)
    {
        //
    }
}
