<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jabatans = jabatan::all();
        return view('jabatan.index')->with('jabatans', $jabatans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nama_jabatan' => 'required|unique:jabatans'
        ],
        [
            'nama_jabatan.required' => 'Nama Jabatan Harus Diisi',
            'nama_jabatan.unique'   => 'Nama Jabatan Sudah Ada'
        ]);

        // 2. simpan
        $jabatan = new jabatan();
        $jabatan->nama_jabatan  = $validateData['nama_jabatan'];
        $jabatan->save(); //Simpan Ke Tabel
        Alert::success('Berhasil', "Jabatan Berhasil Ditambahkan");
        return redirect()->route('jabatan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jabatan $jabatan)
    {
        //
        return view('jabatan.edit')->with('jabatan', $jabatan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, jabatan $jabatan)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nama_jabatan' => 'required'
        ],
        [
            'nama_jabatan.required' => 'Nama Jabatan Harus Diisi'
        ]);

        $jabatan->nama_jabatan = $validateData['nama_jabatan'];
        $jabatan->update();
        Alert::success('Berhasil', "Data Jabatan Dengan Kode $jabatan->id Berhasil Diubah");
        return redirect()->route('jabatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jabatan $jabatan)
    {
        //
        $jabatan->delete();
        Alert::success('Berhasil', "Data Jabatan Dengan Kode $jabatan->id $jabatan->nama_jabatan Berhasil Dihapus");
        return redirect()->route('jabatan.index');
    }
}
