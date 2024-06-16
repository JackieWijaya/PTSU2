<?php

namespace App\Http\Controllers;

use App\Models\bahasa_asing;
use App\Models\data_pribadi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BahasaAsingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
        $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
        $bahasa_asing_status = bahasa_asing::where('data_pribadis_id', $data_pribadi->id)->first();
        $bahasa_asing = bahasa_asing::where('data_pribadis_id', $data_pribadi->id)->get();
        // dd($bahasa_asing);
        return view('data_karyawan.bahasa_asing')->with('data_pribadi', $data_pribadi)->with('bahasa_asing_status', $bahasa_asing_status)->with('bahasa_asing', $bahasa_asing);
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
        $status_isi = $request->input('status_isi');

        // 1. Validasi
        $validateData = $request->validate([
            'lisan'   => 'required',
            'tulisan' => 'required'
        ],
        [
            'lisan.required'   => 'Pilih Nilai Keahlian',
            'tulisan.required' => 'Pilih Nilai Keahlian'
        ]);

        $bahasa_asing = new bahasa_asing();
        $bahasa_asing->data_pribadis_id = $request->id;
        $bahasa_asing->lisan            = $validateData['lisan'];
        $bahasa_asing->tulisan          = $validateData['tulisan'];
        $bahasa_asing->status_isi       = $status_isi;
        $bahasa_asing->save();

        Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
        return redirect('data_karyawan');
    }

    /**
     * Display the specified resource.
     */
    public function show(bahasa_asing $bahasa_asing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bahasa_asing $bahasa_asing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $status_isi = $request->input('status_isi');
        $bahasa_asing = bahasa_asing::where('data_pribadis_id', $request->data_pribadi_id)->first();
        if ($status_isi == '1') {
            $bahasa_asing->status_isi = $status_isi;
            $bahasa_asing->save();
            
            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan');
        } else {
            // 1. Validasi
            $validateData = $request->validate([
                'lisan'   => 'required',
                'tulisan' => 'required'
            ],
            [
                'lisan.required'   => 'Pilih Nilai Keahlian',
                'tulisan.required' => 'Pilih Nilai Keahlian'
            ]);

            $bahasa_asing->lisan   = $validateData['lisan'];
            $bahasa_asing->tulisan = $validateData['tulisan'];
            $bahasa_asing->save();

            Alert::success('Data Tersimpan', "Terima Kasih Sudah Mengisi Data");
            return redirect('data_karyawan?tab=tab_7');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bahasa_asing $bahasa_asing)
    {
        //
    }
}
