<?php

namespace App\Http\Controllers;

use App\Models\data_pribadi;
use App\Models\phk;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StatusPHKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
        $status = $request->input('status');
        $phk = phk::findOrFail($id);
        if ($status == 'Diterima') {
            $phk->status = $status;
            $phk->save();

            $data_pribadi = data_pribadi::where('nik', $phk->nik)->first();
            $user = User::where('id', $data_pribadi->users_id)->first();
            $user->status_user = 'Tidak Aktif';
            $user->save();

            Alert::success('Berhasil', "Pengajuan PHK Diterima");
            return redirect('phk');
        } else {
            $phk->status = $status;
            $phk->save();

            Alert::success('Berhasil', "Pengajuan PHK Ditolak");
            return redirect('phk');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
