<?php

namespace App\Http\Controllers;

use App\Models\pelatihan_sertifikat;
use App\Models\data_pribadi;
use App\Models\data_tampung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PelatihanSertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $pelatihan_sertifikat_status = pelatihan_sertifikat::where('data_pribadis_id', $data_pribadi->id)->first();
        $pelatihan_sertifikat = pelatihan_sertifikat::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($pelatihan_sertifikat);
        return view('data_karyawan.pelatihan_sertifikat')->with('data_pribadi', $data_pribadi)->with('pelatihan_sertifikat_status', $pelatihan_sertifikat_status)->with('pelatihan_sertifikat', $pelatihan_sertifikat);
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
                $pelatihan_sertifikat = new pelatihan_sertifikat();
                $pelatihan_sertifikat->data_pribadis_id = $request->id;
                $pelatihan_sertifikat->nama_lembaga     = $data->nama_lembaga;
                $pelatihan_sertifikat->jenis            = $data->jenis;
                $pelatihan_sertifikat->mulai            = $data->mulai_pelatihan;
                $pelatihan_sertifikat->akhir            = $data->akhir_pelatihan;
                $pelatihan_sertifikat->sertifikat       = $data->sertifikat;
                $pelatihan_sertifikat->status_isi       = $status_isi;
                $pelatihan_sertifikat->save();
            }
            // Hapus data_tampung
            data_tampung::truncate();
            
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_6');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'nama_lembaga'    => 'required',
                'jenis'           => 'required',
                'mulai_pelatihan' => 'required',
                'akhir_pelatihan' => 'required',
                'sertifikat'      => 'required|file|image|max:2000|mimes:jpg,jpeg,png,pdf'
            ],
            [
                'nama_lembaga.required'    => 'Nama Lembaga Harus Diisi',
                'jenis.required'           => 'Jenis Harus Diisi',
                'mulai_pelatihan.required' => 'Tanggal Mulai Harus Diisi',
                'akhir_pelatihan.required' => 'Tanggal Akhir Harus Diisi',
                'sertifikat.required'      => 'Sertifikat Harus Diisi',
                'sertifikat.file'          => 'Sertifikat Harus File',
                'sertifikat.image'         => 'File Harus Foto',   
                'sertifikat.mimes'         => 'Format Sertifikat Harus .jpg/.jpeg/.png/.pdf',
                'sertifikat.max'           => 'Ukuran File Sertifikat Tidak Boleh Lebih Dari 2 MB'
            ]);

            $extsertifikat = $request->sertifikat->getClientOriginalExtension();
            $sertifikat = "sertifikat-".time().".".$extsertifikat;
            $request->sertifikat->storeAs('public/DataKaryawan',$sertifikat);

            $data_tampung = new data_tampung();
            $data_tampung->nama_lembaga     = $validateData['nama_lembaga'];
            $data_tampung->jenis            = $validateData['jenis'];
            $data_tampung->mulai_pelatihan  = $validateData['mulai_pelatihan'];
            $data_tampung->akhir_pelatihan  = $validateData['akhir_pelatihan'];
            $data_tampung->sertifikat       = $sertifikat;
            $data_tampung->save();

            return redirect('data_karyawan?tab=tab_5');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(pelatihan_sertifikat $pelatihan_sertifikat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pelatihan_sertifikat $pelatihan_sertifikat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $pelatihan_sertifikat_status = pelatihan_sertifikat::where('data_pribadis_id', $request->data_pribadi_id)->first();
        $status_isi = $request->input('status_isi');
        if($status_isi == '1'){
            // Get all data_keluarga_kandung entries related to the specific data_pribadi_id
            $pelatihan_sertifikat = pelatihan_sertifikat::where('data_pribadis_id', $request->data_pribadi_id)->get();
            
            // Update status_isi for each entry
            foreach ($pelatihan_sertifikat as $item) {
                $item->status_isi = $status_isi;
                $item->save();  // Save each entry individually
            }
            
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_6');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'nama_lembaga'    => 'required',
                'jenis'           => 'required',
                'mulai_pelatihan' => 'required',
                'akhir_pelatihan' => 'required',
                'sertifikat'      => [
                    'file',
                    'image',
                    'max:2000',
                    'mimes:jpg,jpeg,png,pdf',
                    Rule::requiredIf($pelatihan_sertifikat_status->status_isi != 2)
                ],
            ],
            [
                'nama_lembaga.required'    => 'Nama Lembaga Harus Diisi',
                'jenis.required'           => 'Jenis Harus Diisi',
                'mulai_pelatihan.required' => 'Tanggal Mulai Harus Diisi',
                'akhir_pelatihan.required' => 'Tanggal Akhir Harus Diisi',
                'sertifikat.required'      => 'Sertifikat Harus Diisi',
                'sertifikat.file'          => 'Sertifikat Harus File',
                'sertifikat.image'         => 'File Harus Foto',   
                'sertifikat.mimes'         => 'Format Sertifikat Harus .jpg/.jpeg/.png/.pdf',
                'sertifikat.max'           => 'Ukuran File Sertifikat Tidak Boleh Lebih Dari 2 MB'
            ]);

            $pelatihan_sertifikat = pelatihan_sertifikat::where('id', $request->id)->first();
            if($request->hasFile('sertifikat')){
                $nama_sertifikat_lama = $pelatihan_sertifikat->sertifikat;
                Storage::delete(['public/DataKaryawan/'.$nama_sertifikat_lama]);
                $extsertifikat = $request->sertifikat->getClientOriginalExtension();
                $nama_sertifikat_baru = "sertifikat-".time().".".$extsertifikat;
                $request->sertifikat->storeAs('public/DataKaryawan',$nama_sertifikat_baru);
            } else {
                $validateData['sertifikat'] = $pelatihan_sertifikat->sertifikat;
                $nama_sertifikat_baru = $validateData['sertifikat'];
            }

            $pelatihan_sertifikat->nama_lembaga     = $validateData['nama_lembaga'];
            $pelatihan_sertifikat->jenis            = $validateData['jenis'];
            $pelatihan_sertifikat->mulai            = $validateData['mulai_pelatihan'];
            $pelatihan_sertifikat->akhir            = $validateData['akhir_pelatihan'];
            $pelatihan_sertifikat->sertifikat       = $nama_sertifikat_baru;
            $pelatihan_sertifikat->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_5');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pelatihan_sertifikat $pelatihan_sertifikat)
    {
        //
    }
}
