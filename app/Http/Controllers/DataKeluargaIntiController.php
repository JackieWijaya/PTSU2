<?php

namespace App\Http\Controllers;

use App\Models\data_keluarga_inti;
use App\Models\data_pribadi;
use App\Models\data_tampung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DataKeluargaIntiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $data_keluarga_inti_status = data_keluarga_inti::where('data_pribadis_id', $data_pribadi->id)->first();
        $data_keluarga_inti = data_keluarga_inti::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($data_keluarga_inti);
        return view('data_karyawan.data_keluarga_inti')->with('data_pribadi', $data_pribadi)->with('data_keluarga_inti_status', $data_keluarga_inti_status)->with('data_keluarga_inti', $data_keluarga_inti);
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
        $status_keluarga = $request->status_keluarga_inti;
        $status_isi = $request->input('status_isi');
        if ($status_isi == '1') {
            $data_tampung = data_tampung::all();
            foreach ($data_tampung as $data) {
                // Buat entri baru di data_keluarga_inti
                $data_keluarga_inti = new data_keluarga_inti();
                $data_keluarga_inti->data_pribadis_id      = $request->id;
                $data_keluarga_inti->nik                   = $data->nik;
                $data_keluarga_inti->status_keluarga       = $data->status_keluarga_inti;
                $data_keluarga_inti->nama_anggota_keluarga = $data->nama_anggota_keluarga_inti;
                $data_keluarga_inti->ktp_pasangan          = $data->ktp_pasangan;
                $data_keluarga_inti->tempat_lahir          = $data->tempat_lahir_inti;
                $data_keluarga_inti->tanggal_lahir         = $data->tanggal_lahir_inti;
                $data_keluarga_inti->pendidikan            = $data->pendidikan_inti;
                $data_keluarga_inti->pekerjaan             = $data->pekerjaan_inti;
                $data_keluarga_inti->status_isi            = $status_isi;
                $data_keluarga_inti->save();
            }
            // Hapus data_tampung
            data_tampung::truncate();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_3');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'nik'                        => [
                    'required',
                    'numeric',
                    'gt:-1',
                    Rule::when($request->nik != '0', function () {
                        return ['digits_between:16,17'];
                    }),
                    Rule::unique('data_tampungs')->ignore(0)->where(function ($query) {
                        return $query->where('nik', '!=', 0); // Ignore record with id $data_pribadi->id and nik != 0
                    }),
                    Rule::unique('data_keluarga_intis')->ignore(0)->where(function ($query) {
                        return $query->where('nik', '!=', 0); // Ignore record with id $data_pribadi->id and nik != 0
                    })
                ],
                'status_keluarga_inti'       => 'required',
                'nama_anggota_keluarga_inti' => 'required',
                'ktp_pasangan'               => [
                    'image',
                    'max:800',
                    'mimes:jpg,jpeg,png',
                    Rule::requiredIf($status_keluarga == 'Istri' || $status_keluarga == 'Suami')
                ],
                'tempat_lahir_inti'          => 'required',
                'tanggal_lahir_inti'         => 'required',
                'pendidikan_inti'            => 'required',
                'pekerjaan_inti'             => 'required'
            ],
            [
                'nik.required'                        => 'NIK Harus Diisi',
                'nik.numeric'                         => 'NIK Harus Angka',
                'nik.gt'                              => 'NIK Tidak Boleh Min',
                'nik.digits_between'                  => 'NIK Harus 16-17 Digit',
                'nik.unique'                          => 'NIK Sudah Terdaftar',
                'status_keluarga_inti.required'       => 'Pilih Status Keluarga',
                'nama_anggota_keluarga_inti.required' => 'Nama Anggota Keluarga Harus Diisi',
                'ktp_pasangan.required'               => 'KTP Pasangan Harus Diisi',   
                'ktp_pasangan.image'                  => 'File Harus Foto',   
                'ktp_pasangan.mimes'                  => 'Format Harus .jpg/.jpeg/.png',
                'ktp_pasangan.max'                    => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
                'tempat_lahir_inti.required'          => 'Tempat Lahir Harus Diisi',
                'tanggal_lahir_inti.required'         => 'Tanggal Lahir Harus Diisi',
                'pendidikan_inti.required'            => 'Pilih Pendidikan',
                'pekerjaan_inti.required'             => 'Pekerjaan Harus Diisi'
            ]);

            $ktp_pasangan = '-';
            if($request->hasFile('ktp_pasangan')){
                $extktppasangan = $request->ktp_pasangan->getClientOriginalExtension();
                $ktp_pasangan = "ktp_pasangan-".time().".".$extktppasangan;
                $request->ktp_pasangan->storeAs('public/DataKaryawan',$ktp_pasangan);
            }

            $data_tampung = new data_tampung();
            $data_tampung->nik                        = $validateData['nik'];
            $data_tampung->status_keluarga_inti       = $validateData['status_keluarga_inti'];
            $data_tampung->nama_anggota_keluarga_inti = $validateData['nama_anggota_keluarga_inti'];
            $data_tampung->ktp_pasangan               = $ktp_pasangan;
            $data_tampung->tempat_lahir_inti          = $validateData['tempat_lahir_inti'];
            $data_tampung->tanggal_lahir_inti         = $validateData['tanggal_lahir_inti'];
            $data_tampung->pendidikan_inti            = $validateData['pendidikan_inti'];
            $data_tampung->pekerjaan_inti             = $validateData['pekerjaan_inti'];
            $data_tampung->save();

            return redirect('data_karyawan?tab=tab_2');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(data_keluarga_inti $data_keluarga_inti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_keluarga_inti $data_keluarga_inti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $data_keluarga_inti_status = data_keluarga_inti::where('data_pribadis_id', $request->data_pribadi_id)->first();
        $status_isi = $request->input('status_isi');
        if ($status_isi == '1') {
            // Get all data_keluarga_kandung entries related to the specific data_pribadi_id
            $data_keluarga_inti = data_keluarga_inti::where('data_pribadis_id', $request->data_pribadi_id)->get();
            
            // Update status_isi for each entry
            foreach ($data_keluarga_inti as $item) {
                $item->status_isi = $status_isi;
                $item->save();  // Save each entry individually
            }

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_3');
        } else {
            // dd($request->nik);
            // 1. Validasi
            $validateData = $request->validate([
                'nik'                        => [
                    'required',
                    'numeric',
                    'gt:-1',
                    Rule::when($request->nik != '0', function () {
                        return ['digits_between:16,17'];
                    }),
                    Rule::unique('data_keluarga_intis')->where(function ($query) {
                        return $query->where('nik', '!=', 0); // Ignore record with id $data_pribadi->id and nik != 0
                    })->ignore($request->id)
                ],
                'status_keluarga_inti'       => 'required',
                'nama_anggota_keluarga_inti' => 'required',
                'ktp_pasangan'               => [
                    'image',
                    'max:800',
                    'mimes:jpg,jpeg,png',
                    Rule::requiredIf($data_keluarga_inti_status->status_isi != 2)
                ],
                'tempat_lahir_inti'          => 'required',
                'tanggal_lahir_inti'         => 'required',
                'pendidikan_inti'            => 'required',
                'pekerjaan_inti'             => 'required'
            ],
            [
                'nik.required'                        => 'NIK Harus Diisi',
                'nik.numeric'                         => 'NIK Harus Angka',
                'nik.gt'                              => 'NIK Tidak Boleh Min',
                'nik.digits_between'                  => 'NIK Harus 16-17 Digit',
                'nik.unique'                          => 'NIK Sudah Terdaftar',
                'status_keluarga_inti.required'       => 'Pilih Status Keluarga',
                'nama_anggota_keluarga_inti.required' => 'Nama Anggota Keluarga Harus Diisi',
                'ktp_pasangan.required'               => 'KTP Pasangan Harus Diisi',   
                'ktp_pasangan.image'                  => 'File Harus Foto',   
                'ktp_pasangan.mimes'                  => 'Format Harus .jpg/.jpeg/.png',
                'ktp_pasangan.max'                    => 'Ukuran File Tidak Boleh Lebih Dari 800 KB',
                'tempat_lahir_inti.required'          => 'Tempat Lahir Harus Diisi',
                'tanggal_lahir_inti.required'         => 'Tanggal Lahir Harus Diisi',
                'pendidikan_inti.required'            => 'Pilih Pendidikan',
                'pekerjaan_inti.required'             => 'Pekerjaan Harus Diisi'
            ]);

            $data_keluarga_inti = data_keluarga_inti::where('id', $request->id)->first();
            if($request->hasFile('ktp_pasangan')){
                $nama_ktp_pasangan_lama = $data_keluarga_inti->ktp_pasangan;
                Storage::delete(['public/DataKaryawan/'.$nama_ktp_pasangan_lama]);
                $extktp_pasangan = $request->ktp_pasangan->getClientOriginalExtension();
                $nama_ktp_pasangan_baru = "ktp_pasangan-".time().".".$extktp_pasangan;
                $request->ktp_pasangan->storeAs('public/DataKaryawan',$nama_ktp_pasangan_baru);
            } else {
                $validateData['ktp_pasangan'] = $data_keluarga_inti->ktp_pasangan;
                $nama_ktp_pasangan_baru = $validateData['ktp_pasangan'];
            }

            $data_keluarga_inti->nik                   = $validateData['nik'];
            $data_keluarga_inti->status_keluarga       = $validateData['status_keluarga_inti'];
            $data_keluarga_inti->nama_anggota_keluarga = $validateData['nama_anggota_keluarga_inti'];
            $data_keluarga_inti->ktp_pasangan          = $nama_ktp_pasangan_baru;
            $data_keluarga_inti->tempat_lahir          = $validateData['tempat_lahir_inti'];
            $data_keluarga_inti->tanggal_lahir         = $validateData['tanggal_lahir_inti'];
            $data_keluarga_inti->pendidikan            = $validateData['pendidikan_inti'];
            $data_keluarga_inti->pekerjaan             = $validateData['pekerjaan_inti'];
            $data_keluarga_inti->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_2');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_keluarga_inti $data_keluarga_inti)
    {
        //
    }
}
