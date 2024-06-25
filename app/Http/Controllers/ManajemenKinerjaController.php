<?php

namespace App\Http\Controllers;

use App\Models\data_pribadi;
use App\Models\manajemen_kinerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ManajemenKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->role != 'Karyawan') {
            $manajemen_kinerjas = manajemen_kinerja::all();
        } else {
            $data_pribadi = data_pribadi::where('users_id', Auth::user()->id)->first();
            $manajemen_kinerjas = manajemen_kinerja::where('nik', $data_pribadi->nik)->get();
        }
        
        return view('manajemen_kinerja.index')->with('manajemen_kinerjas', $manajemen_kinerjas);
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
            ->where('data_pribadis.nik', '!=', null)
            ->where('data_pribadis.jabatans_id', '!=', null)
            ->get();
        return view('manajemen_kinerja.create')->with('data_karyawan', $data_karyawan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nik'     => 'required',
            'jenis'   => 'required',
            'foto'    => 'file|image|max:2000|mimes:jpg,jpeg,png,pdf',
            'alasan'  => 'required',
            'catatan' => 'required'
        ],
        [
            'nik.required'     => 'Pilih Nama Karyawan',
            'jenis.required'   => 'Pilih Jenis',
            'foto.file'        => 'Foto / File Bukti Harus File',
            'foto.image'       => 'File Harus Foto',   
            'foto.mimes'       => 'Format Harus .jpg/.jpeg/.png/.pdf',
            'foto.max'         => 'Ukuran File Tidak Boleh Lebih Dari 2 MB',
            'alasan.required'  => 'Alasan Harus Diisi',
            'catatan.required' => 'Catatan Harus Diisi'
        ]);    

        $foto = '';
        if($request->hasFile('foto')){
            $extfoto = $request->foto->getClientOriginalExtension();
            $foto = "foto-".time().".".$extfoto;
            $request->foto->storeAs('public/FotoRewardPunishment',$foto);
        }

        $manajemen_kinerja = new manajemen_kinerja();
        $manajemen_kinerja->nik     = $validateData['nik'];
        $manajemen_kinerja->jenis   = $validateData['jenis'];
        $manajemen_kinerja->foto    = $foto;
        $manajemen_kinerja->alasan  = $validateData['alasan'];
        $manajemen_kinerja->catatan = $validateData['catatan'];
        $manajemen_kinerja->save();

        Alert::success('Berhasil', "Data Berhasil Ditambahkan");
        return redirect()->route('manajemen_kinerja.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(manajemen_kinerja $manajemen_kinerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(manajemen_kinerja $manajemen_kinerja)
    {
        //
        $data_karyawan = User::select('users.*', 'data_pribadis.*')
            ->join('data_pribadis', 'users.no_hp', '=', 'data_pribadis.no_hp')
            ->where('users.role', '!=', 'HRD')
            ->where('data_pribadis.nik', '!=', null)
            ->where('data_pribadis.jabatans_id', '!=', null)
            ->get();
        return view('manajemen_kinerja.edit')->with('manajemen_kinerja', $manajemen_kinerja)->with('data_karyawan', $data_karyawan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, manajemen_kinerja $manajemen_kinerja)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nik'     => 'required',
            'jenis'   => 'required',
            'foto'    => 'file|image|max:2000|mimes:jpg,jpeg,png,pdf',
            'alasan'  => 'required',
            'catatan' => 'required'
        ],
        [
            'nik.required'     => 'Pilih Nama Karyawan',
            'jenis.required'   => 'Pilih Jenis',
            'foto.file'        => 'Foto / File Bukti Harus File',
            'foto.image'       => 'File Harus Foto',   
            'foto.mimes'       => 'Format Harus .jpg/.jpeg/.png/.pdf',
            'foto.max'         => 'Ukuran File Tidak Boleh Lebih Dari 2 MB',
            'alasan.required'  => 'Alasan Harus Diisi',
            'catatan.required' => 'Catatan Harus Diisi'
        ]);    

        if($request->hasFile('foto')){
            $nama_foto_lama = $manajemen_kinerja->foto;
            Storage::delete(['public/FotoRewardPunishment/'.$nama_foto_lama]);
            $extfoto = $request->foto->getClientOriginalExtension();
            $nama_foto_baru = "foto-".time().".".$extfoto;
            $request->foto->storeAs('public/FotoRewardPunishment',$nama_foto_baru);
        } else {
            $validateData['foto'] = $manajemen_kinerja->foto;
            $nama_foto_baru = $validateData['foto'];
        }

        $manajemen_kinerja->nik     = $validateData['nik'];
        $manajemen_kinerja->jenis   = $validateData['jenis'];
        $manajemen_kinerja->foto    = $nama_foto_baru;
        $manajemen_kinerja->alasan  = $validateData['alasan'];
        $manajemen_kinerja->catatan = $validateData['catatan'];
        $manajemen_kinerja->save();

        Alert::success('Berhasil', "Data Berhasil Diubah");
        return redirect()->route('manajemen_kinerja.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(manajemen_kinerja $manajemen_kinerja)
    {
        //
        $manajemen_kinerja->delete();
        Alert::success('Berhasil', "Data Berhasil Dihapus");
        return redirect()->route('manajemen_kinerja.index');
    }
}
