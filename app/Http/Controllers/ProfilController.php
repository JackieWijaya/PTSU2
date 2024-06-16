<?php

namespace App\Http\Controllers;

use App\Models\data_pribadi;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::where('id', Auth::user()->id)->first();
        return view('pengaturan.profil')->with('users', $users);

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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'password' => ['confirmed'],
            'buku_nikah'          => 'image|max:800|mimes:jpg,jpeg,png'
        ],
        [
            'buku_nikah.image'             => 'File Harus Foto',   
            'buku_nikah.mimes'             => 'Format Harus .jpg/.jpeg/.png',
            'buku_nikah.max'               => 'Ukuran File Tidak Boleh Lebih Dari 800 KB'
        ]);

        $users = User::where('id', Auth::user()->id)->first();
        $foto = $users->foto;
        if($request->hasFile('buku_nikah')){
            $ext = $request->buku_nikah->getClientOriginalExtension();
            $foto = "foto-".time().".".$ext;
            $request->buku_nikah->storeAs('public/FotoProfil',$foto);
        }
        // $users = User::where('id', Auth::user()->id)->first();
        $users->name = $request->nama_lengkap;
        $users->no_hp = $request->no_hp;
        if(!empty($request->password))
    	{
    		$users->password = Hash::make($request->password);
    	}
        $users->foto = $foto;
    	$users->update();

        if(Auth::user()->role == 'Karyawan'){
            $data_pribadis = data_pribadi::where('no_hp', $users->no_hp)->first();
            $data_pribadis->nama_lengkap = $request->nama_lengkap;
            $data_pribadis->no_hp = $request->no_hp;
            $data_pribadis->update();
        }

    	Alert::success('Berhasil', 'Profil Berhasil Diupdate');
    	return redirect('profil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
