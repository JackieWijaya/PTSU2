<?php

namespace App\Http\Controllers;

use App\Models\jenis_cuti;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JenisCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jenis_cutis = jenis_cuti::all();
        return view('jenis_cuti.index')->with('jenis_cutis', $jenis_cutis);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('jenis_cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nama_jenis_cuti' => 'required|unique:jenis_cutis',
            'jatah'           => 'required|gt:-1'
        ],
        [
            'nama_jenis_cuti.required' => 'Nama Jabatan Harus Diisi',
            'nama_jenis_cuti.unique'   => 'Nama Jenis Cuti Sudah Ada',
            'jatah.required'           => 'Jatah Harus Diisi',
            'jatah.gt'                 => 'Jatah Tidak Boleh Min'
        ]);

        // 2. simpan
        $jenis_cuti = new jenis_cuti();
        $jenis_cuti->nama_jenis_cuti = $validateData['nama_jenis_cuti'];
        $jenis_cuti->jatah           = $validateData['jatah'];
        $jenis_cuti->save(); //Simpan Ke Tabel
        Alert::success('Berhasil', "Jenis Cuti Berhasil Ditambahkan");
        return redirect()->route('jenis_cuti.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(jenis_cuti $jenis_cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jenis_cuti $jenis_cuti)
    {
        //
        return view('jenis_cuti.edit')->with('jenis_cuti', $jenis_cuti);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jenis_cuti $jenis_cuti)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nama_jenis_cuti' => 'required',
            'jatah'           => 'required|gt:-1'
        ],
        [
            'nama_jenis_cuti.required' => 'Nama Jabatan Harus Diisi',
            'nama_jenis_cuti.unique'   => 'Nama Jenis Cuti Sudah Ada',
            'jatah.required'           => 'Jatah Harus Diisi',
            'jatah.gt'                 => 'Jatah Tidak Boleh Min'
        ]);

        // 2. simpan
        $jenis_cuti->nama_jenis_cuti = $validateData['nama_jenis_cuti'];
        $jenis_cuti->jatah           = $validateData['jatah'];
        $jenis_cuti->save(); //Simpan Ke Tabel
        Alert::success('Berhasil', "Jenis Cuti Dengan Kode $jenis_cuti->id Berhasil Diubah");
        return redirect()->route('jenis_cuti.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jenis_cuti $jenis_cuti)
    {
        //
        $jenis_cuti->delete();
        Alert::success('Berhasil', "Data Jenis Cuti Dengan Kode $jenis_cuti->id Jenis Cuti $jenis_cuti->nama_jenis_cuti Berhasil Dihapus");
        return redirect()->route('jenis_cuti.index');
    }
}
