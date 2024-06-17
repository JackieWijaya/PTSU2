<?php

namespace App\Http\Controllers;

use App\Models\data_pribadi;
use App\Models\devisi;
use App\Models\jabatan;
use App\Models\manajemen_jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ManajemenJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $manajemen_jabatans = manajemen_jabatan::all();
        return view('manajemen_jabatan.index')->with('manajemen_jabatans', $manajemen_jabatans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data_karyawan = User::select('users.*', 'data_pribadis.*')
            ->join('data_pribadis', 'users.no_hp', '=', 'data_pribadis.no_hp')
            ->where('users.role', '!=', 'HRD')
            ->where('data_pribadis.nik', '!=', '-')
            ->where('data_pribadis.jabatans_id', '!=', null)
            ->get();

        $devisi = '';
        $jabatan = '';  
        $devisis = devisi::all();
        $jabatans = jabatan::all();

        return view('manajemen_jabatan.create')->with('data_karyawan', $data_karyawan)->with('devisi', $devisi)->with('devisis', $devisis)->with('jabatan', $jabatan)->with('jabatans', $jabatans);
    }

    public function getDevisiJabatan(Request $request)
    {
        $nik = $request->input('nik');
        $devisi = '';
        $jabatan = '';
        $jabatanId = null;
        $devisiId = null;

        if ($nik) {
            $data_pribadi = data_pribadi::select('data_pribadis.*', 'jabatans.*', 'devisis.*')
                ->join('devisis', 'data_pribadis.devisis_id', '=', 'devisis.id')
                ->join('jabatans', 'data_pribadis.jabatans_id', '=', 'jabatans.id')
                ->where('data_pribadis.nik', $nik)
                ->first();
            if ($data_pribadi) {
                $devisi = $data_pribadi->nama_devisi;
                $jabatan = $data_pribadi->nama_jabatan;
                $devisiId = $data_pribadi->devisis_id;
                $jabatanId = $data_pribadi->jabatans_id;
            }
        }

        return response()->json(['devisi' => $devisi, 'jabatan' => $jabatan, 'devisiId' => $devisiId, 'jabatanId' => $jabatanId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $jenis = $request->jenis;

        // 1. Validasi
        $validateData = $request->validate([
            'nik'          => 'required',
            'jenis'        => 'required',
            'devisi_baru'  => [
                Rule::requiredIf($jenis != 'Mutasi')
            ],
            'jabatan_baru' => [
                Rule::requiredIf($jenis != 'Mutasi')
            ],
            'catatan'    => 'required'
        ],
        [
            'nik.required'          => 'Pilih Karyawan',
            'jenis.required'        => 'Pilih Jenis',
            'devisi_baru.required'  => 'Pilih Devisi Baru',
            'jabatan_baru.required' => 'Pilih Jabatan Baru',
            'catatan.required'      => 'Catatan Harus Diisi'
        ]);           
        
        if ($jenis == 'Mutasi') {
            $devisi_baru = '-';
            $jabatan_baru = '-';
        } else {
            $devisi_baru = $validateData['devisi_baru'];
            $devisi_baru = devisi::where('id', $devisi_baru)->first();
            $devisi_baru = $devisi_baru->nama_devisi;
            $jabatan_baru = $validateData['jabatan_baru'];
            $jabatan_baru = jabatan::where('id', $jabatan_baru)->first();
            $jabatan_baru = $jabatan_baru->nama_jabatan;
        }

        // 2. simpan
        $manajemen_jabatan = new manajemen_jabatan();
        $manajemen_jabatan->nik           = $validateData['nik'];
        $manajemen_jabatan->jenis         = $validateData['jenis'];
        $manajemen_jabatan->devisi_lama   = $request->devisi_lama;
        $manajemen_jabatan->jabatan_lama  = $request->jabatan_lama;
        $manajemen_jabatan->devisi_baru   = $devisi_baru;
        $manajemen_jabatan->jabatan_baru  = $jabatan_baru;
        $manajemen_jabatan->catatan       = $validateData['catatan'];
        $manajemen_jabatan->save(); //Simpan Ke Tabel

        $data_pribadi = data_pribadi::where('nik', $validateData['nik'])->first();

        if ($jenis != 'Mutasi') {
            $devisi_baru = $validateData['devisi_baru'];
            $jabatan_baru = $validateData['jabatan_baru'];
            $data_pribadi->devisis_id  = $devisi_baru;
            $data_pribadi->jabatans_id = $jabatan_baru;
            $data_pribadi->save();
        }

        Alert::success('Berhasil', "Data Berhasil Ditambahkan");
        return redirect()->route('manajemen_jabatan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(manajemen_jabatan $manajemen_jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(manajemen_jabatan $manajemen_jabatan)
    {
        //
        $data_karyawan = User::select('users.*', 'data_pribadis.*')
            ->join('data_pribadis', 'users.no_hp', '=', 'data_pribadis.no_hp')
            ->where('users.role', '!=', 'HRD')
            ->where('data_pribadis.nik', '!=', '-')
            ->where('data_pribadis.jabatans_id', '!=', null)
            ->get();

        $devisis = devisi::all();
        $jabatans = jabatan::all();

        if ($manajemen_jabatan->jenis != 'Mutasi') {
            $devisi_baru = devisi::where('nama_devisi', $manajemen_jabatan->devisi_baru)->first();
            $id_devisi_baru = $devisi_baru->id;
            $jabatan_baru = jabatan::where('nama_jabatan', $manajemen_jabatan->jabatan_baru)->first();
            $id_jabatan_baru = $jabatan_baru->id;
        } else {
            $id_devisi_baru = null;
            $id_jabatan_baru = null;
        }

        return view('manajemen_jabatan.edit')->with('manajemen_jabatan', $manajemen_jabatan)->with('data_karyawan', $data_karyawan)->with('devisis', $devisis)->with('jabatans', $jabatans)->with('id_devisi_baru', $id_devisi_baru)->with('id_jabatan_baru', $id_jabatan_baru);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, manajemen_jabatan $manajemen_jabatan)
    {
        //
        $jenis = $request->jenis;

        // 1. Validasi
        $validateData = $request->validate([
            'nik'          => 'required',
            'jenis'        => 'required',
            'devisi_baru'  => [
                Rule::requiredIf($jenis != 'Mutasi')
            ],
            'jabatan_baru' => [
                Rule::requiredIf($jenis != 'Mutasi')
            ],
            'catatan'    => 'required'
        ],
        [
            'nik.required'          => 'Pilih Karyawan',
            'jenis.required'        => 'Pilih Jenis',
            'devisi_baru.required'  => 'Pilih Devisi Baru',
            'jabatan_baru.required' => 'Pilih Jabatan Baru',
            'catatan.required'      => 'Catatan Harus Diisi'
        ]);           
        
        if ($jenis == 'Mutasi') {
            $devisi_baru = '-';
            $jabatan_baru = '-';
        } else {
            $devisi_baru = $validateData['devisi_baru'];
            $devisi_baru = devisi::where('id', $devisi_baru)->first();
            $devisi_baru = $devisi_baru->nama_devisi;
            $jabatan_baru = $validateData['jabatan_baru'];
            $jabatan_baru = jabatan::where('id', $jabatan_baru)->first();
            $jabatan_baru = $jabatan_baru->nama_jabatan;
        }

        // 2. simpan
        $manajemen_jabatan->nik           = $validateData['nik'];
        $manajemen_jabatan->jenis         = $validateData['jenis'];
        $manajemen_jabatan->devisi_lama   = $request->devisi_lama;
        $manajemen_jabatan->jabatan_lama  = $request->jabatan_lama;
        $manajemen_jabatan->devisi_baru   = $devisi_baru;
        $manajemen_jabatan->jabatan_baru  = $jabatan_baru;
        $manajemen_jabatan->catatan       = $validateData['catatan'];
        $manajemen_jabatan->save(); //Simpan Ke Tabel

        $devisi_baru = devisi::where('nama_devisi', $request->devisi_lama)->first();
        $jabatan_baru = jabatan::where('nama_jabatan', $request->jabatan_lama)->first();
        $data_pribadi = data_pribadi::where('nik', $validateData['nik'])->first();

        if ($jenis != 'Mutasi') {
            $devisi_baru = $validateData['devisi_baru'];
            $jabatan_baru = $validateData['jabatan_baru'];
            $data_pribadi->devisis_id  = $devisi_baru;
            $data_pribadi->jabatans_id = $jabatan_baru;
            $data_pribadi->save();
        } else {
            $devisi_baru = $devisi_baru->id;
            $jabatan_baru = $jabatan_baru->id;
            $data_pribadi->devisis_id  = $devisi_baru;
            $data_pribadi->jabatans_id = $jabatan_baru;
            $data_pribadi->save();
        }

        Alert::success('Berhasil', "Data Berhasil Diupdate");
        return redirect()->route('manajemen_jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(manajemen_jabatan $manajemen_jabatan)
    {
        //
        echo 'Test';
    }
}
