<?php

namespace App\Http\Controllers;

use App\Models\devisi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DevisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $devisis = devisi::all();
        return view('devisi.index')->with('devisis', $devisis);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('devisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nama_devisi' => 'required|unique:devisis'
        ],
        [
            'nama_devisi.required' => 'Nama Devisi Harus Diisi',
            'nama_devisi.unique'   => 'Nama Devisi Sudah Ada'
        ]);

        // 2. simpan
        $devisi = new devisi();
        $devisi->nama_devisi  = $validateData['nama_devisi'];
        $devisi->save(); //Simpan Ke Tabel
        Alert::success('Berhasil', "Devisi Berhasil Ditambahkan");
        return redirect()->route('devisi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(devisi $devisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(devisi $devisi)
    {
        //
        return view('devisi.edit')->with('devisi', $devisi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, devisi $devisi)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nama_devisi' => 'required'
        ],
        [
            'nama_devisi.required' => 'Nama Devisi Harus Diisi'
        ]);

        $devisi->nama_devisi = $validateData['nama_devisi'];
        $devisi->update();
        Alert::success('Berhasil', "Data Devisi Dengan Kode $devisi->id Berhasil Diubah");
        return redirect()->route('devisi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(devisi $devisi)
    {
        //
        $devisi->delete();
        Alert::success('Berhasil', "Data Devisi Dengan Kode $devisi->id $devisi->nama_devisi Berhasil Dihapus");
        return redirect()->route('devisi.index');
    }
}
