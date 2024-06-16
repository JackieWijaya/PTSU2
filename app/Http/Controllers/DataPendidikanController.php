<?php

namespace App\Http\Controllers;

use App\Models\data_pendidikan;
use App\Models\data_pribadi;
use App\Models\data_tampung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $data_pendidikan_status = data_pendidikan::where('data_pribadis_id', $data_pribadi->id)->first();
        $data_pendidikan = data_pendidikan::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($data_pendidikan);
        return view('data_karyawan.data_pendidikan')->with('data_pribadi', $data_pribadi)->with('data_pendidikan_status', $data_pendidikan_status)->with('data_pendidikan', $data_pendidikan);
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
                $data_pendidikan = new data_pendidikan();
                $data_pendidikan->data_pribadis_id = $request->id;
                $data_pendidikan->jenjang          = $data->jenjang;
                $data_pendidikan->fakultas         = $data->fakultas;
                $data_pendidikan->nama_sekolah     = $data->nama_sekolah;
                $data_pendidikan->jurusan          = $data->jurusan;
                $data_pendidikan->tahun_masuk      = $data->tahun_masuk;
                $data_pendidikan->tahun_lulus      = $data->tahun_lulus;
                $data_pendidikan->status_isi       = $status_isi;
                $data_pendidikan->save();
            }
            // Hapus data_tampung
            data_tampung::truncate();
            
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_5');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'jenjang'      => 'required',
                'fakultas'     => 'required',
                'nama_sekolah' => 'required',
                'jurusan'      => 'required',
                'tahun_masuk'  => 'required',
                'tahun_lulus'  => 'required'
            ],
            [
                'jenjang.required'      => 'Pilih Jenjang',
                'fakultas.required'     => 'Fakultas Harus Diisi',
                'nama_sekolah.required' => 'Nama Sekolah Harus Diisi',
                'jurusan.required'      => 'Jurusan Harus Diisi',
                'tahun_masuk.required'  => 'Tahun Masuk Harus Diisi',
                'tahun_lulus.required'  => 'Tahun Lulus Harus Diisi'
            ]);

            $data_tampung = new data_tampung();
            $data_tampung->jenjang          = $validateData['jenjang'];
            $data_tampung->fakultas         = $validateData['fakultas'];
            $data_tampung->nama_sekolah     = $validateData['nama_sekolah'];
            $data_tampung->jurusan          = $validateData['jurusan'];
            $data_tampung->tahun_masuk      = $validateData['tahun_masuk'];
            $data_tampung->tahun_lulus      = $validateData['tahun_lulus'];
            $data_tampung->save();

            return redirect('data_karyawan?tab=tab_4');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(data_pendidikan $data_pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_pendidikan $data_pendidikan)
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
            $data_pendidikan = data_pendidikan::where('data_pribadis_id', $request->data_pribadi_id)->get();
            
            // Update status_isi for each entry
            foreach ($data_pendidikan as $item) {
                $item->status_isi = $status_isi;
                $item->save();  // Save each entry individually
            }
            
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_5');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'jenjang'      => 'required',
                'fakultas'     => 'required',
                'nama_sekolah' => 'required',
                'jurusan'      => 'required',
                'tahun_masuk'  => 'required',
                'tahun_lulus'  => 'required'
            ],
            [
                'jenjang.required'      => 'Pilih Jenjang',
                'fakultas.required'     => 'Fakultas Harus Diisi',
                'nama_sekolah.required' => 'Nama Sekolah Harus Diisi',
                'jurusan.required'      => 'Jurusan Harus Diisi',
                'tahun_masuk.required'  => 'Tahun Masuk Harus Diisi',
                'tahun_lulus.required'  => 'Tahun Lulus Harus Diisi'
            ]);

            $data_pendidikan = data_pendidikan::where('id', $request->id)->first();
            $data_pendidikan->jenjang          = $validateData['jenjang'];
            $data_pendidikan->fakultas         = $validateData['fakultas'];
            $data_pendidikan->nama_sekolah     = $validateData['nama_sekolah'];
            $data_pendidikan->jurusan          = $validateData['jurusan'];
            $data_pendidikan->tahun_masuk      = $validateData['tahun_masuk'];
            $data_pendidikan->tahun_lulus      = $validateData['tahun_lulus'];
            $data_pendidikan->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_4');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_pendidikan $data_pendidikan)
    {
        //
    }
}
