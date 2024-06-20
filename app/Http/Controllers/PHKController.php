<?php

namespace App\Http\Controllers;

use App\Models\data_pribadi;
use App\Models\User;
use App\Models\phk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class PHKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::where('id', Auth::user()->id)->first();
        $data_pribadi = data_pribadi::where('users_id', Auth::user()->id)->first();

        if (Auth::user()->role == 'HRD') {
            $phks = phk::all();
        } else {
            $phks = phk::where('nik', $data_pribadi->nik)->get();
        }
        return view('phk.index')->with('phks', $phks)->with('user', $user);
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
                ->where('users.status_user', '=', 'Aktif')
                ->where('data_pribadis.nik', '!=', null)
                ->where('data_pribadis.jabatans_id', '!=', null)
                ->get();
        $data_pribadi = data_pribadi::where('users_id', Auth::user()->id)->first();

        return view('phk.create')->with('data_karyawan', $data_karyawan)->with('data_pribadi', $data_pribadi);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nik'     => [
                Rule::requiredIf(Auth::user()->role == 'HRD')
            ],
            'alasan'  => 'required',
            'catatan' => 'required'
        ],
        [
            'nik.required'     => 'Pilih Nama Karyawan',
            'alasan.required'  => 'Alasan Harus Diisi',
            'catatan.required' => 'Catatan Harus Diisi'
        ]);

        $data_pribadi = data_pribadi::where('users_id', Auth::user()->id)->first();
        if (Auth::user()->role == 'HRD') {
            $nik = $validateData['nik'];
            $status = '1';
            $label = 'PHK';
        } else {   
            $nik = $data_pribadi->nik;
            $status = '0';
            $label = 'Pengajuan';
        }

        $phk = new phk();
        $phk->nik     = $nik;
        $phk->alasan  = $validateData['alasan'];
        $phk->catatan = $validateData['catatan'];
        $phk->status  = $status;
        $phk->save();

        if (Auth::user()->role == 'HRD') {
            $data_pribadi = data_pribadi::where('nik', $nik)->first();
            $user = User::where('id', $data_pribadi->users_id)->first();
            $user->status_user =  'Tidak Aktif';
            $user->save();
        }
        
        Alert::success('Berhasil', "$label Berhasil Ditambahkan");
        return redirect('phk');
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
    public function edit(phk $phk)
    {
        //
        $data_karyawan = User::select('users.*', 'data_pribadis.*')
                ->join('data_pribadis', 'users.no_hp', '=', 'data_pribadis.no_hp')
                ->where('users.role', '!=', 'HRD')
                ->where('data_pribadis.nik', '!=', null)
                ->where('data_pribadis.jabatans_id', '!=', null)
                ->get();
        return view('phk.edit')->with('phk', $phk)->with('data_karyawan', $data_karyawan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, phk $phk)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nik'     => [
                Rule::requiredIf(Auth::user()->role == 'HRD')
            ],
            'alasan'  => 'required',
            'catatan' => 'required'
        ],
        [
            'nik.required'     => 'Pilih Nama Karyawan',
            'alasan.required'  => 'Alasan Harus Diisi',
            'catatan.required' => 'Catatan Harus Diisi'
        ]);

        if (Auth::user()->role == 'HRD') {
            $data_pribadi = data_pribadi::where('nik', $phk->nik)->first();
            $user = User::where('id', $data_pribadi->users_id)->first();
            $user->status_user =  'Aktif';
            $user->save();
        }

        $data_pribadi = data_pribadi::where('users_id', Auth::user()->id)->first();
        if (Auth::user()->role == 'HRD') {
            $nik = $validateData['nik'];
            $label = 'PHK';
        } else {   
            $nik = $data_pribadi->nik;
            $label = 'Pengajuan';
        }

        $phk->nik     = $nik;
        $phk->alasan  = $validateData['alasan'];
        $phk->catatan = $validateData['catatan'];
        $phk->save();

        if (Auth::user()->role == 'HRD') {
            $data_pribadi = data_pribadi::where('nik', $nik)->first();
            $user = User::where('id', $data_pribadi->users_id)->first();
            $user->status_user =  'Tidak Aktif';
            $user->save();
        }
        
        Alert::success('Berhasil', "Data $label Berhasil Diubah");
        return redirect('phk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(phk $phk)
    {
        //
        if (Auth::user()->role == 'HRD') {
            $data_pribadi = data_pribadi::where('nik', $phk->nik)->first();
            $user = User::where('id', $data_pribadi->users_id)->first();
            $user->status_user =  'Aktif';
            $user->save();
            $label = 'PHK';
        } else {   
            $label = 'Pengajuan';
        }

        $phk->delete();
        Alert::success('Berhasil', "$label Berhasil Dihapus");
        return redirect('phk');
    }
}
