<?php

namespace App\Http\Controllers;

use App\Models\data_tampung;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataTampungController extends Controller
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
    public function show(data_tampung $data_tampung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_tampung $data_tampung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, data_tampung $data_tampung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, data_tampung $data_tampung)
    {
        //
        // dd($data_tampung);
        $tab = $request->input('tab');
        $data_tampung->delete();
        Alert::success('Berhasil', "Data Berhasil Dihapus");
        return redirect("data_karyawan?tab=$tab");
    }
}
