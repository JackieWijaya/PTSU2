<?php

namespace App\Http\Controllers;

use App\Models\data_karyawan;
use App\Models\devisi;
use App\Models\jabatan;
use App\Models\data_pribadi;
use App\Models\data_keluarga_inti;
use App\Models\data_keluarga_kandung;
use App\Models\data_pendidikan;
use App\Models\pelatihan_sertifikat;
use App\Models\pengalaman_kerja;
use App\Models\bahasa_asing;
use App\Models\data_tampung;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Echo_;
use RealRashid\SweetAlert\Facades\Alert;

class DataKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::user()->role == 'HRD'){
            $data_karyawan = User::select('users.*', 'data_pribadis.*')
                ->join('data_pribadis', 'users.no_hp', '=', 'data_pribadis.no_hp')
                ->where('users.role', '!=', 'HRD')
                ->get();
            return view('data_karyawan.index')->with('data_karyawan', $data_karyawan);
        } else {
            $no_hp = Auth::user()->no_hp; // Mengambil pengguna yang sedang login
            $data_pribadi = data_pribadi::where('no_hp', $no_hp)->first();
            $data_keluarga_inti = data_keluarga_inti::where('data_pribadis_id', $data_pribadi->id)->get();
            $data_keluarga_inti_status = data_keluarga_inti::where('data_pribadis_id', $data_pribadi->id)->first();
            $data_keluarga_kandung = data_keluarga_kandung::where('data_pribadis_id', $data_pribadi->id)->get();
            $data_keluarga_kandung_status = data_keluarga_kandung::where('data_pribadis_id', $data_pribadi->id)->first();
            $data_pendidikan = data_pendidikan::where('data_pribadis_id', $data_pribadi->id)->get();
            $data_pendidikan_status = data_pendidikan::where('data_pribadis_id', $data_pribadi->id)->first();
            $pelatihan_sertifikat = pelatihan_sertifikat::where('data_pribadis_id', $data_pribadi->id)->get();
            $pelatihan_sertifikat_status = pelatihan_sertifikat::where('data_pribadis_id', $data_pribadi->id)->first();
            $pengalaman_kerja = pengalaman_kerja::where('data_pribadis_id', $data_pribadi->id)->get();
            $pengalaman_kerja_status = pengalaman_kerja::where('data_pribadis_id', $data_pribadi->id)->first();
            $bahasa_asing = bahasa_asing::where('data_pribadis_id', $data_pribadi->id)->first();
            $data_tampungs = data_tampung::all();

            return view('data_karyawan.index')->with('data_pribadi', $data_pribadi)->with('data_keluarga_inti', $data_keluarga_inti)->with('data_keluarga_inti_status', $data_keluarga_inti_status)->with('data_keluarga_kandung', $data_keluarga_kandung)->with('data_keluarga_kandung_status', $data_keluarga_kandung_status)->with('data_pendidikan', $data_pendidikan)->with('data_pendidikan_status', $data_pendidikan_status)->with('pelatihan_sertifikat', $pelatihan_sertifikat)->with('pelatihan_sertifikat_status', $pelatihan_sertifikat_status)->with('pengalaman_kerja', $pengalaman_kerja)->with('pengalaman_kerja_status', $pengalaman_kerja_status)->with('bahasa_asing', $bahasa_asing)->with('data_tampungs', $data_tampungs);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $devisis = devisi::all();
        $jabatans = jabatan::all();
        return view('data_karyawan.create')->with('devisis', $devisis)->with('jabatans', $jabatans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // 1. Validasi
        $validateData = $request->validate([
            'nama_lengkap'        => 'required', 
            'no_hp'               => 'required|numeric|gt:-1|unique:users',
            'jenis_kelamin'       => 'required', 
            'jabatan'             => 'required', 
            'devisi'              => 'required', 
            'golongan'            => 'required',
            'tanggal_masuk_kerja' => 'required'
        ],
        [
            'nama_lengkap.required'        => 'Nama Lengkap Harus Diisi',
            'no_hp.required'               => 'No HP Harus Diisi',
            'no_hp.numeric'                => 'No HP Harus Angka',
            'no_hp.gt'                     => 'No HP Tidak Boleh Min',
            'no_hp.unique'                 => 'No HP Sudah Terdaftar',
            'jenis_kelamin.required'       => 'Pilih Jenis Kelamin',
            'jabatan.required'             => 'Pilih Jabatan',
            'devisi.required'              => 'Pilih Devisi',
            'golongan.required'            => 'Golongan Harus Diisi',
            'tanggal_masuk_kerja.required' => 'Tanggal Masuk Kerja Harus Diisi'
        ]);

        $user = new User();
        $user->name     = $validateData['nama_lengkap'];
        $user->no_hp    = $validateData['no_hp'];
        $user->password = $validateData['no_hp'];
        $user->save();

        $data_pribadi = new data_pribadi();
        $data_pribadi->users_id            = $user->id; 
        $data_pribadi->nama_lengkap        = $validateData['nama_lengkap'];
        $data_pribadi->tanggal_lahir       = '-';
        $data_pribadi->jenis_kelamin       = $validateData['jenis_kelamin'];
        $data_pribadi->tempat_lahir        = '-';
        $data_pribadi->no_hp               = $validateData['no_hp'];
        $data_pribadi->email               = '-';
        $data_pribadi->alamat              = '-';
        $data_pribadi->pendidikan_terakhir = '-';
        $data_pribadi->agama               = '-';
        $data_pribadi->golongan_darah      = '-';
        $data_pribadi->jabatans_id         = $validateData['jabatan'];
        $data_pribadi->devisis_id          = $validateData['devisi'];
        $data_pribadi->golongan            = $validateData['golongan'];
        $data_pribadi->tanggal_masuk_kerja = $validateData['tanggal_masuk_kerja'];
        $data_pribadi->save();

        Alert::success('Berhasil', "Data Karyawan Berhasil Ditambahkan");
        return redirect()->route('data_karyawan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $data_pribadi_id = $request->query('id');
        $data_pribadi = data_pribadi::where('id', $data_pribadi_id)->first();
        $data_keluarga_inti = data_keluarga_inti::where('data_pribadis_id', $data_pribadi_id)->get();
        $data_keluarga_kandung = data_keluarga_kandung::where('data_pribadis_id', $data_pribadi_id)->get();
        $data_pendidikan = data_pendidikan::where('data_pribadis_id', $data_pribadi_id)->get();
        $pelatihan_sertifikat = pelatihan_sertifikat::where('data_pribadis_id', $data_pribadi_id)->get();
        $pengalaman_kerja = pengalaman_kerja::where('data_pribadis_id', $data_pribadi_id)->get();
        $bahasa_asing = bahasa_asing::where('data_pribadis_id', $data_pribadi_id)->first();
        return view('data_karyawan.detail_info')->with('data_pribadi', $data_pribadi)->with('data_keluarga_inti', $data_keluarga_inti)->with('data_keluarga_kandung', $data_keluarga_kandung)->with('data_pendidikan', $data_pendidikan)->with('pelatihan_sertifikat', $pelatihan_sertifikat)->with('pengalaman_kerja', $pengalaman_kerja)->with('bahasa_asing', $bahasa_asing);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data_pribadi = data_pribadi::where('id', $id)->first();
        $devisis = devisi::all();
        $jabatans = jabatan::all();
        return view('data_karyawan.data_pribadi_hrd')->with('data_pribadi', $data_pribadi)->with('devisis', $devisis)->with('jabatans', $jabatans);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $update_status_isi = $request->input('status_isi');
        // dd($update_status_isi);

        if($update_status_isi == '2'){
            $data_pribadi = data_pribadi::findOrFail($id);
            $data_pribadi->status_isi = $update_status_isi;
            $data_pribadi->update();
            $data_keluarga_inti = data_keluarga_inti::where('data_pribadis_id', $id)->get();
            if($data_keluarga_inti->isNotEmpty()){
                // Loop melalui setiap entri dan perbarui status_isi
                foreach ($data_keluarga_inti as $data) {
                    $data->status_isi = $update_status_isi;
                    $data->update();
                }
            }
            $data_keluarga_kandung = data_keluarga_kandung::where('data_pribadis_id', $id)->get();
            if($data_keluarga_kandung->isNotEmpty()){
                // Loop melalui setiap entri dan perbarui status_isi
                foreach ($data_keluarga_kandung as $data) {
                    $data->status_isi = $update_status_isi;
                    $data->update();
                }
            }
            $data_pendidikan = data_pendidikan::where('data_pribadis_id', $id)->get();
            if($data_pendidikan->isNotEmpty()){
                // Loop melalui setiap entri dan perbarui status_isi
                foreach ($data_pendidikan as $data) {
                    $data->status_isi = $update_status_isi;
                    $data->update();
                }
            }
            $pelatihan_sertifikat = pelatihan_sertifikat::where('data_pribadis_id', $id)->get();
            if($pelatihan_sertifikat->isNotEmpty()){
                // Loop melalui setiap entri dan perbarui status_isi
                foreach ($pelatihan_sertifikat as $data) {
                    $data->status_isi = $update_status_isi;
                    $data->update();
                }
            }
            $pengalaman_kerja = pengalaman_kerja::where('data_pribadis_id', $id)->get();
            if($pengalaman_kerja->isNotEmpty()){
                // Loop melalui setiap entri dan perbarui status_isi
                foreach ($pengalaman_kerja as $data) {
                    $data->status_isi = $update_status_isi;
                    $data->update();
                }
            }
            $bahasa_asing = bahasa_asing::where('data_pribadis_id', $id)->first();
            if($bahasa_asing){
                $bahasa_asing->status_isi = $update_status_isi;
                $bahasa_asing->update();
            }
            Alert::success('Berhasil', "Akses Edit Data Karyawan Dengan NIK $data_pribadi->nik Atas Nama $data_pribadi->nama_lengkap Berhasil Dibuka");
            return redirect()->route('data_karyawan.index');
        } else {      
            // 1. Validasi
            $validateData = $request->validate([
                'jabatan'             => 'required', 
                'devisi'              => 'required', 
                'golongan'            => 'required',
                'tanggal_masuk_kerja' => 'required'
            ],
            [
                'jabatan.required'             => 'Pilih Jabatan',
                'devisi.required'              => 'Pilih Devisi',
                'golongan.required'            => 'Golongan Harus Diisi',
                'tanggal_masuk_kerja.required' => 'Tanggal Masuk Kerja Harus Diisi'
            ]);

            $data_pribadi = data_pribadi::findOrFail($id);
            $data_pribadi->jabatans_id         = $validateData['jabatan'];
            $data_pribadi->devisis_id          = $validateData['devisi'];
            $data_pribadi->golongan            = $validateData['golongan'];
            $data_pribadi->tanggal_masuk_kerja = $validateData['tanggal_masuk_kerja'];
            $data_pribadi->update();

            Alert::success('Berhasil', "Data Pribadi $data_pribadi->nama_lengkap Berhasil Disimpan");
            return redirect()->route('data_karyawan.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data_pribadi = data_pribadi::findOrFail($id);
        User::where('no_hp', $data_pribadi->no_hp)->delete();
        data_pribadi::where('id', $id)->delete();
        data_keluarga_inti::where('data_pribadis_id', $id)->delete();
        data_keluarga_kandung::where('data_pribadis_id', $id)->delete();
        data_pendidikan::where('data_pribadis_id', $id)->delete();
        pelatihan_sertifikat::where('data_pribadis_id', $id)->delete();
        pengalaman_kerja::where('data_pribadis_id', $id)->delete();
        bahasa_asing::where('data_pribadis_id', $id)->delete();

        Alert::success('Berhasil', "Data Karyawan Atas Nama $data_pribadi->nama_lengkap Berhasil Dihapus");
        return redirect()->route('data_karyawan.index');
    }
}
