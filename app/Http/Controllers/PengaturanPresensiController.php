<?php

namespace App\Http\Controllers;

use App\Models\pengaturan_presensi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengaturanPresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pengaturan_presensi = pengaturan_presensi::where('id', 1)->first();
        // dd($pengaturan_presensi);
        return view('pengaturan.presensi')->with('pengaturan_presensi', $pengaturan_presensi);
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
        // 1. Validasi
        $validateData = $request->validate([
            'lokasi_kantor' => 'required',
            'radius'        => 'required',
            'jam_masuk'     => 'required',
            'jam_keluar'    => 'required'
        ],
        [
            'lokasi_kantor.required' => 'Lokasi Kantor Harus Diisi',
            'radius.required'        => 'Radius Harus Diisi',
            'jam_masuk.required'     => 'Jam Masuk Harus Diisi',
            'jam_keluar.required'    => 'Jam Keluar Harus Diisi'
        ]);

        // 2. simpan
        $pengaturan_presensi = pengaturan_presensi::where('id', 1)->first();

        $pengaturan_presensi->lokasi     = $validateData['lokasi_kantor'];
        $pengaturan_presensi->radius     = $validateData['radius'];
        $pengaturan_presensi->jam_masuk  = $validateData['jam_masuk'];
        $pengaturan_presensi->jam_keluar = $validateData['jam_keluar'];
        $pengaturan_presensi->update();
        Alert::success('Berhasil', "Data Berhasil Diubah");
        return redirect()->route('pengaturan_presensi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(pengaturan_presensi $pengaturan_presensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengaturan_presensi $pengaturan_presensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pengaturan_presensi $pengaturan_presensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengaturan_presensi $pengaturan_presensi)
    {
        //
    }
}
