<?php

namespace App\Http\Controllers;

use App\Models\data_keluarga_kandung;
use App\Models\data_pribadi;
use App\Models\data_tampung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DataKeluargaKandungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $data_keluarga_kandung_status = data_keluarga_kandung::where('data_pribadis_id', $data_pribadi->id)->first();
        $data_keluarga_kandung = data_keluarga_kandung::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($data_keluarga_kandung);
        return view('data_karyawan.data_keluarga_kandung')->with('data_pribadi', $data_pribadi)->with('data_keluarga_kandung_status', $data_keluarga_kandung_status)->with('data_keluarga_kandung', $data_keluarga_kandung);
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
        if ($status_isi == '1') {
            $data_tampung = data_tampung::all();
            foreach ($data_tampung as $data) {
                // Buat entri baru di data_keluarga_inti
                $data_keluarga_kandung = new data_keluarga_kandung();
                $data_keluarga_kandung->data_pribadis_id      = $request->id;
                $data_keluarga_kandung->status_keluarga       = $data->status_keluarga_kandung;
                $data_keluarga_kandung->nama_anggota_keluarga = $data->nama_anggota_keluarga_kandung;
                $data_keluarga_kandung->jenis_kelamin         = $data->jenis_kelamin;
                $data_keluarga_kandung->tempat_lahir          = $data->tempat_lahir_kandung;
                $data_keluarga_kandung->tanggal_lahir         = $data->tanggal_lahir_kandung;
                $data_keluarga_kandung->pendidikan            = $data->pendidikan_kandung;
                $data_keluarga_kandung->pekerjaan             = $data->pekerjaan_kandung;
                $data_keluarga_kandung->status_isi            = $status_isi;
                $data_keluarga_kandung->save();
            }
            // Hapus data_tampung
            data_tampung::truncate();
            
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_4');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'status_keluarga_kandung'       => 'required',
                'nama_anggota_keluarga_kandung' => 'required',
                'jenis_kelamin_kandung'         => 'required',
                'tempat_lahir_kandung'          => 'required',
                'tanggal_lahir_kandung'         => 'required',
                'pendidikan_kandung'            => 'required',
                'pekerjaan_kandung'             => 'required'
            ],
            [
                'status_keluarga_kandung.required'       => 'Pilih Status Keluarga',
                'nama_anggota_keluarga_kandung.required' => 'Nama Anggota Keluarga Harus Diisi',
                'jenis_kelamin_kandung.required'         => 'Pilih Jenis Kelamin',
                'tempat_lahir_kandung.required'          => 'Tempat Lahir Harus Diisi',
                'tanggal_lahir_kandung.required'         => 'Tanggal Lahir Harus Diisi',
                'pendidikan_kandung.required'            => 'Pilih Pendidikan',
                'pekerjaan_kandung.required'             => 'Pekerjaan Harus Diisi'
            ]);

            $data_tampung = new data_tampung();
            $data_tampung->status_keluarga_kandung       = $validateData['status_keluarga_kandung'];
            $data_tampung->nama_anggota_keluarga_kandung = $validateData['nama_anggota_keluarga_kandung'];
            $data_tampung->jenis_kelamin                 = $validateData['jenis_kelamin_kandung'];
            $data_tampung->tempat_lahir_kandung          = $validateData['tempat_lahir_kandung'];
            $data_tampung->tanggal_lahir_kandung         = $validateData['tanggal_lahir_kandung'];
            $data_tampung->pendidikan_kandung            = $validateData['pendidikan_kandung'];
            $data_tampung->pekerjaan_kandung             = $validateData['pekerjaan_kandung'];
            $data_tampung->save();

            return redirect('data_karyawan?tab=tab_3');
        }    
    }

    /**
     * Display the specified resource.
     */
    public function show(data_keluarga_kandung $data_keluarga_kandung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_keluarga_kandung $data_keluarga_kandung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $data_pribadi_id = $request->data_pribadi_id;
        $status_isi = $request->input('status_isi');

        if ($status_isi == '1') {
            // Get all data_keluarga_kandung entries related to the specific data_pribadi_id
            $data_keluarga_kandung = data_keluarga_kandung::where('data_pribadis_id', $data_pribadi_id)->get();
            
            // Update status_isi for each entry
            foreach ($data_keluarga_kandung as $item) {
                $item->status_isi = $status_isi;
                $item->save();  // Save each entry individually
            }
            
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_4');
        } else {
            // Validate the request data
            $validatedData = $request->validate([
                'status_keluarga_kandung'       => 'required',
                'nama_anggota_keluarga_kandung' => 'required',
                'jenis_kelamin_kandung'         => 'required',
                'tempat_lahir_kandung'          => 'required',
                'tanggal_lahir_kandung'         => 'required',
                'pendidikan_kandung'            => 'required',
                'pekerjaan_kandung'             => 'required'
            ], [
                'status_keluarga_kandung.required'       => 'Pilih Status Keluarga',
                'nama_anggota_keluarga_kandung.required' => 'Nama Anggota Keluarga Harus Diisi',
                'jenis_kelamin_kandung.required'         => 'Pilih Jenis Kelamin',
                'tempat_lahir_kandung.required'          => 'Tempat Lahir Harus Diisi',
                'tanggal_lahir_kandung.required'         => 'Tanggal Lahir Harus Diisi',
                'pendidikan_kandung.required'            => 'Pilih Pendidikan',
                'pekerjaan_kandung.required'             => 'Pekerjaan Harus Diisi'
            ]);

            // Find the specific data_keluarga_kandung entry by ID and update it
            $data_keluarga_kandung = data_keluarga_kandung::where('id', $id)->first();
            $data_keluarga_kandung->status_keluarga       = $validatedData['status_keluarga_kandung'];
            $data_keluarga_kandung->nama_anggota_keluarga = $validatedData['nama_anggota_keluarga_kandung'];
            $data_keluarga_kandung->jenis_kelamin         = $validatedData['jenis_kelamin_kandung'];
            $data_keluarga_kandung->tempat_lahir          = $validatedData['tempat_lahir_kandung'];
            $data_keluarga_kandung->tanggal_lahir         = $validatedData['tanggal_lahir_kandung'];
            $data_keluarga_kandung->pendidikan            = $validatedData['pendidikan_kandung'];
            $data_keluarga_kandung->pekerjaan             = $validatedData['pekerjaan_kandung'];
            $data_keluarga_kandung->update();  // Save the updated entry

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_3');
        }    
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_keluarga_kandung $data_keluarga_kandung)
    {
        //
    }
}
