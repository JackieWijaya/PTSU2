<?php

namespace App\Http\Controllers;

use App\Models\cuti;
use App\Models\data_pribadi;
use App\Models\jenis_cuti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->role != 'Karyawan') {
            $cutis = cuti::all();
        } else {
            $data_pribadi = data_pribadi::where('users_id', Auth::user()->id)->first();
            $cutis = cuti::where('nik', $data_pribadi->nik)->get();
        }
        return view('cuti.index')->with('cutis', $cutis);
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
            // ->where('data_pribadis.jabatans_id', '!=', null)
            ->get();
        $jenis_cutis = jenis_cuti::all();

        return view('cuti.create')->with('data_karyawan', $data_karyawan)->with('jenis_cutis', $jenis_cutis);
    }

    public function getsisacuti(Request $request)
    {
        $data_pribadi = data_pribadi::where('users_id', Auth::user()->id)->first();
        $tahun_cuti = date('Y');
        $jenis_cuti = jenis_cuti::where('id', $request->jenis_cuti)->first();
        $cuti = cuti::where('nik', $data_pribadi->nik)->where('jenis_cutis_id', $jenis_cuti->id)->where('status', 'Diterima')->whereYear('tanggal_mulai', $tahun_cuti)->sum('jumlah_hari');
        if (!$cuti) {
            $cuti = 0;
        }
        $sisa_cuti = $jenis_cuti->jatah - $cuti;

        return $sisa_cuti;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'jenis_cuti'      => 'required',
            'tanggal_mulai'   => 'required',
            'tanggal_selesai' => 'required',
            'keterangan'      => 'required'
        ],
        [
            'jenis_cuti .required'     => 'Pilih Jenis Cuti',
            'tanggal_mulai.required'   => 'Tanggal Mulai Harus Diisi',
            'tanggal_selesai.required' => 'Tanggal Selesai Harus Diisi',
            'keterangan.required'      => 'Keterangan Harus Diisi'
        ]);

        $data_pribadi = data_pribadi::where('users_id', Auth::user()->id)->first();
        $tahun_cuti = date('Y');
        $jenis_cuti = jenis_cuti::where('id', $validateData['jenis_cuti'])->first();
        $cuti = cuti::where('nik', $data_pribadi->nik)->where('jenis_cutis_id', $validateData['jenis_cuti'])->where('status', 'Diterima')->whereYear('tanggal_mulai', $tahun_cuti)->sum('jumlah_hari');
        if ($cuti + $request->jumlah_hari > $jenis_cuti->jatah  ) {
            Alert::error('Gagal', "Jatah Cuti Tidak Cukup");
            return redirect()->back();
        } else {
            $cuti = new cuti();
            $cuti->nik             = $data_pribadi->nik;
            $cuti->jenis_cutis_id  = $validateData['jenis_cuti'];
            $cuti->tanggal_mulai   = $validateData['tanggal_mulai'];
            $cuti->tanggal_selesai = $validateData['tanggal_selesai'];
            $cuti->jumlah_hari     = $request->jumlah_hari;
            $cuti->keterangan      = $validateData['keterangan'];
            $cuti->status          = '-';
            $cuti->save();

            Alert::success('Berhasil', "Pengajuan Berhasil Ditambahkan");
            return redirect()->route('cuti.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cuti $cuti)
    {
        //
        $status = $request->input('status');
        if ($status == 'Diterima') {
            $cuti->status = $status;
            $cuti->save();

            Alert::success('Berhasil', "Pengajuan Cuti Diterima");
            return redirect('cuti');
        } else {
            $cuti->status = $status;
            $cuti->save();

            Alert::success('Berhasil', "Pengajuan Cuti Ditolak");
            return redirect('cuti');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cuti $cuti)
    {
        //
        $cuti->delete();
        Alert::success('Berhasil', "Pengajuan Cuti Berhasil Dihapus");
        return redirect()->route('cuti.index');
    }
}
